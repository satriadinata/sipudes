<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Akun_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Akun RT/RW';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==4){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==3){
			$this->load->view('akun/index',$data);
		}
	}
	public function add()
	{
		$data['title']='Akun RT/RW';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga']= $this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->result();
		$this->load->view('akun/add',$data);
	}
	public function post()
	{
		$this->form_validation->set_rules('rt','RT','min_length[3]|max_length[3]');
		$this->form_validation->set_rules('rw','RW','min_length[3]|max_length[3]');
		$data=$this->input->post();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$data['updated_at']=date('Y-m-d H:i:s');
		if ($this->form_validation->run()) {
			$this->db->insert('users', $data);
			$this->session->set_flashdata('message', 'Data berhasil di input');
			redirect(site_url('akun'));
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('akun/add'));
		}
	}
	public function getAll()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$wargas = $this->Akun_model->get_data($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {
			if ($r->user_role==2){
				$role='RW';
			}elseif($r->user_role==1){
				$role='RT';
			}
			$data[] = array(
				$r->email,
				$r->password,
				$role,
				$r->rt,
				$r->rw,
				"<button class='btn btn-primary' data-toggle='modal' data-target='#modal-edit' onclick='edit($r->id_user)'>Edit</button> ".
				"<button id='hps".$r->id_user."' class='btn btn-danger' onclick='hapus($r->id_user)'>Hapus</button>",
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $wargas->num_rows(),
			"recordsFiltered" => $wargas->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	public function edit()
	{
		$id=$this->input->post('id');
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		$data['calon']=$this->db->get_where('users',['id_user'=>$id])->row_array();
		$data['warga']=$this->db->get_where('warga',['kode_desa'=>$kode_desa])->result();
		$this->load->view('akun/edit', $data);
	}
	public function update()
	{
		$this->form_validation->set_rules('rt','RT','min_length[3]|max_length[3]');
		$this->form_validation->set_rules('rw','RW','min_length[3]|max_length[3]');
		$data=$this->input->post();
		$data['updated_at']=date('Y-m-d H:i:s');
		if ($this->form_validation->run()) {
			$this->db->where('id_user', $data['id_user']);
			$this->db->update('users', $data);
			$this->session->set_flashdata('message', 'Data berhasil di update');
			redirect(site_url('akun'));
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('errPE', validation_errors());
			redirect(site_url('akun'));	
		}
	}
	public function detail()
	{
		$id=$this->input->post('id');
		$data['calon']=$this->db->get_where('warga',['id_warga'=>$id])->row_array();
		$this->load->view('warga/detail', $data);
	}
	public function hapus()
	{
		$id=$this->input->post('id');
		$this->db->delete('users', ['id_user'=>$id]);
	}
}
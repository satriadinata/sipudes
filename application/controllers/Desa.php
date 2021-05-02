<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Desa_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')['user_role']!=4) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Akun Desa';
		$data['user'] = $this->session->userdata('user_logged');
		$this->load->view('desa/index', $data);
	}
	public function add()
	{
		$data['title']='Akun Desa';
		$data['user'] = $this->session->userdata('user_logged');
		$this->load->view('desa/add',$data);
	}
	public function post()
	{
		$this->form_validation->set_rules('kode_desa','Kode Desa','required|max_length[11]|is_unique[users.kode_desa]');
		$data=$this->input->post();
		$data['created_at']=date('Y-m-d H:i:s');
		$data['updated_at']=date('Y-m-d H:i:s');
		$data['user_role']=3;
		
		if ($this->form_validation->run()) {
			$this->db->insert('users', $data);
			$this->session->set_flashdata('message', 'Data berhasil di input');
			redirect(site_url('desa'));
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('desa/add'));
		}
	}
	public function getAll()
	{
		$ser=$this->session->userdata('user_logged');
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$wargas = $this->Desa_model->get_data();
		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->kode_desa,
				$r->nama_desa,
				$r->email,
				$r->password,
				"<button data-toggle='modal' data-target='#modal-det' class='btn btn-success' onclick='det($r->id_user)'>Detail</button> "."<button class='btn btn-primary' data-toggle='modal' data-target='#modal-edit' onclick='edit($r->id_user)'>Edit</button> ".
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
		$data['calon']=$this->db->get_where('users',['id_user'=>$id])->row_array();
		$this->load->view('desa/edit', $data);
	}
	public function update()
	{
		$desa=$this->db->get_where('users',['id_user'=>$this->input->post()['id_user']])->row_array();
		if ($this->input->post()['kode_desa']!=$desa['kode_desa']) {
			$this->form_validation->set_rules('kode_desa','Kode Desa','required|max_length[11]|is_unique[users.kode_desa]');
			$data=$this->input->post();
			$data['updated_at']=date('Y-m-d H:i:s');
			if ($this->form_validation->run()) {
				$this->db->where('id_user', $data['id_user']);
				$this->db->update('users', $data);
				$this->session->set_flashdata('message', 'Data berhasil di update');
				redirect(site_url('desa'));
			}else{
				$this->session->set_flashdata('input', $data);
				$this->session->set_flashdata('errPE', validation_errors());
				redirect(site_url('desa'));	
			}
		}else{
			$data=$this->input->post();
			$data['updated_at']=date('Y-m-d H:i:s');
			$this->db->where('id_user', $data['id_user']);
			$this->db->update('users', $data);
			$this->session->set_flashdata('message', 'Data berhasil di update');
			redirect(site_url('desa'));

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

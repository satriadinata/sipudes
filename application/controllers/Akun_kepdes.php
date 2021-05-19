<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Akun_kepdes extends CI_Controller {

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
		$data['title']='Akun KEPDES';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5 || $this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('akun_kepdes/index',$data);
		}
	}
	public function add()
	{
		$data['title']='Akun KEPDES';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] = $this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->result();
		$this->load->view('akun_kepdes/add',$data);
	}
	public function post()
	{
		$data=$this->input->post();
		$data['id_warga']=$this->db->get_where('warga',['nik_warga'=>$data['email']])->row_array()['id_warga'];
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['nama_desa']=$this->session->userdata('user_logged')['nama_desa'];
		if ( empty($data['password'])) {
			$tgl=$this->db->get_where('warga',['nik_warga'=>$data['email']])->row_array()['tanggal_lahir_warga'];
			$tgl_explode=explode('-', $tgl);
			$data['password']=$tgl_explode[2].$tgl_explode[1].$tgl_explode[0];
		}
		$data['user_role']=3;
		$data['created_at']=date('Y-m-d H:i:s');
		$data['updated_at']=date('Y-m-d H:i:s');

		$this->db->insert('users', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input');
		redirect(site_url('akun_kepdes'));
	}
	public function getAll()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$wargas = $this->Akun_model->get_kepdes($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->email,
				$r->nama_warga,
				$r->password,
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
		$this->load->view('akun_kepdes/edit', $data);
	}
	public function update()
	{
		$data=$this->input->post();
		$data['id_warga']=$this->db->get_where('warga',['nik_warga'=>$data['email']])->row_array()['id_warga'];
		$data['updated_at']=date('Y-m-d H:i:s');

		$this->db->where('id_user', $data['id_user']);
		$this->db->update('users', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update');
		redirect(site_url('akun_kepdes'));
	}
	public function hapus()
	{
		$id=$this->input->post('id');
		$this->db->delete('users', ['id_user'=>$id]);
	}
}

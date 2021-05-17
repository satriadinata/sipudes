<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rtrw extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Warga_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Warga';
		$data['user'] = $this->session->userdata('user_logged');
		$this->load->view('rtrw/warga', $data);
	}
	public function add()
	{
		$data['title']='Warga';
		$data['user'] = $this->session->userdata('user_logged');
		$this->load->view('warga/add',$data);
	}
	public function post()
	{
		$this->form_validation->set_rules('nik_warga','NIK','required|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('nama_warga','Nama','required|min_length[1]|max_length[45]');
		$this->form_validation->set_rules('rt_warga','RT','required');
		$this->form_validation->set_rules('rw_warga','RW','required');
		$data=$this->input->post();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['nama_desa']=$this->session->userdata('user_logged')['nama_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$data['updated_at']=date('Y-m-d H:i:s');
		
		if ($this->form_validation->run()) {
			$this->db->insert('warga', $data);
			$this->session->set_flashdata('message', 'Data berhasil di input');
			redirect(site_url('warga/add'));
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('warga/add'));
		}
	}
	public function getAll()
	{
		$ser=$this->session->userdata('user_logged');
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		if ($ser['user_role']==2){
			$wargas = $this->Warga_model->get_rw($kode_desa,$ser['rw']);
		}elseif($ser['user_role']==1){
			$wargas = $this->Warga_model->get_rt($kode_desa,$ser['rt'],$ser['rw']);
		};
		// echo $ser['rt_rw'];
		// die();

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->nik_warga,
				$r->nama_warga,
				$r->pekerjaan_warga,
				$r->alamat_ktp_warga,
				$r->rw_warga,
				$r->rt_warga,
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
		$data['calon']=$this->db->get_where('warga',['id_warga'=>$id])->row_array();
		$this->load->view('warga/edit', $data);
	}
	public function update()
	{
		$this->form_validation->set_rules('nik_warga','NIK','required|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('nama_warga','Nama','required|min_length[1]|max_length[45]');
		$this->form_validation->set_rules('rt_warga','RT','required');
		$this->form_validation->set_rules('rw_warga','RW','required');
		$data=$this->input->post();
		if ($this->form_validation->run()) {
			$this->db->where('id_warga', $data['id_warga']);
			$this->db->update('warga', $data);
			$this->session->set_flashdata('message', 'Data berhasil di update');
			redirect(site_url('warga'));
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('errPE', validation_errors());
			redirect(site_url('warga'));	
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
		$this->db->delete('warga', ['id_warga'=>$id]);
	}
}

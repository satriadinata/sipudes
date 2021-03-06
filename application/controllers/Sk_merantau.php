<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Sk_merantau extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Sk_domisili_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='SK Perjalanan Merantau';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5 || $this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('sk_merantau/index',$data);
		}
	}
	public function add()
	{
		$data['title']='SK Perjalanan Merantau';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] = $this->db->get_where('warga',['kode_desa'=>$data['user']["kode_desa"]])->result();
		$this->load->view('sk_merantau/add',$data);
	}
	public function post()
	{
		$data=$this->input->post();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$this->db->insert('sk_merantau', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input');
		redirect(site_url('sk_merantau'));
	}
	public function getAll()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$wargas = $this->Sk_domisili_model->sk_merantau($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->no_surat,
				$r->nama_warga,
				$r->keperluan,
				$r->created_at,
				"<a target='_blank' href='".site_url('sk_merantau/cetak/').$r->id."' class='btn btn-success'>Cetak</a> ".
				"<button id='hps".$r->id."' class='btn btn-danger' onclick='hapus($r->id)'>Hapus</button>",
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
		$this->form_validation->set_rules('rt_warga','RT','required|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('rw_warga','RW','required|min_length[3]|max_length[3]');
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
		$this->db->delete('sk_merantau', ['id'=>$id]);
	}
	public function dt()
	{
		$id=$this->input->post('id');
		$data['calon']=$this->db->get_where('warga',['id_warga'=>$id])->row_array();
		$this->load->view('sk_dom/dt', $data);
	}
	public function cetak($id)
	{
		$this->load->library('pdf');
		$data['surat']=$this->db->get_where('sk_merantau',['id'=>$id])->row_array();
		$data['calon']=$this->db->get_where('warga',['id_warga'=>$data['surat']['id_warga']])->row_array();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['profil']=$this->db->get_where('profil_desa',['kode_desa'=>$data['kode_desa']])->row_array();
		$data['kepdes']=$this->db->get_where('warga',['id_warga'=>$data['profil']['kepala_desa']])->row_array();
		// $this->load->view('CetakPendaftaran',$data);
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "sk_merantau".$data['calon']['nik_warga'].".pdf";
		$this->pdf->load_view('sk_merantau/cetak', $data);
	}
}

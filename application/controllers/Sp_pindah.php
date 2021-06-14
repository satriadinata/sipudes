<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Sp_pindah extends CI_Controller {

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
		$data['title']='Surat Pengantar Pindah';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5 || $this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('sp_pindah/index',$data);
		}
	}
	public function add()
	{
		$data['title']='Surat Pengantar Pindah';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] = $this->db->get_where('warga',['kode_desa'=>$data['user']["kode_desa"]])->result();
		$this->load->view('sp_pindah/add',$data);
	}
	public function post()
	{
		$data=$this->input->post();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$this->db->insert('sp_pindah', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input');
		redirect(site_url('sp_pindah'));
	}
	public function getAll()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$wargas = $this->Sk_domisili_model->sp_pindah($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->nomor_surat,
				$r->nik_warga,
				$r->nama_warga,
				$r->alamat_ktp_warga,
				$r->created_at,
				"<a target='_blank' href='".site_url('sp_pindah/cetak/').$r->id."' class='btn btn-success'>Cetak</a> ".
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
		$this->db->delete('sp_pindah', ['id'=>$id]);
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
		$data['surat']=$this->db->get_where('sp_pindah',['id'=>$id])->row_array();
		$data['calon']=$this->db->get_where('warga',['id_warga'=>$data['surat']['id_warga']])->row_array();
		$kk=$this->db->get_where('kartu_keluarga',['nomor_keluarga'=>$data['calon']['no_kk_warga']])->row_array();
		$data['kep_kel']=$this->db->get_where('warga',['nik_warga'=>$kk['nik_kepala_keluarga']])->row_array();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['profil']=$this->db->get_where('profil_desa',['kode_desa'=>$data['kode_desa']])->row_array();
		$data['kepdes']=$this->db->get_where('warga',['id_warga'=>$data['profil']['kepala_desa']])->row_array();
		// $this->load->view('CetakPendaftaran',$data);
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "sp_pindah".$data['calon']['nik_warga'].".pdf";
		$this->pdf->load_view('sp_pindah/cetak', $data);
	}
}

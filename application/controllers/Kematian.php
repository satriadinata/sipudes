<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Kematian extends CI_Controller {

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
		$data['title']='Data Kematian';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5){
			$this->load->view('kematian/index',$data);
		}
	}
	public function add()
	{
		$data['title']='Data Kematian';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] = $this->db->get_where('warga',['kode_desa'=>$data['user']["kode_desa"]])->result();
		$this->load->view('kematian/add',$data);
	}
	public function post()
	{
		$data=$this->input->post();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$this->db->insert('kematian', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input');
		redirect(site_url('kematian'));
	}
	public function getAll()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$wargas = $this->Sk_domisili_model->kematian($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->no_surat,
				$r->nik_warga,
				$r->nama_warga,
				date('d-m-Y',strtotime($r->tanggal_lahir_warga)),
				date('d-m-Y',strtotime($r->tgl_kematian)),
				$r->anak_ke,
				$r->ibu,
				$r->ayah,
				"<a target='_blank' href='".site_url('kematian/cetak/').$r->id_kematian."' class='btn btn-success'>Cetak</a> ".
				"<a href='".site_url('kematian/edit/').$r->id_kematian."' class='btn btn-primary'>Edit</a> ".
				"<button id='hps".$r->id_kematian."' class='btn btn-danger' onclick='hapus($r->id_kematian)'>Hapus</button>",
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
	public function edit($id)
	{
		$data['title']='Data Kematian';
		$data['user'] = $this->session->userdata('user_logged');
		$kode_desa=$this->session->userdata('user_logged')['kode_desa'];
		$data['calon']=$this->db->get_where('kematian',['id_kematian'=>$id])->row_array();
		$data['warga']=$this->db->get_where('warga',['kode_desa'=>$kode_desa])->result();
		$this->load->view('kematian/edit', $data);
	}
	public function update()
	{
		$data=$this->input->post();
		$this->db->where('id_kematian', $data['id_kematian']);
		$this->db->update('kematian', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update');
		redirect(site_url('kematian'));
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
		$this->db->delete('kematian', ['id_kematian'=>$id]);
	}
	public function dt()
	{
		$id=$this->input->post('id');
		$data['calon']=$this->db->get_where('warga',['id_warga'=>$id])->row_array();
		$this->load->view('sk_dom/dt', $data);
	}
	public function umur($lahir)
	{
		  //date in mm/dd/yyyy format; or it can be in other formats as well
		$birthDate = $lahir;
  //explode the date to get month, day and year
		$birthDate = explode("/", $birthDate);
  //get age from date or birthdate
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
			? ((date("Y") - $birthDate[2]) - 1)
			: (date("Y") - $birthDate[2]));
		return $age;
	}
	public function cetak($id)
	{
		$this->load->library('pdf');
		$data['surat']=$this->db->get_where('kematian',['id_kematian'=>$id])->row_array();
		$data['calon']=$this->db->get_where('warga',['id_warga'=>$data['surat']['id_warga']])->row_array();
		$data['umur']=$this->umur(date('m/d/Y',strtotime($data['calon']['tanggal_lahir_warga'])));
		$data['pelapor']=$this->db->get_where('warga',['id_warga'=>$data['surat']['pelapor']])->row_array();
		$data['umur_pelapor']=$this->umur(date('m/d/Y',strtotime($data['pelapor']['tanggal_lahir_warga'])));
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['profil']=$this->db->get_where('profil_desa',['kode_desa'=>$data['kode_desa']])->row_array();
		$data['kepdes']=$this->db->get_where('warga',['id_warga'=>$data['profil']['kepala_desa']])->row_array();
		// $this->load->view('CetakPendaftaran',$data);
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "kematian".$data['calon']['nik_warga'].".pdf";
		$this->pdf->load_view('kematian/cetak', $data);
	}
}

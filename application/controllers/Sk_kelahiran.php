<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sk_kelahiran extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Sk_kelahiran_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Surat Keterangan Kelahiran';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5 || $this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('sk_lahir/index',$data);
		}
	}
	public function add()
	{
		$data['title']='Surat Keterangan Domisili';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga']=$this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->result();
		$this->load->view('sk_lahir/add',$data);
	}
	public function post()
	{
		$data=$this->input->post();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$this->db->insert('sk_kelahiran', $data);
		$this->session->set_flashdata('message', 'Data berhasil di input');
		redirect(site_url('sk_kelahiran'));
	}	
	public function getAll()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$wargas = $this->Sk_kelahiran_model->get_data($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->nomor_surat,
				$r->nama,
				$this->db->get_where('warga',['id_warga'=>$r->ayah_kandung])->row_array()['nama_warga'],
				$this->db->get_where('warga',['id_warga'=>$r->ibu_kandung])->row_array()['nama_warga'],
				$r->tgl_lahir,
				"<a target='_blank' href='".site_url('sk_kelahiran/cetak/').$r->id."' class='btn btn-success'>Cetak</a> "." <button class='btn btn-primary' data-toggle='modal' data-target='#modal-edit' onclick='edit($r->id)'>Edit</button> ".
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
		$data['calon']=$this->db->get_where('sk_kelahiran',['id'=>$id])->row_array();
		$this->load->view('sk_lahir/edit', $data);
	}
	public function update()
	{
		$data=$this->input->post();
		$this->db->where('id', $data['id']);
		$this->db->update('sk_kelahiran', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update');
		redirect(site_url('sk_kelahiran'));		
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
		$this->db->delete('sk_kelahiran', ['id'=>$id]);
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
		$data['surat']=$this->db->get_where('sk_kelahiran',['id'=>$id])->row_array();
		$data['ibu']=$this->db->get_where('warga',['id_warga'=>$data['surat']['ibu_kandung']])->row_array();
		$data['ayah']=$this->db->get_where('warga',['id_warga'=>$data['surat']['ayah_kandung']])->row_array();
		$data['pelapor']=$this->db->get_where('warga',['id_warga'=>$data['surat']['pelapor']])->row_array();
		$data['umur_ayah']=$this->umur(date('m/d/Y',strtotime($data['ayah']['tanggal_lahir_warga'])));
		$data['umur_ibu']=$this->umur(date('m/d/Y',strtotime($data['ibu']['tanggal_lahir_warga'])));
		$data['umur_pelapor']=$this->umur(date('m/d/Y',strtotime($data['pelapor']['tanggal_lahir_warga'])));
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['profil']=$this->db->get_where('profil_desa',['kode_desa'=>$data['kode_desa']])->row_array();
		$data['kepdes']=$this->db->get_where('warga',['id_warga'=>$data['profil']['kepala_desa']])->row_array();
		// $this->load->view('CetakPendaftaran',$data);
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "sk_kelahiran".$data['surat']['nomor_surat'].".pdf";
		$this->pdf->load_view('sk_lahir/cetak', $data);
	}
}
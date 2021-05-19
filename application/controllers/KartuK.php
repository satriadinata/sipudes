<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KartuK extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Kk_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')['user_role']!=5 && $this->session->userdata('user_logged')['user_role']!=4) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Kartu Keluarga';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5 || $this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('kk/index',$data);
		}
	}
	public function add()
	{
		$data['title']='Kartu Keluarga';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] =  $this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->result();
		$this->load->view('kk/add',$data);
	}
	public function post()
	{
		$this->form_validation->set_rules('nomor_keluarga','No. KK','required|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('rt_keluarga','RT','required');
		$this->form_validation->set_rules('rw_keluarga','RW','required');
		$post=$this->input->post();
		$anggota=[];
		$stat=[];
		$data=[];
		foreach ($post as $key => $value) {
			$ang=$key[0].$key[1].$key[2];
			$temp=[];
			if ($ang=='ang'){
				array_push($anggota, $value);
			}elseif ($ang=='sta') {
				array_push($stat, $value);
			}else{
				$data[$key]=$value;
			}

		}
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$data['updated_at']=date('Y-m-d H:i:s');
		
		if ($this->form_validation->run()) {
			$this->db->insert('kartu_keluarga', $data);
			$insert_id = $this->db->insert_id();
			for ($i=0; $i < count($anggota) ; $i++) { 
				$this->db->insert('warga_has_kartu_keluarga', [
					'id_keluarga'=>$insert_id,
					'id_warga'=>$anggota[$i],
					'shdk'=>$stat[$i],
				]);
			}
			$this->session->set_flashdata('message', 'Data berhasil di input');
			redirect(site_url('KartuK'));
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('KartuK/add'));
		}
	}
	public function getAll()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$datas = $this->Kk_model->get_data($kode_desa);

		$data = array();

		foreach($datas->result() as $r) {

			$data[] = array(
				$r->nomor_keluarga,
				$r->nama_warga,
				$r->alamat_keluarga,
				"<button data-toggle='modal' data-target='#modal-det' class='btn btn-success' onclick='det($r->id_keluarga)'>Detail</button> "."<a class='btn btn-primary' href='".site_url('KartuK/edit/').$r->id_keluarga."'>Edit</a> ".
				"<button id='hps".$r->id_keluarga."' class='btn btn-danger' onclick='hapus($r->id_keluarga)'>Hapus</button>"." <a class='btn btn-warning' target='_blank' href='".site_url('KartuK/cetak/').$r->id_keluarga."'>Cetak</a>",
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $datas->num_rows(),
			"recordsFiltered" => $datas->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	public function edit($id)
	{
		// $id=$this->input->post('id');
		$data['title']='Kartu Keluarga';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] =  $this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->result();
		$data['calon']=$this->db->get_where('kartu_keluarga',['id_keluarga'=>$id])->row_array();
		$data['anggota']=$this->db->get_where('warga_has_kartu_keluarga',['id_keluarga'=>$id])->result();
		$this->load->view('kk/edit', $data);
	}
	public function update()
	{
		$this->form_validation->set_rules('nomor_keluarga','No. KK','required|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('rt_keluarga','RT','required');
		$this->form_validation->set_rules('rw_keluarga','RW','required');
		$post=$this->input->post();
		$anggota=[];
		$stat=[];
		$data=[];
		array_push($anggota, $this->db->get_where('warga',['nik_warga'=>$post['nik_kepala_keluarga']])->row_array()['id_warga']);
		array_push($stat, 'KEPALA KELUARGA');
		foreach ($post as $key => $value) {
			$ang=$key[0].$key[1].$key[2];
			$temp=[];
			if ($ang=='ang'){
				array_push($anggota, $value);
			}elseif ($ang=='sta') {
				array_push($stat, $value);
			}else{
				$data[$key]=$value;
			}
		}
		// echo "<pre>";
		// print_r($anggota);
		// echo "</pre>";
		// die();
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['updated_at']=date('Y-m-d H:i:s');

		if ($this->form_validation->run()) {
			$this->db->where('id_keluarga', $data['id_keluarga']);
			$this->db->update('kartu_keluarga', $data);
			$this->db->delete('warga_has_kartu_keluarga', ['id_keluarga'=>$data['id_keluarga']]);
			$insert_id = $data['id_keluarga'];
			for ($i=0; $i < count($anggota)-1 ; $i++) { 
				$this->db->insert('warga_has_kartu_keluarga', [
					'id_keluarga'=>$insert_id,
					'id_warga'=>$anggota[$i],
					'shdk'=>$stat[$i],
				]);
			}
			$this->session->set_flashdata('message', 'Data berhasil di update');
			redirect(site_url('KartuK'));
		}else{
			$this->session->set_flashdata('input', $data);
			$this->session->set_flashdata('errPE', validation_errors());
			redirect(site_url('KartuK'));	
		}
	}
	public function detail()
	{
		$id=$this->input->post('id');
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] =  $this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->result();
		$data['calon']=$this->db->get_where('kartu_keluarga',['id_keluarga'=>$id])->row_array();
		$data['anggota']=$this->db->get_where('warga_has_kartu_keluarga',['id_keluarga'=>$id])->result();
		$this->load->view('kk/detail', $data);
	}
	public function hapus()
	{
		$id=$this->input->post('id');
		$this->db->delete('kartu_keluarga', ['id_keluarga'=>$id]);
	}
	public function cetak($id_kk)
	{
		$data['calon']=$this->db->get_where('kartu_keluarga',['id_keluarga'=>$id_kk])->row_array();
		$data['kepala']=$this->db->get_where('warga',['nik_warga'=>$data['calon']['nik_kepala_keluarga']])->row_array();
		$data['anggota']=$this->Kk_model->anggota_join($data['calon']['id_keluarga']);
		// echo "<pre>";
		// print_r($data['anggota']);
		// echo "</pre>";
		// die();
		// $this->load->view('kk/cetak', $data);
		
		$this->load->library('pdf');
		$this->pdf->setPaper('Legal', 'landscape');
		$this->pdf->filename = "KK".$data['calon']['nomor_keluarga'].".pdf";
		$this->pdf->load_view('kk/cetak', $data);
	}
	public function import()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		$profil=$this->db->get_where('profil_desa',['kode_desa'=>$kode_desa])->row_array();
		$desa=$profil['nama_desa'];
		$kec=$profil['kec_desa'];
		$kab=$profil['kab_desa'];
		$prov=$profil['prov_desa'];
		$pos=$profil['kode_pos'];
		$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

			$arr_file = explode('.', $_FILES['file']['name']);
			$extension = end($arr_file);
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);

			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$data=array();
			for($i = 1;$i < count($sheetData);$i++)
			{
				array_push($data, array(
					'kode_desa'=> $kode_desa,
					'nomor_keluarga'=> $sheetData[$i]['18'],
					'nik_kepala_keluarga'=>$sheetData[$i]['0'],
					'alamat_keluarga'=>$sheetData[$i]['20'],
					'desa_kelurahan_keluarga'=>$desa,
					'kecamatan_keluarga'=>$kec,
					'kabupaten_kota_keluarga'=>$kab,
					'provinsi_keluarga'=>$prov,
					'negara_keluarga'=>'INDONESIA',
					'rt_keluarga'=>$sheetData[$i]['21'],
					'rw_keluarga'=>$sheetData[$i]['22'],
					'kode_pos_keluarga'=>$pos,
				));
			}
			// echo "<pre>";
			// print_r($data);
			// echo "<pre>";
			$this->db->insert_batch('kartu_keluarga', $data);
			$this->session->set_flashdata('message', 'Data berhasil di import !');
			redirect(site_url('KartuK'));
		}
	}
	public function hapus_has($anggota)
	{
		$this->db->where_in('id', $anggota);
		$this->db->delete('warga_has_kartu_keluarga');
	}
	public function reset()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		$this->db->select('id_keluarga');
		$this->db->from('kartu_keluarga');
		$this->db->where('kode_desa', $kode_desa);
		$data= $this->db->get()->result();
		$hapus=[];
		$anggota=[];
		foreach ($data as $key => $value) {
			array_push($hapus, $value->id_keluarga);
			$ang=$this->db->get_where('warga_has_kartu_keluarga',['id_keluarga'=>$value->id_keluarga])->result();
			array_push($anggota, $ang);
		}
		// echo "<pre>";
		// print_r($anggota);
		// print_r($hapus);
		// echo "</pre>";
		// die();
		$this->db->where_in('id_keluarga', $hapus);
		$this->db->delete('kartu_keluarga');

		foreach ($anggota as $key => $value) {
			$modify=[];
			foreach ($value as $k => $v) {
				array_push($modify, $v->id);
			}
			$this->hapus_has($modify);
		}

		
		// $this->db->empty_table('warga_has_kartu_keluarga');
	}
	public function sync()
	{
		// $this->db->empty_table('kartu_keluarga');
		// $this->db->empty_table('warga_has_kartu_keluarga');
		// $this->db->empty_table('warga');
		// die();
		$user = $this->session->userdata('user_logged');
		$kk=$this->db->get_where('kartu_keluarga',['kode_desa'=>$user['kode_desa']])->result();
		$data=[];
		foreach ($kk as $key => $value) {
			$anggota=$this->db->get_where('warga',['no_kk_warga'=>$value->nomor_keluarga])->result();
			foreach ($anggota as $k => $v) {
				$push=[
					'id_warga'=>$v->id_warga,
					'id_keluarga'=>$value->id_keluarga,
					'shdk'=>$v->shdk_warga,
				];
				array_push($data, $push);
			}
		}
		$this->db->insert_batch('warga_has_kartu_keluarga',$data);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
	}
	public function sync_kodepos()
	{
		$user = $this->session->userdata('user_logged');
		$kode_pos = $this->db->get_where('profil_desa',['kode_desa'=>$user['kode_desa']])->row_array()['kode_pos'];
		$data=$this->db->get_where('kartu_keluarga',['kode_desa'=>$user['kode_desa']])->result();
		$update=[];
		foreach ($data as $key => $value) {
			array_push($update, [
				'id_keluarga'=>$value->id_keluarga,
				'kode_pos_keluarga'=>$kode_pos,
			]);
		}
		$this->db->update_batch('kartu_keluarga',$update, 'id_keluarga'); 
	}
}

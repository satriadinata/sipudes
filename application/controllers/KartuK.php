<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KartuK extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Kk_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Kartu Keluarga';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==4){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==3){
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
		$this->form_validation->set_rules('rt_keluarga','RT','required|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('rw_keluarga','RW','required|min_length[3]|max_length[3]');
		$post=$this->input->post();
		$anggota=[];
		$data=[];
		foreach ($post as $key => $value) {
			$ang=$key[0].$key[1].$key[2];
			$temp=[];
			if ($ang=='ang'){
				array_push($anggota, $value);
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
			foreach ($anggota as $key => $value) {
				$this->db->insert('warga_has_kartu_keluarga', [
					'id_warga'=>$value,
					'id_keluarga'=>$insert_id
				]);
			}
			$this->session->set_flashdata('message', 'Data berhasil di input');
			redirect(site_url('KartuK/add'));
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
		$this->form_validation->set_rules('rt_keluarga','RT','required|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('rw_keluarga','RW','required|min_length[3]|max_length[3]');
		$post=$this->input->post();
		$anggota=[];
		$data=[];
		foreach ($post as $key => $value) {
			$ang=$key[0].$key[1].$key[2];
			$temp=[];
			if ($ang=='ang'){
				array_push($anggota, $value);
			}else{
				$data[$key]=$value;
			}
		}
		$data['kode_desa']=$this->session->userdata('user_logged')['kode_desa'];
		$data['created_at']=date('Y-m-d H:i:s');
		$data['updated_at']=date('Y-m-d H:i:s');

		if ($this->form_validation->run()) {
			$this->db->where('id_keluarga', $data['id_keluarga']);
			$this->db->update('kartu_keluarga', $data);
			$this->db->delete('warga_has_kartu_keluarga', ['id_keluarga'=>$data['id_keluarga']]);
			$insert_id = $data['id_keluarga'];
			foreach ($anggota as $key => $value) {
				$this->db->insert('warga_has_kartu_keluarga', [
					'id_warga'=>$value,
					'id_keluarga'=>$insert_id
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
		$data['kepala']=$this->db->get_where('warga',['id_warga'=>$data['calon']['id_kepala_keluarga']])->row_array();
		$data['anggota']=$this->Kk_model->anggota_join($data['calon']['id_keluarga']);
		// echo "<pre>";
		// print_r($data['anggota']);
		// echo "</pre>";
		// die();
		$this->load->library('pdf');
		$this->pdf->setPaper('Legal', 'landscape');
		$this->pdf->filename = "KK".$data['calon']['nomor_keluarga'].".pdf";
		$this->pdf->load_view('kk/cetak', $data);
	}
}

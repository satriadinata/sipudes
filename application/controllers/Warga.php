<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Warga extends CI_Controller {

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
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5 || $this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('warga/index',$data);
		}
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
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$wargas = $this->Warga_model->get_data($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->nik_warga,
				$r->nama_warga,
				$r->pekerjaan_warga,
				$r->alamat_ktp_warga,
				"<button data-toggle='modal' data-target='#modal-det' class='btn btn-success' onclick='det($r->id_warga)'>Detail</button> "."<button class='btn btn-primary' data-toggle='modal' data-target='#modal-edit' onclick='edit($r->id_warga)'>Edit</button> ".
				"<button id='hps".$r->id_warga."' class='btn btn-danger' onclick='hapus($r->id_warga)'>Hapus</button>",
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
	public function import()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
		$profil=$this->db->get_where('profil_desa',['kode_desa'=>$kode_desa])->row_array();
		$kec=$profil['kec_desa'];
		$kab=$profil['kab_desa'];
		$prov=$profil['prov_desa'];
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
				$tgl=explode('/', $sheetData[$i]['5']);
				$agama='';
				if ($sheetData[$i]['7']=='1'){
					$agama='Islam';
				}elseif ($sheetData[$i]['7']=='2') {
					$agama='Kristen';
				}elseif ($sheetData[$i]['7']=='3') {
					$agama='Katholik';
				}elseif ($sheetData[$i]['7']=='4') {
					$agama='Hindu';
				}elseif ($sheetData[$i]['7']=='5') {
					$agama='Budha';
				}elseif ($sheetData[$i]['7']=='6') {
					$agama='Konghucu';
				}
				array_push($data, array(
					'kode_desa'=> $kode_desa,
					'nik_warga'=> $sheetData[$i]['0'],
					'no_paspor'=>$sheetData[$i]['1'],
					'nama_warga'=>$sheetData[$i]['2'],
					'jenis_kelamin_warga'=>$sheetData[$i]['3'],
					'tempat_lahir_warga'=>$sheetData[$i]['4'],
					'tanggal_lahir_warga' =>date('Y-m-d',strtotime($tgl[1].'-'.$tgl[0].'-'.$tgl[2])),
					'status_perkawinan_warga'=>$sheetData[$i]['8'],
					'shdk_warga'=>$sheetData[$i]['11'],
					'pendidikan_terakhir_warga'=>$sheetData[$i]['14'],
					'pekerjaan_warga'=>$sheetData[$i]['15'],
					'ibu'=>$sheetData[$i]['16'],
					'ayah'=>$sheetData[$i]['17'],
					'no_kk_warga'=>$sheetData[$i]['18'],
					'alamat_warga'=>$sheetData[$i]['20'],
					'desa_kelurahan_warga'=>$sheetData[$i]['20'],
					'kecamatan_warga'=>$kec,
					'kabupaten_kota_warga'=>$kab,
					'provinsi_warga'=>$prov,
					'negara_warga'=>'INDONESIA',
					'rt_warga'=>$sheetData[$i]['21'],
					'rw_warga'=>$sheetData[$i]['22'],
					'agama_warga'=>$agama,
					'status_warga'=>'TETAP',
				));
			}
			// echo "<pre>";
			// print_r($data);
			// echo "<pre>";
			$this->db->insert_batch('warga', $data);
			$this->session->set_flashdata('message', 'Data berhasil di import !');
			redirect(site_url('warga'));
		}
	}
}

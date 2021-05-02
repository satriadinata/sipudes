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
		if($this->session->userdata('user_logged')['user_role']==4){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==3){
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
		$this->form_validation->set_rules('rt_warga','RT','required|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('rw_warga','RW','required|min_length[3]|max_length[3]');
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
		$this->db->delete('warga', ['id_warga'=>$id]);
	}
	public function import()
	{
		$kode_desa = $this->session->userdata('user_logged')['kode_desa'];
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
				$tgl=explode('/', $sheetData[$i]['4']);
				array_push($data, array(
					'kode_desa'=> $kode_desa,
					'nik_warga'=> $sheetData[$i]['1'],
					'nama_warga'=>$sheetData[$i]['2'],
					'tempat_lahir_warga'=>$sheetData[$i]['3'],
					'tanggal_lahir_warga' =>date('d-m-Y',strtotime($tgl[1].'-'.$tgl[0].'-'.$tgl[2])),
					'jenis_kelamin_warga'=>$sheetData[$i]['5'],
					'alamat_ktp_warga'=>$sheetData[$i]['6'],
					'alamat_warga'=>$sheetData[$i]['7'],
					'desa_kelurahan_warga'=>$sheetData[$i]['8'],
					'kecamatan_warga'=>$sheetData[$i]['9'],
					'kabupaten_kota_warga'=>$sheetData[$i]['10'],
					'provinsi_warga'=>$sheetData[$i]['11'],
					'negara_warga'=>$sheetData[$i]['12'],
					'rt_warga'=>$sheetData[$i]['13'],
					'rw_warga'=>$sheetData[$i]['14'],
					'agama_warga'=>$sheetData[$i]['15'],
					'pendidikan_terakhir_warga'=>$sheetData[$i]['16'],
					'pekerjaan_warga'=>$sheetData[$i]['17'],
					'status_perkawinan_warga'=>$sheetData[$i]['18'],
					'status_warga'=>$sheetData[$i]['19'],
				));
			}
			// echo "<pre>";
			// print_r($data);
			// echo "<pre>";
			$this->db->insert_batch('warga', $data);
			$this->session->set_flashdata('message', 'Data berhasil di import !');
			redirect(site_url('warga'));
		}

		// $numrow = 1;    
		// foreach($sheet as $row){     
		// 	if($numrow > 1){
		// 		array_push($data, array(          
		// 		'nis'=>$row['A'], // Insert data nis dari kolom A di excel          
		// 		'nama'=>$row['B'], // Insert data nama dari kolom B di excel          
		// 		'jenis_kelamin'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel          
		// 		'alamat'=>$row['D'], // Insert data alamat dari kolom D di excel        
		// 		));
		// 	}            
		// 	$numrow++;
		// }
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// $this->load->library('excel');
		// try{
		// 	$object = PHPExcel_IOFactory::load($path);
		// 	$data = [];
		// 	foreach($object->getWorksheetIterator() as $worksheet)
		// 	{
		// 		$highestRow = $worksheet->getHighestRow();
		// 		$highestColumn = $worksheet->getHighestColumn();
		// 		for($row=2; $row <= $highestRow; $row++)
		// 		{
		// 			$data[$row]['kode_desa'] = $kode_desa;
		// 			$data[$row]['nik_warga'] = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
		// 			$data[$row]['nama_warga'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
		// 			$data[$row]['tempat_lahir_warga'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
		// 			$data[$row]['tanggal_lahir_warga'] = gmdate("d-m-Y", ($worksheet->getCellByColumnAndRow(4, $row)->getValue() - 25569) * 86400);
		// 			$data[$row]['jenis_kelamin_warga'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
		// 			$data[$row]['alamat_ktp_warga'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
		// 			$data[$row]['alamat_warga'] = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
		// 			$data[$row]['desa_kelurahan_warga'] = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
		// 			$data[$row]['kecamatan_warga'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
		// 			$data[$row]['kabupaten_kota_warga'] = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
		// 			$data[$row]['provinsi_warga'] = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
		// 			$data[$row]['negara_warga'] = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
		// 			$data[$row]['rt_warga'] = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
		// 			$data[$row]['rw_warga'] = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
		// 			$data[$row]['agama_warga'] = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
		// 			$data[$row]['pendidikan_terakhir_warga'] = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
		// 			$data[$row]['pekerjaan_warga'] = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
		// 			$data[$row]['status_perkawinan_warga'] = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
		// 			$data[$row]['status_warga'] = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
		// 		}
		// 	}



			// $this->db->insert_batch('warga', $data);
			// $this->session->set_flashdata('message', 'Data berhasil di import !');
			// redirect(site_url('warga'));
	// }
	// catch (Exception $e)
	// {
	// 	var_dump($e->getMessage());
	// 	exit();
	// }
	}
}

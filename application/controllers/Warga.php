<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
					'gdr'=>$sheetData[$i]['6'],
					'status_perkawinan_warga'=>$sheetData[$i]['8'],
					'no_akta_kwin'=>$sheetData[$i]['9'],
					'no_akta_cerai'=>$sheetData[$i]['10'],
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
	public function importedit()
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
					'gdr'=>$sheetData[$i]['6'],
					'status_perkawinan_warga'=>$sheetData[$i]['8'],
					'no_akta_kwin'=>$sheetData[$i]['9'],
					'no_akta_cerai'=>$sheetData[$i]['10'],
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
			$this->db->update_batch('warga',$data, 'nik_warga');
			// $this->db->insert_batch('warga', $data);
			$this->session->set_flashdata('message', 'Data berhasil di edit !');
			redirect(site_url('warga'));
		}
	}
	// Export ke excel
	public function export()
	{
		$kode_desa=$this->session->userdata('user_logged')['kode_desa'];
		$profil=$this->db->get_where('profil_desa',['kode_desa'=>$kode_desa])->row_array();
		$wargas = $this->db->get_where('warga',['kode_desa'=>$kode_desa])->result();
// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

// Set document properties
		$spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
		->setLastModifiedBy('Andoyo - Java Web Medi')
		->setTitle('Office 2007 XLSX Test Document')
		->setSubject('Office 2007 XLSX Test Document')
		->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
		->setKeywords('office 2007 openxml php')
		->setCategory('Test result file');

// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'nik_warga')
		->setCellValue('B1', 'no_paspor')
		->setCellValue('C1', 'nama_warga')
		->setCellValue('D1', 'jenis_kelamin_warga')
		->setCellValue('E1', 'tempat_lahir_warga')
		->setCellValue('F1', 'tanggal_lahir_warga')
		->setCellValue('G1', 'gdr')
		->setCellValue('H1', 'agama_warga')
		->setCellValue('I1', 'status_perkawinan_warga')
		->setCellValue('J1', 'no_akta_kwin')
		->setCellValue('K1', 'no_akta_cerai')
		->setCellValue('L1', 'shdk_warga')
		->setCellValue('M1', 'shdrt')
		->setCellValue('N1', 'penandang cacat')
		->setCellValue('O1', 'pendidikan_terakhir_warga')
		->setCellValue('P1', 'pekerjaan_warga')
		->setCellValue('Q1', 'ibu')
		->setCellValue('R1', 'ayah')
		->setCellValue('S1', 'no_kk_warga')
		->setCellValue('T1', 'kepkk')
		->setCellValue('U1', 'alamat_warga')
		->setCellValue('V1', 'rt_warga')
		->setCellValue('W1', 'rw_warga')
		;

// Miscellaneous glyphs, UTF-8
		$i=2; foreach($wargas as $warga) {
			$agama='';
				if ($warga->agama_warga=='Islam'){
					$agama='1';
				}elseif ($warga->agama_warga=='Kristen') {
					$agama='2';
				}elseif ($warga->agama_warga=='Katholik') {
					$agama='3';
				}elseif ($warga->agama_warga=='Hindu') {
					$agama='4';
				}elseif ($warga->agama_warga=='Budha') {
					$agama='5';
				}elseif ($warga->agama_warga=='Konghucu') {
					$agama='6';
				}

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$i, "'".$warga->nik_warga)
			->setCellValue('B'.$i, $warga->no_paspor)
			->setCellValue('C'.$i, $warga->nama_warga)
			->setCellValue('D'.$i, $warga->jenis_kelamin_warga)
			->setCellValue('E'.$i, $warga->tempat_lahir_warga)
			->setCellValue('F'.$i, date('d/m/Y',strtotime($warga->tanggal_lahir_warga)))
			->setCellValue('G'.$i, $warga->gdr)
			->setCellValue('H'.$i, $agama)
			->setCellValue('I'.$i, $warga->status_perkawinan_warga)
			->setCellValue('J'.$i, $warga->no_akta_kwin)
			->setCellValue('K'.$i, $warga->no_akta_cerai)
			->setCellValue('L'.$i, $warga->shdk_warga)
			->setCellValue('M'.$i, "")
			->setCellValue('N'.$i, "")
			->setCellValue('O'.$i, $warga->pendidikan_terakhir_warga)
			->setCellValue('P'.$i, $warga->pekerjaan_warga)
			->setCellValue('Q'.$i, $warga->ibu)
			->setCellValue('R'.$i, $warga->ayah)
			->setCellValue('S'.$i, "'".$warga->no_kk_warga)
			->setCellValue('T'.$i, "")
			->setCellValue('U'.$i, $warga->alamat_warga)
			->setCellValue('V'.$i, $warga->rt_warga)
			->setCellValue('W'.$i, $warga->rw_warga);
			$i++;
		}

// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Export Warga '.$profil['nama_desa'].' '.date('d-m-Y').'.xlsx"');
		header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
}
}

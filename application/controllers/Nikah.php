<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nikah extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('SNikah_model');
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')['user_role']!=9) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Surat Nikah';
		$data['user'] = $this->session->userdata('user_logged');
		if($this->session->userdata('user_logged')['user_role']==4){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==3){
			$this->load->view('nikah/index',$data);
		}
	}
	public function add()
	{
		$data['title']='Surat Nikah';
		$data['user'] = $this->session->userdata('user_logged');
		$data['warga'] =  $this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->result();
		$this->load->view('nikah/add',$data);
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


		$wargas = $this->SNikah_model->get_data($kode_desa);

		$data = array();

		foreach($wargas->result() as $r) {

			$data[] = array(
				$r->no_request,
				$r->nama_warga,
				$r->requested_by,
				"<button data-toggle='modal' data-target='#modal-det' class='btn btn-success' onclick='det($r->id_surat_nikah)'>Detail</button> "."<button class='btn btn-primary' data-toggle='modal' data-target='#modal-edit' onclick='edit($r->id_surat_nikah)'>Edit</button> ".
				"<button id='hps".$r->id_surat_nikah."' class='btn btn-danger' onclick='hapus($r->id_surat_nikah)'>Hapus</button>",
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
	}
}

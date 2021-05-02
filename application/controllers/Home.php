<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Dashboard';
		$data['user'] = $this->session->userdata('user_logged');
		$data['total_warga']=$this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->num_rows();
		$data['rt']=$this->db->get_where('users',['kode_desa'=>$data['user']['kode_desa'], 'user_role'=>1 ])->num_rows();
		$data['rw']=$this->db->get_where('users',['kode_desa'=>$data['user']['kode_desa'], 'user_role'=>2 ])->num_rows();
		$data['rw']=$this->db->get_where('users',['kode_desa'=>$data['user']['kode_desa'], 'user_role'=>2 ])->num_rows();
		$data['kk']=$this->db->get_where('kartu_keluarga',['kode_desa'=>$data['user']['kode_desa']])->num_rows();
		if($this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('dashboard/index',$data);
		}elseif($this->session->userdata('user_logged')['user_role']<=3){
			$this->load->view('dashboard/index',$data);
		}
	}
}

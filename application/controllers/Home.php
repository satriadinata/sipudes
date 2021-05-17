<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data['title']='Dashboard';
		$data['user'] = $this->session->userdata('user_logged');
		$data['total_warga']=$this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa']])->num_rows();
		$data['rt']=$this->db->get_where('users',['kode_desa'=>$data['user']['kode_desa'], 'user_role'=>1 ])->num_rows();
		$data['rw']=$this->db->get_where('users',['kode_desa'=>$data['user']['kode_desa'], 'user_role'=>2 ])->num_rows();
		$data['rw']=$this->db->get_where('users',['kode_desa'=>$data['user']['kode_desa'], 'user_role'=>2 ])->num_rows();
		$data['kk']=$this->db->get_where('kartu_keluarga',['kode_desa'=>$data['user']['kode_desa']])->num_rows();
		if($this->session->userdata('user_logged')['user_role']==9){
			$data['jmlh_desa']=$this->db->get('profil_desa')->num_rows();
			$this->load->view('dashboard/index',$data);
		}elseif($this->session->userdata('user_logged')['user_role']<=5 && $this->session->userdata('user_logged')['user_role']>=3){
			$this->load->view('dashboard/index',$data);
		}elseif($this->session->userdata('user_logged')['user_role']==2){
			$data['jmlh_warga']=$this->db->get_where('warga',['kode_desa'=>$data['user']['kode_desa'], 'rw_warga'=>$data['user']['rw'] ])->num_rows();
			$data['jmlh_kk']=$this->db->get_where('kartu_keluarga',['kode_desa'=>$data['user']['kode_desa'], 'rw_keluarga'=>$data['user']['rw'] ])->num_rows();
			$this->load->view('dashboard/index',$data);
		}elseif($this->session->userdata('user_logged')['user_role']==1){
			$data['jmlh_warga']=$this->Warga_model->get_rt($data['user']['kode_desa'],$data['user']['rt'],$data['user']['rw'])->num_rows();
			$data['jmlh_kk']=$this->Warga_model->get_rt_kk($data['user']['kode_desa'],$data['user']['rt'],$data['user']['rw'])->num_rows();
			$this->load->view('dashboard/index',$data);
		}
	}
}

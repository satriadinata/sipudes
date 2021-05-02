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
		if($this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('dashboard/index',$data);
		}elseif($this->session->userdata('user_logged')['user_role']<=3){
			$this->load->view('dashboard/index',$data);
		}
	}
}

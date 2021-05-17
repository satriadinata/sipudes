<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$session = $this->session->userdata();
		if ($this->session->userdata('user_logged')===null) {
			redirect(site_url('auth'));
		};
	}
	public function index()
	{
		$data['title']='Profil Desa';
		$data['user'] = $this->session->userdata('user_logged');
		$data['profil'] = $this->db->get_where('profil_desa',['kode_desa'=>$data['user']['kode_desa']])->row_array();
		$data['kepala_desa'] = $this->db->get_where('warga',['id_warga'=>$data['profil']['kepala_desa']])->row_array();
		if($this->session->userdata('user_logged')['user_role']==9){
			echo "superadmin";
		}elseif($this->session->userdata('user_logged')['user_role']==5 || $this->session->userdata('user_logged')['user_role']==4){
			$this->load->view('profil/index',$data);
		}
	}
	public function edit()
	{
		$id=$this->input->post('id');
		$data['calon']=$this->db->get_where('profil_desa',['id_profil_desa'=>$id])->row_array();
		$data['warga']=$this->db->get_where('warga',['kode_desa'=>$data['calon']['kode_desa']])->result();
		$this->load->view('profil/edit', $data);
	}
	public function update()
	{
		$data=$this->input->post();
		$this->db->where('id_profil_desa', $data['id_profil_desa']);
		$this->db->update('profil_desa', $data);
		$this->session->set_flashdata('message', 'Data berhasil di update');
		redirect(site_url('profil'));
	}
}

<?php

class Warga_model extends CI_Model
{
	public function get_data($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('warga');
		$this->db->where('warga.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}
	public function get_rw($kode_desa,$rw)
	{
		$this->db->select('*');
		$this->db->from('warga');
		$this->db->where('warga.kode_desa',$kode_desa);
		$this->db->where('warga.rw_warga',$rw);
		$query=$this->db->get();
		return $query;
	}
	public function get_rt($kode_desa,$rt,$rw)
	{
		$this->db->select('*');
		$this->db->from('warga');
		$this->db->where('warga.kode_desa',$kode_desa);
		$this->db->where('warga.rw_warga',$rw);
		$this->db->where('warga.rt_warga',$rt);
		$query=$this->db->get();
		return $query;
	}
	public function get_rt_kk($kode_desa,$rt,$rw)
	{
		$this->db->select('*');
		$this->db->from('kartu_keluarga');
		$this->db->where('kartu_keluarga.kode_desa',$kode_desa);
		$this->db->where('kartu_keluarga.rw_keluarga',$rw);
		$this->db->where('kartu_keluarga.rt_keluarga',$rt);
		$query=$this->db->get();
		return $query;
	}

}



?>
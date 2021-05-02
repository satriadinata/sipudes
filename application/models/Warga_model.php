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

}



?>
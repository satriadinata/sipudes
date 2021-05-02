<?php

class Sk_kelahiran_model extends CI_Model
{
	public function get_data($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('sk_kelahiran');
		$this->db->where('sk_kelahiran.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}

}



?>
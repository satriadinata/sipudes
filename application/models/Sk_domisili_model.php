<?php

class Sk_domisili_model extends CI_Model
{
	public function get_data($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('sk_domisili');
		$this->db->join('warga','warga.id_warga=sk_domisili.id_warga');
		$this->db->where('sk_domisili.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}

}



?>
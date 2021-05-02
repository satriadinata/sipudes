<?php

class Kk_model extends CI_Model
{
	public function get_data($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('kartu_keluarga');
		$this->db->join('warga','warga.id_warga=kartu_keluarga.id_kepala_keluarga');
		$this->db->where('kartu_keluarga.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}

}



?>
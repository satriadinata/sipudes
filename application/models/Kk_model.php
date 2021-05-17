<?php

class Kk_model extends CI_Model
{
	public function get_data($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('kartu_keluarga');
		$this->db->join('warga','warga.nik_warga=kartu_keluarga.nik_kepala_keluarga');
		$this->db->where('kartu_keluarga.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}
	public function anggota_join($id_keluarga)
	{
		$this->db->select('*');
		$this->db->from('warga_has_kartu_keluarga');
		$this->db->join('warga','warga.id_warga=warga_has_kartu_keluarga.id_warga');
		$this->db->where('warga_has_kartu_keluarga.id_keluarga',$id_keluarga);
		$query=$this->db->get()->result();
		return $query;	
	}

}



?>
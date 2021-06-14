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
	public function sk_usaha($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('sk_usaha');
		$this->db->join('warga','warga.id_warga=sk_usaha.id_warga');
		$this->db->where('sk_usaha.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}
	public function sp_pindah($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('sp_pindah');
		$this->db->join('warga','warga.id_warga=sp_pindah.id_warga');
		$this->db->where('sp_pindah.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}
	public function sk_merantau($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('sk_merantau');
		$this->db->join('warga','warga.id_warga=sk_merantau.id_warga');
		$this->db->where('sk_merantau.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}
	public function sktm_berobat($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('sktm_berobat');
		$this->db->join('warga','warga.id_warga=sktm_berobat.id_warga');
		$this->db->where('sktm_berobat.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}
	public function kematian($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('kematian');
		$this->db->join('warga','warga.id_warga=kematian.id_warga');
		$this->db->where('kematian.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}
	public function sktm_sekolah($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('sktm_sekolah');
		$this->db->where('sktm_sekolah.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}

}



?>
<?php

class SNikah_model extends CI_Model
{
	public function get_data($kode_desa)
	{
		$this->db->select('*');
		$this->db->from('surat_nikah');
		$this->db->join('warga','warga.id_warga=surat_nikah.id_mempelai1');
		$this->db->join('users','users.id_user=surat_nikah.requested_by');
		$this->db->where('surat_nikah.kode_desa',$kode_desa);
		$query=$this->db->get();
		return $query;
	}

}



?>
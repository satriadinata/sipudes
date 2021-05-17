<?php

class Akun_model extends CI_Model
{
  public function get_data($kode_desa)
  {
   $this->db->select('*');
   $this->db->from('users');
   $this->db->where('users.kode_desa',$kode_desa);
   $this->db->where("(users.user_role=1 OR users.user_role=2)");
   $query=$this->db->get();
   return $query;
 }
 public function get_operator($kode_desa)
 {
  $this->db->select('*');
  $this->db->from('users');
  $this->db->join('warga','warga.nik_warga=users.email');
  $this->db->where('users.kode_desa',$kode_desa);
  $this->db->where("users.user_role=4");
  $query=$this->db->get();
  return $query;
}
public function get_kepdes($kode_desa)
{
 $this->db->select('*');
  $this->db->from('users');
  $this->db->join('warga','warga.nik_warga=users.email');
  $this->db->where('users.kode_desa',$kode_desa);
  $this->db->where("users.user_role=3");
  $query=$this->db->get();
  return $query; 
}

}



?>
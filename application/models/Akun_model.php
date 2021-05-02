<?php

class Akun_model extends CI_Model
{
    public function get_data($kode_desa)
    {
       $this->db->select('*');
       $this->db->from('users');
       $this->db->where('users.kode_desa',$kode_desa);
       $this->db->where("(users.user_role=1 OR users.user_role=2)");
       // $this->db->or_where('users.user_role',1);
       $query=$this->db->get();
       return $query;
   }

}



?>
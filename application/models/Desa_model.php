<?php

class Desa_model extends CI_Model
{
    public function get_data()
    {
       $this->db->select('*');
       $this->db->from('users');
       $this->db->join('profil_desa','profil_desa.kode_desa=users.kode_desa');
       $this->db->where('users.user_role',5);
       $query=$this->db->get();
       return $query;
   }

}



?>
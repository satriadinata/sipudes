<?php

class Desa_model extends CI_Model
{
    public function get_data()
    {
       $this->db->select('*');
       $this->db->from('users');
       $this->db->where('users.user_role',3);
       $query=$this->db->get();
       return $query;
   }

}



?>
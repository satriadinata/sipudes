<?php

class User_model extends CI_Model
{
    private $_table="users";

    public function doLogin()
    {
        $kode_desa=$this->input->post('kode_desa');
        $password=$this->input->post('word_pass');
        $email=$this->input->post('email');
        $user=$this->db->get_where($this->_table, ['email'=>$email,'kode_desa'=>$kode_desa])->row_array();

        if ($user && $user['user_role']==4) {
            if (password_verify($password, $user['password'])) {
                $data=[
                    'id_user'=>$user['id_user'],
                    'email'=>$user['email'],
                    'user_role'=>$user['user_role'],
                    'kode_desa'=>$user['kode_desa'],
                    'nama_desa'=>$user['nama_desa'],
                ];
                $this->session->set_userdata(['user_logged'=>$data]);
                return true;
            }else{
                $this->session->set_flashdata('errP','Wrong Password or Blocked');
                redirect(site_url('auth')); 
            }
        }elseif($user && $user['user_role']==3 && $user['password']==$password){
            $data=[
                'id_user'=>$user['id_user'],
                'email'=>$user['email'],
                'user_role'=>$user['user_role'],
                'nama_desa'=>$user['nama_desa'],
                'kode_desa'=>$user['kode_desa'],
            ];
            $this->session->set_userdata(['user_logged'=>$data]);
            return true;
        }elseif($user && ($user['user_role']==2 || $user['user_role']==1) && $user['password']==$password){
            $data=[
                'id_user'=>$user['id_user'],
                'email'=>$user['email'],
                'user_role'=>$user['user_role'],
                'nama_desa'=>$user['nama_desa'],
                'kode_desa'=>$user['kode_desa'],
                'rt'=>$user['rt'],
                'rw'=>$user['rw'],
            ];
            $this->session->set_userdata(['user_logged'=>$data]);
            return true;
        }else{
            $this->session->set_flashdata('errP','Wrong Username');
            $this->session->set_flashdata('errP','Wrong Password or Blocked');
            redirect(site_url('auth')); 
        }
    }

    public function doLogout()
    {
       $this->session->sess_destroy();
       return true;
   }

   public function get_data()
   {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('users.lvl_user',2);
    $query=$this->db->get();
    return $query;
}

}



?>
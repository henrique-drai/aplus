<?php
class UserModel extends CI_Model {

    public function getUserByEmail($email)
        {
            $query = $this->db->get_where('user', array('email' => $email));
            return $query->result();
        }
}
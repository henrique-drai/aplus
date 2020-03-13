<?php
class UserModel extends CI_Model {

    public function getUserByEmail($email) {
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->row();
    }

    public function getUserById($id) {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->row();
    }

    # serve para o login
    public function isValidPassword($email, $password) {
        $query = $this->db->get_where('user', array('email' => $email,'password' => md5($password)));
        return ($query->num_rows() > 0)? true : false;
    }

    public function registerUser($data) {
        $this->db->insert("user", $data);
        $data["user_id"] = $this->db->insert_id();
        return $data;
    }

    #Admin ver e dar manage nos Alunos
    public function getStudents(){
        $query = $this->db->get_where('user', array('role' => "student"));
        return $query->result_array();
    }

    public function deleteStudent($email){
        $query = $this->db->delete('user', array('email'=>$email));
    }

    public function editStudent($email, $data){
        $this->db->set('name', $data["name"]);
        $this->db->set('surname', $data["surname"]);
        $this->db->set('email', $data["email"]);
        $this->db->set('password', $data["password"]);
        $this->db->set("role", $data["role"]);
        $this->db->where('email', $email);
        $this->db->update('mytable');
    }

    public function getTeachers(){
        $query = $this -> db -> get_where('user', array('role' => "teacher"));
        return $query->result_array();
    }
}
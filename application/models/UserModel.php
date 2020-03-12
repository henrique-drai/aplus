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

    public function getTeachers(){
        $query = $this -> db -> get_where('user', array('role' => "teacher"));
        return $query->result_array();
    }
    // NAO DEVERIA SER DELETEUSER, JÁ QUE A FUNÇÃO É IGUAL PARA AMBOS?
    public function deleteTeacher($email){
        $query = $this->db->delete('user', array('email'=>$email));
    }
}
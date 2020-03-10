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

        $id = $this->db->insert_id();

        $data["user_id"] = $id;

        switch ($data["role"]) {
            case "admin":
                $this->db->insert("admin", Array("user_id" => $id));
                $data["admin_id"] = $this->db->insert_id();
                break;
            case "student":
                $this->db->insert("aluno", Array("user_id" => $id));
                $data["student_id"] = $this->db->insert_id();
                break;
            case "teacher":
                $this->db->insert("professor", Array("user_id" => $id));
                $data["teacher_id"] = $this->db->insert_id();
                break;
            default: $data["msg"] = "ERRO (o role eh invalido)";
        }

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
}
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

    public function deleteUser($email){
        $query = $this->db->delete('user', array('email'=>$email));
    }

    public function editStudent($email, $data){
        $this->db->set('name', $data["name"]);
        $this->db->set('surname', $data["surname"]);
        $this->db->set('email', $data["email"]);
        $this->db->set('password', $data["password"]);
        $this->db->set("role", $data["role"]);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function updateUser($data){
        $null = true;
        if(isset($data["name"]))
            {$this->db->set('name', $data["name"]); $null=false;}
        if(isset($data["surname"]))
            {$this->db->set('surname', $data["surname"]); $null=false;}
        if(isset($data["password"]))
            {$this->db->set('password', md5($data["password"])); $null=false;}

        if(!$null) {
            $this->db->where('id', $data["id"]);
            $this->db->update('user');
        }
    }

    public function getTeachers(){
        $query = $this -> db -> get_where('user', array('role' => "teacher"));
        return $query->result_array();
    }

    public function countStudents(){
        $this->db->where('role', 'student');
        return $this->db->count_all_results('user');
    }

    public function countTeachers(){
        $this->db->where('role', 'teacher');
        return $this->db->count_all_results('user');
    }

    //////////////////////////////////////////////////////////////
    //                         TEACHER
    //////////////////////////////////////////////////////////////
    #buscar as cadeiras de um prof
    public function getCadeiras($id) {
        $this->db->select("cadeira_id");
        $this->db->where(array('user_id =' => $id));
        $query = $this->db->get('professor_cadeira');
        return $query->result_array();
    }

    public function getCadeiraInfo($id) {
        $query = $this->db->get_where('cadeira', array('id =' => $id));
        return $query->result_array();
    }

    public function getDescription($id) {
        $query = $this->db->get_where('cadeira', array('code =' => $id));
        return $query->result_array();
    }

    public function getHours($id, $user_id) {
        $query = $this->db->get_where('professor_cadeira', array('cadeira_id =' => $id, 'user_id =' => $user_id));
        return $query->result_array();
    }

    public function insertText($data) {
        $this->db->set('description', $data["text"]);
        $this->db->where('code', $data["id"]);
        $data = $this->db->update('cadeira');
    }
}
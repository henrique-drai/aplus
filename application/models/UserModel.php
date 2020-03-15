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

    //////////////////////////////////////////////////////////////
    //                         TEACHER
    //////////////////////////////////////////////////////////////
    #burcar as cadeiras de um prof
    public function getCadeiras($id) {
        $this->db->select("cadeira_id");
        $this->db->where(array('user_id =' => $id));
        $query = $this->db->get('professor_cadeira');
        return $query->result_array();
        // console.log($data);

        // for(var i=0; i < $data.length; i++) {
        //     $this->db->where(array('id = ' => $data[i]));
        //     $query = $this->db->get('cadeira');
        // }

        // return $data;
    }

    public function getCadeiraInfo($id) {
        // $this->db->select('*');
        // $this->db->where(array('id =' => $id));
        $query = $this->db->get_where('cadeira', array('id =' => $id));
        return $query->result_array();
    }
}
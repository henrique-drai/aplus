<?php
class UserModel extends CI_Model {

    public function getUserByEmail($email) {
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->row();
    }

    public function getUserByEmailRA($email) {
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->result_array();
    }

    public function getUserById($id) {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->row();
    }

    public function getUserByIdRA($id) {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->result_array();
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
        $this->db->where(array('role' => "student"));
        $this->db->order_by("name","asc");
        $query = $this->db->get("user");
        return $query->result_array();
    }

    public function getSearchStudentTeachers($query){
        $this->db->select("*");
        $status_condition = 'user.role = student OR user.role = teacher';
        $this->db->where($status_condition);

        // $this->db->where("role = 'student'");
        // $this->db->or_where("role = 'teacher'");

        if($query != ''){
            // $this->db->group_start();
            $this->db->like("email", $query);
            $this->db->or_like("name", $query);
            $this->db->or_like("surname", $query);
            // $this->db->group_end();
        }
        $this->db->order_by("name","ASC");
        return $this->db->get('user');
    }

    public function deleteUser($email){
        $query = $this->db->delete('user', array('email'=>$email));
    }

    public function editStudent($email, $data){
        if(isset($data["name"])){
            $this->db->set('name', $data["name"]);
        }
        if(isset($data["surname"])){
            $this->db->set('surname', $data["surname"]);
        }
        if(isset($data["email"])){
            $this->db->set('email', $data["email"]);
        }
        if(isset($data["password"])){
            $this->db->set('password', md5($data["password"]));
        }
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function updateUser($data){
        if(isset($data["name"]))
            {$this->db->set('name', $data["name"]);}
        if(isset($data["surname"]))
            {$this->db->set('surname', $data["surname"]);}
        if(isset($data["password"]))
            {$this->db->set('password', md5($data["password"]));}
        
        $this->db->set('description', $data["description"]);
        $this->db->set('gabinete', $data["gabinete"]);
        $this->db->where('id', $data["id"]);
        $this->db->update('user');
    }

    public function getTeachers(){
        $this->db->where(array('role' => "teacher"));
        $this->db->order_by("name","asc");
        $query = $this->db->get("user");
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

    public function getStudentsTeachers(){
        $this->db->where('role', 'student');
        $this->db->or_where('role', 'teacher');
        $query = $this->db->get('user');
        
        return $query->result_array();

    }

    public function getSearchStudent($query){
        $this->db->select("*");
        $this->db->where("role = 'student'");
        if($query != ''){
            $this->db->group_start();
            $this->db->like("email", $query);
            $this->db->or_like("name", $query);
            $this->db->or_like("surname", $query);
            $this->db->group_end();
        }
        $this->db->order_by("name","ASC");
        return $this->db->get('user');
    }

    public function getSearchTeacher($query){
        $this->db->select("*");
        $this->db->where("role = 'teacher'");
        if($query != ''){
            $this->db->group_start();
            $this->db->like("email", $query);
            $this->db->or_like("name", $query);
            $this->db->or_like("surname", $query);
            $this->db->group_end();
        }
        $this->db->order_by("name","ASC");
        return $this->db->get('user');
    }
    
    public function updatePicture($user_id, $value){
        $this->db->set('picture', $value);
        $this->db->where('id', $user_id);
        $this->db->update('user');
    }

    public function insertUpdate($data){
        #Necessário fazer o else update?
        $query = $this->db->get_where('user', array(
            'email ='         => $data["email"], 
        ));

        if ($query->num_rows() == 0) {
            $this->db->insert('user', $data);  
        }

    }
}
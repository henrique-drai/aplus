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

    public function getSomeValuesUser($id){
        $this->db->select("name, surname, id, picture, email");
        $this->db->where(array('id' => $id));
        $query = $this->db->get("user");
        return $query->row();
    }

    public function getMyRatings($user_id) {
        $query = $this->db->get_where('member_classification', array('classificado_id' => $user_id));
        return $query->result_array();
    }

    public function userIsRelatedToGroup($user_id, $grupo_id) {
        $grupo_id = $this->db->escape($grupo_id);
        $result = $this->db->query("select * 
            from grupo_aluno, user
            where grupo_aluno.user_id = user.id
            and user.id = $user_id
            and grupo_aluno.grupo_id = $grupo_id");
        return ($result->num_rows() > 0)? true : false;
    }

    public function getFutureSubmissionsByGroupId($grupo_id){
        $id = $this->db->escape($grupo_id);
        $query = "select * 
            from grupo, projeto, etapa
            where etapa.projeto_id = projeto.id
            and grupo.projeto_id = projeto.id
            and etapa.deadline >= CURDATE()
            and grupo.id = $id";
        return $this->db->query($query)->result_array();
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

    public function isValidUser($id) {
        $query = $this->db->get_where('user', array('id' => $id));
        return ($query->num_rows() > 0)? true : false;
    }

    public function registerUser($data) {
        $this->db->insert("user", $data);
        $data["user_id"] = $this->db->insert_id();
        return $data;
    }

    #Admin ver e dar manage nos Alunos
    public function getStudents(){
        $this->db->select("name, surname, email");
        $this->db->where(array('role' => "student"));
        $this->db->order_by("name","asc");
        $query = $this->db->get("user");
        return $query->result_array();
    }

    public function getSearchStudentTeachers($query){
        $this->db->select("name, surname, picture, id");
        $status_condition = 'role != "admin"';
        $this->db->where($status_condition);

        if($query != ''){
            $this->db->group_start();
            $this->db->like("email", $query);
            $this->db->or_like("name", $query);
            $this->db->or_like("surname", $query);
            $this->db->or_like("CONCAT(name,' ',surname)", $query);
            $this->db->limit(20);  
            $this->db->group_end();
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
        if(strlen($data["name"]))
            {$this->db->set('name', $data["name"]);}
        if(strlen($data["surname"]))
            {$this->db->set('surname', $data["surname"]);}
        if(strlen($data["password"]))
            {$this->db->set('password', md5($data["password"]));}
        
        $this->db->set('description', $data["description"]);
        $this->db->set('gabinete', $data["gabinete"]);
        $this->db->where('id', $data["id"]);
        $this->db->update('user');
    }

    public function getTeachers(){
        $this->db->select("name, surname, email");
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
        $this->db->select("name, surname, email");
        $this->db->where("role = 'student'");
        if($query != ''){
            $this->db->group_start();
            $this->db->like("email", $query);
            $this->db->or_like("name", $query);
            $this->db->or_like("surname", $query);
            $this->db->or_like("CONCAT(name,' ',surname)", $query);
            $this->db->group_end();
        }
        $this->db->order_by("name","ASC");
        return $this->db->get('user');
    }

    public function getSearchTeacher($query){
        $this->db->select("name, surname, email");
        $this->db->where("role = 'teacher'");
        if($query != ''){
            $this->db->group_start();
            $this->db->like("email", $query);
            $this->db->or_like("name", $query);
            $this->db->or_like("surname", $query);
            $this->db->or_like("CONCAT(name,' ',surname)", $query);
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
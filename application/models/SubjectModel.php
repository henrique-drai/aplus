<?php
class SubjectModel extends CI_Model { //cadeira

    public function getSubjectByCode($code) {
        $query = $this->db->get_where('cadeira', array('code' => $code));
        return $query->row();
    }

    //esta é a unica query que vai buscar o subject certo no ano letivo id certo
    public function getSubjectByCodeAndYear($code, $year){
        $query = "select *
            from cadeira
            where cadeira.code =".$this->db->escape($code)."
            and (select ano_letivo_id from curso 
                where id = cadeira.curso_id) =".$year;

        $result = $this->db->query($query);
        return $result->row();

    }

    public function getSearchStudentCourse($string, $cadeira_id) {
        $query = "select *
                  from user
                  left join aluno_cadeira on id = user_id
                  where cadeira_id = ".$cadeira_id ."
                  and (name like '" . $string . "%'
                  or email like '" . $string . "%'
                  or surname like '" . $string . "%')";
        
        $data = $this->db->query($query);
        return $data->result_array();
    }


    public function getSubjectByID($id) {
        $query = $this->db->get_where('cadeira', array('id' => $id));
        return $query->row();
    }

    public function getCadeiras($id, $role) {
        $this->db->select("cadeira_id");
        $this->db->where(array('user_id =' => $id));
        
        if($role == "teacher") {
            $query = $this->db->get('professor_cadeira');
        } else if($role == "student") {
            $query = $this->db->get('aluno_cadeira');
        }
        
        return $query->result_array();
    }

    public function getCadeirasOrder($id, $role) {
        $this->db->where(array('user_id =' => $id));
        $this->db->order_by('last_visited', 'DESC');
        
        if($role == "teacher") {
            $query = $this->db->get('professor_cadeira');
        } else if($role == "student") {
            $query = $this->db->get('aluno_cadeira');
        }
        
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

    public function getDescriptionById($id) {
        $query = $this->db->get_where('cadeira', array('id =' => $id));
        return $query->result_array();
    }

    public function getHours($id) {
        $query = $this->db->get_where('horario_duvidas', array('id_cadeira =' => $id));
        return $query->result_array();
    }

    public function insertText($data) {
        $this->db->set('description', $data["text"]);
        $this->db->where('id', $data["id"]);
        $data = $this->db->update('cadeira');
    }

    public function saveHours($data) {
        $query = $this->db->get_where('horario_duvidas', array(
            'id_prof ='         => $data["id_prof"], 
            'id_cadeira ='      => $data["id_cadeira"], 
            'day ='             => $data['day']
        ));

        if ($query->num_rows() > 0) {
            $this->db->where(array(
                'id_prof ='     => $data['id_prof'],
                'id_cadeira ='  => $data["id_cadeira"],
                'day ='         => $data["day"]
            ));
            return $this->db->update('horario_duvidas', $data);
        } else {
            $this->db->insert('horario_duvidas', $data);
            return $this->db->insert_id();
        }
    }

    public function removeHours($data) {
        $this->db->where(array(
            'id_prof ='         => $data['id_prof'],
            'id_cadeira ='      => $data["id_cadeira"],
            'start_time ='      => $data["start_time"],
            'end_time ='        => $data["end_time"],
            'day ='             => $data["day"]
        ));
        return $this->db->delete('horario_duvidas');
    }

    public function getProj($id) {
        $query = $this->db->get_where('projeto', array('cadeira_id =' => $id));
        return $query->result_array();
    }

    public function registerSubject($data){
        $this->db->insert("cadeira", $data);
        $data["cadeira_id"] = $this->db->insert_id();
        return $data;
    }

    public function getAllSubjects(){
        $query = $this->db->get("cadeira");
        return $query->result_array();
    }

    public function getSubjectsByCursoId($id){
        $query = $this->db->get_where('cadeira', array('curso_id ' => $id));
        return $query->result_array();
    }

    public function countSubjects(){
        return $this->db->count_all_results('cadeira');
    }

    public function deleteSubject($code){
        $query = $this->db->delete('cadeira', array('code'=>$code));
    }

    public function registerStudentSubject($data){
        $this->db->insert("aluno_cadeira", $data);
    }

    public function getNumSubjectByCourse($course){
        $query = $this->db->get_where("cadeira", array('curso_id ' => $course));
        return $query->num_rows();
    }

    public function insertUpdate($data){

        $query = $this->db->get_where('aluno_cadeira', array(
            'user_id ='         => $data["user_id"], 
            'cadeira_id ='      => $data["cadeira_id"]
        ));

        if ($query->num_rows() > 0) {
            $this->db->where(array(
                'user_id ='     => $data['user_id'],
                'cadeira_id ='  => $data["cadeira_id"],
                'is_completed ='         => $data["is_completed"],
                'image_url ='         => $data["image_url"]
            ));
            return $this->db->update('aluno_cadeira', $data);
        }
        else{
            $this->db->insert('aluno_cadeira', $data);    
        }

    }

    public function insertDate($cadeira_id, $user_id, $role) {
        $this->db->set('last_visited', date('Y-m-d H:i:s'));
        $this->db->where(array("user_id" => $user_id, "cadeira_id" => $cadeira_id));

        if($role == "student") {
            return $this->db->update("aluno_cadeira");
        } else {
            return $this->db->update("professor_cadeira");
        }
        
    }

    public function getLastLogged($user_id, $cadeira_id) {
        $query = $this->db->get_where("aluno_cadeira", array('cadeira_id ' => $cadeira_id, "user_id" => $user_id));
        return $query->row();
    }


    public function editSubject($id, $data){
        if(isset($data["code"])){
            $this->db->set('code', $data["code"]);
        }
        if(isset($data["name"])){
            $this->db->set('name', $data["name"]);
        }
        if(isset($data["sigla"])){
            $this->db->set('sigla', $data["sigla"]);
        }
        if(isset($data["semestre"])){
            $this->db->set('semestre', $data["semestre"]);
        }
        if(isset($data["description"])){
            $this->db->set('description', $data["description"]);
        }
        $this->db->where('id', $id);
        $this->db->update('cadeira');
    }

    public function deleteHourById($id) {
        $this->db->where('id', $id);
        $this->db->delete('horario_duvidas');
    }


    public function getFicheiroAreaByURLSub($url, $cadeira_id){
        return $this->db->get_where("ficheiros_cadeira", array('url' => $url, "cadeira_id" => $cadeira_id))->row();
    }

    public function submitFicheiroArea($data){
        return $this->db->insert("ficheiros_cadeira", $data);
    }

    public function updateFicheiroArea($id, $url){
        $this->db->set("url", $url);
        $this->db->where("id", $id);
        $this->db->update("ficheiros_cadeira");
        return $this->db->affected_rows();
    }

    public function getFicheirosCadeira($cadeira_id){
        return $this->db->get_where("ficheiros_cadeira", array("cadeira_id" => $cadeira_id))->result_array();
    }

    public function removeFicheiroAreaCadeira($ficheiro_id){
        $this->db->where("id", $ficheiro_id);
        $this->db->delete("ficheiros_cadeira");
    }

    public function getFicheiroById($ficheiro_id){
        return $this->db->get_where("ficheiros_cadeira", array("id" => $ficheiro_id))->result_array();
    }

    public function insertAlunoCadeira($data){
        $this->db->insert("aluno_cadeira", $data);
    }

    public function insertProfCadeira($data){
        $this->db->insert("professor_cadeira", $data);
    }

    public function verifyTeacherSubject($user_id, $cadeira_id){
        return $this->db->get_where("professor_cadeira", array("user_id" => $user_id, "cadeira_id" => $cadeira_id))->row();
    }

    public function deleteStudentSubject($user_id, $cadeira_id){
        $query = $this->db->delete('aluno_cadeira', array('user_id'=>$user_id, 'cadeira_id'=>$cadeira_id));
    }

    public function confirmUserInSubject($user_id, $cadeira_id){
        return $this->db->get_where("aluno_cadeira", array('user_id' => $user_id, "cadeira_id" => $cadeira_id))->row();
    }
}
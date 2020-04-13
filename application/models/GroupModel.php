<?php
class GroupModel extends CI_Model { //grupo & member_classification & grupo_msg

    public function getAllGroups($proj_id){
        return $this->db->get_where("grupo", array("projeto_id" => $proj_id)) -> result_array();
    }

    public function getStudents($group_id){
        return $this->db->get_where("grupo_aluno", array("grupo_id" => $group_id)) -> result_array();
    }

    public function getGroups($user_id){
        return $this->db->get_where("grupo_aluno", array("user_id" => $user_id)) -> result_array();
    }

    public function getProjectId($group_id){
        return $this->db->get_where("grupo", array("id" => $group_id)) -> result_array();
    }

    public function insertClassification($data){
        $this->db->insert("member_classification", $data);    
    }

    
}
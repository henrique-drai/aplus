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

    public function getClassVal($grupo_id, $userId){
        return $this->db->get_where("member_classification", array("grupo_id" => $grupo_id, "classificado_id" => $userId)) -> row();
    }

    public function insertClassification($data){
        $this->db->insert("member_classification", $data);    
    }

    public function getGroupById($group_id){
        return $this->db->get_where("grupo", array("id" => $group_id)) -> result_array();
    }
    
    public function leaveGroup($user_id, $group_id){
        $this->db->where("user_id", $user_id);
        $this->db->where("grupo_id", $group_id);
        $this->db->delete('grupo_aluno');
    }

    public function countElements($group_id){
        $q = $this->db->get_where("grupo_aluno", array("grupo_id" => $group_id));
        return $q->num_rows();
    }

    public function createGroup($data){
        $this->db->insert("grupo", $data);
        $data["grupo"] = $this->db->insert_id();
        return $data;
    }

    public function addElementGroup($data){
        $this->db->insert("grupo_aluno", $data);
        $data["grupo_aluno"] = $this->db->insert_id();
        return $data;
    }
}
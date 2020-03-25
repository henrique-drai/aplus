<?php
class GroupModel extends CI_Model { //grupo & member_classification & grupo_msg

    public function getAllGroups($proj_id){
        return $this->db->get_where("grupo", array("projeto_id" => $proj_id)) -> result_array();
    }

    public function getStudents($group_id){
        return $this->db->get_where("grupo_aluno", array("grupo_id" => $group_id)) -> result_array();
    }
    
}
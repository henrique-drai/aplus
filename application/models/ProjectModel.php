<?php
class ProjectModel extends CI_Model { //projeto & etapa & tarefa & etapa_submit

    public function insertProject($data){
        $this->db->insert("projeto", $data);
        return $this->db->insert_id();
    }

    public function insertEtapa($data){
        $this->db->insert("etapa", $data);
    }

    public function getProjectByID($proj_id){
        return $this->db->get_where("projeto", array("id" => $proj_id)) -> result_array();
    }
}



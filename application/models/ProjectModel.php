<?php
class ProjectModel extends CI_Model { //projeto & etapa & tarefa & etapa_submit

    public function insertProject($data){
        $this->db->insert("projeto", $data);
        return $this->db->insert_id();
    }

    public function insertEtapa($data){
        $this->db->insert("etapa", $data);
        return $this->db->insert_id();
    }

    public function getProjectByID($proj_id){
        return $this->db->get_where("projeto", array("id" => $proj_id)) -> result_array();
    }

    public function removeProjectByID($proj_id){
        return $this->db->delete("projeto", array("id" => $proj_id));
    }

    public function getEtapasByProjectID($proj_id){
        return $this->db->order_by("deadline", "ASC")->get_where("etapa",array("projeto_id" => $proj_id)) -> result_array();
    }

    public function removeEtapaByID($id){
        return $this->db->delete("etapa", array("id" => $id));
    }
}



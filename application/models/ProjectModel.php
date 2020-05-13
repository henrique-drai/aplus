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

    public function updateEtapa($data, $id){
        return $this->db->update("etapa", $data, ['id' => $id]);
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

    public function getLastEtapa($proj_id){
        return $this->db->order_by("deadline", "DESC")->get_where("etapa",array("projeto_id" => $proj_id)) -> result_array();
    }

    public function getEtapaByID($id){
        return $this->db->get_where("etapa", array("id" => $id));
    }

    public function removeEtapaByID($id){
        return $this->db->delete("etapa", array("id" => $id));
    }

    public function updateProjEnunciado($enunciado, $proj_id){
        $this->db->set('enunciado_url', $enunciado);
        $this->db->where('id', $proj_id);
        $this->db->update("projeto");
        return $this->db->affected_rows(); 
    }

    public function clearEnuncEtapa($id){
        $this->db->set('enunciado_url', '');
        $this->db->where('id', $id);
        $this->db->update("etapa");
        return $this->db->affected_rows(); 
    }

    public function getSubmission($grupo_id, $etapa_id){
        return $this->db->get_where("etapa_submit", array("grupo_id" => $grupo_id, "etapa_id" => $etapa_id));
    }

    public function insertFeedback($feedback, $id){
        $this->db->set('feedback', $feedback);
        $this->db->where('id', $id);
        $this->db->update("etapa_submit");
        return $this->db->affected_rows(); 
    }

    public function editEtapaEnunciado($enunciado, $etapa){
        $this->db->set('enunciado_url', $enunciado);
        $this->db->where('id', $etapa);
        $this->db->update("etapa");
        return $this->db->affected_rows();
    }

    public function removeEnunciadoProj($proj){
        $this->db->set('enunciado_url', '');
        $this->db->where('id', $proj);
        $this->db->update("projeto");
        return $this->db->affected_rows(); 
    }

    public function submitEtapa($data){
        $this->db->insert("etapa_submit", $data);
        return $this->db->insert_id();
    }

    public function updateSubmission($grupo, $etapa, $ficheiro){
        $this->db->set('submit_url', $ficheiro);
        $this->db->where('grupo_id', $grupo);
        $this->db->where('etapa_id', $etapa);
        $this->db->update("etapa_submit");
        return $this->db->affected_rows(); 
    }
}



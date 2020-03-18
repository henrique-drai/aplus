<?php
class ProjectModel extends CI_Model {
    public function insertProject($data){
        $this->db->insert("projeto", $data);
        return $this->db->insert_id();
    }
}



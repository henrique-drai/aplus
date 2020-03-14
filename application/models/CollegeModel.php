<?php
class CollegeModel extends CI_Model {

    public function registerCollege($data) {
        $this->db->insert("faculdade", $data);
        $data["faculdade_id"] = $this->db->insert_id();
        return $data;
    }
}
<?php
class CollegeModel extends CI_Model {

    public function registerCollege($data) {
        $this->db->insert("faculdade", $data);
        $data["faculdade_id"] = $this->db->insert_id();
        return $data;
    }

    public function getColleges(){
        $query = $this->db->get("faculdade");
        return $query->result_array();
    }

    public function deleteCollege($siglas){
        $query = $this->db->delete('faculdade', array('siglas'=>$siglas));
    }

}
<?php
class CollegeModel extends CI_Model {

    public function registerCollege($data) {
        $this->db->insert("faculdade", $data);
        $data["faculdade_id"] = $this->db->insert_id();
        return $data;
    }

    public function getColleges(){
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get("faculdade");
        return $query->result_array();
    }

    public function deleteCollege($siglas){
        $query = $this->db->delete('faculdade', array('siglas'=>$siglas));
    }

    public function countColleges(){
        return $this->db->count_all_results('faculdade');
    }

    public function getCollegeBySigla($sigla){
        $query = $this->db->get_where("faculdade", array('siglas'=>$sigla));
        return $query->row();
    }

}
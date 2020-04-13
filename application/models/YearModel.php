<?php
class YearModel extends CI_Model { //ano_letivo
    public function getAllSchoolYears(){
        $this->db->order_by("inicio", "asc");
        $query = $this->db->get('ano_letivo');
        return $query->result();
    }
    public function registerSchoolYear($data){
        $this->db->insert("ano_letivo", $data);
    }
    public function deleteSchoolYear($inicio){
        $this->db->delete('ano_letivo', array('inicio'=>$inicio));
    }

    public function countAcademicYear(){
        return $this->db->count_all_results('ano_letivo');
    }
    public function getYearById($data) {
        $query = $this->db->get_where("ano_letivo", array('id'=>$data));
        return $query->result_array();
    }

    public function getYearByInicio($inicio){
        $query = $this->db->get_where("ano_letivo", array('inicio'=>$inicio));
        return $query->result_array();
    }
}

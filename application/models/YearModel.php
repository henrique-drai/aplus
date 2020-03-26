<?php
class YearModel extends CI_Model { //ano_letivo
    public function getSchoolYears(){
        $query = $this->db->get('ano_letivo');
        return $query->result();
    }
    public function registerSchoolYear($data){
        $this->db->insert("ano_letivo", $data);
    }
}

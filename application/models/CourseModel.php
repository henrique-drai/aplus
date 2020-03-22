<?php
class CourseModel extends CI_Model { //curso & curso_standard

    public function getCollegeCourses($faculdade){
        $query = $this->db->get_where("curso", array('faculdade_id'=>$faculdade));
        return $query->result_array();
    }

    public function getCourse_Standard($course){
        $query = $this->db->get_where("curso_standard", array("id"=>$course));
        return $query->row();
    }

    public function getCourse_StandardId($courseid){
        $query = $this->db->get_where("curso", array("id"=>$course));
        return $query->row("curso_standard_id");
    }
}
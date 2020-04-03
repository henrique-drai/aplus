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


    public function register_course_standard($data){
        $this->db->insert("curso_standard", $data);
        $course_id = $this->db->insert_id();
        return $course_id;
    }

    public function deleteCollegeCourse($data){
        $this->db->where(array(
            'faculdade_id ='         => $data['faculdade_id'],
            'curso_standard_id ='      => $data['curso_standard_id'],
        ));
        return $this->db->delete('curso');
    }
    
    public function register_course($data){
        $this->db->insert("curso", $data);
    }
    
    public function getCourse_StandardId($courseid){
        $query = $this->db->get_where("curso", array("id"=>$courseid));
        return $query->row("curso_standard_id");
    }

    public function countCourses(){
        return $this->db->count_all_results('curso_standard');
    }

}


    


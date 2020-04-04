<?php
class CourseModel extends CI_Model { //curso & curso_standard

    public function getCollegeCourses($faculdade){
        $query = $this->db->get_where("curso", array('faculdade_id'=>$faculdade));
        return $query->result_array();
    }

    public function deleteCollegeCourse($data){
        $this->db->where(array(
            'faculdade_id ='         => $data['faculdade_id'],
            'code ='      => $data['code'],
        ));
        return $this->db->delete('curso');
    }
    
    public function register_course($data){
        $this->db->insert("curso", $data);
    }
    
    public function countCourses(){
        return $this->db->count_all_results('curso');
    }

    public function countMany($idCurso){
        $this->db->where('curso_standard_id',$idCurso);
        $this->db->from("curso");
        return $this->db->count_all_results();
    }

    public function getCursobyId($cursoId){
        $query = $this->db->get_where("curso", array('id'=>$cursoId));
        return $query->row();
    }


    public function editCourse($data){

        $this->db->set('ano_letivo_id', $data["academicYear"]);
        $this->db->set('code', $data["code"]);
        $this->db->set('name', $data["name"]);
        $this->db->set('description', $data["description"]);
       
        $this->db->where(array(
            'faculdade_id ='    => $data['collegeId'],
            'code ='            => $data['oldCurso'],
        ));
        
        $this->db->update('curso');    
    }

}


    


<?php
class CourseModel extends CI_Model { //curso & curso_standard & aluno_curso

    public function getCollegeYearCourses($faculdade, $ano){
        $query = $this->db->get_where("curso", array('faculdade_id'=>$faculdade, "ano_letivo_id"=>$ano));
        return $query->result_array();
    }

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

    public function getCursobyId($cursoid){
        $query = $this->db->get_where("curso", array('id'=>$cursoid));
        return $query->row();
    }

    public function getCourses(){
        $query = $this->db->get("curso");
        return $query->result_array();
    }

    public function getCursobyName($cursoName){
        $query = $this->db->get_where("curso", array('name'=>$cursoName));
        return $query->result_array();
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

    public function getCoursesByYear($yearid){
        $query = $this->db->get_where("curso", array('ano_letivo_id'=>$yearid));
        return $query->result_array();
    }

    public function getStudentsByCourse($cursoid){
        $query = $this->db->get_where("aluno_curso", array('curso_id'=>$cursoid));
        return $query->result_array();
    }
}


    


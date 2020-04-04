<?php
class CourseModel extends CI_Model { //curso & curso_standard

    public function getCollegeCourses($faculdade){
        $query = $this->db->get_where("curso", array('faculdade_id'=>$faculdade));
        return $query->result_array();
    }

    //PARA APAGAR
    public function getCourse_Standard($course){
        $query = $this->db->get_where("curso_standard", array("id"=>$course));
        return $query->row();
    }

    //PARA APAGAR
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
    
    //PARA APAGAR
    public function getCourse_StandardId($courseid){
        $query = $this->db->get_where("curso", array("id"=>$courseid));
        return $query->row("curso_standard_id");
    }

    public function countCourses(){
        return $this->db->count_all_results('curso');
    }

    public function countMany($idCurso){
        $this->db->where('curso_standard_id',$idCurso);
        $this->db->from("curso");
        return $this->db->count_all_results();
    }


    public function editCourse($data){

        // EDITAR CURSO QUE SÓ PERTENÇA A 1 E SÓ 1 FACULDADE?
        // $data = Array(
        //     "idCurso"       => $this->post('idCurso'),
        //     "name"          => $this->post('name'),
        //     "description"   => $this->post('description'),
        //     "oldCurso"      => $this->post('oldCurso'),
        // );

        // if(countMany(data['idCurso']==1)){

        // }
        // $this->db->set('name', $data["name"]);
        // $this->db->set('surname', $data["surname"]);
        // $this->db->set('email', $data["email"]);
        // $this->db->set('password', $data["password"]);
        // $this->db->set("role", $data["role"]);
        // $this->db->where('email', $email);
        // $this->db->update('user');
        
    }

}


    


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


    


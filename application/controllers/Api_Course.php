<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Course extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->verify_request();
    }

    
    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function editCourse_post(){ 
        $this->verify_admin();
        $this->load->model("CourseModel");
        $this->load->model("YearModel");

        $idYear = $this->YearModel->getYearByInicio(htmlspecialchars($this->post('academicYear')))->id;

        $data = Array(
            "code"         => htmlspecialchars($this->post('code')),
            "name"          => htmlspecialchars($this->post('name')),
            "academicYear"  => $idYear,
            "description"   => htmlspecialchars($this->post('description')),
            "oldCurso"      => htmlspecialchars($this->post('oldCurso')),
            "collegeId"      => htmlspecialchars($this->post('collegeId')),
        );
        $this->CourseModel->editCourse($data);
    }

    public function registerCurso_post(){ 
        $this->verify_admin();
        $this -> load -> model('CourseModel');
       
        $data = Array(
            "faculdade_id"      => htmlspecialchars($this->post('collegeId')),
            "ano_letivo_id"     => htmlspecialchars($this->post('academicYear')),
            "code"              => htmlspecialchars($this->post('codCourse')),
            "name"              => htmlspecialchars($this->post('nameCourse')),
            "description"       =>htmlspecialchars($this->post('descCourse'))
        );
       
        $this->CourseModel->register_course($data);
    }


    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////


    public function getAllCollegesYearCourses_get(){ 
        $this->verify_admin();

        $faculdade = htmlspecialchars($this->get('faculdade'));
        $ano = htmlspecialchars($this->get('anoletivo'));
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCollegeYearCourses($faculdade, $ano);
        $this->response($data, parent::HTTP_OK);
    }

    
    public function getAllCollegesCourses_get(){ 
        $this->verify_admin();

        $faculdade = htmlspecialchars($this->get('faculdade'));
        $this->load->model('CourseModel');
        $this->load->model('YearModel');

        $data["courses"] = $this->CourseModel->getCollegeCourses($faculdade);

        $data["years"] = array();

        for($i=0; $i<count($data["courses"]);$i++){

            $anoLetivo = $data["courses"][$i]["ano_letivo_id"];
            $inicio = $this -> YearModel -> getYearById($anoLetivo)[0]["inicio"];
            // $fim = $this -> YearModel -> getYearById($anoLetivo)[0]["fim"];
            
            // array_push($data["years"], $inicio . "|" . $fim);
            array_push($data["years"], $inicio);
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getAllCoursesByYear_get(){ 
        $this->verify_admin();

        $ano = htmlspecialchars($this->get('idyear'));
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCoursesByYear($ano);
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllCourses_get(){ 
        $this->verify_admin();

        $this->load->model('CourseModel');
        $this->load->model('SubjectModel');
        $data["courses"] = $this->CourseModel->getCourses();
        $data["numSubject"] = array();
        for($i=0; $i<count($data["courses"]);$i++){
            $values = array(
                $data["courses"][$i]["name"] => $this->SubjectModel->getNumSubjectByCourse($data["courses"][$i]["id"])
            );
            $data["numSubject"] = array_merge($data["numSubject"], $values);
        }
        $this->response($data, parent::HTTP_OK);

    }


    //////////////////////////////////////////////////////////////
    //                      DELETE
    //////////////////////////////////////////////////////////////

    public function deleteCourse_delete(){ 
        $this->verify_admin();

        $this->load->model('CourseModel');
        $data = Array(
            "faculdade_id" => htmlspecialchars($this -> delete('idCollege')),
            "code" => htmlspecialchars($this -> delete('code')),            
        );
        $this -> CourseModel -> deleteCollegeCourse($data);
    }


    //////////////////////////////////////////////////////////////
    //                      AUTHENTICATION
    //////////////////////////////////////////////////////////////

    private function verify_request()
    {
        if(is_null($this->session->userdata('role'))){
            $this->response(array('msg' => 'You must be logged in!'), parent::HTTP_UNAUTHORIZED);
            exit();
        }
    }

    private function verify_admin(){
        $auth = $this->session->userdata('id');
        $this->load->model('UserModel');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(array('msg' => 'No admin rights.'), parent::HTTP_UNAUTHORIZED);
            exit();
        }
    }
}

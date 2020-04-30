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
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('UserModel');

    }

    
    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function editCourse_post(){
        $this->verify_request();
        $this->load->model("CourseModel");

        $data = Array(
            "code"         => $this->post('code'),
            "name"          => $this->post('name'),
            "academicYear"  => $this->post('academicYear'),
            "description"   => $this->post('description'),
            "oldCurso"      => $this->post('oldCurso'),
            "collegeId"      => $this->post('collegeId'),
        );
        $this->CourseModel->editCourse($data);
    }

    public function registerCurso_post(){
        $this->verify_request();
        $this -> load -> model('CourseModel');
       
        $data = Array(
            "faculdade_id"      => $this->post('collegeId'),
            "ano_letivo_id"     => $this->post('academicYear'),
            "code"              => $this->post('codCourse'),
            "name"              => $this->post('nameCourse'),
            "description"       => $this->post('descCourse')
        );
       
        $this->CourseModel->register_course($data);
    }


    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////


    public function getAllCollegesYearCourses_get(){
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }
        $faculdade = $this->get('faculdade');
        $ano = $this->get('anoletivo');
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCollegeYearCourses($faculdade, $ano);
        $this->response($data, parent::HTTP_OK);
    }

    
    public function getAllCollegesCourses_get(){
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $faculdade = $this->get('faculdade');
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCollegeCourses($faculdade);
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllCoursesByYear_get(){
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $ano = $this->get('idyear');
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCoursesByYear($ano);
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllCourses_get(){
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

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
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->model('CourseModel');
        $data = Array(
            "faculdade_id" => $this -> delete('idCollege'),
            "code" => $this -> delete('code'),            
        );
        $this -> CourseModel -> deleteCollegeCourse($data);
    }


    //////////////////////////////////////////////////////////////
    //                      AUTHENTICATION
    //////////////////////////////////////////////////////////////

    private function verify_request()
    {
        $headers = $this->input->request_headers();
        $token = $headers['Authorization'];
        // JWT library throws exception if the token is not valid
        try {
            // Successfull validation will return the decoded user data else returns false
            $data = AUTHORIZATION::validateToken($token);
            if ($data === false) {
                $status = parent::HTTP_UNAUTHORIZED;
                $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
                $this->response($response, $status);
                exit();
            } else {
                return $data;
            }
        } catch (Exception $e) {
            // Token is invalid
            // Send the unathorized access message
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }
}

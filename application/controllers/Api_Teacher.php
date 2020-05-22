<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Teacher extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->verify_request();
        $this->load->model("SubjectModel");
        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $this->load->model('StudentListModel');
    }


    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////





    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getProfHome_get($user_id = null) { 
        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        $data["ids"] = $this->SubjectModel->getCadeiras($user_id, "teacher");

        if(count($data["ids"]) > 0) {
            $data["info"] = array();
            for($i = 0; $i < count($data["ids"]); $i++) {
                array_push($data["info"], $this->SubjectModel->getCadeiraInfo($data["ids"][$i]["cadeira_id"]));
            };

            if(count($data["info"]) > 0) {
                $data["year"] = array();
            
                for($i = 0; $i < count($data["info"]); $i++) {
                    $tmp = $this->CourseModel->getCursobyId($data["info"][0][0]["curso_id"]);
                    array_push($data["year"], $this->YearModel->getYearById($tmp->ano_letivo_id));
                };
            }
    
            $data["alunos"] = array();
            for($i = 0; $i < count($data["ids"]); $i++) {
                array_push($data["alunos"], $this->StudentListModel->getStudentsbyCadeiraID($data["ids"][$i]["cadeira_id"]));
            }
        }
        
        $this->response($data, parent::HTTP_OK);
    }
    
    public function getSearchTeacher_get(){ 
        $query = '';
        $this->load->model('UserModel');
        if($this->get("query")){
            $query = $this->get("query");
        }
        $resultquery = $this->UserModel->getSearchTeacher($query);
        $data["teachers"] = "";
        if($resultquery -> num_rows() == 0){
            $data["teachers"] = "no data"; 
        }
        else{
            $data["teachers"] = $resultquery->result();
        }
        $this->response($data, parent::HTTP_OK);

    }

    public function getAllTeachers_get(){ 
        $this ->load-> model('UserModel');
        $data["teachers"] = $this ->UserModel-> getTeachers();
        $this -> response($data, parent::HTTP_OK);
    }


    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////




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
}

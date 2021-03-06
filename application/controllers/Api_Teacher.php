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
    
    public function getSearchTeacher_get(){ 
        $this->verify_admin();
        $query = '';
        $this->load->model('UserModel');
        if(htmlspecialchars($this->get("query"))){
            $query = htmlspecialchars($this->get("query"));
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
        $this->verify_admin();
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

    private function verify_admin(){
        $this->load->model('UserModel');
        $auth = $this->session->userdata('id');

        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(array('msg' => 'No admin rights.'), parent::HTTP_UNAUTHORIZED);
            exit();
        }
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_College extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->verify_request();
    }

  
    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////


    public function registerCollege_post(){ 
        $this->verify_admin();
        $data = Array(
            "name" => htmlspecialchars($this->post('nomefaculdade')),
            "location"   => htmlspecialchars($this->post('morada')),
            "siglas"   => htmlspecialchars($this->post('siglas')),
        );

        $this->load->model('CollegeModel');
        $retrieved = $this->CollegeModel->registerCollege($data);
        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }


    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getAllColleges_get(){ 
        $this->verify_admin();
        $this->load->model('CollegeModel');
        $data["colleges"] = $this->CollegeModel->getColleges();
        
        $this->response($data, parent::HTTP_OK);
    }

    //////////////////////////////////////////////////////////////
    //                           DELETE
    //////////////////////////////////////////////////////////////


    public function deleteCollege_delete(){
        $this->verify_admin();
        $siglas = $this->delete('siglas');
        $this->load->model('CollegeModel');
        $this->CollegeModel->deleteCollege($siglas);
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
        $this->load->model('UserModel');
        $auth = $this->session->userdata('id');

        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(array('msg' => 'No admin rights.'), parent::HTTP_UNAUTHORIZED);
            exit();
        }
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Year extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("YearModel");
        $this->load->model('UserModel');

    }


    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function registerSchoolYear_post(){
        $this->verify_request();
        $data = Array(
            "inicio"   => $this->post('inicio'),
            "fim"   => $this->post('fim'),
        );
        $retrieved = $this->YearModel->registerSchoolYear($data);
        $this->response(json_encode($retrieved), parent::HTTP_OK);
        }




    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getAllSchoolYears_get(){
        $this->verify_request();
        $auth = $this->session->userdata('id');

        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->model('YearModel');
        $data["schoolYears"] = $this->YearModel->getAllSchoolYears();
        $this->response($data, parent::HTTP_OK);
    }

    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////

    public function deleteSchoolYear_delete(){
        $this->verify_request();
        $auth = $this->session->userdata('id');

        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }
        $inicio = $this->delete('inicio');
        $this->load->model('YearModel');
        $this->YearModel->deleteSchoolYear($inicio);
    }



    //////////////////////////////////////////////////////////////
    //                      AUTHENTICATION
    //////////////////////////////////////////////////////////////

    private function verify_request()
    {
        if(is_null($this->session->userdata('role'))){
            $this->response(array('msg' => 'You must be logged in!'), parent::HTTP_UNAUTHORIZED);
            return null;
        }
    }
}

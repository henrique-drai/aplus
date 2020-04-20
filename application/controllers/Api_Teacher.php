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
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model("SubjectModel");
        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $this->load->model("StudentListModel");
    }


    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////





    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getProfHome_get($user_id = null) {
        if($user_id != $this->verify_request()->id) {
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



    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////




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

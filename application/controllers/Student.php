<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Student extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    //student/api/função
    public function api_post($f) {
        switch ($f) {
            // case "submitRating":            $this->submitRating(); break;//     /student/api/getCadeiras
            // adicionem aqui as vossas funções

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_get($f) {
        switch ($f) {
            case "getMyGroups":             $this->getMyGroups(); break;
            // case "getStudentsFromGroup":    $this->getStudentsFromGroup(); break;
            case "getCadeiraGrupo":         $this->getCadeiraGrupo(); break;

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }


    
    //////////////////////////////////////////////////////////////
    //                     Students
    //////////////////////////////////////////////////////////////
    
    public function getAllStudents(){
        $this->load->model('UserModel');
        $data["students"] = $this->UserModel->getStudents();
        
        $this->response($data, parent::HTTP_OK);
    }


    //////////////////////////////////////////////////////////////
    //                     GROUPS
    //////////////////////////////////////////////////////////////

    
    

    //////////////////////////////////////////////////////////////
    //                   Projetos e Etapas
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

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Teacher extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    //teacher/api/função
    public function api_post($f) {
        switch ($f) {
            case "getCadeiras":     $this->getCadeiras(); break;//    /teacher/api/getCadeiras
            case "getCadeiraInfo":  $this->getCadeiraInfo(); break;//  /teacher/api/getCadeiraInfo
            
            default:            $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }



    //////////////////////////////////////////////////////////////
    //                         TEACHER
    //////////////////////////////////////////////////////////////
    public function getCadeiras() {
        $user_id = $this->post('id');
        $this->load->model('UserModel');
        $data["cadeiras_id"] = $this->UserModel->getCadeiras($user_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getCadeiraInfo() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('UserModel');
        $data["info"] = $this->UserModel->getCadeiraInfo($cadeira_id);

        $this->response($data, parent::HTTP_OK);
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

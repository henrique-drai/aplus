<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    //api/user/função
    public function api_post($f) {
        switch ($f) {
            case "getInfo":     $this->getUserInfo(); break; //     /api/user/getInfo
            case "teste":       $this->testeLogin(); break; //      /api/user/teste
            case "logout":      $this->logout(); break; //          /api/user/logout
            case "updateInfo":  $this->updateInfo(); break; //      /api/user/updateInfo

            default:            $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }




    public function getUserInfo() {
        $user_id = $this->post('user_id');

        $this->load->model('UserModel');
        
        $user = $this->UserModel->getUserById($user_id);
        $data = Array(
            "email" => $user->email,
            "name" => $user->name,
            "surname" => $user->surname,
            "role" => $user->role,
        );
        $this->response(json_encode($data), parent::HTTP_OK);
    }


    public function testeLogin() {

        $data = $this->verify_request();

        $this->response($data, parent::HTTP_OK);
    }

    public function logout() {

        $data = $this->verify_request();

        $this->session->sess_destroy();

        $this->response($data, parent::HTTP_OK);
    }


    public function updateInfo(){

        $data = Array(
            "id" => $this->verify_request()->id,
            "name" => $this->post('name'),
            "surname" => $this->post('surname'),
            "password" => $this->post('password'),
        );

        $this->load->model('UserModel');

        $this->UserModel->updateUser($data);

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
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Auth extends REST_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(['jwt', 'authorization']);
    }
    

    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');

        $this->load->model('UserModel');

        if ($this->UserModel->isValidPassword($email, $password)) {

            $user = $this->UserModel->getUserByEmail($email);

            $session_data = array(
                "id" => $user->id,
                "email" => $email,
                "role" => $user->role
            );

            $this->session->set_userdata($session_data);
            
            $token = AUTHORIZATION::generateToken(['username' => $email]);

            $status = parent::HTTP_OK;

            $response = [
                'status' => $status,
                'token' => $token,
                'role' => $user->role,
                'id' => $user->id,
                'profile_pic' => $user->profile_pic_url
            ];

            $this->response($response, $status);
        }
        else {
            $this->response(['msg' => 'Invalid username or password!'], parent::HTTP_NOT_FOUND);
        }
    }

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
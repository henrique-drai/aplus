<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    public function login_post()
    {
        $email      = $this->post('email');
        $password   = $this->post('password');

        $this->load->model('UserModel');

        if ($this->UserModel->isValidPassword($email, $password)) {

            $user = $this->UserModel->getUserByEmail($email);

            $session_data = array(
                "id"    => $user->id,
                "email" => $email,
                "role"  => $user->role
            );

            $this->session->set_userdata($session_data);
            
            $token = AUTHORIZATION::generateToken(['id' => strval($user->id)]);

            $status = parent::HTTP_OK;

            $response = [
                'status'        => $status,
                'token'         => $token,
                'role'          => $user->role,
                'id'            => $user->id,
                'profile_pic'   => $user->profile_pic_url
            ];

            $this->response($response, $status);
        }
        else {
            $this->response(['msg' => 'Invalid username or password!'], parent::HTTP_NOT_FOUND);
        }
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Authentication extends REST_Controller {

    //auth/login
    public function login_post()
    {
        $email      = $this->post('email');
        $password   = $this->post('password');

        $this->load->model('UserModel');

        if ($this->UserModel->isValidPassword($email, $password)) {

            $user = $this->UserModel->getUserByEmail($email);

            $session_data = array(
                "id" => $user->id,
                "email" => $email,
                "name" => $user->name,
                "surname" => $user->surname,
                "role" => $user->role,
                "picture" => $user->picture,
            );

            $this->session->set_userdata($session_data);

            $response = ['role' => $user->role, 'id' => $user->id];

            $this->response($response, parent::HTTP_OK);
        }
        else {
            $this->response(['msg' => 'Invalid username or password!'], parent::HTTP_NOT_FOUND);
        }
    }


    //auth/logout
    public function logout_post() {
        $this->session->sess_destroy();

        $this->response(array(), parent::HTTP_OK);
    }
}

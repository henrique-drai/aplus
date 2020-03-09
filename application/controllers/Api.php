<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api extends REST_Controller {

    public function getUserInfo_post() {
        $user_id = $this->post('user_id');

        $this->load->model('UserModel');
        
        $user = $this->UserModel->getUserById($user_id);
        $data = Array(
            "name" => $user->name,
            "surname" => $user->surname,
            "role" => $user->role,
        );
        $this->response(json_encode($data), parent::HTTP_OK);
    }

    // SÓ PARA TESTES, DEVE SER ELIMINADA
    public function getUserByEmail_get ($email = '')
    {
        $this->load->model('UserModel');
        echo json_encode($this->UserModel->getUserByEmail($email));
    }

    public function registerUser_post ()
    {
        $email = $this->post('email');

        $data = Array(
            "name"      => $this->post('name'),
            "surname"   => $this->post('surname'),
            "email"     => $this->post('email'),
            "password"  => $this->post('password'),
            "role"      => $this->post('role'),
        );

        $this->load->model('UserModel');
        $this->UserModel->registerUser($data);

        $this->response(json_encode($data), parent::HTTP_OK);
    }

}
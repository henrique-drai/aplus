<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api extends REST_Controller {

    public function getUserInfo_post() {
        $email = $this->post('email');
        $this->load->model('UserModel');
        $user = $this->UserModel->getUserByEmail($email);
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

}
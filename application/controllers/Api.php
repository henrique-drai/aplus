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

    //api/user/função
    public function user_post($f) {
        switch ($f) {
            case "getInfo":     $this->getUserInfo(); break; //     /api/user/getInfo
            case "teste":       $this->testeLogin(); break; //     /api/user/teste

            default:            $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //api/admin/função
    public function admin_post($f) {
        switch ($f) {
            case "register":     $this->registerUser(); break; //     /api/admin/register

            default:             $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function admin_get($f){
        switch($f){
            case "getallstudents": $this->getAllStudents(); break; //      /api/admin/getallstudents

            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //api/student/função
    public function student_post($f) {
        switch ($f) {
            // adicionem aqui as vossas funções

            default:            $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //api/teacher/função
    public function teacher_post($f) {
        switch ($f) {
            // adicionem aqui as vossas funções

            default:            $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }




    //////////////////////////////////////////////////////////////
    //                          USER
    //////////////////////////////////////////////////////////////

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




    //////////////////////////////////////////////////////////////
    //                          ADMIN
    //////////////////////////////////////////////////////////////

    public function registerUser(){

        $email = $this->post('email');

        $data = Array(
            "name"      => $this->post('name'),
            "surname"   => $this->post('surname'),
            "email"     => $this->post('email'),
            "password"  => md5($this->post('password')),
            "role"      => $this->post('role'),
        );

        $this->load->model('UserModel');
        $this->UserModel->registerUser($data);

        $this->response(json_encode($data), parent::HTTP_OK);
    }

    public function getAllStudents(){
        $this->load->model('UserModel');
        $data["students"] = $this->UserModel->getStudents();
        
        $this->response($data, parent::HTTP_OK);
        
    }

    public function deleteStudent_delete(){
        $email = $this->delete('email');
        $this->load->model('UserModel');
        $this->UserModel->deleteStudent($email);

    }


    //////////////////////////////////////////////////////////////
    //                          STUDENT
    //////////////////////////////////////////////////////////////

    




    //////////////////////////////////////////////////////////////
    //                         TEACHER
    //////////////////////////////////////////////////////////////






    //////////////////////////////////////////////////////////////
    //                      AUTHENTICATION
    //////////////////////////////////////////////////////////////

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
            
            $token = AUTHORIZATION::generateToken(['id' => strval($user->id)]);

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

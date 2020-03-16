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

    //api/admin/função
    public function admin_post($f) {
        switch ($f) {
            case "register":     $this->registerUser(); break; //     /api/admin/register
            case "registerCollege": $this->registerCollege(); break; //     /api/admin/registerCollege
            case "editUser":     $this->editUser(); break; //     /api/admin/editUser
            
            default:             $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function admin_get($f){
        switch($f){
            case "getAllStudents": $this->getAllStudents(); break; //      /api/admin/getAllStudents
            case "getAllTeachers": $this -> getAllTeachers(); break;
            case "saveCSV":     $this->export(); break;
            
            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function admin_delete($f){
        switch($f){
            case "deleteUser": $this->deleteUser(); break; //      /api/admin/deleteUser

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
            case "getCadeiras": $this->getCadeiras(); break;//    /api/teacher/getCadeiras
            case "getCadeiraInfo": $this->getCadeiraInfo(); break;//  /api/teacher/getCadeiraInfo
            case "getDescription": $this->getDescription(); break;//  /api/teacher/getDescription

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
    //                          ADMIN
    //////////////////////////////////////////////////////////////


    //////////////////////////////////////////////////////////////
    //                          STUDENT
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

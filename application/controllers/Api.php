<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api extends REST_Controller {

    //api/user/função
    public function user_post($f) {
        switch ($f) {
            case "getInfo":     $this->getUserInfo(); break; //     /api/user/getInfo

            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //api/admin/função
    public function admin_post($f) {
        switch ($f) {
            case "register":     $this->registerUser(); break; //     /api/admin/register

            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
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

            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //api/teacher/função
    public function teacher_post($f) {
        switch ($f) {
            // adicionem aqui as vossas funções

            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
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
            "name" => $user->name,
            "surname" => $user->surname,
            "role" => $user->role,
        );
        $this->response(json_encode($data), parent::HTTP_OK);
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
    //                          TEACHER
    //////////////////////////////////////////////////////////////









}
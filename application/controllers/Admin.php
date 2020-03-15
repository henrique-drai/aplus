<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Admin extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    //admin/api/função
    public function api_post($f) {
        switch ($f) {
            case "register":        $this->registerUser(); break; //        admin/api/register
            case "registerCollege": $this->registerCollege(); break; //     admin/api/registerCollege
            case "editUser":        $this->editUser(); break; //            admin/api/editUser
            
            default:             $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_get($f){
        switch($f){
            case "getAllStudents":  $this->getAllStudents(); break; //      admin/api/getAllStudents
            case "getAllTeachers":  $this->getAllTeachers(); break;
            case "saveCSV":         $this->export(); break;
            
            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_delete($f){
        switch($f){
            case "deleteUser": $this->deleteUser(); break; //       admin/api/deleteUser

            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
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
        $retrieved = $this->UserModel->registerUser($data);

        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }

    public function registerCollege(){
        $data = Array(
            "name" => $this->post('nomefaculdade'),
            "location"   => $this->post('morada'),
        );

        $this->load->model('CollegeModel');
        $retrieved = $this->CollegeModel->registerCollege($data);
        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }

    public function getAllStudents(){
        $this->load->model('UserModel');
        $data["students"] = $this->UserModel->getStudents();
        
        $this->response($data, parent::HTTP_OK);
    }

    public function deleteUser(){
        $email = $this->delete('email');
        $this->load->model('UserModel');
        $this->UserModel->deleteUser($email);
    }

    public function editUser(){
        $email = $this->post('oldemail');
        $data = Array(
            "name"      => $this->post('name'),
            "surname"   => $this->post('surname'),
            "email"     => $this->post('email'),
            "password"  => md5($this->post('password')),
            "role"      => $this->post('role'),
        );
        $this->load->model('UserModel');
        $retrieved = $this->UserModel->editStudent($email, $data);

        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }

    public function getAllTeachers(){
        $this -> load -> model('UserModel');
        $data["teachers"] = $this -> UserModel -> getTeachers();
        $this -> response($data, parent::HTTP_OK);
    }

    public function export(){
        $this->load->model('UserModel');
       
        $file_name = "stInfo".date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        $studentsInfo = $this -> UserModel -> getStudents();

        $file = fopen('php://output','w');
        $header = array("Name", "Surname", "Email");

        fputcsv($file, $header);
    
        foreach($studentsInfo as $student){
            $dados = array($student['name'], $student['surname'],$student['email']);
            fputcsv($file, $dados);
        }
        fclose($file);
        exit;
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

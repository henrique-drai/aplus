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
            case "importCSV":       $this ->importCSV(); break; //        admin/api/importCSV   ##!
            case "importX": $this->importX(); break;                                            ##!
            default:                $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function getCourseNameById(){
        $cursoid = $this->get('course_id');
        $this->load->model('CourseModel');
        $data["course"] = $this->CourseModel->getCursobyId($cursoid);
        $this->response($data, parent::HTTP_OK);
    }



    public function importX(){
        $role = $this->post('role');
        print_r($role);

        if($role=="users"){
            $this -> importCSV();
        }
        else{
            $this -> importStudentSubjects();
        }
    }

    // IMPORTAR USERS
    public function importCSV(){
        $this->load->helper('url');
        $this -> load -> model('UserModel');
        $count_files = $_FILES["userfile"]['tmp_name'];
        $file  = fopen($count_files, 'r');

        // Skip first line
        fgetcsv($file, 0, ","); 
        while (($column = fgetcsv($file, 0, ",")) !== FALSE) {
            $data = Array(
                "name"      => $column[0],
                "surname"   => $column[1],
                "email"     => $column[2],
                "role"      => $column[3],
                "password"  => $column[4]
            );
            $this -> UserModel -> registerUser($data);        
        }
        header("Location: ". base_url()."app/admin/");
    }

    // IMPORTAR AUNOS E AS SUAS CADEIRAS
    public function importStudentSubjects(){
        $this->load->helper('url');
        $this -> load -> model('UserModel');
        $this -> load -> model('SubjectModel');
        $count_files = $_FILES["userfile"]['tmp_name'];
        $file  = fopen($count_files, 'r');

        // Skip first line
        fgetcsv($file, 0, ","); 
        while (($column = fgetcsv($file, 0, ",")) !== FALSE) {

            $idUser = $this -> UserModel -> getUserByEmailRA($column[0]);
            
            $data = Array(
                "user_id"      => $idUser[0]['id'],
                "cadeira_id"   => $column[1],
                "is_completed"     => $column[2],
                "image_url"     => "",
            );
            $this -> SubjectModel -> insertUpdate($data);        
        }
        header("Location: ". base_url()."app/admin/");
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

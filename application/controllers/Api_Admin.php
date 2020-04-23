<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Admin extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('UserModel');
        $this->load->model('CollegeModel');
        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $this->load->model('SubjectModel');

    }

    // // IMPORTAR USERS
    // public function importCSV(){
    //     $this->verify_request();
    //     $this->load->helper('url');
    //     $this -> load -> model('UserModel');
    //     $count_files = $_FILES["userfile"]['tmp_name'];
    //     $file  = fopen($count_files, 'r');

    //     // Skip first line
    //     fgetcsv($file, 0, ","); 
    //     while (($column = fgetcsv($file, 0, ",")) !== FALSE) {
    //         $data = Array(
    //             "name"      => $column[0],
    //             "surname"   => $column[1],
    //             "email"     => $column[2],
    //             "role"      => $column[3],
    //             "password"  => $column[4]
    //         );
    //         $this -> UserModel -> registerUser($data);        
    //     }
    //     header("Location: ". base_url()."app/admin/");
    // }

    // public function importX_post(){
    //     $role = $this->post('role');
    //     print_r($role);

    //     if($role=="users"){
    //         $this -> importCSV();
    //     }
    //     else{
    //         $this -> importStudentSubjects();
    //     }
    // }

    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////





    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getAdminHome_get(){
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $data = Array(
            "num_students" => $this->UserModel->countStudents(),
            "num_teachers" => $this->UserModel->countTeachers(),
            "num_colleges" => $this->CollegeModel->countColleges(),
            "num_courses" => $this->CourseModel->countCourses(),
            "num_academicYear" => $this->YearModel->countAcademicYear(),
            "num_subjects" => $this->SubjectModel->countSubjects(),
        );

        $this->response($data, parent::HTTP_OK);
    }

    public function export_get(){
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->model('UserModel');
        $role = $this -> get("role");
        // $file_name = "stInfo".date('Ymd').'.csv';
        
        // header("Content-Description: File Transfer");
        // header("Content-Disposition: attachment; filename=$file_name");
        // header("Content-Type: application/csv;");
        
        // $file = fopen('php://output','w');
        echo "Name,Surname,Email,Role,Password \n";

        if($role == "student"){
            $info = $this -> UserModel -> getStudents();
        }
        elseif($role == "teacher"){
            $info = $this -> UserModel -> getTeachers();
        }
        else{
            $info = $this -> UserModel -> getStudentsTeachers();
        }

        // fputcsv($file, $header);
        foreach($info as $user){
            echo $user['name'] .",". $user['surname'] .",". $user['email'] .",". $user['role'] .",". $user['password']."\n";

            // fputcsv($file, $dados);
        }
        // fclose($file);
        // exit;
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

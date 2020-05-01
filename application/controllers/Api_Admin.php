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

    //////////////////////////////////////////////////////////////
    //                         IMPORTAR USERS
    //////////////////////////////////////////////////////////////

    public function importX_post(){

        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $role = $this->post('role');

        if($role=="users"){
            $this -> importCSV();
        }
        else{
            $this -> importStudentSubjects();
        }
    }

    // IMPORTAR USERS
    public function importCSV(){
        
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

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
            // print_r($data);

            // $this -> UserModel -> registerUser($data);   
            $this -> UserModel -> insertUpdate($data);       
        }
        // header("Location: ". base_url()."app/admin/");
    }

    // IMPORTAR AUNOS E AS SUAS CADEIRAS
    public function importStudentSubjects(){
        
        $auth = $this->verify_request();

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

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
        
        $file = fopen('php://output','w');
        $header = array("Name", "Surname", "Email","Role", "Password");

        if($role == "student"){
            $info = $this -> UserModel -> getStudents();
        }
        elseif($role == "teacher"){
            $info = $this -> UserModel -> getTeachers();
        }
        else{
            $info = $this -> UserModel -> getStudentsTeachers();
        }

        fputcsv($file, $header);
        foreach($info as $user){
            $dados = array($user['name'], $user['surname'],$user['email'],$user['role'],$user['password']);
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

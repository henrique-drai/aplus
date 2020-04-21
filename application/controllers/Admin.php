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
            // case "register":        $this->registerUser(); break; //        admin/api/register
            // case "registerCollege": $this->registerCollege(); break; //     admin/api/registerCollege
            // case "editUser":        $this->editUser(); break; //            admin/api/editUser
            // case "registerSubject":  $this->registerSubject(); break; //    admin/api/registerSubject
            // case "registerCurso":   $this -> registerCurso(); break; //     admin/api/registerCurso  
            case "registerSchoolYear": $this -> registerSchoolYear(); break;    // admin/api/registerSchoolYear
            case "getSearchTeacher": $this->getSearchTeacher(); break; // admin/api/getSearchTeacher
            case "getSearchStudent": $this->getSearchStudent(); break; // admin/api/getSearchStudent
            case "editCourse": $this -> editCourse(); break; 
            case "importCSV":       $this ->importCSV(); break; //        admin/api/importCSV   ##!
            case "importX": $this->importX(); break;   ##!
            default:                $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_get($f){
        switch($f){
            case "getAllColleges":  $this->getAllColleges(); break; //      admin/api/getAllColleges
            case "getAllSchoolYears":  $this->getAllSchoolYears(); break; //      admin/api/getAllSchoolYears
            case "getAllStudents":  $this->getAllStudents(); break; //      admin/api/getAllStudents
            case "getAllTeachers":  $this->getAllTeachers(); break; //      admin/api/getAllTeachers
            case "getAdminHome":    $this->getAdminHome(); break; //        admin/api/getAdminHome
            case "getAllFaculdadesUnidCurricular":  $this->getAllColleges(); break; // admin/api/getAllFaculdadesUnidCurricular
            case "getAllCursosFaculdadeAno": $this->getAllCollegesYearCourses(); break; // admin/api/getAllCursosFaculdadeAno
            case "getAllCursosFaculdade": $this->getAllCollegesCourses(); break; // admin/api/getAllCursosFaculdadeAno
            case "getAllSubjects": $this->getAllSubjects(); break; // admin/api/getAllSubjects
            case "getAllCoursesByCollege": $this->getAllCoursesByCollege(); break; // admin/api/getAllCoursesByCollege
            case "getAllSubjectsByCourse": $this->getAllSubjectsByCourse(); break; // admin/api/getAllSubjectsByCourse
            case "getUserByEmail": $this->getUserByEmail(); break; // admin/api/getUserByEmail
            case "getAllYears": $this->getAllYears(); break; // admin/api/getAllYears
            case "getAllCoursesByYear": $this->getAllCoursesByYear(); break; // admin/api/getAllCoursesByYear
            case "saveCSV":         $this->export(); break;

            default:                $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_delete($f){
        switch($f){
            case "deleteUser": $this->deleteUser(); break; //       admin/api/deleteUser
            case "deleteCollege": $this->deleteCollege(); break; //  admin/api/deleteCollege
            case "deleteSubject": $this->deleteSubject(); break; //  admin/api/deleteSchoolYear
            case "deleteSchoolYear": $this->deleteSchoolYear(); break; //  admin/api/deleteSchoolYear
            case "deleteCourse":    $this->deleteCourse(); break;

            default: $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }





    //////////////////////////////////////////////////////////////
    //                          ADMIN
    //////////////////////////////////////////////////////////////

    public function registerSchoolYear(){
        $data = Array(
            "inicio"   => $this->post('inicio'),
            "fim"   => $this->post('fim'),
        );
        $this->load->model('YearModel');
        $retrieved = $this->YearModel->registerSchoolYear($data);
        $this->response(json_encode($retrieved), parent::HTTP_OK);
        }

    public function getAllSchoolYears(){
        $this->load->model('YearModel');
        $data["schoolYears"] = $this->YearModel->getAllSchoolYears();
        $this->response($data, parent::HTTP_OK);
    }

    public function deleteSchoolYear(){
        $inicio = $this->delete('inicio');
        $this->load->model('YearModel');
        $this->YearModel->deleteSchoolYear($inicio);
    }

    // public function registerUser(){

    //     $email = $this->post('email');

    //     $data = Array(
    //         "name"      => $this->post('name'),
    //         "surname"   => $this->post('surname'),
    //         "email"     => $this->post('email'),
    //         "password"  => md5($this->post('password')),
    //         "role"      => $this->post('role'),
    //     );

    //     $this->load->model('UserModel');
    //     $retrieved = $this->UserModel->registerUser($data);

    //     $this->response(json_encode($retrieved), parent::HTTP_OK);
    // }

    // public function registerCollege(){
    //     $data = Array(
    //         "name" => $this->post('nomefaculdade'),
    //         "location"   => $this->post('morada'),
    //         "siglas"   => $this->post('siglas'),
    //     );

    //     $this->load->model('CollegeModel');
    //     $retrieved = $this->CollegeModel->registerCollege($data);
    //     $this->response(json_encode($retrieved), parent::HTTP_OK);
    // }

    public function getAllColleges(){
        $this->load->model('CollegeModel');
        $data["colleges"] = $this->CollegeModel->getColleges();
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllCollegesCourses(){
        $faculdade = $this->get('faculdade');
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCollegeCourses($faculdade);
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllCollegesYearCourses(){
        $faculdade = $this->get('faculdade');
        $ano = $this->get('anoletivo');
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCollegeYearCourses($faculdade, $ano);
        $this->response($data, parent::HTTP_OK);
    }

    public function getCourseNameById(){
        $cursoid = $this->get('course_id');
        $this->load->model('CourseModel');
        $data["course"] = $this->CourseModel->getCursobyId($cursoid);
        $this->response($data, parent::HTTP_OK);
    }

    // public function registerSubject(){
    //     $data = Array(
    //         "code" => $this->post('codeCadeira'),
    //         "curso_id"   => $this->post('curso'),
    //         "name" => $this->post('nomeCadeira'),
    //         "description"   => $this->post('descCadeira'),
    //     );

    //     $this->load->model('SubjectModel');
    //     $retrieved = $this->SubjectModel->registerSubject($data);
    //     $this->response(json_encode($retrieved), parent::HTTP_OK);

    // }

    public function getAllSubjects(){
        $this->verify_request();
        $this->load->model('SubjectModel');
        $this->load->model('CourseModel');
        $data["subjects"] = $this->SubjectModel->getAllSubjects();
        $data["courses"] = array();
        for($i=0; $i<count($data["subjects"]); $i++){
            array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
        };
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllYears(){
        $this->load->model('YearModel');
        $data["years"] = $this->YearModel->getAllSchoolYears();
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllCoursesByYear(){
        $ano = $this->get('idyear');
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCoursesByYear($ano);
        $this->response($data, parent::HTTP_OK);
    }

    public function deleteSubject(){
        $code = $this->delete('code');
        $this->load->model('SubjectModel');
        $this->SubjectModel->deleteSubject($code);
    }

    public function getAllCoursesByCollege(){
        $faculdade = $this->get('faculdade');
        $this->load->model('CourseModel');
        $data["courses"] = $this->CourseModel->getCollegeCourses($faculdade);
        $this->response($data, parent::HTTP_OK);
    }

    public function getAllSubjectsByCourse(){
        $this->verify_request();
        $courses = $this->get('courses');
        $this->load->model('SubjectModel');
        $this->load->model('CourseModel');
        $data["courses"] = array(); 
        if(is_array($courses)){
            $data["subjects"] = array();
            
            for($x=0; $x<count($courses); $x++){
                $cursos = $this->SubjectModel->getSubjectsByCursoId($courses[$x]["id"]);
                $data["subjects"]=array_merge($data["subjects"], $cursos);
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
        }
        else{
            $data["subjects"] = $this->SubjectModel->getSubjectsByCursoId($courses);
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
        }
        
        
        $this->response($data, parent::HTTP_OK);
    }

    public function deleteCollege(){
        $siglas = $this->delete('siglas');
        $this->load->model('CollegeModel');
        $this->CollegeModel->deleteCollege($siglas);
    }

    public function getAllStudents(){
        $this->verify_request();
        $this->load->model('UserModel');
        $data["students"] = $this->UserModel->getStudents();
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getSearchStudent(){
        $this->verify_request();
        $query = '';
        $this->load->model('UserModel');
        if($this->post("query")){
            $query = $this->post("query");
        }
        $resultquery = $this->UserModel->getSearchStudent($query);
        $data["students"] = "";
        if($resultquery -> num_rows() == 0){
            $data["students"] = "no data"; 
        }
        else{
            $data["students"] = $resultquery->result();
        }
        $this->response($data, parent::HTTP_OK);
    }

    public function getSearchTeacher(){
        $this->verify_request();
        $query = '';
        $this->load->model('UserModel');
        if($this->post("query")){
            $query = $this->post("query");
        }
        $resultquery = $this->UserModel->getSearchTeacher($query);
        $data["teachers"] = "";
        if($resultquery -> num_rows() == 0){
            $data["teachers"] = "no data"; 
        }
        else{
            $data["teachers"] = $resultquery->result();
        }
        $this->response($data, parent::HTTP_OK);

    }

    public function deleteUser(){
        $this->verify_request();
        $email = $this->delete('email');
        $this->load->model('UserModel');
        $this->UserModel->deleteUser($email);
    }

    public function getUserByEmail(){
        $email = $this->get('email');
        $this->load->model('UserModel');
        $user = $this->UserModel->getUserByEmail($email);
        $data = Array(
            "email" => $user->email,
            "name" => $user->name,
            "surname" => $user->surname,
            "password" => $user->password,
        );

        $this->response($data, parent::HTTP_OK);
    }

    // public function editUser(){
    //     $this->verify_request();
    //     $email = $this->post('oldemail');
    //     $data = Array(
    //         "name"      => $this->post('name'),
    //         "surname"   => $this->post('surname'),
    //         "email"     => $this->post('email'),
    //         "password"  => md5($this->post('password')),
    //     );
    //     $this->load->model('UserModel');
    //     $retrieved = $this->UserModel->editStudent($email, $data);

    //     $this->response(json_encode($retrieved), parent::HTTP_OK);
    // }

    public function getAllTeachers(){
        $this->verify_request();
        $this ->load-> model('UserModel');
        $data["teachers"] = $this ->UserModel-> getTeachers();
        $this -> response($data, parent::HTTP_OK);
    }

    public function deleteCourse(){
        $this->load->model('CourseModel');
        $data = Array(
            "faculdade_id" => $this -> delete('idCollege'),
            "code" => $this -> delete('code'),            
        );
        $this -> CourseModel -> deleteCollegeCourse($data);
    }


    public function editCourse(){
        $this->load->model("CourseModel");

        $data = Array(
            "code"         => $this->post('code'),
            "name"          => $this->post('name'),
            "academicYear"  => $this->post('academicYear'),
            "description"   => $this->post('description'),
            "oldCurso"      => $this->post('oldCurso'),
            "collegeId"      => $this->post('collegeId'),
        );
        $this->CourseModel->editCourse($data);
    }


    // public function registerCurso(){
    //     $this -> load -> model('CourseModel');
       
    //     $data = Array(
    //         "faculdade_id"      => $this->post('collegeId'),
    //         "ano_letivo_id"     => $this->post('academicYear'),
    //         "code"              => $this->post('codCourse'),
    //         "name"              => $this->post('nameCourse'),
    //         "description"       => $this->post('descCourse')
    //     );
       
    //     $this->CourseModel->register_course($data);
    // }

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

    public function export(){
        $this->load->model('UserModel');
        $role = $this -> get("role");
        $file_name = "stInfo".date('Ymd').'.csv';
        
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");
        
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

    public function getAdminHome(){
        
        $this->load->model('UserModel');
        $this->load->model('CollegeModel');
        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $this->load->model('SubjectModel');

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

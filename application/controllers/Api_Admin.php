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
        $this->verify_request();

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

        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $role = htmlspecialchars($this->post('role'));

        if($role=="users"){
            $this -> importCSV();
        }
        else{
            $this -> importStudentSubjects();
        }
    }

    // ######################## IMPORTAR USERS ####################################################

    public function importStudentsCourse_post(){

        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->helper('url');

        $count_files = $_FILES["userfile"]['tmp_name'];
        $file  = fopen($count_files, 'r');

        $courseId = htmlspecialchars($this -> post("courses"));
        
;
        // Skip first line
        fgetcsv($file, 0, ","); 
        while (($column = fgetcsv($file, 0, ",")) !== FALSE) {

            $email = $column[2];
            
            $idUser = $this -> UserModel -> getUserByEmailRA($column[2])[0]['id'];
           

            $data = Array(
                "user_id"      => $idUser,
                "curso_id"   => $courseId,               
            );
            

            if($this -> CourseModel -> userInCourse($idUser, $courseId) == 0){
                $this -> CourseModel -> insertAlunoCurso($data);
            }
        }
    }


    public function importCSV(){
        
        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->helper('url');
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
            $this -> UserModel -> insertUpdate($data);       
        }
        // header("Location: ". base_url()."app/admin/");
    }

    // IMPORTAR AUNOS E AS SUAS CADEIRAS
    public function importStudentSubjects(){
        
        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->helper('url');

        $count_files = $_FILES["userfile"]['tmp_name'];
        $file  = fopen($count_files, 'r');

        // Skip first line
        fgetcsv($file, 0, ","); 
        while (($column = fgetcsv($file, 0, ",")) !== FALSE) {

            $idUser = $this -> UserModel -> getUserByEmailRA($column[0]);
            
            $data = Array(
                "user_id"           => $idUser[0]['id'],
                "cadeira_id"        => $column[1],
                "is_completed"      => $column[2],
                "image_url"         => "",
            );
            $this -> SubjectModel -> insertUpdate($data);        
        }
        // header("Location: ". base_url()."app/admin/");
    }


    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////


    public function importTeachersSubjects_post(){

        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->helper('url');
        $count_files = $_FILES["userfile"]['tmp_name'];
        $file  = fopen($count_files, 'r');

        // Skip first line
        fgetcsv($file, 0, ","); 
        while (($column = fgetcsv($file, 0, ",")) !== FALSE) {
            
            // TODO: VERSÃO BASE -> JÁ TER OS PROFS TODOS NA TABELA USERS

                $idAnoLetivo    = $this->YearModel->getYearByInicio($column[3])->id;
                $idFaculdade    = $this->CollegeModel->getCollegeBySigla($column[4])->id;
                $idCurso        = $this->CourseModel->getCourseByFaculdadeAnoNome($idFaculdade, $idAnoLetivo, $column[5])->id;
                $idUser         = $this->UserModel->getUserByEmail($column[2])->id;
                $idCadeira      = $this->SubjectModel->getSubjectsByCursoIdName($idCurso, $column[6])->id;

                $this->SubjectModel->registerProfCadeira($idUser, $idCadeira);
        }
    }

    public function importUcClasses_post(){

        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->helper('url');
        $count_files = $_FILES["userfile"]['tmp_name'];
        $file  = fopen($count_files, 'r');

           // Skip first line
        fgetcsv($file, 0, ","); 
        while (($column = fgetcsv($file, 0, ",")) !== FALSE) {

            $idUser         = $this->UserModel->getUserByEmail($column[0])->id;
            $idAnoLetivo    = $this->YearModel->getYearByInicio($column[1])->id;

            $idFaculdade    = $this->CollegeModel->getCollegeBySigla($column[2])->id;

            $idCurso        = $this->CourseModel->getCourseByFaculdadeAnoNome($idFaculdade, $idAnoLetivo, $column[3])->id;
            $idCadeira      = $this->SubjectModel->getSubjectsByCursoIdName($idCurso, $column[4])->id;

            $data = Array(
                "user_id" => $idUser,
                "cadeira_id" => $idCadeira,
                "is_completed"      => 0,
                "last_visited"         => "",
            );
            $this -> SubjectModel->insertUpdate($data);
        }

    }

    public function importGroups_post(){
        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $this->load->helper('url');
        $count_files = $_FILES["userfile"]['tmp_name'];
        $file  = fopen($count_files, 'r');

        fgetcsv($file, 0, ","); 
        $this->load->model('ProjectModel');
        $this->load->model('GroupModel');
        while (($column = fgetcsv($file, 0, ",")) !== FALSE) {
            $idAnoLetivo    = $this->YearModel->getYearByInicio($column[3])->id;
            $idFaculdade    = $this->CollegeModel->getCollegeBySigla($column[0])->id;
            $idCurso        = $this->CourseModel->getCourseByFaculdadeAnoNome($idFaculdade, $idAnoLetivo, $column[1])->id;
            $idUser         = $this->UserModel->getUserByEmail($column[6])->id;
            $idCadeira      = $this->SubjectModel->getSubjectsByCursoIdName($idCurso, $column[2])->id;
            $idProjeto      = $this->ProjectModel->getProjectByCadeiraIdName($idCadeira, $column[4])->id;
            $grupo          = $this->GroupModel->confirmNameInProject($idProjeto, $column[5]);
            if(!$grupo){
                $datagrupo = Array(
                    "name" => $column[5],
                    "projeto_id" => $idProjeto,
                );
                $retrieved = $this->GroupModel->createGroup($datagrupo);

                $datagrupoaluno = Array(
                    "grupo_id" => $retrieved["grupo"],
                    "user_id" => $idUser,
                );

                $addeduser = $this->GroupModel->addElementGroup($datagrupoaluno);
            }    
            else{
                $datagrupoaluno = Array(
                    "grupo_id" => $grupo->id,
                    "user_id" => $idUser,
                );

                $addeduser = $this->GroupModel->addElementGroup($datagrupoaluno);
            }
        }
    }



    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getAdminHome_get(){

        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

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

        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

 
        $role = htmlspecialchars($this -> get("role"));
        
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

    public function exportSpecific_get(){
        $auth = $this->session->userdata('id');

        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }
  
        $file = fopen('php://output','w');
        $header = array("Name", "Surname", "Email","Role", "Password");

        // $college = $this -> get('college');        
        // $year = $this -> get('year');           
        $course = htmlspecialchars($this -> get('course'));         
        
        $data["students"] = $this -> CourseModel -> getStudentsByCourse($course);

        fputcsv($file, $header);
        for($i=0; $i<count($data["students"]);$i++){

            $path = $this -> UserModel -> getUserById($data["students"][$i]['user_id']);
            $dados = array($path -> name, $path -> surname,$path -> email, $path -> role, $path -> password);
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
        if(is_null($this->session->userdata('role'))){
            $this->response(array('msg' => 'You must be logged in!'), parent::HTTP_UNAUTHORIZED);
            exit();
        }
    }
}

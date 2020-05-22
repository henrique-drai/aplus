<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Subject extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->verify_request();
        $this->load->model('SubjectModel');
        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $this->load->model('UserModel');
        $this->load->model("ForumModel");
        $this->load->model("EventModel");
        $this->load->model("StudentListModel");
    }


    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function insertText_post() {
        $user_id = $this->session->userdata('id');

        $data = Array(
            "id"    => $this->post("cadeira_id"),
            "text"  => $this->post("text"),
        );

        if($this->verify_teacher($user_id, $data["id"], "cadeira")) {
            $this->SubjectModel->insertText($data);
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function saveHours_post() { 
        $data = Array (
            'id_prof'             => $this->session->userdata('id'),
            'id_cadeira'          => $this->post('cadeira_id'),
            'start_time'          => $this->post('start_time'),
            'end_time'            => $this->post('end_time'),
            'day'                 => $this->post('day'),
        );

        if($this->verify_teacher($user_id, $data["id_cadeira"], "cadeira")) {
            $this->SubjectModel->saveHours($data);
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function registerSubject_post(){ 
        $data = Array(
            "code" => $this->post('codeCadeira'),
            "curso_id"   => $this->post('curso'),
            "name" => $this->post('nomeCadeira'),
            "sigla" => $this->post('sigla'),
            "description"   => $this->post('descCadeira'),
            "semestre" => $this->post("semestre"),
            "color" => $this->post("cor"),
        );

        $this->load->model('SubjectModel');
        $retrieved = $this->SubjectModel->registerSubject($data);
        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }

    public function insertEvent_post($hour_id) { 
        $user_id = $this->session->userdata('id');

        if($this->verify_student($user_id, $this->post("cadeira_id"))) {
            $daysOfWeek = array("", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "");
            $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    
            $data["hour"] = $this->EventModel->getHorarioDuvidasById($hour_id);
    
            if(count($data["hour"]) > 0) {
                $data["user"] = $this->UserModel->getUserById($data["hour"]->id_prof);
    
                $daysToGo = array_search($data["hour"]->day, $daysOfWeek);
                $currentDay = date("Y-m-d");
                $newDate = date("Y-m-d", strtotime('next ' . $days[$daysToGo]));
                $startTime = $newDate . " " . $data["hour"]->start_time;
                $endTime = $newDate . " " . $data["hour"]->end_time;
    
                $dataInsert = Array (
                    'start_date'          => date("Y-m-d H:i:s", strtotime($startTime)),
                    'end_date'            => date("Y-m-d H:i:s", strtotime($endTime)),
                    'name'                => "Horário de Dúvidas",
                    'description'         => "Horário de Dúvidas com o(a) professor(a) " . $data["user"]->name . " " . $data["user"]->surname,
                    'location'            => $data["user"]->gabinete,
                    'horario_id'          => $hour_id,
                );
        
                $event_id = $this->EventModel->insertEvent($dataInsert);
    
                $this->EventModel->insertUserEvent(Array ("evento_id" => $event_id, "user_id" => $data["user"]->id));
                $this->EventModel->insertUserEvent(Array ("evento_id" => $event_id, "user_id" => $user_id));
            }
    
            
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }

        
    }

    public function insertDate_post($id, $role) { 
        $user_id = $this->session->userdata('id');

        $flag = false;
        if($role == "teacher") {
            if($this->verify_teacher($user_id, $id, "cadeira")) {
                $flag = true;
            }
        } else if($role == "student") {
            if($this->verify_student($user_id, $id)) {
                $flag = true;
            }
        }

        if($flag == "true") {
            $this->SubjectModel->insertDate($id, $user_id, $role);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
        
    }

    public function editSubject_post(){ 
        $auth = $this->session->userdata('id');

        $user = $this->UserModel->getUserById($auth);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $id = $this->post('id');

        $data = Array(
            "code"      => $this->post('codigo'),
            "name"     => $this->post('nome'),
            "sigla"  => $this->post('sigla'),
            "semestre"  => $this->post('semestre'),
            "description"  => $this->post('desc'),
        );

        $this->load->model('SubjectModel');
        $retrieved = $this->SubjectModel->editSubject($id, $data);

        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }


    public function submitFileAreaCadeira_post(){
        $user_id = $this->session->userdata('id');

        if ($this->verify_teacher($user_id,$this->post("cadeira_id"),"cadeira")){
            $data_send = Array(
               "user_id"        =>  $user_id,
               "cadeira_id"     =>  $this->post("cadeira_id"),
               "url"            =>  $this->post("ficheiro_url"),     
            );

            //ver se o ficheiro ja consta

            $data["ficheiro_db"] = $this->SubjectModel->getFicheiroAreaByURL($this->post("ficheiro_url"));

            if(empty($data["ficheiro_db"])){
                $toReturn = $this->SubjectModel->submitFicheiroArea($data_send);
            } else {
                $toReturn = "Exists";
            }

            

            $data["result"] = $toReturn;

            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }



    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getCadeiras_get($user_id = null, $role) { 
        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        $data["cadeiras_id"] = $this->SubjectModel->getCadeiras($user_id, $role);

        $data["info"] = array();
        $data["curso"] = array();
        for($i=0; $i < count($data["cadeiras_id"]); $i++) {
            $tmp = $this->SubjectModel->getCadeiraInfo($data["cadeiras_id"][$i]["cadeira_id"]);
            array_push($data["curso"], $this->CourseModel->getCursobyId($tmp[0]["curso_id"]));
            array_push($data["info"], $tmp);
        }

        if(count($data["info"]) > 0) {
            $tmp = $this->CourseModel->getCursobyId($data["info"][0][0]["curso_id"]);
            $data["year"] = $this->YearModel->getYearById($tmp->ano_letivo_id);
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getCadeirasOrder_get($user_id = null, $role) { 
        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        $data["cadeiras_id"] = $this->SubjectModel->getCadeirasOrder($user_id, $role);

        $data["info"] = array();
        $data["curso"] = array();
        for($i=0; $i < count($data["cadeiras_id"]); $i++) {
            $tmp = $this->SubjectModel->getCadeiraInfo($data["cadeiras_id"][$i]["cadeira_id"]);
            array_push($data["curso"], $this->CourseModel->getCursobyId($tmp[0]["curso_id"]));
            array_push($data["info"], $tmp);
        }

        if(count($data["info"]) > 0) {
            $tmp = $this->CourseModel->getCursobyId($data["info"][0][0]["curso_id"]);
            $data["year"] = $this->YearModel->getYearById($tmp->ano_letivo_id);
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getHours_get($cadeira_id) { 
        $user_id =  $this->session->userdata('id');

        if($this->verify_teacher($user_id, $cadeira_id, "cadeira")) {
            $data["hours"] = $this->SubjectModel->getHours($cadeira_id);

            $data['user'] = array();
            for ($i=0; $i < count($data["hours"]); $i++) {
                array_push($data["user"], $this->UserModel->getUserById($data["hours"][$i]['id_prof']));
            }
            
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
        
    }

    public function getInfo_get($cadeira_id) {
        $user_id = $this->get("user_id");
        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        $flag = false;
        if($this->get("role") == "student") {
            $flag = $this->verify_student($user_id, $cadeira_id);
        } else if ($this->get("role") == "teacher") {
            $flag = $this->verify_teacher($user_id, $cadeira_id, "cadeira");
        }

        if ($flag) {
            $data["desc"] = $this->SubjectModel->getDescriptionById($cadeira_id);
            $data["forum"] = $this->ForumModel->getForumByCadeiraID($cadeira_id);
            $data["proj"] = $this->SubjectModel->getProj($cadeira_id);
            $data["hours"] = $this->SubjectModel->getHours($cadeira_id);
            $eventos = $this->EventModel->getStudentEvents($this->get("user_id"));
            
            $data['user'] = array();
            for ($i=0; $i < count($data["hours"]); $i++) {
                array_push($data["user"], $this->UserModel->getUserById($data["hours"][$i]['id_prof']));
            }
    
            if(count($eventos) > 0) {
                $data["evento"] = array();
                for($i=0; $i < count($eventos); $i++) {
                    array_push($data["evento"], $this->EventModel->getEventById($eventos[$i]["evento_id"]));
                }
            }
    
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
        
    }

    public function getCourseStudents_get($cadeira_id) { 
        $user_id = $this->get("user_id");
        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        if($this->verify_teacher($user_id, $cadeira_id, "cadeira")) {
            $data["cadeira_id"] = $cadeira_id;
            $data["users_id"] = $this->StudentListModel->getStudentsbyCadeiraID($cadeira_id);
    
            $data["info"] = array();
            for($i=0; $i < count($data["users_id"]); $i++) {
                array_push($data["info"], $this->StudentListModel->getStudentsInfo($data["users_id"][$i]["user_id"]));
            }
    
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function getAllSubjects_get(){
        $data["subjects"] = $this->SubjectModel->getAllSubjects();
        $data["courses"] = array();
        for($i=0; $i<count($data["subjects"]); $i++){
            array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
        };
        $this->response($data, parent::HTTP_OK);
    }

    // public function getAllSubjectsByCourse_get(){
    //     $this->verify_request();
    //     $courses = $this->get('courses');
    //     $this->load->model('SubjectModel');
    //     $this->load->model('CourseModel');
    //     $data["courses"] = array(); 
    //     if(is_array($courses)){
    //         $data["subjects"] = array();
            
    //         for($x=0; $x<count($courses); $x++){
    //             $cursos = $this->SubjectModel->getSubjectsByCursoId($courses[$x]["id"]);
    //             $data["subjects"]=array_merge($data["subjects"], $cursos);
    //         }
    //         for($i=0; $i<count($data["subjects"]); $i++){
    //             array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
    //         };
    //     }
    //     else{
    //         $data["subjects"] = $this->SubjectModel->getSubjectsByCursoId($courses);
    //         for($i=0; $i<count($data["subjects"]); $i++){
    //             array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
    //         };
    //     }
        
        
    //     $this->response($data, parent::HTTP_OK);
    // }

    public function getSubjectsByFilters_get(){ 
        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $faculdade = $this->get('f'); 
        $curso = $this->get('c');
        $ano = $this->get('a');
        $data["courses"] = array(); 
        $data["subjects"] = array();

        if($faculdade != "" && $curso != "" && $ano != ""){
            $cursos = $this->CourseModel->getCollegeCourses($faculdade);
            for($i=0; $i<count($cursos);$i++){
                if($curso == $cursos[$i]["name"] && $ano == $cursos[$i]["ano_letivo_id"]){
                    $getcursos = $this->SubjectModel->getSubjectsByCursoId($cursos[$i]["id"]);
                    $data["subjects"]=array_merge($data["subjects"], $getcursos);
                }
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
                
        }
        else if($faculdade != "" && $curso != "" && $ano == ""){
            $cursos = $this->CourseModel->getCollegeCourses($faculdade);
            for($i=0; $i<count($cursos);$i++){
                if($curso == $cursos[$i]["name"]){
                    $getcursos = $this->SubjectModel->getSubjectsByCursoId($cursos[$i]["id"]);
                    $data["subjects"]=array_merge($data["subjects"], $getcursos);
                }
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
        }
        else if($faculdade != "" && $curso == "" && $ano != ""){
            $cursos = $this->CourseModel->getCollegeCourses($faculdade);
            for($i=0; $i<count($cursos);$i++){
                if($ano == $cursos[$i]["ano_letivo_id"]){
                    $getcursos = $this->SubjectModel->getSubjectsByCursoId($cursos[$i]["id"]);
                    $data["subjects"]=array_merge($data["subjects"], $getcursos);
                }
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
        }
        else if($faculdade == "" && $curso != "" && $ano != ""){
            $cursos = $this->CourseModel->getCursobyName($curso);
            for($i=0; $i<count($cursos);$i++){
                if($ano == $cursos[$i]["ano_letivo_id"]){
                    $getcursos = $this->SubjectModel->getSubjectsByCursoId($cursos[$i]["id"]);
                    $data["subjects"]=array_merge($data["subjects"], $getcursos);
                }
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
            
        }
        else if($faculdade != "" && $curso == "" && $ano == ""){
            $cursos = $this->CourseModel->getCollegeCourses($faculdade);
            for($i=0; $i<count($cursos);$i++){
                $getcursos = $this->SubjectModel->getSubjectsByCursoId($cursos[$i]["id"]);
                $data["subjects"]=array_merge($data["subjects"], $getcursos);
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
        }
        else if($faculdade == "" && $curso != "" && $ano == ""){
            $cursos = $this->CourseModel->getCursobyName($curso);
            for($i=0; $i<count($cursos);$i++){
                $getcursos = $this->SubjectModel->getSubjectsByCursoId($cursos[$i]["id"]);
                $data["subjects"]=array_merge($data["subjects"], $getcursos);
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
        }
        else if($faculdade == "" && $curso == "" && $ano != ""){
            $cursos = $this->CourseModel->getCoursesByYear($ano);
            for($i=0; $i<count($cursos);$i++){
                $getcursos = $this->SubjectModel->getSubjectsByCursoId($cursos[$i]["id"]);
                $data["subjects"]=array_merge($data["subjects"], $getcursos);
            }
            for($i=0; $i<count($data["subjects"]); $i++){
                array_push($data["courses"], $this->CourseModel->getCursobyId($data["subjects"][$i]["curso_id"]));
            };
        }

        else if($faculdade == "" && $curso == "" && $ano = ""){
            $data["subjects"] = "";
        }

        $this->response($data, parent::HTTP_OK);

    }

    public function getSearchStudentCourse_get() { 
        $user_id = $this->get("user_id");
        $cadeira_id = $this->get("cadeira_id");
        if($this->get("query")){
            $query = $this->get("query");
        }

        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }
        
        if($this->verify_teacher($user_id, $cadeira_id, "cadeira")) {
            $data = $this->SubjectModel->getSearchStudentCourse($query, $cadeira_id);

            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }        
    }

   

    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////

    public function removeHours_delete() { 
        $data = Array (
            'id_prof'             => $this->session->userdata('id'),
            'id_cadeira'          => $this->delete('cadeira_id'),
            'start_time'          => $this->delete('start_time'),
            'end_time'            => $this->delete('end_time'),
            'day'                 => $this->delete('day'),
        );

        if($this->verify_teacher($data["id_prof"], $data["id_cadeira"], "cadeira")) {
            $this->SubjectModel->removeHours($data);

            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }        
    }

    
    public function deleteSubject_delete(){ 
        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }
        $code = $this->delete('code');
        $this->load->model('SubjectModel');
        $this->SubjectModel->deleteSubject($code);
    }


    public function deleteHourById_delete() { 
        $user_id = $this->delete("user_id");
        $cadeira_id = $this->delete("cadeira_id");
        $id = $this->delete("id");

        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        if($this->verify_teacher($user_id, $cadeira_id, "cadeira")) {
            $this->SubjectModel->deleteHourById($id);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }        
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

    private function verify_teacher($user_id, $variable, $mode){

        if ($mode == "projeto"){
            $projeto = $this->ProjectModel->getProjectByID($variable);
            $cadeiras = $this->SubjectModel->getCadeiras($user_id, "teacher");
            $flag_found = false;

            for($i=0; $i < count($cadeiras); $i++) {
                if($projeto[0]["cadeira_id"] == $cadeiras[$i]["cadeira_id"]){
                    $flag_found = true;
                }
            }

            return $flag_found;

        } elseif ($mode == "etapa") {
            $etapa = $this->ProjectModel->getEtapaByID($variable)->result_array();
            $projeto = $this->ProjectModel->getProjectByID($etapa[0]["projeto_id"]);
            $cadeiras = $this->SubjectModel->getCadeiras($user_id, "teacher");
            $flag_found = false;

            for($i=0; $i < count($cadeiras); $i++) {
                if($projeto[0]["cadeira_id"] == $cadeiras[$i]["cadeira_id"]){
                    $flag_found = true;
                }
            }

            return $flag_found;

        } elseif ($mode == "cadeira"){
            $cadeiras = $this->SubjectModel->getCadeiras($user_id, "teacher");
            $flag_found = false;

            for($i=0; $i < count($cadeiras); $i++) {
                if($variable == $cadeiras[$i]["cadeira_id"]){
                    $flag_found = true;
                }
            }

            return $flag_found;
    
        } else {
            return false;
        }
    }

    private function verify_student($user_id, $cadeira_id){
        $membros = $this->StudentListModel->getStudentsByCadeiraID($cadeira_id);

        $flag_found = false;

        for ($i=0; $i < count($membros); $i++){
            if($user_id == $membros[$i]["user_id"]){
                $flag_found = true;
            }    
        }

        return $flag_found;
    }
}

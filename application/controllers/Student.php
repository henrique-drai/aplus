<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Student extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    //student/api/função
    public function api_post($f) {
        switch ($f) {
            case "submitRating":         $this->submitRating(); break;//     /student/api/getCadeiras
            // adicionem aqui as vossas funções

            default:                $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_get($f) {
        switch ($f) {
            case "getCadeiras":         $this->getCadeiras(); break;//     /student/api/getCadeiras
            case "getInfo":             $this->getInfo(); break;//     /student/api/getInfo
            case "getMyGroups":         $this->getMyGroups(); break;
            case "getStudentsFromGroup":    $this->getStudentsFromGroup(); break;
            case "getCadeiraGrupo":         $this->getCadeiraGrupo(); break;

            default:                $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }


       //////////////////////////////////////////////////////////////
    //                     Classification
    //////////////////////////////////////////////////////////////
    
    public function submitRating(){
        $this->load->model('GroupModel');

        $data = Array(
            "classificador_id"      => $this->post('meuUser'),
            "classificado_id"     => $this->post('himUser'),
            "grupo_id"              => $this->post('grupoId'),
            "valor"              => $this->post('rating')
        );
       
        $this->GroupModel->insertClassification($data); 
    }


    //////////////////////////////////////////////////////////////
    //                         SUBJECT
    //////////////////////////////////////////////////////////////
    public function getCadeiras() {
        $user_id = $this->get('id');
        $this->load->model('SubjectModel');
        $data["cadeiras_id"] = $this->SubjectModel->getCadeiras($user_id, "student");

        $data["info"] = array();
        for($i=0; $i < count($data["cadeiras_id"]); $i++) {
            array_push($data["info"], $this->SubjectModel->getCadeiraInfo($data["cadeiras_id"][$i]["cadeira_id"]));
        }

        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $tmp = $this->CourseModel->getCursobyId($data["info"][0][0]["curso_id"]);
        $data["year"] = $this->YearModel->getYearById($tmp->ano_letivo_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getInfo() {
        $cadeira_code = $this->get('cadeira_code');
        $cadeira_id = $this->get('cadeira_id');
        $this->load->model('SubjectModel');
        $data["desc"] = $this->SubjectModel->getDescription($cadeira_code);

        $data["proj"] = $this->SubjectModel->getProj($cadeira_id);
        $data["hours"] = $this->SubjectModel->getHours($cadeira_id);

        $this->load->model('UserModel');
        $data['user'] = array();
        for ($i=0; $i < count($data["hours"]); $i++) {
            array_push($data["user"], $this->UserModel->getUserById($data["hours"][$i]['id_prof']));
        }

        $this->response($data, parent::HTTP_OK);
    }


    
    //////////////////////////////////////////////////////////////
    //                     Students
    //////////////////////////////////////////////////////////////
    
    public function getAllStudents(){
        $this->load->model('UserModel');
        $data["students"] = $this->UserModel->getStudents();
        
        $this->response($data, parent::HTTP_OK);
    }


    //////////////////////////////////////////////////////////////
    //                     GROUPS
    //////////////////////////////////////////////////////////////

    public function getMyGroups(){
        $this->load->model('GroupModel');
        $this->load->model('ProjectModel');

        $user_id = $this->get('id');
        $data['grupo'] = $this->GroupModel->getGroups($user_id);

        $data["info"] = array();

        for ($i=0; $i < count($data["grupo"]); $i++) {
           
            $projId =  $this->GroupModel->getProjectId($data["grupo"][$i]["grupo_id"]);
            array_push($data["info"], $this->ProjectModel->getProjectByID($projId[0]['projeto_id']));
        }
              
        $this->response($data, parent::HTTP_OK);
    }
    
    public function getStudentsFromGroup(){
        $this->load->model('GroupModel');
        $this->load->model('UserModel');
        $this->load->model('ProjectModel');
        
        $grupo_id =  $this->get('id');

        $projId =  $this->GroupModel->getProjectId($grupo_id);
        $data['proj_name'] = $this->ProjectModel->getProjectByID($projId[0]['projeto_id']);

        $data['students'] = $this->GroupModel->getStudents($grupo_id);
        $data["notClass"] = array();
        $data["class"] = array();

        for ($i=0; $i < count($data["students"]); $i++) {
            $userId = $data["students"][$i]['user_id']; 
            $data["x"] = $this->GroupModel->getClassVal($grupo_id, $userId); 

            if(count($data['x']) !=0) {
                array_push($data["class"], $this->UserModel->getUserById($data["students"][$i]['user_id']));
            }
            else{
                array_push($data["notClass"], $this->UserModel->getUserById($data["students"][$i]['user_id']));
            }
           
        }

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

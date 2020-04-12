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
    //                     GROUPS
    //////////////////////////////////////////////////////////////

    public function getMyGroups(){
        $this->load->model('GroupModel');
        $user_id = $this->get('id');
        $data['grupo'] = $this->GroupModel->getGroups($user_id);
        $this->response($data, parent::HTTP_OK);
    }

    public function getStudentsFromGroup(){
        $this->load->model('GroupModel');
        $grupo_id =  $this->get('id');
        $data['students'] = $this->GroupModel->getStudents($grupo_id);
        $this->response($data, parent::HTTP_OK);
    }

    public function getCadeiraGrupo(){
        $this->load->model('GroupModel');
        $this->load->model('ProjectModel');

        $grupo_id =  $this->get('id');

        // print_r($grupo_id);

        $projId =  $this->GroupModel->getProjectId($grupo_id);
        // echo "<br>";
        // print_r($projId);
        // echo "<br>";
        $data = $this->ProjectModel->getProjectByID($projId[0]['projeto_id']);
        // echo "<br>";
        // print_r($data[0]);


        $this->response($data[0], parent::HTTP_OK);

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

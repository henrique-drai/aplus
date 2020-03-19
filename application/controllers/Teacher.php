<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Teacher extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    //teacher/api/função
    public function api_post($f) {
        switch ($f) {
            case "getCadeiras":     $this->getCadeiras(); break;//     /teacher/api/getCadeiras
            case "getCadeiraInfo":  $this->getCadeiraInfo(); break;//  /teacher/api/getCadeiraInfo
            case "getDescription":  $this->getDescription(); break;//  /teacher/cadeira/id/getDescription
            case "getHours":        $this->getHours(); break;//        /teacher/cadeira/id/getHours
            case "insertText":      $this->insertText(); break;//      /teacher/cadeira/id/insertText
            case "createProject":   $this->createProject(); break;//    /teacher/api/createProject

            default:                $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //////////////////////////////////////////////////////////////
    //                         TEACHER
    //////////////////////////////////////////////////////////////
    public function getCadeiras() {
        $user_id = $this->post('id');
        $this->load->model('CourseModel');
        $data["cadeiras_id"] = $this->CourseModel->getCadeiras($user_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getCadeiraInfo() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('CourseModel');
        $data["info"] = $this->CourseModel->getCadeiraInfo($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getDescription() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('CourseModel');
        $data["info"] = $this->CourseModel->getDescription($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getHours() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('CourseModel');
        $data["hours"] = $this->CourseModel->getHours($cadeira_id);

        $this->load->model('UserModel');
        $data['user'] = array();
        for ($i=0; $i < count($data["hours"]); $i++) {
            array_push($data["user"], $this->UserModel->getUserById($data["hours"][$i]['id_prof']));
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function insertText() {
        $data = Array(
            "id"    => $this->post("cadeira_id"),
            "text"  => $this->post("text"),
        );
        $this->load->model('CourseModel');
        $this->CourseModel->insertText($data);

        $this->response($data, parent::HTTP_OK);
    }

<<<<<<< HEAD
=======

    public function createProject(){
        $dataProj = Array(
            "cadeira_id"          => $this->post("cadeira_id"),
            "nome"                => $this->post("projName"),
            "min_elementos"       => $this->post("groups_min"),
            "max_elementos"       => $this->post("groups_max"),
            "description"         => $this->post("projDescription"),
            "enunciado_url"        => $this->post("file"),
        );
        
        $dataEtapa = $this->post("listetapas");


        $this->load->model('ProjectModel');
        $proj_id = $this->ProjectModel->insertProject($dataProj);

        $this->load->model('EtapaModel');

        for($i=0; $i < count($dataEtapa); $i++) {

            $newEtapa = Array (
                "projeto_id"        => $proj_id,
                "nome"              => $dataEtapa[$i]["nome"],
                "description"       => $dataEtapa[$i]["desc"],
                "deadline"          => $dataEtapa[$i]["data"],
            );

            $this->EtapaModel->insertEtapa($newEtapa);
        }


        $this->response($dataProj, parent::HTTP_OK);
    }



>>>>>>> 6fc0d18d0d4a4e10d90ea6d92a4100b2c7b4a0d5
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

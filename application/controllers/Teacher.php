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
            case "createProject":   $this->createProject(); break;//   /teacher/api/createProject
            case "saveHours":       $this->saveHours(); break;//       /teacher/api/saveHours 
            case "removeHours":     $this->removeHours(); break;//     /teacher/api/removeHours
            case "getProj":         $this->getProj(); break;//         /teacher/api/getProj

            default:                $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //////////////////////////////////////////////////////////////
    //                         TEACHER
    //////////////////////////////////////////////////////////////
    public function getCadeiras() {
        $user_id = $this->post('id');
        $this->load->model('SubjectModel');
        $data["cadeiras_id"] = $this->SubjectModel->getCadeiras($user_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getCadeiraInfo() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('SubjectModel');
        $data["info"] = $this->SubjectModel->getCadeiraInfo($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getDescription() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('SubjectModel');
        $data["info"] = $this->SubjectModel->getDescription($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getHours() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('SubjectModel');
        $data["hours"] = $this->SubjectModel->getHours($cadeira_id);

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
        $this->load->model('SubjectModel');
        $this->SubjectModel->insertText($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function saveHours() {
        $data = Array (
            'id_prof'             => $this->post('user_id'),
            'id_cadeira'          => $this->post('cadeira_id'),
            'start_time'          => $this->post('start_time'),
            'end_time'            => $this->post('end_time'),
            'day'                 => $this->post('day'),
        );

        $this->load->model('SubjectModel');
        $this->SubjectModel->saveHours($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function removeHours() {
        $data = Array (
            'id_prof'             => $this->post('user_id'),
            'id_cadeira'          => $this->post('cadeira_id'),
            'start_time'          => $this->post('start_time'),
            'end_time'            => $this->post('end_time'),
            'day'                 => $this->post('day'),
        );

        $this->load->model('SubjectModel');
        $this->SubjectModel->removeHours($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function getProj() {
        $cadeira_id = $this->post('cadeira_id');
        $this->load->model('SubjectModel');
        $data = $this->SubjectModel->getProj($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function createProject(){
        $dataProj = Array(
            "cadeira_id"          => $this->post("cadeira_id"),
            "nome"                => $this->post("projName"),
            "min_elementos"       => $this->post("groups_min"),
            "max_elementos"       => $this->post("groups_max"),
            "description"         => $this->post("projDescription"),
            "enunciado_url"       => $this->post("file"),
        );
        
        $dataEtapa = $this->post("listetapas");


        $this->load->model('ProjectModel');
        $proj_id = $this->ProjectModel->insertProject($dataProj);

        $this->load->model('ProjectModel');

        for($i=0; $i < count($dataEtapa); $i++) {

            $newEtapa = Array (
                "projeto_id"        => $proj_id,
                "nome"              => $dataEtapa[$i]["nome"],
                "description"       => $dataEtapa[$i]["desc"],
                "deadline"          => $dataEtapa[$i]["data"],
            );

            $this->ProjectModel->insertEtapa($newEtapa);
        }


        $this->response($dataProj, parent::HTTP_OK);
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

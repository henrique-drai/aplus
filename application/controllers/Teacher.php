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
            case "createProject":           $this->createProject(); break;//        /teacher/api/createProject
            case "createEtapa":             $this->createEtapa(); break;//          /teacher/api/createEtapa
            case "editEtapa":               $this->editEtapa(); break;//            /teacher/api/editEtapa
            case "editEnunciado":           $this->editEnunciado(); break;//        /teacher/api/editEnunciado
            case "insertFeedback":          $this->insertFeedback(); break;//       /teacher/api/insertFeedback
            case "editEtapaEnunciado":      $this->editEtapaEnunciado(); break;//   /teacher/api/editEtapaEnunciado

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_get($f) {
        switch ($f) {
            case "getCourseStudents":       $this->getCourseStudents(); break; //   /teacher/api/getCourseStudents
            case "getProj":                 $this->getProj(); break;//              /teacher/api/getProj
            case "getSub":                  $this->getSub(); break;//               /teacher/api/getSub
            case "getAllEtapas":            $this->getAllEtapas(); break; //        /teacher/api/getAllEtapas
            case "getAllGroups":            $this->getAllGroups(); break; //        /teacher/api/getAllGroups

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_delete($f) {
        switch ($f) {
            case "removeProject":           $this->removeProject(); break; //       /teacher/api/removeProject
            case "removeEtapa":             $this->removeEtapa(); break;//          /teacher/api/removeEtapa
            case "removeEnunciadoEtapa":    $this->removeEnunciadoEtapa(); break;// /teacher/api/removeEnunciadoEtapa
            case "removeEnunciadoProj":     $this->removeEnunciadoProj(); break;//  /teacher/api/removeEnunciadoEtapa
            
            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }


    //////////////////////////////////////////////////////////////
    //                         PROJECTS
    //////////////////////////////////////////////////////////////

    public function getProj() {
        $this->verify_request();

        $cadeira_id = $this->get('cadeira_id');
        $this->load->model('SubjectModel');
        $data = $this->SubjectModel->getProj($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }


    public function removeProject() {
        $this->verify_request();

        $proj_id = $this->delete('projid');
        $this->load->model('ProjectModel');
        $data = $this->ProjectModel->removeProjectByID($proj_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function createProject(){
        $this->verify_request();

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
                "enunciado_url"     => $dataEtapa[$i]["enunciado"],
                "deadline"          => $dataEtapa[$i]["data"],
            );

            $this->ProjectModel->insertEtapa($newEtapa);
        }


        $this->response($proj_id, parent::HTTP_OK);
    }

    public function getAllEtapas(){
        $this->verify_request();

        $proj_id = $this->get('projid');
        $this->load->model('ProjectModel');
        $data = $this->ProjectModel->getEtapasByProjectID($proj_id);

        $this->response($data, parent::HTTP_OK);
    }


    public function removeEtapa(){
        $this->verify_request();

        $id = $this->delete('etapa_id');
        $this->load->model('ProjectModel');
        $data = $this->ProjectModel->removeEtapaByID($id);

        $this->response($data, parent::HTTP_OK);
    }


    public function createEtapa(){
        $this->verify_request();

        $etapa = $this->post('new_etapa');
        $this->load->model('ProjectModel');

        $new_etapa = Array (
            "projeto_id"        => $this->post('projid'),
            "nome"              => $etapa["nome"],
            "description"       => $etapa["desc"],
            "enunciado_url"     => $etapa["enunciado"],
            "deadline"          => $etapa["data"],
        );

        $data = $this->ProjectModel->insertEtapa($new_etapa);

        $this->response($data, parent::HTTP_OK);
    }

    public function editEtapa(){
        $this->verify_request();

        $etapa = $this->post('edited_etapa');
        $this->load->model('ProjectModel');

        $id = $this->post('id');

        $enunciado = '';

        if(empty($etapa["enunciado"])){
            $this_etapa = $this->ProjectModel->getEtapaByID($id);
            $enunciado = $this_etapa->row()->enunciado_url;
            
        } else {
            $enunciado = $etapa["enunciado"];
        }

        $new_etapa = Array (
            "projeto_id"        => $this->post('projid'),
            "nome"              => $etapa["nome"],
            "description"       => $etapa["desc"],
            "enunciado_url"     => $enunciado,
            "deadline"          => $etapa["data"],
        );

        $this->ProjectModel->updateEtapa($new_etapa, $id);

        $this->response($etapa, parent::HTTP_OK);
    }


    public function removeEnunciadoEtapa(){
        $this->verify_request();

        $this->load->model('ProjectModel');
        $id = $this->delete('id');
        $proj = $this->delete('projid');

        unlink("uploads/enunciados_files/" . $proj . "/" . $id . ".pdf");

        $this->ProjectModel->clearEnuncEtapa($id);

        $this->response($id, parent::HTTP_OK);
    }


    public function editEnunciado(){
        $this->verify_request();

        $proj = $this->post('projid');
        $this->load->model('ProjectModel');

        $enunciado = $this->post('enunciado');

        $this->ProjectModel->updateProjEnunciado($enunciado, $proj);

        $this->response($enunciado, parent::HTTP_OK);
    }

    public function getCourseStudents() {
        $this->verify_request();

        $cadeira_id = $this->get('id');
        $this->load->model('StudentListModel');
        $data["users_id"] = $this->StudentListModel->getStudentsbyCadeiraID($cadeira_id);

        $data["info"] = array();
        for($i=0; $i < count($data["users_id"]); $i++) {
            array_push($data["info"], $this->StudentListModel->getStudentsInfo($data["users_id"][$i]["user_id"]));
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getAllGroups() {
        $this->verify_request();
        
        $proj_id = $this->get("proj_id");
        $this->load->model("GroupModel");
        $data["grupos"] = $this->GroupModel->getAllGroups($proj_id);

        $data["students"] = array();
        for($i=0; $i  < count($data["grupos"]); $i++) {
            array_push($data["students"], $this->GroupModel->getStudents($data["grupos"][$i]["id"]));
        }

        $this->load->model("UserModel");
        $data["nomes"] = array();
        for($i=0; $i  < count($data["students"][0]); $i++) {
            array_push($data["nomes"], array(
                'grupo_id'      =>      $data["students"][0][$i]["grupo_id"], 
                'user_name'     =>      $this->UserModel->getUserById($data["students"][0][$i]["user_id"]))
            );
        }

        $this->response($data, parent::HTTP_OK);
    }


    public function getSub(){
        $this->verify_request();

        $grupo_id = $this->get('grupo_id');
        $etapa_id = $this->get('etapa_id');

        $this->load->model('ProjectModel');

        $url = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);

        $this->response($url->result_array(), parent::HTTP_OK);
    }

    public function insertFeedback(){
        $this->verify_request();

        $grupo_id = $this->post('grupo_id');
        $etapa_id = $this->post('etapa_id');
        $feedback = $this->post('feedback');

        $this->load->model('ProjectModel');

        $etapa_submit = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);

        $data = $this->ProjectModel->insertFeedback($feedback, $etapa_submit->row()->id);

        $this->response($etapa_submit, parent::HTTP_OK);
    }

    public function editEtapaEnunciado(){
        $this->verify_request();

        $etapa = $this->post('etapaid');
        $enunc = $this->post('enunciado');

        $this->load->model('ProjectModel');

        $this->ProjectModel->editEtapaEnunciado($enunc, $etapa);

        $this->response($enunc, parent::HTTP_OK);
    }


    public function removeEnunciadoProj(){
        $this->verify_request();

        $proj = $this->delete('projid');
        $this->load->model('ProjectModel');
        $this->ProjectModel->removeEnunciadoProj($proj);

        unlink("uploads/enunciados_files/" . $proj . ".pdf");

        $this->response($proj, parent::HTTP_OK);
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

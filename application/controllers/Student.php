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
            case "submitRating":            $this->submitRating(); break;//     /student/api/getCadeiras
            // adicionem aqui as vossas funções

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_get($f) {
        switch ($f) {
            case "getMyGroups":             $this->getMyGroups(); break;
            case "getStudentsFromGroup":    $this->getStudentsFromGroup(); break;
            case "getCadeiraGrupo":         $this->getCadeiraGrupo(); break;

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
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

    
    
    public function getStudentsFromGroup(){
        $this->load->model('GroupModel');
        $this->load->model('UserModel');
        $this->load->model('ProjectModel');
        
        $grupo_id =  $this->get('id');
        $classificador = $this->get('classificador');

        $projId =  $this->GroupModel->getProjectId($grupo_id);

        $data['proj_name'] = $this->ProjectModel->getProjectByID($projId[0]['projeto_id']);

        $data['students'] = $this->GroupModel->getStudents($grupo_id);
        $data["notClass"] = array();
        $data["class"] = array();
        $data["rate"] = array();

        for ($i=0; $i < count($data["students"]); $i++) {
            $userId = $data["students"][$i]['user_id'];
            
            if($userId != $classificador){
                $nota = $this->GroupModel->getClassVal($grupo_id, $userId); 

                if(isset($nota)) {
                    array_push($data["class"], $this->UserModel->getUserById($userId));
                    array_push($data["rate"], $nota->valor);
                }
                else{
                    array_push($data["notClass"], $this->UserModel->getUserById($userId));
                }
            }
        }
        $this->response($data, parent::HTTP_OK);
    }

    //////////////////////////////////////////////////////////////
    //                   Projetos e Etapas
    //////////////////////////////////////////////////////////////




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

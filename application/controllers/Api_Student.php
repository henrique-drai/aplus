<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Student extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('TasksModel');
    }

    
    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////





    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////
    
    public function getAllStudents_get(){
        $this->verify_request();
        $this->load->model('UserModel');
        $data["students"] = $this->UserModel->getStudents();
        
        $this->response($data, parent::HTTP_OK);
    }


    public function getSearchStudent_get(){
        $this->verify_request();
        $query = '';
        $this->load->model('UserModel');
        if($this->get("query")){
            $query = $this->get("query");
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

    // TAREFAS - GRUPO 

    public function getAllTasks_get($grupo_id) {
        $this->verify_request();

        $this->load->model('TasksModel');
        $data["tarefas"] = $this->TasksModel->getTarefas($grupo_id);
        
        $data["membro_nome"] = array();
        for($i=0; $i < count($data["tarefas"]); $i++) {
            array_push($data["membro_nome"], $this->TasksModel->getMembroNome($data["tarefas"][$i]["user_id"]));
        }


        $this->response($data, parent::HTTP_OK);

    }

     //////////////////////////////////////////////////////////////
    //                     GROUPS
    //////////////////////////////////////////////////////////////


    public function getMyGroups_get(){
        $this->load->model('GroupModel');
        $this->load->model('ProjectModel');
        $this->load->model('SubjectModel');

        $user_id = $this->get('id');
        $data['grupo'] = $this->GroupModel->getGroups($user_id);

        $data["info"] = array();
        $data["subjName"] = array();
        $data["deadline"] = array();

        for ($i=0; $i < count($data["grupo"]); $i++) {
           
            $projId =  $this->GroupModel->getProjectId($data["grupo"][$i]["grupo_id"]);
            
            // array_push($data["deadline"], $this->ProjectModel->getLastEtapa($projId[0]['projeto_id'])[0]['deadline']);

            $idCadeira = $this->ProjectModel->getProjectByID($projId[0]['projeto_id'])[0]['cadeira_id'];
            $nomeCadeira = $this->SubjectModel->getSubjectByID($idCadeira)->name;

            array_push($data["info"], $this->ProjectModel->getProjectByID($projId[0]['projeto_id']));
            array_push($data["subjName"], $nomeCadeira);

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

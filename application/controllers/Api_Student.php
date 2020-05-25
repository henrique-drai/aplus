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
        $this->verify_request();
        $this->load->model('TasksModel');
    }

    
    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////





    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////
    
    public function getAllStudents_get(){
        $this->load->model('UserModel');
        $data["students"] = $this->UserModel->getStudents();
        
        $this->response($data, parent::HTTP_OK);
    }


    public function getSearchStudent_get(){ 
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

        $data["proj_name"] = array();


        for ($i=0; $i < count($data["grupo"]); $i++) {
           
            $projId =  $this->GroupModel->getProjectId($data["grupo"][$i]["grupo_id"]);

            array_push($data["proj_name"], $projId[$i]['name']);
            
            array_push($data["deadline"], $this->ProjectModel->getLastEtapa($projId[0]['projeto_id'])[0]['deadline']);

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
        if(is_null($this->session->userdata('role'))){
            $this->response(array('msg' => 'You must be logged in!'), parent::HTTP_UNAUTHORIZED);
            exit();
        }
    }
}

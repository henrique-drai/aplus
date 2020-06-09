<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Chat extends REST_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->model("YearModel");
        // $this->load->model('UserModel');
        $this->verify_request();
    }


    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function sendMessageGroup_post(){
        $this->load->model('ChatModel');
    
        $data = Array(
            "content"     => htmlspecialchars($this->post('m')),
            "grupo_id"    => htmlspecialchars($this->post('id')),
            "user_id"     => $this->session->userdata('id'),
            "date"        => htmlspecialchars($this->post('t')),  
        );
        $this->ChatModel->sendMessageGroup($data);
    }

    public function sendMessage_post(){
        $this->load->model('ChatModel');
      
        $data = Array(
            "content"     => htmlspecialchars($this->post('m')),
            "id_receiver" => htmlspecialchars($this->post('id')),
            "id_sender"   => $this->session->userdata('id'),
            "date"        => htmlspecialchars($this->post('t')),  
        );
        $this->ChatModel->sendMessage($data);
    }

    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    // public function getLastPrivateMsg_get(){ 
    //     $this->load->model('ChatModel');
        
    //     $id_receiver = $this->session->userdata('id');

    //     $id_sender = $this->get('id_sender');

    //     $resultquery = $this->ChatModel->last_record_privateMsg($id_receiver,$id_sender);
    //     $data['msg']="";
    //     if(empty($resultquery)){
    //         $data["msg"]="no data";
    //     }else{
    //         $data["msg"] = $resultquery;
    //     }

    //     $this->response($data, parent::HTTP_OK);
    // }

    public function getChatLogs_get(){
        $id = $this->session->userdata('id');
        $this->load->model('ChatModel');
        $this->load->model('UserModel');
        $resultquery = $this->ChatModel->getChatLogs($id);
        $data['users']=array();
        $compArray=array();

        for($i=0; $i < count($resultquery); $i++) {
            if($resultquery[$i]["sender"]!=$id && !in_array($resultquery[$i]["sender"], $compArray)){
                $tmp = $this->UserModel->getUserById($resultquery[$i]["sender"]);
                array_push($data["users"], $tmp);
                array_push($compArray,$resultquery[$i]["sender"]);
            }elseif ($resultquery[$i]["sender"]==$id && !in_array($resultquery[$i]["receiver"], $compArray)) {
                $tmp = $this->UserModel->getUserById($resultquery[$i]["receiver"]);
                array_push($data["users"], $tmp);
                array_push($compArray,$resultquery[$i]["receiver"]);
            }
        }  
        $this->response($data, parent::HTTP_OK);
    }

    public function getChatHistory_get(){
        $id = $this->session->userdata('id');
        $this->load->model('ChatModel');
        $id_sender = htmlspecialchars($this->get('id_sender'));
        $resultquery = $this->ChatModel->getChatHistory($id,$id_sender);
        $this->load->model('UserModel');

        $data['user']=$this->UserModel->getUserById($id_sender);
        $data['msg']=array();

        if(empty($resultquery)){
            $data["msg"]="";
        }else{
            $data["msg"] = $resultquery;
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getChatGroupHistory_get(){
        $id = $this->session->userdata('id');
        $this->load->model('ChatModel');
        $this->load->model('GroupModel');
        $this->load->model('ProjectModel');
        $id_group = htmlspecialchars($this->get('id_group'));
        $resultquery = $this->ChatModel->getChatGroupHistory($id_group);
        $this->load->model('UserModel');
        $grupo=$this->GroupModel->getGroupById($id_group);
        array_push($grupo, $this->ProjectModel->getProjectByID($grupo[0]["projeto_id"]));

        // print_r($grupo);
        $data['me']= $id ;

        $data['msg']=array();
        for($i=0; $i < count($resultquery); $i++) {
            array_push($data['msg'], array($resultquery[$i],$this->UserModel->getUserById($resultquery[$i]["user_id"])));
        }
        array_push($data,$grupo[0]["name"]);
        array_push($data,$grupo[1][0]["nome"]);
        if(empty($resultquery)){
            $data["msg"]="";
        }
        // else{
        //     $data["msg"] = $resultquery;
        // }
        // $data['sent']=array();
        // $data['received']=array();
        
        // for($i=0; $i < count($resultquery); $i++) {
        //     if($resultquery[$i]["user_id"]==$id){
        //         array_push($data['sent'], array($resultquery[$i],$this->UserModel->getUserById($resultquery[$i]["user_id"])));
        //     }
        //     else{
        //         array_push($data['received'], array($resultquery[$i],$this->UserModel->getUserById($resultquery[$i]["user_id"])));
        //     }
            
        // }
        // if(empty($resultquery)){
        //     $data="";
        // }

        $this->response($data, parent::HTTP_OK);
    }
    

    public function getGroups_get(){
        $id = $this->session->userdata('id');
        $this->load->model('GroupModel');
        $this->load->model('ProjectModel');
        $ides["grupos"] = $this->GroupModel->getGroups($id);
        $data=array();
        $grupo=array();
        for ($i=0; $i < count($ides["grupos"]); $i++) {
            $grupo = $this->GroupModel->getGroupById($ides["grupos"][$i]["grupo_id"]);
            array_push($grupo, $this->ProjectModel->getProjectByID($grupo[0]["projeto_id"]));
            array_push($data, $grupo);
        }
        $this->response($data, parent::HTTP_OK);

    }

    public function getLastConvo_get(){
        $id = $this->session->userdata('id');
        $this->load->model('ChatModel');
        $this->load->model('GroupModel');
        $this->load->model('ProjectModel');


        $data=array();
        $resultquery = $this->ChatModel->getLastConvo($id);
        // $grupo = $this->GroupModel->getGroupById($resultquery[]);
        // $resultquery[]
        // print_r($grupo[0]["name"]);
        if($resultquery[0]["Type"]=="Grupo"){
            $grupo=$this->GroupModel->getGroupById($resultquery[0]["ID"]);
            array_push($grupo, $this->ProjectModel->getProjectByID($grupo[0]["projeto_id"]));
            array_push($data,$resultquery);
            array_push($data,$grupo[0]["name"]);
            array_push($data,$grupo[1][0]["nome"]);

        }
        elseif($resultquery[0]["Type"]=="Privado"){
            $data = $resultquery;
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
            return null;
        }
    }
}

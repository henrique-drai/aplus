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
        // $this->load->model('ChatModel');
        // // $msg = htmlspecialchars($this->post('m'));
        // // $id_receiver = $this->post('id');
        // // $id = $this->session->userdata('id');
        // $data = Array(
        //     "content"     => htmlspecialchars($this->post('m')),
        //     "id_receiver" => $this->post('id'),
        //     "id_sender"   => $this->session->userdata('id'),
        //     "date"        => $this->post('t'),  
        // );
        // $this->ChatModel->sendMessage($data);
    }

    public function sendMessage_post(){
        $this->load->model('ChatModel');
        // $msg = htmlspecialchars($this->post('m'));
        // $id_receiver = $this->post('id');
        // $id = $this->session->userdata('id');
        $data = Array(
            "content"     => htmlspecialchars($this->post('m')),
            "id_receiver" => $this->post('id'),
            "id_sender"   => $this->session->userdata('id'),
            "date"        => $this->post('t'),  
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
        // $data['content']=array();


        // if(empty($resultquery)){
        //     $data["users"]="no data";
        // }else{
        //     $data["users"] = $resultquery;
        // }
        
        // $user = $this->UserModel->getUserById(intval($user_id));
        $compArray=array();
        // print_r($resultquery);

        for($i=0; $i < count($resultquery); $i++) {
            if($resultquery[$i]["id_sender"]!=$id && !in_array($resultquery[$i]["id_sender"], $compArray)){
                $tmp = $this->UserModel->getUserById($resultquery[$i]["id_sender"]);
                array_push($data["users"], $tmp);
                array_push($compArray,$resultquery[$i]["id_sender"]);
            // array_push($data["content"], $resultquery[$i]["id_sender"]);
            }elseif ($resultquery[$i]["id_sender"]==$id && !in_array($resultquery[$i]["id_receiver"], $compArray)) {
                $tmp = $this->UserModel->getUserById($resultquery[$i]["id_receiver"]);
                array_push($data["users"], $tmp);
                array_push($compArray,$resultquery[$i]["id_receiver"]);
            }
        }

        // $data["content"]=$resultquery;
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getChatHistory_get(){
        $id = $this->session->userdata('id');
        $this->load->model('ChatModel');
        $id_sender = $this->get('id_sender');
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
        $this->load->model('ChatModel');
        $id_group = $this->get('id_group');
        $resultquery = $this->ChatModel->getChatGroupHistory($id_group);
        $this->load->model('UserModel');

        // $data['user']=$this->UserModel->getUserById($id_sender);
        // $data['users']=array();

        $data['msg']=array();
        for($i=0; $i < count($resultquery); $i++) {
            array_push($data['msg'], array($resultquery[$i],$this->UserModel->getUserById($resultquery[$i]["user_id"])));
        }
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
        $ides["grupos"] = $this->GroupModel->getGroups($id);
        $data=array();
        for ($i=0; $i < count($ides["grupos"]); $i++) {
            $grupo = $this->GroupModel->getGroupById($ides["grupos"][$i]["grupo_id"]);
            array_push($data, $grupo);
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

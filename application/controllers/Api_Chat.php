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


    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getLastPrivateMsg_get(){ 
        $this->load->model('ChatModel');
        
        $id_receiver = $this->session->userdata('id');

        $id_sender = $this->get('id_sender');

        $resultquery = $this->ChatModel->last_record_privateMsg($id_receiver,$id_sender);
        $data['msg']="";
        if(empty($resultquery)){
            $data["msg"]="no data";
        }else{
            $data["msg"] = $resultquery;
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getChatLogs_get(){
        $id = $this->session->userdata('id');

        $this->load->model('ChatModel');

        $this->load->model('UserModel');

        $resultquery = $this->ChatModel->getChatLogs($id);

        $data['users']=array();

        // if(empty($resultquery)){
        //     $data["users"]="no data";
        // }else{
        //     $data["users"] = $resultquery;
        // }
        
        // $user = $this->UserModel->getUserById(intval($user_id));

        for($i=0; $i < count($resultquery); $i++) {
            $tmp = $this->UserModel->getUserById($resultquery[$i]["id_sender"]);
            array_push($data["users"], $tmp);
        }

        $data["content"]=$resultquery;
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getChatHistory_get(){
        $id = $this->session->userdata('id');
        $this->load->model('ChatModel');
        $id_sender = $this->get('id_sender');
        $resultquery = $this->ChatModel->getChatHistory($id,$id_sender);

        $data['msg']=array();

        if(empty($resultquery)){
            $data["msg"]="no data";
        }else{
            $data["msg"] = $resultquery;
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

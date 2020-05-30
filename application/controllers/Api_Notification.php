<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Notification extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->verify_request();
        $this->load->model('NotificationModel');
    }

    public function all_get(){
        $user_id = $this->session->userdata('id');
        $data = $this->NotificationModel->getAll($user_id);
        $this->response($data, parent::HTTP_OK);
    }

    public function new_get(){
        $user_id = $this->session->userdata('id');
        $data = $this->NotificationModel->getNew($user_id);
        $this->response($data, parent::HTTP_OK);
    }

    public function notification_post($notification_id){
        $notification_id = htmlspecialchars($notification_id);
        $user_id = $this->session->userdata('id');
        $data = $this->NotificationModel->updateSeen($user_id, $notification_id);
        $this->response($data, parent::HTTP_OK);
    }

    public function notification_delete($notification_id){
        $notification_id = htmlspecialchars($notification_id);
        $user_id = $this->session->userdata('id');
        $data = $this->NotificationModel->delete($user_id, $notification_id);
        $this->response($data, parent::HTTP_OK);
    }

    //////////////////////////////////////////////////////////////
    //                      AUTHENTICATION
    //////////////////////////////////////////////////////////////

    private function verify_request(){
        if(is_null($this->session->userdata('role'))){
            $this->response(array('msg' => 'You must be logged in!'), parent::HTTP_UNAUTHORIZED);
            exit();
        }
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Event extends REST_Controller {

    public function __construct() {
      parent::__construct();
      $this->verify_request();
    }

    public function event_delete($event_id) {
      $event_id = htmlspecialchars($event_id);

      $user_id = $this->session->userdata('id');

      $this->load->model('EventModel');

      if ($this->EventModel->userRelatedToEvent($user_id, $event_id)){
        $this->EventModel->delete($event_id);
      } 

      $this->response(array(), parent::HTTP_OK);
    }

    public function going_delete($event_id) { 
      $event_id = htmlspecialchars($event_id);
      $user_id = $this->session->userdata('id');

      $this->load->model('EventModel');

      if ($this->EventModel->userRelatedToEvent($user_id, $event_id)){
        $this->EventModel->notGoing($user_id, $event_id);
      } 

      $this->response(array(), parent::HTTP_OK);
    }

    public function editGroupEvent_post($grupo_id){
      $grupo_id = htmlspecialchars($grupo_id);
       
      $data = array (
        "name" => htmlspecialchars($this->post("name")),
        "description" => htmlspecialchars($this->post("description")),
        "location" => htmlspecialchars($this->post("location")),
        "start_date" => htmlspecialchars($this->post("start_date")),
        "end_date" => htmlspecialchars($this->post("end_date")),
      );
      
      // $evento_id = $this->EventModel->insertEvent($data_evento);
      
      // $data_Evento_Grupo = Array (
      //     "evento_id" => $evento_id,
      //     "grupo_id" => $grupo_id,   
      // );

      // $this->EventModel->insertGroupEvent($data_Evento_Grupo);

      // if ($this->EventModel->userRelatedToEvent($user_id, $event_id)){

      // } 
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

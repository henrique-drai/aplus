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

    public function event_post($event_id) {
      $event_id = htmlspecialchars($event_id);

      $post = array (
        "name" => htmlspecialchars($this->post("name")),
        "description" => htmlspecialchars($this->post("description")),
        "location" => htmlspecialchars($this->post("location")),
        "start_date" => htmlspecialchars($this->post("start_date")),
        "end_date" => htmlspecialchars($this->post("end_date")),
      );

      $user_id = $this->session->userdata('id');

      $this->load->model('EventModel');

      //TODO PRIVACIDADE (comment abaixo)
      $this->EventModel->update($event_id, $post);

      // if ($this->EventModel->userRelatedToEvent($user_id, $event_id)){
      //   $this->EventModel->update($event_id, $post);
      // } 

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

    // create
    public function meeting_post ($grupo_id) {
      $post = array (
        "name" => htmlspecialchars($this->post("name")),
        "description" => htmlspecialchars($this->post("description")),
        "location" => htmlspecialchars($this->post("location")),
        "start_date" => htmlspecialchars($this->post("start_date")),
        "end_date" => htmlspecialchars($this->post("end_date")),
      );

      // TODO ver se o utilizador está no grupo

      $this->load->model('EventModel');

      $this->EventModel->insertMeeting($post, $grupo_id);
       
      $this->response($post, parent::HTTP_OK);
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

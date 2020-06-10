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

      // DESLIGUEI A PRIVACIDADE PARA DEIXAR APAGAR EVENTOS DE GRUPO
      // if ($this->EventModel->userRelatedToEvent($user_id, $event_id)){
      //   $this->EventModel->delete($event_id);
      // } 

      $this->EventModel->delete($event_id);

      $this->response(array($event_id), parent::HTTP_OK);
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

      $this->response($data, parent::HTTP_OK);
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
      $user_id = $this->session->userdata('id');
      $grupo_id = htmlspecialchars($grupo_id);
      $data = array();
      $post = array (
        "name" => htmlspecialchars($this->post("name")),
        "description" => htmlspecialchars($this->post("description")),
        "location" => htmlspecialchars($this->post("location")),
        "start_date" => htmlspecialchars($this->post("start_date")),
        "end_date" => htmlspecialchars($this->post("end_date")),
      );
      $this->load->model('EventModel');
      $this->load->model('GroupModel');
      $this->load->model('NotificationModel');
      date_default_timezone_set('Europe/Lisbon');

      if ($this->GroupModel->isValidGroup($grupo_id,$user_id)){
        $evento_id = $this->EventModel->insertMeeting($post, $grupo_id); //criar evento e grupo_evento
        
        $students = $this->GroupModel->getStudents($grupo_id); //buscar pessoas do grupo
        
        $people = array(); //organizar info para inscrever os alunos na reunião
        $notifications = array(); //escrever notificações
        $curr_date = date('Y/m/d H:i:s', time());

        foreach ($students as $key => $value) { 
          array_push($people, array(
            "evento_id" => $evento_id,
            "user_id" => intval($value["user_id"])
          ));
        }
        
        $this->EventModel->multiplePeopleGoing($people); //inscrever alunos na reunião
        
        foreach ($students as $key => $value) {
          if($user_id != intval($value["user_id"])){
            array_push($notifications, Array(
              "user_id" => intval($value["user_id"]),
              "type" => "alert",
              "title" => "Reunião de grupo agendada",
              "content" => "Clica para saberes mais",
              "link" => "app/grupo/" . $grupo_id,
              "seen" => FALSE,
              "date" => $curr_date
            ));
          }
        }
        $data = $notifications;

        $this->NotificationModel->createMultiple($notifications); //enviar notificações para todos os alunos
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

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

      if ($this->post("going") == "true") {
        $this->EventModel->userIsGoing($user_id, $event_id);
      } else {
        $this->EventModel->notGoing($user_id, $event_id);
      }

      $this->response(array("going" => $this->post("going")), parent::HTTP_OK);
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

        $this->NotificationModel->createMultiple($notifications); //enviar notificações para todos os alunos
      } 

      $this->response(array(), parent::HTTP_OK);
    }

    // para convidar profs para uma reunião
    public function invite_post ($evento_id) {
      //segurança
      $post = $this->post("people");
      $evento_id = htmlspecialchars($evento_id);
      $grupo_id = htmlspecialchars($this->post("grupo_id"));

      foreach ($post as $key => $value)
        $post[$key] = htmlspecialchars($value);

      $this->load->model('EventModel');
      $this->load->model('NotificationModel');
      date_default_timezone_set('Europe/Lisbon');

      //inscrição
      $evento_user = array();
      foreach ($post as $key => $value) { 
        array_push($evento_user, array(
          "evento_id" => $evento_id,
          "user_id" => $value
        ));
      }
      $this->EventModel->multiplePeopleGoing($evento_user);

      //notificação
      $notification = array();
      $curr_date = date('Y/m/d H:i:s', time());
      foreach ($post as $key => $value) {
        array_push($notification, Array(
          "user_id" => $value,
          "type" => "alert",
          "title" => "Nova reunião no calendário",
          "content" => "Clique para saber mais",
          "link" => "app",
          "seen" => FALSE,
          "date" => $curr_date
        ));
      }

      $this->NotificationModel->createMultiple($notification);

      $this->response($evento_user, parent::HTTP_OK);
    }

    public function removeEventByHourId_delete($hour_id) {
      $this->load->model('EventModel');
      $user_id = htmlspecialchars($this->delete("user_id"));
      $cadeira_id = htmlspecialchars($this->delete("cadeira_id"));

      if($this->verify_student($user_id, $cadeira_id)) {
        $this->EventModel->deleteEventByHourId($hour_id);

        $this->response(array($hour_id), parent::HTTP_OK);
      }
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

    private function verify_student($user_id, $cadeira_id){
      $this->load->model('StudentListModel');
      $membros = $this->StudentListModel->getStudentsByCadeiraID($cadeira_id);

      $flag_found = false;

      for ($i=0; $i < count($membros); $i++){
          if($user_id == $membros[$i]["user_id"]){
              $flag_found = true;
          }    
      }

      return $flag_found;
  }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Calendario extends REST_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function calendario_get() {
        $this->verify_request();
        $user_id = $this->session->userdata('id');

        $this->load->model('UserModel');
        $this->load->model('EventModel');

        $user = $this->UserModel->getUserById($user_id);

        $duvidas = array();

        if ($user->role == "student") {
            $classes = $this->EventModel->getClassesByStudentId($user_id);
        } else if ($user->role == "teacher") {
            $classes = $this->EventModel->getClassesByTeacherId($user_id);
            $duvidas = $this->EventModel->getHorarioDuvidasByTeacherId($user_id);
        } else {
            $this->response(Array(), parent::HTTP_NOT_FOUND); return null;
        }

        $events = $this->EventModel->getFutureEventsByUserId($user_id);
        $group_events = $this->EventModel->getFutureGroupEventsByUserId($user_id);
        $submissions = $this->EventModel->getFutureSubmissionsByUserId($user_id);

        //encontrar eventos duplicados
        $ids_to_remove = Array();
        foreach ($events as $index => $e) foreach ($group_events as $ge) 
            if ($ge["evento_id"] == $e["id"]) array_push($ids_to_remove, $index);

        //apagar eventos duplicados (transforma o events em objeto)
        foreach ($ids_to_remove as $itr) unset($events[$itr]);

        //voltar a converter para array
        $events = array_values($events);

        $data = Array(
            "classes" => $classes,
            "events" => $events,
            "group_events" => $group_events,
            "submissions" => $submissions,
            "duvidas" => $duvidas,
        );

        $this->response($data, parent::HTTP_OK);
    }

    public function agenda_get() {
        $this->verify_request();

        $user_id = $this->session->userdata('id');

        $this->load->model('UserModel');
        $this->load->model('EventModel');

        $user = $this->UserModel->getUserById($user_id);

        $events = $this->EventModel->getFutureEventsByUserId($user_id);
        $group_events = $this->EventModel->getFutureGroupEventsByUserId($user_id);
        $submissions = $this->EventModel->getFutureSubmissionsByUserId($user_id);

        //encontrar eventos duplicados
        $ids_to_remove = Array();
        foreach ($events as $index => $e) foreach ($group_events as $ge) 
            if ($ge["evento_id"] == $e["id"]) array_push($ids_to_remove, $index);

        //apagar eventos duplicados (transforma o events em objeto)
        foreach ($ids_to_remove as $itr) unset($events[$itr]);

        //voltar a converter para array
        $events = array_values($events);

        $data = Array(
            "events" => $events,
            "group_events" => $group_events,
            "submissions" => $submissions,
        );

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

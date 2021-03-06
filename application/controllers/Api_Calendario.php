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
        $this->verify_request();
    }

    public function calendario_get() {
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

    public function export_get(){
        @header("Content-type: text/x-csv");
        @header("Content-Disposition: attachment; filename=calendario.csv");
        @header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        echo "\xEF\xBB\xBF";

        $user_id = $this->session->userdata('id');

        $this->load->model('UserModel');
        $this->load->model('EventModel');

        $user = $this->UserModel->getUserById($user_id);
        
        $file = fopen('php://output','w');
        $header = array("Subject","Start Date","Start Time","End Date","End Time","All day event","Description","Location");

        $duvidas = array();

        $events = $this->EventModel->getFutureEventsByUserId($user_id);
        $submissions = $this->EventModel->getFutureSubmissionsByUserId($user_id);

        fputcsv($file, $header);
        foreach($events as $e){
            $start_date = date("m-d-Y",strtotime($e["start_date"]));
            $start_time = date("h:i A",strtotime($e["start_date"]));
            $end_date = date("m-d-Y",strtotime($e["start_date"]));
            $end_time = date("h:i A",strtotime($e["start_date"])); 
            $dados = array($e["name"],$start_date,$start_time,$end_date,$end_time,"False",$e["description"],$e["location"]);
            fputcsv($file, $dados);
        }
        foreach($submissions as $s){
            $date = date("m-d-Y",strtotime($s["deadline"]));
            $time = date("h:i A",strtotime($s["deadline"]));
            $subject = $s["nome"] . " (Data de Entrega)";
            $dados = array($subject,$date,$time,$date,$time,"False",$s["description"],"Área de Grupo no A+");
            fputcsv($file, $dados);
        }
        fclose($file);
        exit;
    }

    public function agenda_get() {
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

    public function grupo_get($grupo_id) {
        $user_id = $this->session->userdata('id');        

        $this->load->model('UserModel');
        $this->load->model('EventModel');
        $this->load->model('GroupModel');

        if($this->UserModel->userIsRelatedToGroup($user_id, $grupo_id) == false){
            $this->response(array('msg' => 'You don\'t have access to that group!'), parent::HTTP_UNAUTHORIZED); exit();
        }

        $group_events = $this->EventModel->getFutureEventsByGroupId($grupo_id);
        $submissions = $this->EventModel->getFutureSubmissionsByGroupId($grupo_id);
        $teachers = $this->GroupModel->getTeachersByGroupId($grupo_id);

        foreach ($group_events as $key => $value) {
            $group_events[$key]["people_going"] = $this->EventModel->getPeopleGoing($value["evento_id"]);
        }

        $data = Array(
            "group_events" => $group_events,
            "submissions" => $submissions,
            "teachers" => $teachers,
        );

        $this->response($data, parent::HTTP_OK);
    }
    

    //////////////////////////////////////////////////////////////
    //                      AUTHENTICATION
    //////////////////////////////////////////////////////////////

    private function verify_request()
    {
        if(is_null($this->session->userdata('role'))){
            $this->response(array('msg' => 'You must be logged in!'), parent::HTTP_UNAUTHORIZED); exit();
        }
    }
}

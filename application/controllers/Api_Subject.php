<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Subject extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('SubjectModel');
        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $this->load->model('UserModel');
        $this->load->model("ForumModel");
        $this->load->model("EventModel");
        $this->load->model("StudentListModel");
    }


    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function insertText_post() {
        $this->verify_request();
        $data = Array(
            "id"    => $this->post("cadeira_id"),
            "text"  => $this->post("text"),
        );

        $this->SubjectModel->insertText($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function saveHours_post() {
        $this->verify_request();

        $data = Array (
            'id_prof'             => $this->verify_request()->id,
            'id_cadeira'          => $this->post('cadeira_id'),
            'start_time'          => $this->post('start_time'),
            'end_time'            => $this->post('end_time'),
            'day'                 => $this->post('day'),
        );

        $this->SubjectModel->saveHours($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function registerSubject_post(){
        $this->verify_request();
        $data = Array(
            "code" => $this->post('codeCadeira'),
            "curso_id"   => $this->post('curso'),
            "name" => $this->post('nomeCadeira'),
            "description"   => $this->post('descCadeira'),
        );

        $this->load->model('SubjectModel');
        $retrieved = $this->SubjectModel->registerSubject($data);
        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }

    public function insertEvent_post($hour_id) {
        $user_id = $this->verify_request()->id;

        $daysOfWeek = array("", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "");

        $data["hour"] = $this->EventModel->getHorarioDuvidasById($hour_id);

        if(count($data["hour"]) > 0) {
            $data["user"] = $this->UserModel->getUserById($data["hour"]->id_prof);

            $daysToGo = array_search($data["hour"]->day, $daysOfWeek) + 1; //adicionar +1
            $currentDay = date("Y-m-d");
            $newDate = date("Y-m-d", strtotime('+' . (8 - $daysToGo) . ' days'));
            $startTime = $newDate . " " . $data["hour"]->start_time;
            $endTime = $newDate . " " . $data["hour"]->end_time;

            $dataInsert = Array (
                'start_date'          => date("Y-m-d H:i:s", strtotime($startTime)),
                'end_date'            => date("Y-m-d H:i:s", strtotime($endTime)),
                'name'                => "Horário de Dúvidas",
                'description'         => "Horário de Dúvidas com o(a) professor(a) " . $data["user"]->name . " " . $data["user"]->surname,
                'location'            => $data["user"]->gabinete,
            );
    
            $event_id = $this->EventModel->insertEvent($dataInsert);

            $this->EventModel->insertUserEvent(Array ("evento_id" => $event_id, "user_id" => $data["user"]->id));
            $this->EventModel->insertUserEvent(Array ("evento_id" => $event_id, "user_id" => $user_id));
        }

        
        $this->response($data, parent::HTTP_OK);
    }



    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getCadeiras_get($user_id = null, $role) {
        if($user_id != $this->verify_request()->id) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        $data["cadeiras_id"] = $this->SubjectModel->getCadeiras($user_id, $role);

        $data["info"] = array();
        $data["curso"] = array();
        for($i=0; $i < count($data["cadeiras_id"]); $i++) {
            $tmp = $this->SubjectModel->getCadeiraInfo($data["cadeiras_id"][$i]["cadeira_id"]);
            array_push($data["curso"], $this->CourseModel->getCursobyId($tmp[0]["curso_id"]));
            array_push($data["info"], $tmp);
        }

        if(count($data["info"]) > 0) {
            $tmp = $this->CourseModel->getCursobyId($data["info"][0][0]["curso_id"]);
            $data["year"] = $this->YearModel->getYearById($tmp->ano_letivo_id);
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getHours_get($cadeira_id) {
        $this->verify_request();

        $data["hours"] = $this->SubjectModel->getHours($cadeira_id);

        $data['user'] = array();
        for ($i=0; $i < count($data["hours"]); $i++) {
            array_push($data["user"], $this->UserModel->getUserById($data["hours"][$i]['id_prof']));
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getInfo_get($cadeira_id) {
        $this->verify_request();

        $data["desc"] = $this->SubjectModel->getDescriptionById($cadeira_id);
        $data["forum"] = $this->ForumModel->getForumByCadeiraID($cadeira_id);
        $data["proj"] = $this->SubjectModel->getProj($cadeira_id);
        $data["hours"] = $this->SubjectModel->getHours($cadeira_id);

        $data['user'] = array();
        for ($i=0; $i < count($data["hours"]); $i++) {
            array_push($data["user"], $this->UserModel->getUserById($data["hours"][$i]['id_prof']));
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getCourseStudents_get($cadeira_id) {
        $this->verify_request();

        $data["cadeira_id"] = $cadeira_id;
        $this->load->model('StudentListModel');
        $data["users_id"] = $this->StudentListModel->getStudentsbyCadeiraID($cadeira_id);

        $data["info"] = array();
        for($i=0; $i < count($data["users_id"]); $i++) {
            array_push($data["info"], $this->StudentListModel->getStudentsInfo($data["users_id"][$i]["user_id"]));
        }

        $this->response($data, parent::HTTP_OK);
    }


    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////

    public function removeHours_delete() {
        $data = Array (
            'id_prof'             => $this->verify_request()->id,
            'id_cadeira'          => $this->delete('cadeira_id'),
            'start_time'          => $this->delete('start_time'),
            'end_time'            => $this->delete('end_time'),
            'day'                 => $this->delete('day'),
        );

        $this->SubjectModel->removeHours($data);

        $this->response($data, parent::HTTP_OK);
    }



    //////////////////////////////////////////////////////////////
    //                      AUTHENTICATION
    //////////////////////////////////////////////////////////////

    private function verify_request()
    {
        $headers = $this->input->request_headers();
        $token = $headers['Authorization'];
        // JWT library throws exception if the token is not valid
        try {
            // Successfull validation will return the decoded user data else returns false
            $data = AUTHORIZATION::validateToken($token);
            if ($data === false) {
                $status = parent::HTTP_UNAUTHORIZED;
                $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
                $this->response($response, $status);
                exit();
            } else {
                return $data;
            }
        } catch (Exception $e) {
            // Token is invalid
            // Send the unathorized access message
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }
}

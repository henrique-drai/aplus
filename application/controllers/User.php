<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    //user/api/função
    public function api_post($f) {
        switch ($f) {
            case "getInfo": $this->getUserInfo(); break; //user/api/getInfo
            case "teste": $this->testeLogin(); break; //user/api/teste
            case "updateInfo": $this->updateInfo(); break; //user/api/updateInfo
            case "getCalendario": $this->getCalendario(); break; //user/api/getCalendario

            default:            $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }




    public function getUserInfo() {
        $user_id = $this->post('user_id');

        $this->load->model('UserModel');
        
        $user = $this->UserModel->getUserById($user_id);
        $data = Array(
            "id" => $user_id,
            "email" => $user->email,
            "name" => $user->name,
            "surname" => $user->surname,
            "role" => $user->role,
            "picture" => $user->picture,
        );
        $this->response(json_encode($data), parent::HTTP_OK);
    }


    public function testeLogin() {

        $data = $this->verify_request();

        $this->response($data, parent::HTTP_OK);
    }

    
    public function updateInfo(){

        $data = Array(
            "id" => $this->verify_request()->id,
            "name" => $this->post('name'),
            "surname" => $this->post('surname'),
            "password" => $this->post('password'),
            "description" => $this->post('description'),
            "gabinete" => $this->post('gabinete'),
        );

        $this->load->model('UserModel');

        $this->UserModel->updateUser($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function getCalendario() {
        $user_id = $this->verify_request()->id;

        $this->load->model('UserModel');
        $this->load->model('EventModel');

        $user = $this->UserModel->getUserById($user_id);

        if ($user->role == "student")
            $classes = $this->EventModel->getClassesByStudentId($user_id);
        else if ($user->role == "teacher")
            $classes = $this->EventModel->getClassesByTeacherId($user_id);
        else {$this->response(Array(), parent::HTTP_NOT_FOUND); return null;}

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
        );

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

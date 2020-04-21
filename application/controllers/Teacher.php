<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Teacher extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    public function api_get($f) {
        switch ($f) {
            case "getCourseStudents":       $this->getCourseStudents(); break; //   /teacher/api/getCourseStudents

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //////////////////////////////////////////////////////////////
    //                         PROJECTS
    //////////////////////////////////////////////////////////////


    public function getCourseStudents() {
        $this->verify_request();

        $cadeira_id = $this->get('id');
        $this->load->model('StudentListModel');
        $data["users_id"] = $this->StudentListModel->getStudentsbyCadeiraID($cadeira_id);

        $data["info"] = array();
        for($i=0; $i < count($data["users_id"]); $i++) {
            array_push($data["info"], $this->StudentListModel->getStudentsInfo($data["users_id"][$i]["user_id"]));
        }

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

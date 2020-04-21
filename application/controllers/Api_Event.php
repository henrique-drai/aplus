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
      $this->load->helper(['jwt', 'authorization']);
    }

    public function event_delete($event_id) {
      $user_id = $this->verify_request()->id;

      $this->load->model('EventModel');

      if ($this->EventModel->userRelatedToEvent($user_id, $event_id)){
        $this->EventModel->delete($event_id);
      } 

      $this->response(array(), parent::HTTP_OK);
    }

    public function going_delete($event_id) {
      $user_id = $this->verify_request()->id;

      $this->load->model('EventModel');

      if ($this->EventModel->userRelatedToEvent($user_id, $event_id)){
        $this->EventModel->notGoing($user_id, $event_id);
      } 

      $this->response(array(), parent::HTTP_OK);
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

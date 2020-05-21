<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');

    }





    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    
    public function user_post(){
        $this->verify_request();
        $data = Array(
            "id" => $this->session->userdata('id'),
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

    public function registerUser_post(){
        $this->verify_request();
        $email = $this->post('email');

        $data = Array(
            "name"      => $this->post('name'),
            "surname"   => $this->post('surname'),
            "email"     => $this->post('email'),
            "password"  => md5($this->post('password')),
            "role"      => $this->post('role'),
        );

        $this->load->model('UserModel');
        $retrieved = $this->UserModel->registerUser($data);

        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }

    public function editUser_post(){
        $this->verify_request();
        $email = $this->post('oldemail');
        $data = Array(
            "name"      => $this->post('name'),
            "surname"   => $this->post('surname'),
            "email"     => $this->post('email'),
            "password"  => md5($this->post('password')),
        );
        $this->load->model('UserModel');
        $retrieved = $this->UserModel->editStudent($email, $data);

        $this->response(json_encode($retrieved), parent::HTTP_OK);
    }


    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function user_get() {
        $this->verify_request();
        $user_id = $this->session->userdata('id');

        $this->load->model('UserModel');
        
        $user = $this->UserModel->getUserById(intval($user_id));
        
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

    
    public function getSearchStudentTeachers_get(){
        $this->verify_request();
        $query = '';
        $this->load->model('UserModel');
        if($this->get("query")){
            $query = $this->get("query");
        }
        $resultquery = $this->UserModel->getSearchStudentTeachers($query);
        $data["users"] = "";
        if($resultquery -> num_rows() == 0){
            $data["users"] = "no data"; 
        }
        else{
            $data["users"] = $resultquery->result();
        }
        $this->response($data, parent::HTTP_OK);

    }
    

    //////////////////////////////////////////////////////////////
    //                           DELETE
    //////////////////////////////////////////////////////////////


    public function deleteUser_delete(){
        $this->verify_request();

        $auth = $this->session->userdata('id');

        $user = $this->UserModel->getUserById($auth->id);

        if($user->role != "admin"){
            $this->response(Array("msg"=>"No admin rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        $email = $this->delete('email');
        $this->load->model('UserModel');
        $this->UserModel->deleteUser($email);
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

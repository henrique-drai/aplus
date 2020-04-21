<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Admin extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
    }

    // // IMPORTAR USERS
    // public function importCSV(){
    //     $this->verify_request();
    //     $this->load->helper('url');
    //     $this -> load -> model('UserModel');
    //     $count_files = $_FILES["userfile"]['tmp_name'];
    //     $file  = fopen($count_files, 'r');

    //     // Skip first line
    //     fgetcsv($file, 0, ","); 
    //     while (($column = fgetcsv($file, 0, ",")) !== FALSE) {
    //         $data = Array(
    //             "name"      => $column[0],
    //             "surname"   => $column[1],
    //             "email"     => $column[2],
    //             "role"      => $column[3],
    //             "password"  => $column[4]
    //         );
    //         $this -> UserModel -> registerUser($data);        
    //     }
    //     header("Location: ". base_url()."app/admin/");
    // }

    // public function importX_post(){
    //     $role = $this->post('role');
    //     print_r($role);

    //     if($role=="users"){
    //         $this -> importCSV();
    //     }
    //     else{
    //         $this -> importStudentSubjects();
    //     }
    // }

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

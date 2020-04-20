<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Forum extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('ForumModel');
        $this->load->model("UserModel");
    }

    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function insertForum_post() {
        $this->verify_request();

        $data = Array (
            "cadeira_id"        => $this->post('cadeira_id'),
            "name"              => $this->post("name"),
            "description"       => $this->post("desc"),
            "teachers_only"     => $this->post("teachers_only"),
        );

        $data = $this->ForumModel->insertForum($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function insertThread_post() {
        $data = Array (
            "user_id"           => $this->verify_request()->id,
            "forum_id"          => $this->post("forum_id"),
            "title"             => $this->post("title"),
            "content"           => $this->post("content"),
            "date"              => $this->post("date"),
        );

        $this->ForumModel->insertThread($data);
    }

    public function insertPost_post() {
        $data = Array (
            "thread_id"          => $this->post("thread_id"),
            "user_id"            => $this->verify_request()->id,
            "content"            => $this->post("content"),
            "date"               => $this->post("date"),
        );

        $this->ForumModel->insertPost($data);
    }


    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getForumById_get($forum_id) {
        $user_id = $this->verify_request()->id;
        $data["info"] = $this->ForumModel->getForumByID($forum_id);
        $data["user"] = $this->UserModel->getUserById($user_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getThreadsByForumId_get($forum_id) {
        $this->verify_request();
        $data["threads"] = $this->ForumModel->getThreadsByForumId($forum_id);
        $data["criadores"] = array();
        for($i=0; $i < count($data["threads"]); $i++) {
            array_push($data["criadores"], $this->UserModel->getUserById($data["threads"][$i]["user_id"]));
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getForum_get() {
        $this->verify_request();
        $cadeira_id = $this->get("cadeira_id");
        $data = $this->ForumModel->getForumByCadeiraID($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getThreadById_get($thread_id) {
        $user_id = $this->verify_request()->id;
        $data["info"] = $this->ForumModel->getThreadByID($thread_id);
        $data["posts"] = $this->ForumModel->getThreadPosts($thread_id);
        $data["user"] = $this->UserModel->getUserById($user_id);

        $data["users"] = array();
        for($i=0; $i < count($data["posts"]); $i++) {
            array_push($data["users"], $this->UserModel->getUserById($data["posts"][$i]["user_id"]));
        }

        $this->response($data, parent::HTTP_OK);
    }

    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////

    public function removeForum_delete($forum_id) {
        $this->verify_request();
        $this->ForumModel->removeForum($forum_id);
    }

    public function removePost_delete($post_id) {
        $this->verify_request();
        $this->ForumModel->removePost($post_id);
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

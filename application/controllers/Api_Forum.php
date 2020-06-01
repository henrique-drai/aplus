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
        $this->verify_request();
        $this->load->model('ForumModel');
        $this->load->model("UserModel");
        $this->load->model('SubjectModel');
        $this->load->model("ProjectModel");
        $this->load->model("StudentListModel");
    }

    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function insertForum_post() {
        $user_id = $this->session->userdata('id');
        $data = Array (
            "cadeira_id"        => htmlspecialchars($this->post('cadeira_id')),
            "name"              => htmlspecialchars($this->post("name")),
            "description"       => htmlspecialchars($this->post("desc")),
            "teachers_only"     => htmlspecialchars($this->post("teachers_only")),
        );

        if($this->verify_teacher($user_id, $data["cadeira_id"], "cadeira")) {
            $data = $this->ForumModel->insertForum($data);

            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }

        
    }

    public function insertThread_post() {
        $cadeira_id = $this->post("cadeira_id");
        $role = $this->post("role");
        $data = Array (
            "user_id"           => $this->session->userdata('id'),
            "forum_id"          => htmlspecialchars($this->post("forum_id")),
            "title"             => htmlspecialchars($this->post("title")),
            "content"           => htmlspecialchars($this->post("content")),
            "date"              => htmlspecialchars($this->post("date")),
        );

        $flag = false;
        if($role == "teacher") {
            if($this->verify_teacher($data["user_id"], $cadeira_id, "cadeira")) {
                $flag = true;
            }
        } else if($role == "student") {
            if($this->verify_student($data["user_id"], $cadeira_id)) {
                $flag = true;
            }
        }
        
        if($flag) {
            $this->ForumModel->insertThread($data);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }        
    }

    public function insertPost_post() {
        $cadeira_id = $this->post("cadeira_id");
        $role = $this->post("role");
        $data = Array (
            "thread_id"          => htmlspecialchars($this->post("thread_id")),
            "user_id"            => $this->session->userdata('id'),
            "content"            => htmlspecialchars($this->post("content")),
            "date"               => htmlspecialchars($this->post("date")),
        );

        $flag = false;
        if($role == "teacher") {
            if($this->verify_teacher($data["user_id"], $cadeira_id, "cadeira")) {
                $flag = true;
            }
        } else if($role == "student") {
            if($this->verify_student($data["user_id"], $cadeira_id)) {
                $flag = true;
            }
        }

        if($flag) {
            $this->ForumModel->insertPost($data);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }        
    }


    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getForumById_get($forum_id) {
        $user_id = $this->session->userdata('id');
        $cadeira_id = htmlspecialchars($this->get("cadeira_id"));
        $role = htmlspecialchars($this->get("role"));

        $flag = false;
        if($role == "teacher") {
            if($this->verify_teacher($user_id, $cadeira_id, "cadeira")) {
                $flag = true;
            }
        } else if($role == "student") {
            if($this->verify_student($user_id, $cadeira_id)) {
                $flag = true;
            }
        }

        if($flag) {
            $data["info"] = $this->ForumModel->getForumByID(htmlspecialchars($forum_id));
            $data["user"] = $this->UserModel->getUserById(htmlspecialchars($user_id));
    
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!', 'user_id' => $user_id];
            $this->response($response, $status);
        }        
    }

    public function getThreadsByForumId_get($forum_id) {
        $data["threads"] = $this->ForumModel->getThreadsByForumId(htmlspecialchars($forum_id));
        $data["criadores"] = array();
        for($i=0; $i < count($data["threads"]); $i++) {
            array_push($data["criadores"], $this->UserModel->getUserById($data["threads"][$i]["user_id"]));
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getForum_get() {
        $cadeira_id = htmlspecialchars($this->get("cadeira_id"));
        $data = $this->ForumModel->getForumByCadeiraID($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getThreadById_get($thread_id) {
        $user_id = $this->session->userdata('id');
        $data["info"] = $this->ForumModel->getThreadByID(htmlspecialchars($thread_id));
        $data["posts"] = $this->ForumModel->getThreadPosts(htmlspecialchars($thread_id));
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
        $user_id = htmlspecialchars($this->delete("user_id"));
        $cadeira_id = htmlspecialchars($this->delete("cadeira_id"));

        if($user_id != $this->session->userdata('id')) {
            $this->response(array(), parent::HTTP_NOT_FOUND); return null;
        }

        if($this->verify_teacher($user_id, $cadeira_id, "cadeira")) {
            $this->ForumModel->removeForum(htmlspecialchars($forum_id));
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!', 'user_id' => $user_id];
            $this->response($response, $status);
        }        
    }

    public function removePost_delete($post_id) { 
        $user_id = htmlspecialchars($this->delete("user_id"));
        $cadeira_id = htmlspecialchars($this->delete("cadeira_id"));
        $role = htmlspecialchars($this->delete("role"));

        $flag = false;
        if($role == "teacher") {
            if($this->verify_teacher($user_id, $cadeira_id, "cadeira")) {
                $flag = true;
            }
        } else if($role == "student") {
            if($this->verify_student($user_id, $cadeira_id)) {
                $flag = true;
            }
        }

        if($flag) {
            $this->ForumModel->removePost(htmlspecialchars($post_id));
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!', 'user_id' => $user_id];
            $this->response($response, $status);
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

    private function verify_teacher($user_id, $variable, $mode){

        if ($mode == "projeto"){
            $projeto = $this->ProjectModel->getProjectByID($variable);
            $cadeiras = $this->SubjectModel->getCadeiras($user_id, "teacher");
            $flag_found = false;

            for($i=0; $i < count($cadeiras); $i++) {
                if($projeto[0]["cadeira_id"] == $cadeiras[$i]["cadeira_id"]){
                    $flag_found = true;
                }
            }

            return $flag_found;

        } elseif ($mode == "etapa") {
            $etapa = $this->ProjectModel->getEtapaByID($variable)->result_array();
            $projeto = $this->ProjectModel->getProjectByID($etapa[0]["projeto_id"]);
            $cadeiras = $this->SubjectModel->getCadeiras($user_id, "teacher");
            $flag_found = false;

            for($i=0; $i < count($cadeiras); $i++) {
                if($projeto[0]["cadeira_id"] == $cadeiras[$i]["cadeira_id"]){
                    $flag_found = true;
                }
            }

            return $flag_found;

        } elseif ($mode == "cadeira"){
            $cadeiras = $this->SubjectModel->getCadeiras($user_id, "teacher");
            $flag_found = false;

            for($i=0; $i < count($cadeiras); $i++) {
                if($variable == $cadeiras[$i]["cadeira_id"]){
                    $flag_found = true;
                }
            }

            return $flag_found;
    
        } else {
            return false;
        }
    }

    private function verify_student($user_id, $cadeira_id){
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

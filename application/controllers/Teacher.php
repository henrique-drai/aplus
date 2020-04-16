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

    //teacher/api/função
    public function api_post($f) {
        switch ($f) {
            case "insertText":              $this->insertText(); break;//           /teacher/api/insertText
            case "createProject":           $this->createProject(); break;//        /teacher/api/createProject
            case "saveHours":               $this->saveHours(); break;//            /teacher/api/saveHours 
            case "createEtapa":             $this->createEtapa(); break;//          /teacher/api/createEtapa
            case "editEtapa":               $this->editEtapa(); break;//            /teacher/api/editEtapa
            case "editEnunciado":           $this->editEnunciado(); break;//        /teacher/api/editEnunciado
            case "insertForum":             $this->insertForum(); break;//          /teacher/api/insertForum
            case "insertFeedback":          $this->insertFeedback(); break;//       /teacher/api/insertFeedback
            case "insertThread":            $this->insertThread(); break;//         /teacher/api/insertThread
            case "insertPost":              $this->insertPost(); break;//           /teacher/api/insertPost
            case "editEtapaEnunciado":      $this->editEtapaEnunciado(); break;//   /teacher/api/editEtapaEnunciado

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_get($f) {
        switch ($f) {
            case "getCourseStudents":       $this->getCourseStudents(); break; //   /teacher/api/getCourseStudents
            case "getProfHome":             $this->getProfHome(); break; //         /teacher/api/getProfHome
            case "getForumInfo":            $this->getForumInfo(); break;//         /teacher/api/getForumInfo
            case "getThreads":              $this->getThreads(); break;//           /teacher/api/getThreads
            case "getForum":                $this->getForum(); break;//             /teacher/api/getForum
            case "getThreadInfo":           $this->getThreadInfo(); break;//        /teacher/api/getThreadInfo
            case "getDescription":          $this->getDescription(); break;//       /teacher/api/getDescription
            case "getHours":                $this->getHours(); break;//             /teacher/api/getHours
            case "getProj":                 $this->getProj(); break;//              /teacher/api/getProj
            case "getCadeiras":             $this->getCadeiras(); break;//          /teacher/api/getCadeiras
            case "getSub":                  $this->getSub(); break;//               /teacher/api/getSub
            case "getAllEtapas":            $this->getAllEtapas(); break; //        /teacher/api/getAllEtapas
            case "getAllGroups":            $this->getAllGroups(); break; //        /teacher/api/getAllGroups

            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    public function api_delete($f) {
        switch ($f) {
            case "removePost":              $this->removePost(); break; //          /teacher/api/removePost
            case "removeHours":             $this->removeHours(); break;//          /teacher/api/removeHours
            case "removeProject":           $this->removeProject(); break; //       /teacher/api/removeProject
            case "removeEtapa":             $this->removeEtapa(); break;//          /teacher/api/removeEtapa
            case "removeEnunciadoEtapa":    $this->removeEnunciadoEtapa(); break;// /teacher/api/removeEnunciadoEtapa
            case "removeEnunciadoProj":     $this->removeEnunciadoProj(); break;//  /teacher/api/removeEnunciadoEtapa
            case "removeForum":             $this->removeForum(); break;//          /teacher/api/removeForum
            
            default:                        $this->response("Invalid API call.", parent::HTTP_NOT_FOUND);
        }
    }

    //////////////////////////////////////////////////////////////
    //                         SUBJECT
    //////////////////////////////////////////////////////////////
    public function getCadeiras() {
        $user_id = $this->get('id');
        $this->load->model('SubjectModel');
        $this->load->model('CourseModel');
        $this->load->model('YearModel');
        $data["cadeiras_id"] = $this->SubjectModel->getCadeiras($user_id, "teacher");

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

    public function getDescription() {
        $cadeira_id = $this->get('cadeira_id');
        $this->load->model('SubjectModel');
        $data["info"] = $this->SubjectModel->getDescription($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getHours() {
        $cadeira_id = $this->get('cadeira_id');
        $this->load->model('SubjectModel');
        $data["hours"] = $this->SubjectModel->getHours($cadeira_id);

        $this->load->model('UserModel');
        $data['user'] = array();
        for ($i=0; $i < count($data["hours"]); $i++) {
            array_push($data["user"], $this->UserModel->getUserById($data["hours"][$i]['id_prof']));
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function insertText() {
        $data = Array(
            "id"    => $this->post("cadeira_id"),
            "text"  => $this->post("text"),
        );
        $this->load->model('SubjectModel');
        $this->SubjectModel->insertText($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function saveHours() {
        $data = Array (
            'id_prof'             => $this->post('user_id'),
            'id_cadeira'          => $this->post('cadeira_id'),
            'start_time'          => $this->post('start_time'),
            'end_time'            => $this->post('end_time'),
            'day'                 => $this->post('day'),
        );

        $this->load->model('SubjectModel');
        $this->SubjectModel->saveHours($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function removeHours() {
        $data = Array (
            'id_prof'             => $this->delete('user_id'),
            'id_cadeira'          => $this->delete('cadeira_id'),
            'start_time'          => $this->delete('start_time'),
            'end_time'            => $this->delete('end_time'),
            'day'                 => $this->delete('day'),
        );

        $this->load->model('SubjectModel');
        $this->SubjectModel->removeHours($data);

        $this->response($data, parent::HTTP_OK);
    }



    //////////////////////////////////////////////////////////////
    //                         PROJECTS
    //////////////////////////////////////////////////////////////

    public function getProj() {
        $cadeira_id = $this->get('cadeira_id');
        $this->load->model('SubjectModel');
        $data = $this->SubjectModel->getProj($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }


    public function removeProject() {
        $proj_id = $this->delete('projid');
        $this->load->model('ProjectModel');
        $data = $this->ProjectModel->removeProjectByID($proj_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function createProject(){
        $dataProj = Array(
            "cadeira_id"          => $this->post("cadeira_id"),
            "nome"                => $this->post("projName"),
            "min_elementos"       => $this->post("groups_min"),
            "max_elementos"       => $this->post("groups_max"),
            "description"         => $this->post("projDescription"),
            "enunciado_url"       => $this->post("file"),
        );
        
        $dataEtapa = $this->post("listetapas");


        $this->load->model('ProjectModel');
        $proj_id = $this->ProjectModel->insertProject($dataProj);

        $this->load->model('ProjectModel');

        for($i=0; $i < count($dataEtapa); $i++) {

            $newEtapa = Array (
                "projeto_id"        => $proj_id,
                "nome"              => $dataEtapa[$i]["nome"],
                "description"       => $dataEtapa[$i]["desc"],
                "enunciado_url"     => $dataEtapa[$i]["enunciado"],
                "deadline"          => $dataEtapa[$i]["data"],
            );

            $this->ProjectModel->insertEtapa($newEtapa);
        }


        $this->response($proj_id, parent::HTTP_OK);
    }

    public function getAllEtapas(){
        $proj_id = $this->get('projid');
        $this->load->model('ProjectModel');
        $data = $this->ProjectModel->getEtapasByProjectID($proj_id);

        $this->response($data, parent::HTTP_OK);
    }


    public function removeEtapa(){
        $id = $this->delete('etapa_id');
        $this->load->model('ProjectModel');
        $data = $this->ProjectModel->removeEtapaByID($id);

        $this->response($data, parent::HTTP_OK);
    }


    public function createEtapa(){

        $etapa = $this->post('new_etapa');
        $this->load->model('ProjectModel');

        $new_etapa = Array (
            "projeto_id"        => $this->post('projid'),
            "nome"              => $etapa["nome"],
            "description"       => $etapa["desc"],
            "enunciado_url"     => $etapa["enunciado"],
            "deadline"          => $etapa["data"],
        );

        $data = $this->ProjectModel->insertEtapa($new_etapa);

        $this->response($data, parent::HTTP_OK);
    }

    public function editEtapa(){

        $etapa = $this->post('edited_etapa');
        $this->load->model('ProjectModel');

        $id = $this->post('id');

        $enunciado = '';

        if(empty($etapa["enunciado"])){
            $this_etapa = $this->ProjectModel->getEtapaByID($id);
            $enunciado = $this_etapa->row()->enunciado_url;
            
        } else {
            $enunciado = $etapa["enunciado"];
        }

        $new_etapa = Array (
            "projeto_id"        => $this->post('projid'),
            "nome"              => $etapa["nome"],
            "description"       => $etapa["desc"],
            "enunciado_url"     => $enunciado,
            "deadline"          => $etapa["data"],
        );

        $this->ProjectModel->updateEtapa($new_etapa, $id);

        $this->response($etapa, parent::HTTP_OK);
    }


    public function removeEnunciadoEtapa(){
        $this->load->model('ProjectModel');
        $id = $this->delete('id');
        $proj = $this->delete('projid');

        unlink("uploads/enunciados_files/" . $proj . "/" . $id . ".pdf");

        $this->ProjectModel->clearEnuncEtapa($id);

        $this->response($id, parent::HTTP_OK);
    }


    public function editEnunciado(){
        $proj = $this->post('projid');
        $this->load->model('ProjectModel');

        $enunciado = $this->post('enunciado');

        $this->ProjectModel->updateProjEnunciado($enunciado, $proj);

        $this->response($enunciado, parent::HTTP_OK);
    }

    public function getCourseStudents() {
        $cadeira_id = $this->get('id');
        $this->load->model('StudentListModel');
        $data["users_id"] = $this->StudentListModel->getStudentsbyCadeiraID($cadeira_id);

        $data["info"] = array();
        for($i=0; $i < count($data["users_id"]); $i++) {
            array_push($data["info"], $this->StudentListModel->getStudentsInfo($data["users_id"][$i]["user_id"]));
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getAllGroups() {
        $proj_id = $this->get("proj_id");
        $this->load->model("GroupModel");
        $data["grupos"] = $this->GroupModel->getAllGroups($proj_id);

        $data["students"] = array();
        for($i=0; $i  < count($data["grupos"]); $i++) {
            array_push($data["students"], $this->GroupModel->getStudents($data["grupos"][$i]["id"]));
        }

        $this->load->model("UserModel");
        $data["nomes"] = array();
        for($i=0; $i  < count($data["students"][0]); $i++) {
            array_push($data["nomes"], array(
                'grupo_id'      =>      $data["students"][0][$i]["grupo_id"], 
                'user_name'     =>      $this->UserModel->getUserById($data["students"][0][$i]["user_id"]))
            );
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getProfHome() {
        $user_id = $this->get("user_id");
        $this->load->model("SubjectModel");
        $data["ids"] = $this->SubjectModel->getCadeiras($user_id, "teacher");

        if(count($data["ids"]) > 0) {
            $data["info"] = array();
            for($i = 0; $i < count($data["ids"]); $i++) {
                array_push($data["info"], $this->SubjectModel->getCadeiraInfo($data["ids"][$i]["cadeira_id"]));
            };

            if(count($data["info"]) > 0) {
                $data["year"] = array();
                $this->load->model('CourseModel');
                $this->load->model('YearModel');

                for($i = 0; $i < count($data["info"]); $i++) {
                    $tmp = $this->CourseModel->getCursobyId($data["info"][0][0]["curso_id"]);
                    array_push($data["year"], $this->YearModel->getYearById($tmp->ano_letivo_id));
                };
            }
    
            $data["alunos"] = array();
            $this->load->model("StudentListModel");
            for($i = 0; $i < count($data["ids"]); $i++) {
                array_push($data["alunos"], $this->StudentListModel->getStudentsbyCadeiraID($data["ids"][$i]["cadeira_id"]));
            }
        }
        
        $this->response($data, parent::HTTP_OK);
    }

    public function getSub(){
        $grupo_id = $this->get('grupo_id');
        $etapa_id = $this->get('etapa_id');

        $this->load->model('ProjectModel');

        $url = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);

        $this->response($url->result_array(), parent::HTTP_OK);
    }

    public function insertFeedback(){
        $grupo_id = $this->post('grupo_id');
        $etapa_id = $this->post('etapa_id');
        $feedback = $this->post('feedback');

        $this->load->model('ProjectModel');

        $etapa_submit = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);

        $data = $this->ProjectModel->insertFeedback($feedback, $etapa_submit->row()->id);

        $this->response($etapa_submit, parent::HTTP_OK);
    }

    public function editEtapaEnunciado(){
        $etapa = $this->post('etapaid');
        $enunc = $this->post('enunciado');

        $this->load->model('ProjectModel');

        $this->ProjectModel->editEtapaEnunciado($enunc, $etapa);

        $this->response($enunc, parent::HTTP_OK);
    }


    public function removeEnunciadoProj(){
        $proj = $this->delete('projid');
        $this->load->model('ProjectModel');
        $this->ProjectModel->removeEnunciadoProj($proj);

        unlink("uploads/enunciados_files/" . $proj . ".pdf");

        $this->response($proj, parent::HTTP_OK);
    }

    //////////////////////////////////////////////////////////////
    //                         FORUM
    //////////////////////////////////////////////////////////////

    public function insertForum() {
        $data = Array (
            "cadeira_id"        => $this->post('cadeira_id'),
            "name"              => $this->post("name"),
            "description"       => $this->post("desc"),
            "teachers_only"     => $this->post("teachers_only"),
        );

        $this->load->model("ForumModel");
        $data = $this->ForumModel->insertForum($data);

        $this->response($data, parent::HTTP_OK);
    }

    public function getForumInfo() {
        $forum_id = $this->get("forum_id");
        $this->load->model("ForumModel");
        $data["info"] = $this->ForumModel->getForumByID($forum_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function getThreads() {
        $forum_id = $this->get("forum_id");
        $this->load->model("ForumModel");
        $data["threads"] = $this->ForumModel->getThreads($forum_id);

        $this->load->model("UserModel");
        $data["criadores"] = array();
        for($i=0; $i < count($data["threads"]); $i++) {
            array_push($data["criadores"], $this->UserModel->getUserById($data["threads"][$i]["user_id"]));
        }
        
        
        $this->response($data, parent::HTTP_OK);
    }

    public function insertThread() {
        $data = Array (
            "user_id"           => $this->post("user_id"),
            "forum_id"          => $this->post("forum_id"),
            "title"             => $this->post("title"),
            "content"           => $this->post("content"),
            "date"              => $this->post("date"),
        );

        $this->load->model("ForumModel");
        $this->ForumModel->insertThread($data);
    }

    public function getForum() {
        $cadeira_id = $this->get("cadeira_id");
        $this->load->model("ForumModel");
        $data = $this->ForumModel->getForumByCadeiraID($cadeira_id);

        $this->response($data, parent::HTTP_OK);
    }

    public function removeForum() {
        $forum_id = $this->delete("forum_id");
        $this->load->model("ForumModel");
        $this->ForumModel->removeForum($forum_id);
    }

    //////////////////////////////////////////////////////////////
    //                         THREAD
    //////////////////////////////////////////////////////////////

    public function getThreadInfo() {
        $thread_id = $this->get("thread_id");
        $this->load->model("ForumModel");
        $data["info"] = $this->ForumModel->getThreadByID($thread_id);

        $data["posts"] = $this->ForumModel->getThreadPosts($thread_id);

        $this->load->model("UserModel");
        $data["users"] = array();
        for($i=0; $i < count($data["posts"]); $i++) {
            array_push($data["users"], $this->UserModel->getUserById($data["posts"][$i]["user_id"]));
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function insertPost() {
        $data = Array (
            "thread_id"          => $this->post("thread_id"),
            "user_id"            => $this->post("user_id"),
            "content"            => $this->post("content"),
            "date"               => $this->post("date"),
        );

        $this->load->model("ForumModel");
        $this->ForumModel->insertPost($data);
    }

    public function removePost() {
        $post_id = $this->delete("post_id");
        $this->load->model("ForumModel");
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

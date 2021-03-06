<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'third_party/REST_Controller.php';
require APPPATH . 'third_party/Format.php';

use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


class Api_Project extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->verify_request();
        $this->load->model("SubjectModel");
        $this->load->model('ProjectModel');
        $this->load->model('GroupModel');
        $this->load->model('EventModel');
        $this->load->model("UserModel");
        $this->load->model("StudentListModel");
        $this->load->model("TasksModel");
    }



    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function createProject_post(){ 
        $user_id = $this->session->userdata('id');
        $this->load->model('NotificationModel');
        //Verificar se o id do professor guardado no token está associado à cadeira
        //tabela que liga cadeira a user

        $cadeira_id = htmlspecialchars($this->post("cadeira_id"));
        if ($this->verify_teacher($user_id,$cadeira_id,"cadeira") == true){

            $name_proj = htmlspecialchars($this->post("projName"));
            $nameExists = $this->ProjectModel->getProjectByCadeiraIdName($cadeira_id, $name_proj);

            if($nameExists){
                $data["nameExists"] = true;
                $this->response($data, parent::HTTP_CONFLICT);
            }

            $data["nameExists"] = false;

            $dataProj = Array(
                "cadeira_id"          => $cadeira_id,
                "nome"                => $name_proj,
                "min_elementos"       => htmlspecialchars($this->post("groups_min")),
                "max_elementos"       => htmlspecialchars($this->post("groups_max")),
                "description"         => htmlspecialchars($this->post("projDescription")),
                "enunciado_url"       => htmlspecialchars($this->post("file")),
                "enunciado_original"  => "",
            );
            
            $dataEtapa = $this->post("listetapas");

            $proj_id = $this->ProjectModel->insertProject($dataProj);    
            for($i=0; $i < count($dataEtapa); $i++) {
    
                $newEtapa = Array (
                    "projeto_id"        => $proj_id,
                    "nome"              => htmlspecialchars($dataEtapa[$i]["nome"]),
                    "description"       => htmlspecialchars($dataEtapa[$i]["desc"]),
                    "enunciado_url"     => htmlspecialchars($dataEtapa[$i]["enunciado"]),
                    "enunciado_original"=> "",
                    "deadline"          => htmlspecialchars($dataEtapa[$i]["data"]),
                );
    
                $this->ProjectModel->insertEtapa($newEtapa);
            }

            //alunos da cadeira
            $students =  $this->SubjectModel->getAllStudentSubject($cadeira_id);
            $cadeira_name =  $this->SubjectModel->getCadeiraInfo($cadeira_id)[0]["name"];

            $notifications = array(); //escrever notificações
            $curr_date = date('Y/m/d H:i:s', time());
    
            foreach ($students as $key => $value) {
                if($user_id != intval($value["user_id"])){
                  array_push($notifications, Array(
                    "user_id" => intval($value["user_id"]),
                    "type" => "alert",
                    "title" => "Novo projeto da cadeira '".$cadeira_name."' criado",
                    "content" => "Clica para saberes mais",
                    "link" => "projects/project/" . $proj_id,
                    "seen" => FALSE,
                    "date" => $curr_date
                  ));
                }
            }

            $this->NotificationModel->createMultiple($notifications); //enviar notificações para todos os alunos
    
            $this->response($proj_id, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function createEtapa_post(){ 
        $user_id = $this->session->userdata('id');

        //Verificar se o id do professor guardado no token está associado à cadeira atraves da etapa - verify teacher
        
        $etapa = $this->post('new_etapa');


        if ($this->verify_teacher($user_id,$this->post('projid'),"projeto") == true){
            $new_etapa = Array (
                "projeto_id"        => htmlspecialchars($this->post('projid')),
                "nome"              => htmlspecialchars($etapa["nome"]),
                "description"       => htmlspecialchars($etapa["desc"]),
                "enunciado_url"     => htmlspecialchars($etapa["enunciado"]),
                "enunciado_original"=> "",
                "deadline"          => htmlspecialchars($etapa["data"]),
            );
    
            $data = $this->ProjectModel->insertEtapa($new_etapa);

            if ($data){
                $arr_msg = array (
                    "msg" => "Etapa criada com sucesso",
                    "type" => "S",
                );
            } else {
                $arr_msg = array (
                    "msg" => "Erro ao submeter a etapa",
                    "type" => "E",
                );
            }

            $this->session->set_userdata('result_msg', $arr_msg);            
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    
    public function insertFeedback_post(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        $grupo_id = htmlspecialchars($this->post('grupo_id'));
        $etapa_id = htmlspecialchars($this->post('etapa_id'));
        $feedback = htmlspecialchars($this->post('feedback'));
       
        if($this->verify_teacher($user_id, $etapa_id, "etapa") == true){
            $etapa_submit = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);
            $data = $this->ProjectModel->insertFeedback($feedback, $etapa_submit->row()->id);

            //alunos do grupo
            $this->load->model('NotificationModel');
            $students = $this->GroupModel->getStudents($grupo_id);

            $etapa = $this->ProjectModel->getEtapaByID($etapa_id)->result_array();

            $etapa_name = $etapa[0]["nome"];
            $proj = $this->ProjectModel->getProjectByID($etapa[0]["projeto_id"]);

            $proj_name = $proj[0]["nome"];
            $proj_id = $proj[0]["id"];

            $notifications = array(); //escrever notificações
            $curr_date = date('Y/m/d H:i:s', time());
    
            foreach ($students as $key => $value) {
                if($user_id != intval($value["user_id"])){
                    array_push($notifications, Array(
                    "user_id" => intval($value["user_id"]),
                    "type" => "alert",
                    "title" => "Feedback atribuido à etapa '".$etapa_name."' do projeto '".$proj_name."'",
                    "content" => "Clica para saberes mais",
                    "link" => "projects/project/" . $proj_id,
                    "seen" => FALSE,
                    "date" => $curr_date
                    ));
                }
            }

            $this->NotificationModel->createMultiple($notifications); //enviar notificações para todos os alunos

            if ($data){
                $arr_msg = array (
                    "msg" => "Feedback submetido com sucesso",
                    "type" => "S",
                );
            } else {
                $arr_msg = array (
                    "msg" => "Erro ao submeter o feedback",
                    "type" => "E",
                );
            }

            $this->session->set_userdata('result_msg', $arr_msg);
            $this->response($etapa_submit, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function editEtapa_post(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        if ($this->verify_teacher($user_id, htmlspecialchars($this->post('projid')), "projeto") == true){
            $etapa = $this->post('edited_etapa');
            $id = htmlspecialchars($this->post('id'));
    
            $enunciado = '';
    
            if(empty($etapa["enunciado"])){
                $this_etapa = $this->ProjectModel->getEtapaByID($id);
                $enunciado = $this_etapa->row()->enunciado_url;
                
            } else {
                $enunciado = $etapa["enunciado"];
            }
    
            $new_etapa = Array (
                "projeto_id"        => htmlspecialchars($this->post('projid')),
                "nome"              => htmlspecialchars($etapa["nome"]),
                "description"       => htmlspecialchars($etapa["desc"]),
                "enunciado_url"     => htmlspecialchars($enunciado),
                "deadline"          => htmlspecialchars($etapa["data"]),
            );
    
            $data = $this->ProjectModel->updateEtapa($new_etapa, $id);

            if ($data){
                $arr_msg = array (
                    "msg" => "Etapa editada com sucesso",
                    "type" => "S",
                );
            } else {
                $arr_msg = array (
                    "msg" => "Erro ao editar a etapa",
                    "type" => "E",
                );
            }

            $this->session->set_userdata('result_msg', $arr_msg);
            $this->response($etapa, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function insertTask_post() { 
        $user_id = htmlspecialchars($this->post("user_id"));
        $grupo_id = htmlspecialchars($this->post("grupo_id"));

        if($this->verify_student($user_id, $grupo_id)==true){
            $data_send = Array (
                "grupo_id"          => $grupo_id,
                "name"              => htmlspecialchars($this->post("name")),
                "description"       => htmlspecialchars($this->post("description")),
            );

            $this->load->model("TasksModel");
            $data = $this->TasksModel->insertTask($data_send);

            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function criarGrupo_post(){
        $user_id = $this->session->userdata('id');
        $cadeiraid = htmlspecialchars($this->post("cadeiraid"));
        $projectid = htmlspecialchars($this->post("projid"));
        $nomeGrupo = htmlspecialchars($this->post("nomeGrupo"));

        if($this->verify_studentInCadeira($user_id, $cadeiraid)==true){
            $this->load->model("GroupModel");
            $grupoExists = $this->GroupModel->confirmNameInProject($projectid, $nomeGrupo);
            if($grupoExists){
                $data["groupExist"] = True;
                $this->response($data, parent::HTTP_OK);
            }
            else{
                $datagrupo = Array(
                    "name" => $nomeGrupo,
                    "projeto_id" => $projectid,
                );

                $retrieved = $this->GroupModel->createGroup($datagrupo);

                $datagrupoaluno = Array(
                    "grupo_id" => $retrieved["grupo"],
                    "user_id" => $user_id,
                );

                $addeduser = $this->GroupModel->addElementGroup($datagrupoaluno);
                $this->response(json_encode($retrieved), parent::HTTP_OK);
            }
                
        }
        else{
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }

        
    }

    public function entrarGrupo_post(){
        $user_id = $this->session->userdata('id');
        $proj_id = htmlspecialchars($this->post("projid"));
        $grupoid = htmlspecialchars($this->post("grupoid"));
        $cadeiraid = htmlspecialchars($this->post("cadeiraid"));

        if($this->verify_studentInCadeira($user_id, $cadeiraid)==true){
            $datagrupo = Array(
                "grupo_id" => $grupoid,
                "user_id" => $user_id,
            );
    
            $this->load->model("ProjectModel");
            $this->load->model("GroupModel");
    
            $maxelementos = $this->ProjectModel->getMaxElementsGroup($proj_id);
            $numElegroup = $this->GroupModel->countElements($grupoid);
            if($numElegroup < $maxelementos[0]["max_elementos"]){
                $data["grupo_aluno"] = $this->GroupModel->addElementGroup($datagrupo);
            }
            else{
                $data["grupo_aluno"] = "";
            }
            $this->response($data, parent::HTTP_OK);
        }
        else{
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function submitRating_post(){
        
        $myUser = htmlspecialchars($this->post('meuUser'));
        $group_id = htmlspecialchars($this->post('grupoId'));


        if($this->verify_student($myUser, $group_id)){

            $data = Array(
                "classificador_id"      => $myUser,
                "classificado_id"     => htmlspecialchars($this->post('himUser')),
                "grupo_id"              => $group_id,
                "valor"              => htmlspecialchars($this->post('rating'))
            );
           
            $this->GroupModel->insertClassification($data); 

        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }

      
    }

    public function insertTaskStartDate_post($task_id) {
        $user_id = htmlspecialchars($this->post("user_id"));
        $group_id = htmlspecialchars($this->post("grupo_id"));

        if($this->verify_student($user_id, $group_id)) {
            date_default_timezone_set("Europe/Lisbon");
            $data["data"] = date("Y-m-d h:i:s");
            $tmp = $this->UserModel->getUserById($user_id);
            $data["user"] = $tmp->name . " " . $tmp->surname;
            $this->TasksModel->insertTaskDate($data["data"], $user_id, htmlspecialchars($task_id), "start");
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
            $this->response($response, $status);
        } 
    }

    public function insertTaskEndDate_post($task_id) {
        $user_id = htmlspecialchars($this->post("user_id"));
        $group_id = htmlspecialchars($this->post("grupo_id"));

        if($this->verify_student($user_id, $group_id)) {
            date_default_timezone_set("Europe/Lisbon");
            $data = date("Y-m-d h:i:s");
            $this->TasksModel->insertTaskDate($data, $user_id, htmlspecialchars($task_id), "end");
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
            $this->response($response, $status);
        } 
    }


    //DESCOMENTAR SE DER MERDA
    // public function editTask_post(){ 
        
    //     $task = htmlspecialchars($this->post('task'));
    //     $id = htmlspecialchars($this->post('id'));
         
    //     $new_task = Array (
    //         "grupo_id"          => htmlspecialchars($this->post('grupoid')),
    //         "user_id"           => htmlspecialchars($this->post('userid')),
    //         "name"              => htmlspecialchars($this->post('name')),
    //         "description"       => htmlspecialchars($this->post('description')),
    //         "start_date"        => htmlspecialchars($this->post('start')),
    //         "done_date"         => htmlspecialchars($this->post('done')),
    //     );
    
    //     $this->TasksModel->updateTask($new_task, $id);
    //     $this->response($etapa, parent::HTTP_OK);
    // }

    public function updateTaskById_post($task_id) {
        $user_id = $this->session->userdata('id');
        $grupo_id = htmlspecialchars($this->post("grupo_id"));

        if($this->verify_student($user_id, $grupo_id)) {
            $name = htmlspecialchars($this->post('name'));
            $description = htmlspecialchars($this->post("description"));

            $this->TasksModel->updateTaskById(htmlspecialchars($task_id), $name, $description);
            $this->response($etapa, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
            $this->response($response, $status);
        } 
    }

    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    
    public function getStudentsFromGroup_get(){
         
        $grupo_id =  htmlspecialchars($this->get('id'));
        $classificador = htmlspecialchars($this->get('classificador'));

        $projId =  $this->GroupModel->getProjectId($grupo_id);

        $data['proj_name'] = $this->ProjectModel->getProjectByID($projId[0]['projeto_id']);

        $data['students'] = $this->GroupModel->getStudents($grupo_id);
        $data["notClass"] = array();
        $data["class"] = array();
        $data["rate"] = array();

        for ($i=0; $i < count($data["students"]); $i++) {
            $userId = $data["students"][$i]['user_id'];
            
            if($userId != $classificador){
                $nota = $this->GroupModel->getClassVal($grupo_id, $classificador, $userId); 

                if(isset($nota)) {  
                    array_push($data["class"], $this->UserModel->getUserById($userId));
                    array_push($data["rate"], $nota->valor);
                }
                else{
                    array_push($data["notClass"], $this->UserModel->getUserById($userId));
                }
            }
        }
        $this->response($data, parent::HTTP_OK);
    }

    public function getProjectStatus_get(){ 
        $grupo_id =  htmlspecialchars($this->get('grupo_id'));
        $projeto_id = $this->GroupModel->getProjectId($grupo_id)[0]["projeto_id"];
        $data["date"] = $this->ProjectModel->getLastEtapa($projeto_id)[0]["deadline"];

        $this->response($data, parent::HTTP_OK);
        
        
    }

    public function getSub_get(){ 
        $user_id = $this->session->userdata('id');
        $grupo_id = htmlspecialchars($this->get('grupo_id'));
        $etapa_id = htmlspecialchars($this->get('etapa_id'));
        
        if($this->verify_student($user_id, $grupo_id) || $this->verify_teacher($user_id, $etapa_id, "etapa")){
            $result = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);
            $this->response($result->result_array(), parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }

    }


    public function getAllEtapas_get(){ 
        $user_id = $this->session->userdata('id');
        $proj_id = htmlspecialchars($this->get('projid'));

        $projeto = $this->ProjectModel->getProjectByID($proj_id);
        $cadeira_id = $projeto[0]["cadeira_id"];

        if($this->verify_studentInCadeira($user_id, $cadeira_id) || $this->verify_teacher($user_id, $proj_id, "projeto")){
            $data["etapas"] = $this->ProjectModel->getEtapasByProjectID($proj_id);
            $data["data_final"] = $this->ProjectModel->getLastEtapa($proj_id)[0]["deadline"];
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }


    public function getAllGroups_get(){ 
        $user_id = $this->session->userdata('id');
        $proj_id = htmlspecialchars($this->get("proj_id"));
        
        
        if($this->verify_teacher($user_id, $proj_id, "projeto")){
            $data["grupos"] = $this->GroupModel->getAllGroups($proj_id);

            $data["students"] = array();
            for($i=0; $i  < count($data["grupos"]); $i++) {
                array_push($data["students"], $this->GroupModel->getStudents($data["grupos"][$i]["id"]));
            }
    
            $this->load->model("UserModel");
            $data["nomes"] = array();
            for($i=0; $i  < count($data["students"]); $i++) {
                for($j=0; $j < count($data["students"][$i]); $j++){
                    $query = $this->UserModel->getUserById($data["students"][$i][$j]["user_id"]);
                    array_push($data["nomes"], array(
                        'grupo_id'      =>      $data["students"][$i][$j]["grupo_id"], 
                        'user_name'     =>      array($query->name, $query->surname, $data["students"][$i][$j]["user_id"]))
                    );
                }
            }
    
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function showNotFullGroup_get(){ 
        $proj_id = htmlspecialchars($this->get("proj_id"));
        $this->load->model("UserModel");

        $maxelementos = $this->ProjectModel->getMaxElementsGroup($proj_id);
        $grupos = $this->GroupModel->getAllGroups($proj_id);
        $data["gruposdisponiveis"] = array();
        $data["alunosnogrupo"] = array();
        array_push($data["alunosnogrupo"], array("maxElementos"=>$maxelementos[0]["max_elementos"]));
        for($i=0; $i<count($grupos); $i++) {
            $numElegroup = $this->GroupModel->countElements($grupos[$i]["id"]);
            if ($numElegroup < $maxelementos[0]["max_elementos"]){
                $data["students"] = array();
                array_push($data["gruposdisponiveis"], array(
                    "grupo_nome" => $grupos[$i]["name"],
                    "grupo_id" => $grupos[$i]["id"],
                ));
                array_push($data["students"], $this->GroupModel->getStudents($grupos[$i]["id"]));
                for($v=0; $v  < count($data["students"]); $v++) {
                    for($j=0; $j < count($data["students"][$v]); $j++){
                        $query = $this->UserModel->getUserById($data["students"][$v][$j]["user_id"]);
                        array_push($data["alunosnogrupo"], array(
                            'user_name'     =>      array($query->name, $query->surname, $data["students"][$v][$j]["user_id"]),
                            'grupo_id'      =>      $grupos[$i]["id"])
                        );

                    }
                }
            }
        }
        $this->response($data, parent::HTTP_OK);
        
    }


    public function getMyGroupInProj_get(){ 
        $user_id = $this->session->userdata('id');
        $proj_id = htmlspecialchars($this->get("proj_id"));

        $projeto = $this->ProjectModel->getProjectByID($proj_id);
        $cadeira_id = $projeto[0]["cadeira_id"];

        if($this->verify_studentInCadeira($user_id, $cadeira_id)){
            $data["grupos"] = $this->GroupModel->getGroups($user_id);

            $group_to_return = array();
    
            $flag_exists = false;
    
            for ($i=0; $i < count($data["grupos"]); $i++) {
                $grupo = $this->GroupModel->getGroupById($data["grupos"][$i]["grupo_id"]);
                $proj = $grupo[0]["projeto_id"];
    
                if ($proj_id == $proj){
                    $group_to_return["grupo"] = $grupo[0];
                    $flag_exists = true;
                }
            }
    
    
            if($flag_exists == true){
                // ir buscar os membros do grupo
                $group_to_return["membros"] = $this->GroupModel->getStudents($group_to_return["grupo"]["id"]);
    
                // ir buscar nomes dos membros
                $group_to_return["nomes"] = array();
                for($i=0; $i< count($group_to_return["membros"]); $i++) {
                    $query = $this->UserModel->getUserById($group_to_return["membros"][$i]["user_id"]);
                    array_push($group_to_return["nomes"], array($query->name, $query->surname, $group_to_return["membros"][$i]["user_id"], $query->picture));
                }
            }
    
            $this->response($group_to_return, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function getGroupMembers_get($group_id) {        
        $data["user_ids"] = $this->GroupModel->getStudents(htmlspecialchars($group_id));
        $data["users"] = array();
        for($i=0; $i < count($data["user_ids"]); $i++) {
            array_push($data["users"], $this->UserModel->getSomeValuesUser($data["user_ids"][$i]["user_id"]));
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getTasks_get($group_id) { 
        $user_id = $this->session->userdata('id');

        if($this->verify_student($user_id, htmlspecialchars($group_id))) {
            $data["tasks"] = $this->TasksModel->getTarefas(htmlspecialchars($group_id));
    
            $data["members"] = array();
            for($i=0; $i < count($data["tasks"]); $i++) {
                array_push($data["members"], $this->TasksModel->getMembroNome($data["tasks"][$i]["user_id"]));
            }
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
        
    }

    public function getFicheirosGrupo_get(){
        $user_id = $this->session->userdata('id');
        $grupo_id = htmlspecialchars($this->get("grupo_id"));

        if($this->verify_student($user_id, $grupo_id)){
            $data["ficheiros"] = $this->GroupModel->getFicheirosGrupo($grupo_id);
            $membros = $this->GroupModel->getStudents($grupo_id);

            $data["nomes"] = array();
            for($i=0; $i< count($membros); $i++) {
                $query = $this->UserModel->getUserById($membros[$i]["user_id"]);
                array_push($data["nomes"], array($query->name, $query->surname, $membros[$i]["user_id"]));
            }

            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function getTaskById_get($id) {
        $data["task"] = $this->TasksModel->getTaskById(htmlspecialchars($id));

        $this->response($data, parent::HTTP_OK);
    }

    public function export_get(){
        $auth = $this->session->userdata('id');
        $user = $this->UserModel->getUserById($auth);
        $grupo_id = htmlspecialchars($this->get("grupo_id"));
        $role = htmlspecialchars($this->get("role"));

        if($user->role != $role){
            $this->response(Array("msg"=>"No student rights."), parent::HTTP_UNAUTHORIZED);
            return null;
        }

        if($this->verify_student($user->id, $grupo_id)){         
            $file = fopen('php://output','w');
            // fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            $header = array("Tarefa", "Descrição", "Membro Responsável", "Data Início", "Data Fim");

            $info = $this->TasksModel->getTarefas($grupo_id);
            
            $users = array();
            for($i=0; $i < count($info); $i++) {
                if($info[$i]['user_id'] == 0) {
                    array_push($users, "Ainda não atribuído");
                } else {
                    array_push($users, $this->UserModel->getUserById($info[$i]['user_id']));
                }
            }

            fputcsv($file, $header);
            for($i=0; $i < count($info); $i++) {
                if(isset($users[$i]->name)) {
                    $nome = $users[$i]->name . " " . $users[$i]->surname;
                    $dados = array($info[$i]['name'], 
                        $info[$i]['description'], 
                        $nome,
                        $info[$i]['start_date'],
                        $info[$i]['done_date']
                    );
                } else {
                    $dados = array($info[$i]['name'], 
                        $info[$i]['description'], 
                        $users[$i],
                        $info[$i]['start_date'],
                        $info[$i]['done_date']
                    );
                }
                fputcsv($file, $dados);
            }
            fclose($file);
            exit;
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
        
    }

    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////

    public function removeProject_delete(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        if ($this->verify_teacher($user_id, htmlspecialchars($this->delete('projid')),"projeto") == true){
            $proj_id = htmlspecialchars($this->delete('projid'));
            $data = $this->ProjectModel->removeProjectByID($proj_id);

            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function removeEtapa_delete(){ 
        $user_id = $this->session->userdata('id');

        //Verificar se o id do professor guardado no token está associado à cadeira

        $id = htmlspecialchars($this->delete('etapa_id'));

        if ($this->verify_teacher($user_id,$id,"etapa") == true){
            $data = $this->ProjectModel->removeEtapaByID($id);

            if ($data){
                $arr_msg = array (
                    "msg" => "Etapa removida com sucesso",
                    "type" => "S",
                );
            } else {
                $arr_msg = array (
                    "msg" => "Erro ao remover a etapa",
                    "type" => "E",
                );
            }

            $this->session->set_userdata('result_msg', $arr_msg);
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function removeEnunciadoEtapa_delete(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        $id = htmlspecialchars($this->delete('id'));
        $proj = htmlspecialchars($this->delete('projid'));

        if($this->verify_teacher($user_id, $proj, "projeto") == true){
            $etapa = $this->ProjectModel->getEtapaByID($id)->result_array();
            unlink("uploads/enunciados_files/" . $proj . "/" . $etapa[0]["enunciado_url"]);
            $this->ProjectModel->clearEnuncEtapa($id);
            $this->response($id, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function removeEnunciadoProj_delete(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        $proj = htmlspecialchars($this->delete('projid'));

        if($this->verify_teacher($user_id, $proj, "projeto") == true){
            $this->ProjectModel->removeEnunciadoProj($proj);
            unlink("uploads/enunciados_files/" . $proj . ".pdf");
            $this->response($proj, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function leaveMyGroup_delete(){ 
        $user_id = $this->session->userdata('id');
        $group_id = htmlspecialchars($this->delete("grupo_id"));
        // $proj_id = htmlspecialchars($this->get("proj_id"));
        
        if($this->verify_student($user_id, $group_id)==true){
            $this->load->model("GroupModel");

            $this->GroupModel->leaveGroup($user_id, $group_id);

            $numElegroup = $this->GroupModel->countElements($group_id);

            if($numElegroup == 0){
                $this->GroupModel->deleteGroup($group_id);
            }
        }
        else{
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
        
    }


    public function removeFicheiroAreaGrupo_delete(){
        $user_id = $this->session->userdata('id');
        $group_id = htmlspecialchars($this->delete("grupo_id"));
        $ficheiro_id = htmlspecialchars($this->delete("ficheiro_id"));

        if($this->verify_student($user_id, $group_id)){
            $data["ficheiro"] = $this->GroupModel->getFicheiroGrupoById($ficheiro_id);
            $this->GroupModel->removeFicheiroAreaGrupo($ficheiro_id);
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function deleteTaskById_delete($id){ 
        $user_id = $this->session->userdata('id');
        $group_id = htmlspecialchars($this->delete("grupo_id"));

        if($this->verify_student($user_id, $group_id)){
            $this->load->model("TasksModel");
            $data = $this->TasksModel->deleteTaskById(htmlspecialchars($id));
        
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
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

    //variavel pode ser o id do projeto, id da cadeira, etc
    //mode vai nos dizer o que é a variavel, assim podemos diferenciar os casos
    private function verify_teacher($user_id, $variable, $mode){
        $this->load->model('SubjectModel');

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

    private function verify_student($user_id, $group_id){
        $verify = $this->GroupModel->verifyGroupStudent($user_id, $group_id);

        if(empty($verify)){
            return false;
        } else {
            return true;
        }
    }

    private function verify_studentInCadeira($user_id, $cadeira_id){

        $this->load->model('StudentListModel');
        $verify = $this->StudentListModel->verifyStudentInCadeira($user_id, $cadeira_id);

        if(empty($verify)){
            return false;
        } else {
            return true;
        }

        // $membros = $this->StudentListModel->getStudentsByCadeiraID($cadeira_id);

        // $flag_found = false;

        // for ($i=0; $i < count($membros); $i++){
        //     if($user_id == $membros[$i]["user_id"]){
        //         $flag_found = true;
        //     }    
        // }

        // return $flag_found;
    }

}

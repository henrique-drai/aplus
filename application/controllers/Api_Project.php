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
    }



    //////////////////////////////////////////////////////////////
    //                           POST
    //////////////////////////////////////////////////////////////

    public function createProject_post(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira
        //tabela que liga cadeira a user


        if ($this->verify_teacher($user_id,$this->post("cadeira_id"),"cadeira") == true){

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
        $this->load->model('ProjectModel');


        if ($this->verify_teacher($user_id,$this->post('projid'),"projeto") == true){
            $new_etapa = Array (
                "projeto_id"        => $this->post('projid'),
                "nome"              => $etapa["nome"],
                "description"       => $etapa["desc"],
                "enunciado_url"     => $etapa["enunciado"],
                "deadline"          => $etapa["data"],
            );
    
            $data = $this->ProjectModel->insertEtapa($new_etapa);
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

        $grupo_id = $this->post('grupo_id');
        $etapa_id = $this->post('etapa_id');
        $feedback = $this->post('feedback');

        $this->load->model('ProjectModel');

        if($this->verify_teacher($user_id, $etapa_id, "etapa") == true){
            $etapa_submit = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);
            $data = $this->ProjectModel->insertFeedback($feedback, $etapa_submit->row()->id);
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

        $this->load->model('ProjectModel');


        if ($this->verify_teacher($user_id,$this->post('projid'), "projeto") == true){
            $etapa = $this->post('edited_etapa');
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
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }

    public function editEnunciado_post(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        $proj = $this->post('projid');
        $enunciado = $this->post('enunciado');

        $this->load->model('ProjectModel');

        if ($this->verify_teacher($user_id,$proj,"projeto") == true){
            $this->ProjectModel->updateProjEnunciado($enunciado, $proj);
            $this->response($enunciado, parent::HTTP_OK);            
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }

    }

    public function editEtapaEnunciado_post(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        $etapa = $this->post('etapaid');
        $enunc = $this->post('enunciado');
        $this->load->model('ProjectModel');

        if($this->verify_teacher($user_id, $etapa, "etapa") == true){
            $this->ProjectModel->editEtapaEnunciado($enunc, $etapa);
            $this->response($enunc, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }
    }


    public function submitEtapa_post(){ 

        $user_id = $this->session->userdata('id');
        //Verificar se o id do aluno guardado no token está associado à cadeira e ao grupo.  - VERIFY ALUNO

        //verificar se a submissão existe associada à etapa, projeto e grupo
        //se existir, update, se nao existir, insert

        $grupo = $this->post('grupo');
        $etapa = $this->post('etapa');
        $fich  = $this->post('ficheiro');
        $this->load->model('ProjectModel');


        if($this->verify_student($user_id, $grupo)==true){
            $data_send = Array(
                "grupo_id"            => $grupo,
                "etapa_id"            => $etapa,
                "submit_url"          => $fich,
                "feedback"            => "",
            );
    
            $data["sub"] = $this->ProjectModel->getSubmission($grupo, $etapa);
    
            if(empty($data["sub"]->row())){
                //submit
                $returned = $this->ProjectModel->submitEtapa($data_send);
            } else {
                //update
                $returned = $this->ProjectModel->updateSubmission($grupo, $etapa, $fich);
            }
    
            $data["fich"] = $fich;
            $data["result"] = $returned;
    
            $this->response($data, parent::HTTP_OK);
        } else {
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
            $this->response($response, $status);
        }

    }

    public function insertTask_post() { 

        $data_send = Array (
            "grupo_id"          => $this->post("grupo_id"),
            "user_id"           => $this->post("user_id"),
            "name"              => $this->post("name"),
            "description"       => $this->post("description"),
            "start_date"        => $this->post("start_date"),
            "done_date"         => $this->post("done_date"),
        );

        $this->load->model("TasksModel");
        $data = $this->TasksModel->insertTask($data_send);

        $this->response($data, parent::HTTP_OK);
    }

    

    //////////////////////////////////////////////////////////////
    //                           GET
    //////////////////////////////////////////////////////////////

    public function getProjectStatus_get(){ 

        $this->load->model('GroupModel');
        $this->load->model('ProjectModel');

        $grupo_id =  $this->get('grupo_id');
        $projeto_id = $this->GroupModel->getProjectId($grupo_id)[0]["projeto_id"];
        $data["date"] = $this->ProjectModel->getLastEtapa($projeto_id)[0]["deadline"];

        $this->response($data, parent::HTTP_OK);
        
        
    }

    public function getSub_get(){ 

        $grupo_id = $this->get('grupo_id');
        $etapa_id = $this->get('etapa_id');

        $this->load->model('ProjectModel');

        $result = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);

        $this->response($result->result_array(), parent::HTTP_OK);
    }


    public function getAllEtapas_get(){ 

        $proj_id = $this->get('projid');
        $this->load->model('ProjectModel');
        $data = $this->ProjectModel->getEtapasByProjectID($proj_id);

        $this->response($data, parent::HTTP_OK);
    }


    public function getAllGroups_get(){ 
        $proj_id = $this->get("proj_id");
        $this->load->model("GroupModel");
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
    }

    public function showNotFullGroup_get(){ 
        $proj_id = $this->get("proj_id");

        $this->load->model('ProjectModel');
        $this->load->model('GroupModel');
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

        $proj_id = $this->get("proj_id");
        $this->load->model("GroupModel");
        $this->load->model("UserModel");

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
                array_push($group_to_return["nomes"], array($query->name, $query->surname, $group_to_return["membros"][$i]["user_id"]));
            }
        }

        $this->response($group_to_return, parent::HTTP_OK);

    }

    public function getGroupMembers_get($group_id) {        
        $this->load->model("GroupModel");

        $data["user_ids"] = $this->GroupModel->getStudents($group_id);

        $this->load->model("UserModel");
        $data["users"] = array();
        for($i=0; $i < count($data["user_ids"]); $i++) {
            array_push($data["users"], $this->UserModel->getUserById($data["user_ids"][$i]["user_id"]));
        }

        $this->response($data, parent::HTTP_OK);
    }

    public function getTasks_get($group_id) { 
        $this->load->model("TasksModel");

        $data["tasks"] = $this->TasksModel->getTarefas($group_id);

        $data["members"] = array();
        for($i=0; $i < count($data["tasks"]); $i++) {
            array_push($data["members"], $this->TasksModel->getMembroNome($data["tasks"][$i]["user_id"]));
        }
        $this->response($data, parent::HTTP_OK);
    }

    //////////////////////////////////////////////////////////////
    //                         DELETE
    //////////////////////////////////////////////////////////////

    public function removeProject_delete(){ 
        $user_id = $this->session->userdata('id');
        //Verificar se o id do professor guardado no token está associado à cadeira

        $this->load->model('ProjectModel');

        if ($this->verify_teacher($user_id,$this->delete('projid'),"projeto") == true){
            $proj_id = $this->delete('projid');
            $this->load->model('ProjectModel');
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

        $id = $this->delete('etapa_id');
        $this->load->model('ProjectModel');

        if ($this->verify_teacher($user_id,$id,"etapa") == true){
            $data = $this->ProjectModel->removeEtapaByID($id);
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
        $this->load->model('ProjectModel');

        $id = $this->delete('id');
        $proj = $this->delete('projid');

        if($this->verify_teacher($user_id, $proj, "projeto") == true){
            unlink("uploads/enunciados_files/" . $proj . "/" . $id . ".pdf");
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

        $proj = $this->delete('projid');
        $this->load->model('ProjectModel');

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
        $group_id = $this->delete("grupo_id");
        $proj_id = $this->get("proj_id");

        $this->load->model("GroupModel");

        $this->GroupModel->leaveGroup($user_id, $group_id);

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
        $this->load->model('ProjectModel');
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
        $this->load->model('GroupModel');
        $membros_grupo = $this->GroupModel->getStudents($group_id);

        $flag_found = false;

        for ($i=0; $i < count($membros_grupo); $i++){
            if($user_id == $membros_grupo[$i]["user_id"]){
                $flag_found = true;
            }    
        }

        return $flag_found;
    }

}

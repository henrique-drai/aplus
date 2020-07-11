<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


class S3_Routing extends CI_Controller {

    
    public $s3;
    public $s3Replica;
    public $bucketName;
    public $replica_name;
    public $mime_types;


    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        if(is_null($this->session->userdata('role'))){ $this->load->view('errors/403'); }
        $this->load->model('UserModel');
        $this->load->model('ProjectModel');
        $this->load->model('GroupModel');
        $this->load->model('SubjectModel');
        $this->load->model('StudentListModel');

        $IAM_KEY = 'AKIAVFIHVJAOIQ3CYTWP';
        $IAM_SECRET = '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';
        
        $this -> s3 = S3Client::factory(
            array(
                'credentials' => array(
                    'key' => $IAM_KEY,
                    'secret' => $IAM_SECRET
                ),
                'version' => 'latest',
                'region'  => 'eu-west-3'
            )
        );    
        
        $this -> s3Replica = S3Client::factory(
            array(
                'credentials' => array(
                    'key' => $IAM_KEY,
                    'secret' => $IAM_SECRET
                ),
                'version' => 'latest',
                'region'  => 'eu-central-1'
            )
        );       

        $this->bucketName = 'plusa';
        $this->replica_name = 'plusa-replicate-new';

        $this->mime_types = array (
            "pdf" => "pdf",
            "rar" => "x-rar-compressed",
            "zip" => "zip",
            "docx"=> "vnd.openxmlformats-officedocument.wordprocessingml.document",
        );
    }

  
    public function profile_pic($userId){


        $userId = htmlspecialchars($userId);
        $userPicture = $this->UserModel->getUserById($userId)->picture;


        if($userPicture == ""){
            $plain_url = base_url() . "uploads/profile/default.jpg";

            $image = file_get_contents($plain_url);
            header('Content-type: image/jpg;');            
        }
        else{

            $file_path = "profile/" . $userId . "." . $userPicture;

            if(!$this->s3->doesObjectExist($this->bucketName, $file_path)) {
                $plain_url = $this->s3Replica->getObjectUrl($this->replica_name, $file_path);
            } else {
                $plain_url = $this->s3->getObjectUrl($this->bucketName, $file_path);
            }
            
            $image = file_get_contents($plain_url);
            header('Content-type: image/' . $userPicture . ';');
            
        }

        header("Content-Length: " . strlen($image));
        echo $image;
    }


    public function enunciado_projeto($idProjeto){
        $idProjeto = htmlspecialchars($idProjeto);
        $user_id = $this->session->userdata('id');

        $projeto = $this->ProjectModel->getProjectByID($idProjeto);
        $cadeira_id = $projeto[0]["cadeira_id"];

        if($this->verify_teacher($user_id, $idProjeto, "projeto") || $this->verify_studentInCadeira($user_id, $cadeira_id)){
            
            $file_path = "enunciados_files/" . $idProjeto . ".pdf";

            if(!$this->s3->doesObjectExist($this->bucketName, $file_path)) {
                $plain_url = $this->s3Replica->getObjectUrl($this->replica_name, $file_path);
            } else {
                $plain_url = $this->s3->getObjectUrl($this->bucketName, $file_path);
            }
            
            $file = file_get_contents($plain_url);
            header('Content-type: application/pdf;');
            header("Content-Length: " . strlen($file));
            echo $file;
        } else {
            $this->load->view('errors/403');
        }
    }

    public function enunciado_etapa_projeto($idProjeto, $idEtapa){
        $user_id = $this->session->userdata('id');
        $idProjeto = htmlspecialchars($idProjeto);
        $idEtapa = htmlspecialchars($idEtapa);

        $projeto = $this->ProjectModel->getProjectByID($idProjeto);
        $cadeira_id = $projeto[0]["cadeira_id"];

        if($this->verify_teacher($user_id, $idProjeto, "projeto") || $this->verify_studentInCadeira($user_id, $cadeira_id)){

            $file_path = "enunciados_files/" . $idProjeto . "/" . $idEtapa . ".pdf";

            if(!$this->s3->doesObjectExist($this->bucketName, $file_path)) {
                $plain_url = $this->s3Replica->getObjectUrl($this->replica_name, $file_path);
            } else {
                $plain_url = $this->s3->getObjectUrl($this->bucketName, $file_path);
            }
            
            $file = file_get_contents($plain_url);
            header('Content-type: application/pdf;');
            header("Content-Length: " . strlen($file));
            echo $file;
        } else {
            $this->load->view('errors/403');
        }
    }

    public function submissao_etapa($idProjeto, $idEtapa, $idGrupo){
        $user_id = $this->session->userdata('id');
        $idProjeto = htmlspecialchars($idProjeto);
        $idEtapa = htmlspecialchars($idEtapa);
        $idGrupo = htmlspecialchars($idGrupo);

        if($this->verify_teacher($user_id, $idProjeto, "projeto") || $this->verify_student_group($user_id, $idGrupo)){
            $sub = $this->ProjectModel->getSubmission($idGrupo, $idEtapa)->row()->submit_url;
            $ext = explode(".", $sub)[1];

            $file_path = "submissions/" . $idProjeto . "/" . $idEtapa . "/" . $idGrupo . "." . $ext;

            if(!$this->s3->doesObjectExist($this->bucketName, $file_path)) {
                $plain_url = $this->s3Replica->getObjectUrl($this->replica_name, $file_path);
            } else {
                $plain_url = $this->s3->getObjectUrl($this->bucketName, $file_path);
            }
            
            $file = file_get_contents($plain_url);
            header('Content-type: application/' . $this->mime_types[$ext] . ';');
            header("Content-Length: " . strlen($file));
            echo $file;
        } else {
            $this->load->view('errors/403');
        }

    }

    public function group_files($idGrupo, $file_url){
        $user_id = $this->session->userdata('id');
        $idGrupo = htmlspecialchars($idGrupo);
        $file_url = urldecode(htmlspecialchars($file_url));

        if($this->verify_student_group($user_id, $idGrupo)){
            $file = $this->GroupModel->getFicheiroGrupoByNormalURL($file_url, $idGrupo)->url_original;
            $ext = explode(".", $file)[1];

            $file_path = "grupo_files/" . $idGrupo . "/" . $file;

            if(!$this->s3->doesObjectExist($this->bucketName, $file_path)) {
                $plain_url = $this->s3Replica->getObjectUrl($this->replica_name, $file_path);
            } else {
                $plain_url = $this->s3->getObjectUrl($this->bucketName, $file_path);
            }

            $file = file_get_contents($plain_url);
            header('Content-type: application/' . $this->mime_types[$ext] . ';');
            header("Content-Length: " . strlen($file));
            echo $file;
        } else {
            $this->load->view('errors/403');
        }
    }

    public function subject_files($idCadeira, $file_url){
        $user_id = $this->session->userdata('id');
        $idCadeira = htmlspecialchars($idCadeira);
        $file_url = urldecode(htmlspecialchars($file_url));

        if($this->verify_teacher($user_id, $idCadeira, "cadeira") || $this->verify_studentInCadeira($user_id, $idCadeira)){
            $file = $this->SubjectModel->getFicheiroAreaByNormalURL($file_url, $idCadeira)->url_original;
            $ext = explode(".", $file)[1];

            $file_path = "cadeira_files/" . $idCadeira . "/" . $file;

            if(!$this->s3->doesObjectExist($this->bucketName, $file_path)) {
                $plain_url = $this->s3Replica->getObjectUrl($this->replica_name, $file_path);
            } else {
                $plain_url = $this->s3->getObjectUrl($this->bucketName, $file_path);
            }

            $file = file_get_contents($plain_url);
            header('Content-type: application/' . $this->mime_types[$ext] . ';');
            header("Content-Length: " . strlen($file));
            echo $file;
        } else {
            $this->load->view('errors/403');
        }


    }

    public function delete_from_bucket($filename, $grupo_or_cadeira_id, $type){
        // type = 0 -> area de grupo; type = 1 -> area de ficheiros;
        $user_id = $this->session->userdata('id');
        $filename = htmlspecialchars($filename);
        $grupo_or_cadeira_id = htmlspecialchars($grupo_or_cadeira_id);
        $type = htmlspecialchars($type);
        
        if ($type == 0){
            if($this->verify_student_group($user_id, $grupo_or_cadeira_id)){
                $file_path = "grupo_files/" . $grupo_or_cadeira_id . "/" . $filename;
                if($this->s3->doesObjectExist($this->bucketName, $file_path)) {
                    $result = $this->s3->deleteObject([
                        'Bucket' => $this->bucketName,
                        'Key'    => $file_path
                    ]);
                }

                $file_path2 = "grupo_files/" . $grupo_or_cadeira_id . "/" . $filename;
                if($this->s3Replica->doesObjectExist($this->replica_name, $file_path2)) {
                    $result = $this->s3Replica->deleteObject([
                        'Bucket' => $this->replica_name,
                        'Key'    => $file_path2
                    ]);
                }

                header("Location: ".base_url()."app/ficheiros/".$grupo_or_cadeira_id);
            } else {
                $this->load->view('errors/403');
            }
            
        } else if ($type == 1){
            if($this->verify_teacher($user_id, $grupo_or_cadeira_id, "cadeira")){
                $file_path = "cadeira_files/" . $grupo_or_cadeira_id . "/" . $filename;
                if($this->s3->doesObjectExist($this->bucketName, $file_path)) {
                    $result = $this->s3->deleteObject([
                        'Bucket' => $this->bucketName,
                        'Key'    => $file_path
                    ]);
                }

                $file_path2 = "cadeira_files/" . $grupo_or_cadeira_id . "/" . $filename;
                if($this->s3Replica->doesObjectExist($this->replica_name, $file_path2)) {
                    $result = $this->s3Replica->deleteObject([
                        'Bucket' => $this->replica_name,
                        'Key'    => $file_path2
                    ]);
                }

                header("Location: ".base_url()."route/subject_files/" . $grupo_or_cadeira_id);
            } else {
                $this->load->view('errors/403');
            }
        }
    }

    private function verify_teacher($user_id, $var, $type){
        if($type == "projeto"){
            $projeto = $this->ProjectModel->getProjectByID($var);
            $verify = $this->SubjectModel->verifyTeacherSubject($user_id, $projeto[0]["cadeira_id"]);
        } else if($type == "cadeira"){
            $verify = $this->SubjectModel->verifyTeacherSubject($user_id, $var);
        }

        if(empty($verify)){
            return false;
        } else {
            return true;
        }
    }

    private function verify_student_group($user_id, $grupo_id){
        $verify = $this->GroupModel->verifyGroupStudent($user_id, $grupo_id);

        if(empty($verify)){
            return false;
        } else {
            return true;
        }
    }

    
    private function verify_studentInCadeira($user_id, $cadeira_id){
        $verify = $this->StudentListModel->verifyStudentInCadeira($user_id, $cadeira_id);

        if(empty($verify)){
            return false;
        } else {
            return true;
        }
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require '../vendor/autoload.php';
	
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


class UploadsC extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        if(is_null($this->session->userdata('role'))){ $this->load->view('errors/403'); }
        $this->load->model('ProjectModel');

        $bucketName = 'plusa';
        $IAM_KEY = 'AKIAVFIHVJAOIQ3CYTWP';
        $IAM_SECRET = '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';
        
        try {
            $s3 = S3Client::factory(
                array(
                    'credentials' => array(
                        'key' => $IAM_KEY,
                        'secret' => $IAM_SECRET
                    ),
                    'version' => 'latest',
                    'region'  => 'eu-west-3'
                )
            );
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }

    }


    //      uploadsc/uploadEnunciadoProjeto/:projeto_id
    public function uploadEnunciadoProjeto($project_id_par)
    {
        $project_id = htmlspecialchars($project_id_par);
        $user_id = $this->session->userdata('id');

        if($this->verify_teacher($user_id, $project_id, "projeto")){

            // MUDAR NOME $_FILES
            $realName = basename($_FILES["fileToUpload"]['name']);
            $keyName = 'enunciados_files/' . $project_id . pathinfo($realName, PATHINFO_EXTENSION);
            $pathInS3 = 'https://plusa.s3.eu-west-3.amazonaws.com/' . $keyName;

            try {
                // Uploaded:
                $file = $_FILES["fileToUpload"]['tmp_name'];
        
                $s3->putObject(
                    array(
                        'Bucket'=>$bucketName,
                        'Key' =>  $keyName,
                        'SourceFile' => $file,
                        'StorageClass' => 'REDUCED_REDUNDANCY'
                    )
                );
        
            } catch (Exception $e) {

                $arr_msg = array (
                    "msg" => "Erro ao submeter ficheiro",
                    "type" => "E",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }

            $arr_msg = array (
                "msg" => "Ficheiro submetido com sucesso",
                "type" => "S",
            );

            $name_enunciado = $project_id . pathinfo($realName, PATHINFO_EXTENSION);

            $this->ProjectModel->updateProjEnunciado($name_enunciado, $realName, $project_id);
            $this->session->set_userdata('result_msg', $arr_msg);
            header("Location: ".base_url()."projects/project/".$project_id);
        
            
            // VERIFICAR O LINK PARA IR BUSCAR O FICHEIRO
            echo "<a href='" . $pathInS3 . "' > Link </a>";
        
        } else {
            header("Location: ".base_url()."errors/403");
        }
        

    }

    public function uploadEnunciadoEtapa($project_id_par, $etapa_id_par)
    {
        $project_id = htmlspecialchars($project_id_par);
        $etapa_id = htmlspecialchars($etapa_id_par);
        $user_id = $this->session->userdata('id');
   
        if($this->verify_teacher($user_id, $project_id, "projeto")){



            $realName = basename($_FILES["fileToUpload"]['name']);
            $keyName = 'enunciados_files/' . $project_id . "/" . $etapa_id . pathinfo($realName, PATHINFO_EXTENSION);
            $pathInS3 = 'https://plusa.s3.eu-west-3.amazonaws.com/' . $keyName;


            try {
                // Uploaded:
                $file = $_FILES["fileToUpload"]['tmp_name'];
        
                $s3->putObject(
                    array(
                        'Bucket'=>$bucketName,
                        'Key' =>  $keyName,
                        'SourceFile' => $file,
                        'StorageClass' => 'REDUCED_REDUNDANCY'
                    )
                );
        
            } catch (Exception $e) {

                $arr_msg = array (
                    "msg" => "Erro ao submeter ficheiro da etapa",
                    "type" => "E",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }

            $arr_msg = array (
                "msg" => "Ficheiro da etapa submetido com sucesso",
                "type" => "S",
            );

            $name_enunciado = $project_id . pathinfo($realName, PATHINFO_EXTENSION);

            $this->ProjectModel->editEtapaEnunciado($name_enunciado, $realName, $etapa_id);
            $this->session->set_userdata('result_msg', $arr_msg);
            header("Location: ".base_url()."projects/project/".$project_id);
                  
            // VERIFICAR O LINK PARA IR BUSCAR O FICHEIRO
            echo "<a href='" . $pathInS3 . "' > Link </a>";


        } else {
            header("Location: ".base_url()."errors/403");
        }
    }

    // submit de alunos para etapa
    public function uploadSubmissao($project_id_par, $etapa_id_par, $grupo_id_par)
    {
        $grupo_id = htmlspecialchars($grupo_id_par);
        $project_id = htmlspecialchars($project_id_par);
        $etapa_id = htmlspecialchars($etapa_id_par);
        $user_id = $this->session->userdata('id');

        if($this->verify_student($user_id, $grupo_id)){


            $realName = basename($_FILES["fileToUpload"]['name']);
            $keyName = 'submissions/' . $project_id . "/" . $etapa_id . "/" . $grupo_id . pathinfo($realName, PATHINFO_EXTENSION);
            $pathInS3 = 'https://plusa.s3.eu-west-3.amazonaws.com/' . $keyName;


            try {
                // Uploaded:
                $file = $_FILES["fileToUpload"]['tmp_name'];
        
                $s3->putObject(
                    array(
                        'Bucket'=>$bucketName,
                        'Key' =>  $keyName,
                        'SourceFile' => $file,
                        'StorageClass' => 'REDUCED_REDUNDANCY'
                    )
                );

                
        
            } catch (Exception $e) {

                $arr_msg = array (
                    "msg" => "Erro ao submeter o trabalho",
                    "type" => "E",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }


            $arr_msg = array (
                "msg" => "Trabalho submetido com sucesso",
                "type" => "S",
            );


            $name_enunciado = $project_id . pathinfo($realName, PATHINFO_EXTENSION);


            $sub = $this->ProjectModel->getSubmission($grupo_id, $etapa_id);

            if(empty($sub->row())){
                //submit
                $data_send = Array(
                    "grupo_id"            => $grupo_id,
                    "etapa_id"            => $etapa_id,
                    "submit_url"          => $name_enunciado,
                    "submit_original"     => $realName,
                    "feedback"            => "",
                );

                $this->ProjectModel->submitEtapa($data_send);
            } else {
                //update
                $this->ProjectModel->updateSubmission($grupo_id, $etapa_id, $name_enunciado, $realName);
            }

            $this->session->set_userdata('result_msg', $arr_msg);
            header("Location: ".base_url()."projects/project/".$project_id);
                  
            // VERIFICAR O LINK PARA IR BUSCAR O FICHEIRO
            echo "<a href='" . $pathInS3 . "' > Link </a>";

        } else {
            header("Location: ".base_url()."errors/403");
        }
    }


    // submit de alunos para area de grupo - to do
    public function uploadFicheirosGrupo($grupo_id_par)
    {
        $grupo_id = htmlspecialchars($grupo_id_par);
        $user_id = $this->session->userdata('id');

        if($this->verify_student($user_id, $grupo_id)){

            if(!is_dir('./uploads/grupo_files/' . strval($grupo_id) . '/')){
                mkdir('./uploads/grupo_files/' . strval($grupo_id) . '/', 0777, TRUE);
            }

            $upload['upload_path'] = './uploads/grupo_files/' . strval($grupo_id) . '/';
            $upload['allowed_types'] = 'zip|rar|pdf|docx';
            $upload['max_size'] = 2048;
            $upload['overwrite'] = true;

            $this->load->library('upload', $upload);

            if ( ! $this->upload->do_upload("file_submit"))
            {
                $error = array('error' => $this->upload->display_errors());
                header("Location: ".base_url()."app/ficheiros/".$grupo_id);
            }  
            else
            {

                $enunciado = $this->upload->data('raw_name');
                $ext = $this->upload->data('file_ext');
                $name_enunciado = $enunciado . '_' . time() . $ext;

                rename("uploads/grupo_files/" . $grupo_id . '/' . $enunciado . $ext, "uploads/grupo_files/" . $grupo_id . '/' . $name_enunciado);

                //registar ficheiro na bd e cenas
                $this->load->model('GroupModel');
                $fich = $this->upload->data('client_name');
                $res = $this->GroupModel->getFicheiroGrupoByURLSub($fich, $grupo_id);
                if(empty($res)){
                    $data_send = Array(
                        "grupo_id"      => $grupo_id,
                        "user_id"       => $user_id,
                        "url"           => $name_enunciado,
                        "url_original"  => $fich,
                    );
                    $this->GroupModel->submit_ficheiro_areagrupo($data_send);
                } else {
                    $this->GroupModel->change_ficheiro_areagrupo_url($name_enunciado, $grupo_id);
                }

                header("Location: ".base_url()."app/ficheiros/".$grupo_id);
            }
        } else {
            header("Location: ".base_url()."errors/403");
        }
    }

    // submit de professor para area de ficheiros da cadeira - to do
    public function uploadFicheirosCadeira($cadeira_id_par, $cadeira_code_par, $year_par)
    {
        $cadeira_id = htmlspecialchars($cadeira_id_par);
        $cadeira_code = htmlspecialchars($cadeira_code_par);
        $year = htmlspecialchars($year_par);
        $user_id = $this->session->userdata('id');

        if($this->verify_teacher($user_id, $cadeira_id, "cadeira")){
            $this->load->model('YearModel');
            $this->load->model('SubjectModel');

            //verificar se o ano letivo existe e é valido
            $ano_letivo = $this->YearModel->getYearByInicio($year);
            $subject = $this->SubjectModel->getSubjectByCodeAndYear($cadeira_code, $ano_letivo->id);

            //verificar se o objeto existe
            if(is_null($subject)){
                header("Location: ".base_url()."errors/404");
            }

            if(!is_dir('./uploads/cadeira_files/' . strval($cadeira_id) . '/')){
                mkdir('./uploads/cadeira_files/' . strval($cadeira_id) . '/', 0777, TRUE);
            }

            $upload['upload_path'] = './uploads/cadeira_files/' . strval($cadeira_id) . '/';
            $upload['allowed_types'] = 'zip|rar|pdf|docx';
            $upload['max_size'] = 5048;
            $upload['overwrite'] = true;

            $this->load->library('upload', $upload);

            if ( ! $this->upload->do_upload("file_submit"))
            {
                $error = array('error' => $this->upload->display_errors());
                header("Location: ".base_url()."subjects/ficheiros/".$cadeira_code.'/'.$year);
            }  
            else
            {

                $enunciado = $this->upload->data('raw_name');
                $ext = $this->upload->data('file_ext');
                $name_enunciado = $enunciado . '_' . time() . $ext;

                rename("uploads/cadeira_files/" . $cadeira_id . '/' . $enunciado . $ext, "uploads/cadeira_files/" . $cadeira_id . '/' . $name_enunciado);

                $this->load->model('SubjectModel');
                $fich = $this->upload->data('client_name');
                $res = $this->SubjectModel->getFicheiroAreaByURLSub($fich, $cadeira_id);
                if(empty($res)){
                    $data_send = Array(
                        "user_id"        =>  $user_id,
                        "cadeira_id"     =>  $cadeira_id,
                        "url"            =>  $name_enunciado,
                        "url_original"   =>  $fich,    
                     );
                     
                    $this->SubjectModel->submitFicheiroArea($data_send);
                } else {
                    $this->SubjectModel->changeFicheirosAreaURL($name_enunciado, $cadeira_id);
                }

                header("Location: ".base_url()."subjects/ficheiros/".$cadeira_code.'/'.$year);
            }
        } else {
            header("Location: ".base_url()."errors/403");
        }
     
    }

    public function uploadProfilePic()
    {
        $user_id = $this->session->userdata('id');
        $upload['upload_path'] = './uploads/profile/';
        $upload['allowed_types'] = 'jpeg|jpg|png';
        $upload['max_size'] = 2048;
        $upload['file_name'] = $user_id;
        $upload['overwrite'] = true;

        $this->load->library('upload', $upload);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata('std-message', "O formato escolhido não é suportado.");
            $this->session->set_userdata('std-message-type', "error");
            header("Location: ".base_url()."app/profile/edit");
        }
        else
        {
            $this->load->model('UserModel');
            $ext = $this->upload->data('file_ext');
            $this->UserModel->updatePicture($user_id, $ext);
            $this->session->set_userdata('picture', $ext);
            $this->session->set_userdata('std-message', "A sua imagem de perfil foi atualizada.");
            $this->session->set_userdata('std-message-type', "success");
            header("Location: ".base_url()."app/profile/".$user_id);
        }
    }


    public function verify_teacher($user_id, $var, $type){
        //verificar
        $this->load->model('ProjectModel');
        $this->load->model('SubjectModel');
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

    public function verify_student($user_id, $grupo_id){
        //verificar
        $this->load->model('GroupModel');
        $verify = $this->GroupModel->verifyGroupStudent($user_id, $grupo_id);

        if(empty($verify)){
            return false;
        } else {
            return true;
        }
    }
}
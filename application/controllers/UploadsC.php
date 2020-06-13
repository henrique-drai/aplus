<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UploadsC extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    //      uploadsc/
    public function index()
    {

    }

    //      uploadsc/uploadEnunciadoProjeto/:projeto_id
    public function uploadEnunciadoProjeto($project_id)
    {
        $user_id = $this->session->userdata('id');

        if($this->verify_teacher($user_id, $project_id, "projeto")){

            $path = './uploads/enunciados_files/';

            // echo substr(sprintf('%o', fileperms("uploads/enunciados_files/" . $project_id . ".pdf")), -4);
            echo substr(sprintf('%o', fileperms("uploads/enunciados_files/" . $project_id . ".pdf")), -4);

            if(!is_dir($path)){
                mkdir($path, 0777, TRUE);
            } else {
                chmod($path, 0777);
                chmod("uploads/enunciados_files/" . $project_id . ".pdf", 0777);
            }

            echo "cenas pelo meio";

            echo substr(sprintf('%o', fileperms("uploads/enunciados_files/" . $project_id . ".pdf")), -4);
            if(file_exists("uploads/enunciados_files/" . $project_id . ".pdf")) unlink("uploads/enunciados_files/" . $project_id . ".pdf");
            
            echo "depois do unlink";
            clearstatcache();
            echo substr(sprintf('%o', fileperms("uploads/enunciados_files/" . $project_id . ".pdf")), -4);

            $upload['upload_path'] = $path;
            $upload['allowed_types'] = 'pdf';
            $upload['file_name'] = $project_id;
            $upload['max_size'] = 5048;
            $upload['overwrite'] = true;

            $this->load->library('upload', $upload);
            // $this->upload->overwrite = TRUE;
            $this->upload->initialize($upload);

            $error = $this->upload->display_errors();
            print_r($error);

            
            // type == S -> msg de sucesso
            // type == E -> msg de erro
    
            if ( ! $this->upload->do_upload('file_projeto'))
            {
      
                // $error = array('error' => $this->upload->display_errors());

                $arr_msg = array (
                    "msg" => "Erro ao submeter ficheiro",
                    "type" => "E",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }
            else
            {

                $arr_msg = array (
                    "msg" => "Ficheiro submetido com sucesso",
                    "type" => "S",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }
        } else {
            header("Location: ".base_url()."errors/403");
        }
        

    }

    public function uploadEnunciadoEtapa($project_id, $etapa_id)
    {
        $user_id = $this->session->userdata('id');
   
        if($this->verify_teacher($user_id, $project_id, "projeto")){
            
            if(!is_dir('./uploads/enunciados_files/' . strval($project_id) . '/')){
                mkdir('./uploads/enunciados_files/' . strval($project_id) . '/', 0777, TRUE);
            }

            $upload['upload_path'] = './uploads/enunciados_files/' . strval($project_id) . '/';
            $upload['allowed_types'] = 'pdf';
            $upload['file_name'] = $etapa_id;
            $upload['max_size'] = 5048;
            $upload['overwrite'] = true;

            $this->load->library('upload', $upload);

            if ( ! $this->upload->do_upload('file_etapa'))
            {
                // $error = array('error' => $this->upload->display_errors());
                // print_r($error);
                $arr_msg = array (
                    "msg" => "Erro ao submeter ficheiro da etapa",
                    "type" => "E",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }
            else
            {
                $arr_msg = array (
                    "msg" => "Ficheiro da etapa submetido com sucesso",
                    "type" => "S",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }
        } else {
            header("Location: ".base_url()."errors/403");
        }
    }

    // submit de alunos para etapa
    public function uploadSubmissao($project_id, $etapa_id, $grupo_id)
    {
        $user_id = $this->session->userdata('id');

        if($this->verify_student($user_id, $grupo_id)){

            if(!is_dir('./uploads/submissions/' . strval($project_id) . '/' . strval($etapa_id) . '/')){
                mkdir('./uploads/submissions/' . strval($project_id) . '/' . strval($etapa_id) . '/', 0777, TRUE);
            }

            $upload['upload_path'] = './uploads/submissions/' . strval($project_id) . '/' . strval($etapa_id) . '/';
            $upload['allowed_types'] = 'zip|rar';
            $upload['file_name'] = $grupo_id;
            $upload['max_size'] = 5048;
            $upload['overwrite'] = true;

            $this->load->library('upload', $upload);

            if(file_exists("uploads/submissions/" . $project_id . '/' . $etapa_id . '/' . $grupo_id . ".rar")) unlink("uploads/submissions/" . $project_id . '/' . $etapa_id . '/' . $grupo_id . ".rar");
            if(file_exists("uploads/submissions/" . $project_id . '/' . $etapa_id . '/' . $grupo_id . ".zip")) unlink("uploads/submissions/" . $project_id . '/' . $etapa_id . '/' . $grupo_id . ".zip");

            if ( ! $this->upload->do_upload('file_submit'))
            {
                $arr_msg = array (
                    "msg" => "Erro ao submeter a entrega",
                    "type" => "E",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }
            else
            {
                $arr_msg = array (
                    "msg" => "Entrega submetida com sucesso",
                    "type" => "S",
                );

                $this->session->set_userdata('result_msg', $arr_msg);
                header("Location: ".base_url()."projects/project/".$project_id);
            }
        } else {
            header("Location: ".base_url()."errors/403");
        }
    }


    // submit de alunos para area de grupo - to do
    public function uploadFicheirosGrupo($grupo_id)
    {
        $user_id = $this->session->userdata('id');

        if($this->verify_student($user_id, $grupo_id)){

            if(!is_dir('./uploads/grupo_files/' . strval($grupo_id) . '/')){
                mkdir('./uploads/grupo_files/' . strval($grupo_id) . '/', 0777, TRUE);
            }

            $upload['upload_path'] = './uploads/grupo_files/' . strval($grupo_id) . '/';
            $upload['allowed_types'] = 'zip|rar|pdf|docx';
            $upload['max_size'] = 5048;
            $upload['overwrite'] = true;

            $this->load->library('upload', $upload);

            if ( ! $this->upload->do_upload("file_submit"))
            {
                $error = array('error' => $this->upload->display_errors());
                header("Location: ".base_url()."app/ficheiros/".$grupo_id);
                //check é feito em js para mostrar a mensagem de erro
            }  
            else
            {
                header("Location: ".base_url()."app/ficheiros/".$grupo_id);
            }
        } else {
            header("Location: ".base_url()."errors/403");
        }
    }

    // submit de professor para area de ficheiros da cadeira - to do
    public function uploadFicheirosCadeira($cadeira_id, $cadeira_code, $year)
    {

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
            header("Location: ".base_url()."app/profile/".$user_id);
        }
        else
        {
            $this->load->model('UserModel');
            $ext = $this->upload->data('file_ext');
            $this->UserModel->updatePicture($user_id, $ext);
            $this->session->set_userdata('picture', $ext);
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
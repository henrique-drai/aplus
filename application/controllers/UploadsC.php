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
        // $project_id = $_SESSION["project_id"];
        $upload['upload_path'] = './uploads/enunciados_files/';
        $upload['allowed_types'] = 'pdf';
        $upload['file_name'] = $project_id;
        $upload['overwrite'] = true;

        $this->load->library('upload', $upload);

        if ( ! $this->upload->do_upload('file_proj'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            echo "<br>Erro upload ficheiro";
        }
        else
        {
            header("Location: ".base_url()."projects/project/".$project_id);
        }
    }

    public function uploadEnunciadoEtapa($project_id, $etapa_id)
    {
        if(!is_dir('./uploads/enunciados_files/' . strval($project_id) . '/')){
            mkdir('./uploads/enunciados_files/' . strval($project_id) . '/', 0777, TRUE);
        }

        $upload['upload_path'] = './uploads/enunciados_files/' . strval($project_id) . '/';
        $upload['allowed_types'] = 'pdf';
        $upload['file_name'] = $etapa_id;
        $upload['overwrite'] = true;

        $this->load->library('upload', $upload);

        if ( ! $this->upload->do_upload('file_etapa'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            echo "<br>Erro upload ficheiro";
        }
        else
        {
            header("Location: ".base_url()."projects/project/".$project_id);
        }
    }

    // submit de alunos para etapa
    public function uploadSubmitEtapa($project_id, $etapa_id)
    {
        // if(!is_dir('./uploads/enunciados_files/' . strval($project_id) . '/')){
        //     mkdir('./uploads/enunciados_files/' . strval($project_id) . '/', 0777, TRUE);
        // }

        // $upload['upload_path'] = './uploads/enunciados_files/' . strval($project_id) . '/';
        // $upload['allowed_types'] = 'pdf';
        // $upload['file_name'] = $etapa_id;
        // $upload['overwrite'] = true;

        // $this->load->library('upload', $upload);

        // if ( ! $this->upload->do_upload('file_etapa'))
        // {
        //     $error = array('error' => $this->upload->display_errors());
        //     print_r($error);
        //     echo "<br>Erro upload ficheiro";
        // }
        // else
        // {
        //     header("Location: ".base_url()."projects/project/".$project_id);
        // }
    }

    public function uploadProfilePic()
    {
        $user_id = $this->session->userdata('id');
        $upload['upload_path'] = './uploads/profile/';
        $upload['allowed_types'] = 'jpeg|jpg|png';
        $upload['file_name'] = $user_id;
        $upload['overwrite'] = true;

        $this->load->library('upload', $upload);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            #print_r($error);
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
}
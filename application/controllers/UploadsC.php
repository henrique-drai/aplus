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
        // query para verificar se user na session está associado ao projeto
        
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
        // query para verificar se user na session está associado ao projeto

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
    public function uploadSubmissao($project_id, $etapa_id, $grupo_id)
    {
        // query para verificar se user na session está associado ao grupo

        if(!is_dir('./uploads/submissions/' . strval($project_id) . '/' . strval($etapa_id) . '/')){
            mkdir('./uploads/submissions/' . strval($project_id) . '/' . strval($etapa_id) . '/', 0777, TRUE);
        }

        $upload['upload_path'] = './uploads/submissions/' . strval($project_id) . '/' . strval($etapa_id) . '/';
        $upload['allowed_types'] = 'zip|rar';
        $upload['file_name'] = $grupo_id;
        $upload['overwrite'] = true;

        $this->load->library('upload', $upload);

        // embora esteja a ser feito overwrite, apagar à mao os ficheiros pertencentes ao grupo de 
        // modo a evitar que existam ficheiros com diferentes extensoes na pasta a ocupar espaço.

        if ( ! $this->upload->do_upload('file_submit'))
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


    // submit de alunos para area de grupo - to do
    public function uploadFicheirosGrupo($grupo_id)
    {
        // query para verificar se user na session está associado ao grupo
        if ( ! $this->upload->do_upload('file_submit'))
        {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
        echo "<br>Erro upload ficheiro";
        }
    }

    // submit de professor para area de ficheiros da cadeira - to do
    public function uploadFicheirosCadeira($cadeira_id)
    {
        // query para verificar se user na session está associado ao grupo
        if ( ! $this->upload->do_upload('file_submit'))
        {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
        echo "<br>Erro upload ficheiro";
        }
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
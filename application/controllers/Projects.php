<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ProjectModel');
        $this->load->model('SubjectModel');
    }

    //      projects/
    public function index()
    {

    }

    //      projects/new/:subject_code/:year
    public function new($subject_code, $year)
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o codigo do curso
        $data["subject"] = $this->SubjectModel->getSubjectByCode($subject_code);

        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        //verificar se o curso ao qual a cadeira pertence 
        // ir buscar ano letivo id do ano letivo que começa em year
        // ir buscar curso cujo id é igual ao subject[curso_id]
        // verificar se id do ano letivo é igual ao ano letivo do curso
        $this->load->model('YearModel');
        $this->load->model('CourseModel');

    
        $ano_letivo = $this->YearModel->getYearByInicio($year);
        $course = $this->CourseModel->getCursobyId($data["subject"]->curso_id);
    

        if ($course->ano_letivo_id != $ano_letivo[0]["id"]){
            $this->load->view('errors/404', $data); return null;
        }

        $this->load->helper('form');

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/projectsNEW',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }
    }

    //      projects/project/:project_id/
    public function project($project_id)
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o projeto
        $data["project"] = $this->ProjectModel->getProjectByID($project_id);

        $_SESSION["project_id"] = $project_id;

        //verificar se o objeto associado ao projeto existe
        if(is_null($data["project"])){
            $this->load->view('errors/404', $data); return null;
        }

        //buscar a info sobre o codigo do curso
        $data["subject"] = $this->SubjectModel->getSubjectByID($data["project"][0]["cadeira_id"]);
    
        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        $this->load->helper('form');

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/project',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }

        
    }

    //      projects/rating/:project_id
    public function rating($project_id)
    {
        
    }

    //      projects/chat/:project_id
    public function chat($project_id)
    {
        
    }
    
    public function uploadEnunciadoProjeto()
    {
        $project_id = $_SESSION["project_id"];
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

    public function uploadEnunciadoEtapa($etapa_id)
    {
        $project_id = $_SESSION["project_id"];
        $upload['upload_path'] = './uploads/enunciados_files/' + $project_id + '/';
        $upload['allowed_types'] = 'pdf';
        $upload['file_name'] = 'idetapa';
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

}
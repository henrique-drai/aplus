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

    //      projects/new/:subject_code
    public function new($subject_code)
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

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/projectsNEW',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }
    }

    //      projects/project/:project_id
    public function project($project_id)
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o projeto
        $data["project"] = $this->ProjectModel->getProjectByID($project_id);

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

}
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

        if(is_null($ano_letivo)){
            $this->load->view('errors/404', $data); return null;
        }

        $course = $this->CourseModel->getCursobyId($data["subject"]->curso_id);
    
        if(is_null($course)){
            $this->load->view('errors/404', $data); return null;
        }

        if ($course->ano_letivo_id != $ano_letivo->id){
            $this->load->view('errors/404', $data); return null;
        }

        $data["year"] = $year;
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


        $this->load->model('YearModel');
        $this->load->model('CourseModel');
        $this->load->model('SubjectModel');


        $subject = $this->SubjectModel->getSubjectByID($data["project"][0]["cadeira_id"]);
        $course = $this->CourseModel->getCursobyId($subject->curso_id);
        $data["year"] = $this->YearModel->getYearById($course->ano_letivo_id);

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

        $this->load->view('templates/head', $data);

        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/project', $data); break;
            case 'teacher': $this->load->view('teacher/project', $data); break;
            case 'admin':   $this->load->view('admin/project', $data); break;
        }
        
        $this->load->view('templates/footer');  
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
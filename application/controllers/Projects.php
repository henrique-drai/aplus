<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ProjectModel');
        $this->load->model('EtapaModel');
    }

    //      projects/
    public function index()
    {

    }

    //      projects/new/:course_code
    public function new($course_code)
    {
        $this->load->model('CourseModel');

        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o codigo do curso
        $data["course"] = $this->CourseModel->getCourseByCode($course_code);

        //verificar se o objeto existe
        if(is_null($data["course"])){
            $this->load->view('errors/404', $data); return null;
        }

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/projects',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }
    }

    //      projects/project/:project_id
    public function project($project_id)
    {
        
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
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        if(is_null($this->session->userdata('role'))){ $this->load->view('errors/403'); }
        $this->load->model('ProjectModel');
        $this->load->model('SubjectModel');
    }

    //      projects/new/:subject_code/:year
    public function new($subject_code, $year = null)
    {

        $data["base_url"] = base_url();

        $this->load->model('YearModel');

        //verificar se o ano letivo existe e é valido
        $ano_letivo = $this->YearModel->getYearByInicio($year);

        if(is_null($ano_letivo)){
            $this->load->view('errors/404', $data);
        }

        //usar ano letivo na query para ir buscar a cadeira cujo code = subject code
        //  e cujo o ano_letivo_id = ao get ano_letivo_id do curso respetivo

        $data["subject"] = $this->SubjectModel->getSubjectByCodeAndYear($subject_code, $ano_letivo->id);

        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data);
        }

        $data["year"] = $year;

        $this->load->helper('form');

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/projectsNEW',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data);
        }
    }

    //      projects/project/:project_id/
    public function project($project_id = null)
    {
        $data["base_url"] = base_url();

        //buscar a info sobre o projeto
        $data["project"] = $this->ProjectModel->getProjectByID($project_id);

        //verificar se o objeto associado ao projeto existe
        if(empty($data["project"])){
            $this->load->view('errors/404', $data);
        }

        $this->load->model('YearModel');
        $this->load->model('CourseModel');
        $this->load->model('SubjectModel');


        $subject = $this->SubjectModel->getSubjectByID($data["project"][0]["cadeira_id"]);
        $course = $this->CourseModel->getCursobyId($subject->curso_id);
        $data["year"] = $this->YearModel->getYearById($course->ano_letivo_id);


        //buscar a info sobre o codigo do curso
        $data["subject"] = $this->SubjectModel->getSubjectByID($data["project"][0]["cadeira_id"]);
    
        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data);
        }

        $arr_msg = array (
            "msg" => "",
            "type" => "",
        );

        $data["msg"] = $this->session->userdata("result_msg");

        if ($data["msg"] == ""){
            $data["msg"] = $arr_msg;
        }

        $this->session->set_userdata('result_msg', $arr_msg);

        $this->load->helper('form');

        $this->load->view('templates/head', $data);

        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/project', $data); break;
            case 'teacher': $this->load->view('teacher/project', $data); break;
            case 'admin':   $this->load->view('admin/project', $data); break;
        }
        
        $this->load->view('templates/footer');  
    }
}
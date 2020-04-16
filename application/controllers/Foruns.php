<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Foruns extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ForumModel');
        $this->load->model('SubjectModel');
    }

    //      aplus.com/foruns/thread/:thread_id/:year
    public function thread($thread_id, $year)
    {
        $data["base_url"] = base_url();
        $this->load->model("CourseModel");
        $this->load->model("YearModel");
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre a thread
        $data["thread"] = $this->ForumModel->getThreadByID($thread_id);

        //buscar o year
        $data["year"] = $this->YearModel->getYearByInicio($year);

        //verificar se o objeto existe
        if(is_null($data["thread"])){
            $this->load->view('errors/404', $data); return null;
        }

        //verificar se o ano existe
        if(is_null($data["year"])){
            $this->load->view('errors/404', $data); return null;
        }

        //buscar a info sobre o forum
        $data["forum"] = $this->ForumModel->getForumByID($data["thread"]->forum_id);

        //verificar se o objeto associado ao forum existe
        if(is_null($data["forum"])){
            $this->load->view('errors/404', $data); return null;
        }

        //buscar a info sobre o codigo do curso
        $data["subject"] = $this->SubjectModel->getSubjectByID($data["forum"]->cadeira_id);

        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/thread',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }
    }

    //      aplus.com/foruns/new/:subject_code/:year
    public function new($subject_code, $year)
    {
        $data["base_url"] = base_url();
        $this->load->model("CourseModel");
        $this->load->model("YearModel");
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o codigo do curso
        $data["subject"] = $this->SubjectModel->getSubjectByCode($subject_code);

        //buscar o year
        $data["year"] = $this->YearModel->getYearByInicio($year);

        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        //verificar se o ano existe
        if(is_null($data["year"])){
            $this->load->view('errors/404', $data); return null;
        }

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/forum_new',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }
    }

    //      aplus.com/foruns/forum/:forum_id/:year
    public function forum($forum_id, $year)
    {
        $data["base_url"] = base_url();
        $this->load->model("CourseModel");
        $this->load->model("YearModel");
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o forum
        $data["forum"] = $this->ForumModel->getForumByID($forum_id);

        //buscar o year
        $data["year"] = $this->YearModel->getYearByInicio($year);

        //verificar se o objeto associado ao forum existe
        if(is_null($data["forum"])){
            $this->load->view('errors/404', $data); return null;
        }

        //verificar se o ano existe
        if(is_null($data["year"])){
            $this->load->view('errors/404', $data); return null;
        }

        //buscar a info sobre o codigo do curso
        $data["subject"] = $this->SubjectModel->getSubjectByID($data["forum"]->cadeira_id);
    
        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/forum',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }
    }

}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('SubjectModel');
    }

    //      Página que mostra todas as cadeiras de um user:
    //      aplus.com/subjects/
    public function index()
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/subjects', $data); break;
            case 'teacher': $this->load->view('teacher/subjects_prof', $data); break;
            case 'admin':   $this->load->view('admin/subjects', $data); break;
        }

        $this->load->view('templates/footer');       
    }

    //      Página de cadeira:
    //      aplus.com/subject/subject/:subject_code
    public function subject($subject_code = '')
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o objeto
        $data["subject"] = $this->SubjectModel->getSubjectByCode($subject_code);

        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/subject', $data); break;
            case 'teacher': $this->load->view('teacher/subject', $data); break;
            case 'admin':   $this->load->view('admin/subject', $data); break;
        }

        $this->load->view('templates/footer');       
    }
}


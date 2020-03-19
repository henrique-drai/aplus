<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CourseModel');
    }

    //      Página que mostra todas as cadeiras de um user:
    //      aplus.com/courses/
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
            case 'student': $this->load->view('student/courses', $data); break;
            case 'teacher': $this->load->view('teacher/courses_prof', $data); break;
            case 'admin':   $this->load->view('admin/courses', $data); break;
        }

        $this->load->view('templates/footer');       
    }

    //      Página de cadeira:
    //      aplus.com/courses/course/:course_code
    public function course($course_code = '')
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o objeto
        $data["course"] = $this->CourseModel->getCourseByCode($course_code);

        //verificar se o objeto existe
        if(is_null($data["course"])){
            $this->load->view('errors/404', $data); return null;
        }

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/course', $data); break;
            case 'teacher': $this->load->view('teacher/course', $data); break;
            case 'admin':   $this->load->view('admin/course', $data); break;
        }

        $this->load->view('templates/footer');       
    }
}


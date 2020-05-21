<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('SubjectModel');
        $this->load->model('StudentListModel');

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
    //      aplus.com/subjects/subject/:subject_code/:year
    public function subject($subject_code = '', $year = null)
    {
        $data["base_url"] = base_url();

        $this->load->model('YearModel');
        $this->load->model('CourseModel');
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //verificar se o ano letivo existe e é valido
        $ano_letivo = $this->YearModel->getYearByInicio($year);

        if(is_null($ano_letivo)){
            $this->load->view('errors/404', $data); return null;
        }

        //usar ano letivo na query para ir buscar a cadeira cujo code = subject code
        //  e cujo o ano_letivo_id = ao get ano_letivo_id do curso respetivo

        $data["subject"] = $this->SubjectModel->getSubjectByCodeAndYear($subject_code, $ano_letivo->id);

        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        $data["year"] = $year;

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/subject', $data); break;
            case 'teacher': $this->load->view('teacher/subject', $data); break;
            case 'admin':   $this->load->view('admin/subject', $data); break;
        }

        $this->load->view('templates/footer');       
    }

    //      aplus.com/subject/students/:subject_code/:year
    public function students($subject_code = '', $year = null)
    {
        $data["base_url"] = base_url();
        $this->load->model('YearModel');
        $this->load->model('CourseModel');
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //verificar se o ano letivo existe e é valido
        $ano_letivo = $this->YearModel->getYearByInicio($year);

        if(is_null($ano_letivo)){
            $this->load->view('errors/404', $data); return null;
        }

        //usar ano letivo na query para ir buscar a cadeira cujo code = subject code
        //  e cujo o ano_letivo_id = ao get ano_letivo_id do curso respetivo

        $data["subject"] = $this->SubjectModel->getSubjectByCodeAndYear($subject_code, $ano_letivo->id);

        //verificar se o objeto existe
        if(is_null($data["subject"])){ 
            $this->load->view('errors/404', $data); return null;
        }

        $data["year"] = $year;

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/subject', $data); break;
            case 'teacher': $this->load->view('teacher/studentsList', $data); break;
            case 'admin':   $this->load->view('admin/subject', $data); break;
        }

        $this->load->view('templates/footer');       
    }

    //      aplus.com/subject/ficheiros/:subject_code/:year
    public function ficheiros($subject_code = '', $year = null)
    {
        $data["base_url"] = base_url();

        $this->load->model('YearModel');
        $this->load->model('CourseModel');
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //verificar se o ano letivo existe e é valido
        $ano_letivo = $this->YearModel->getYearByInicio($year);

        if(is_null($ano_letivo)){
            $this->load->view('errors/404', $data); return null;
        }

        //usar ano letivo na query para ir buscar a cadeira cujo code = subject code
        //  e cujo o ano_letivo_id = ao get ano_letivo_id do curso respetivo

        $data["subject"] = $this->SubjectModel->getSubjectByCodeAndYear($subject_code, $ano_letivo->id);

        //verificar se o objeto existe
        if(is_null($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        $data["year"] = $year;

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/ficheiros-cadeira', $data); break;
            case 'teacher': $this->load->view('teacher/ficheiros-cadeira', $data); break;
        }

        $this->load->view('templates/footer');       
    }

}


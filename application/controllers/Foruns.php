<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Foruns extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ForumModel');
        $this->load->model('SubjectModel');
        $this->load->model("CourseModel");
        $this->load->model("YearModel");
    }

    //      aplus.com/foruns/thread/:thread_id
    public function thread($thread_id)
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre a thread
        $data["thread"] = $this->ForumModel->getThreadByID($thread_id);

        //verificar se o objeto existe
        if(is_null($data["thread"])){
            $this->load->view('errors/404', $data); return null;
        }

        $forum = $this->ForumModel->getForumByID($data["thread"]->forum_id);
        $subject = $this->SubjectModel->getSubjectByID($forum->cadeira_id);
        $course = $this->CourseModel->getCursobyId($subject->curso_id);
        $data["year"] = $this->YearModel->getYearById($course->ano_letivo_id);

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

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('forum/thread', $data); break;
            case 'teacher': $this->load->view('forum/thread', $data); break;
        
            default: $this->load->view('errors/403', $data); return null;
        }

        $this->load->view('templates/footer');   
    }

    //      aplus.com/foruns/new/:subject_code/:year
    public function new($subject_code, $year=null)
    {
        $data["base_url"] = base_url();
        
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

        if ($this->session->userdata('role') == 'teacher'){
            $this->load->view('templates/head', $data);
            $this->load->view('teacher/forum_new',$data);
            $this->load->view('templates/footer');  
        } else {
            $this->load->view('errors/403', $data); return null;
        }
    }

    //      aplus.com/foruns/forum/:forum_id
    public function forum($forum_id)
    {
        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        //buscar a info sobre o forum
        $data["forum"] = $this->ForumModel->getForumByID($forum_id);

        //verificar se o objeto associado ao forum existe
        if(is_null($data["forum"])){
            $this->load->view('errors/404', $data); return null;
        }

        $subject = $this->SubjectModel->getSubjectByID($data["forum"]->cadeira_id);
        $course = $this->CourseModel->getCursobyId($subject->curso_id);
        $data["year"] = $this->YearModel->getYearById($course->ano_letivo_id);

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

        $this->load->view('templates/head', $data);

        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('forum/forum', $data); break;
            case 'teacher': $this->load->view('forum/forum', $data); break;
        
            default: $this->load->view('errors/403', $data); return null;
        }

        $this->load->view('templates/footer'); 
    }

}
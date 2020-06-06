<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    //app/
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
            case 'student': $this->load->view('student/home', $data); break;
            case 'teacher': $this->load->view('teacher/home', $data); break;
            case 'admin':   $this->load->view('admin/home', $data); break;
        }

        $this->load->view('templates/footer');       
    }   

    //app/student
    public function student($page = 'home')
    {
        if (! file_exists(APPPATH.'views/student/'.$page.'.php')){show_404();}

        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->view('templates/head', $data);
        $this->load->view('student/'.$page, $data);
        $this->load->view('templates/footer');
    }

    //app/teacher
    public function teacher($page = 'home')
    {
        if (! file_exists(APPPATH.'views/teacher/'.$page.'.php')){show_404();}

        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->view('templates/head', $data);
        $this->load->view('teacher/'.$page, $data);
        $this->load->view('templates/footer');
    }

    //app/students
    public function students($page = 'home') {

        $data["base_url"] = base_url();

        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->view('templates/head', $data);
        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role') == 'teacher') {
            case true:  $this->load->view('teacher/' .$page, $data); break;
            case false: $this->load->view('admin/' .$page, $data); break;
        }
        $this->load->view('templates/footer');
    }

    //app/grupo/:grupoid - done
    public function grupo($grupo_id = null){
        $this->load->model('GroupModel');

        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403'); return null;
        }
        
        //verificar se o grupo id está vazio ou se o grupo nao existe - usar get grupo by id
        $grupos = $this->GroupModel->getGroupById($grupo_id);

        if(empty($grupos)){$this->load->view('errors/404'); return null;}

        $grupo = $grupos[0];

        $data["base_url"] = base_url();
        $data["grupo"] = $grupo;
        $data["info"] = $this->GroupModel->getProjectAndSubjectInfo($grupo_id);

        if($this->session->userdata('role') == "student"){
            $this->load->view('templates/head');
            $this->load->view('student/grupo', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('errors/403'); return null;
        }
    }

    //app/rating/:grupoid
    public function rating($grupo_id = null){
        $data["base_url"] = base_url();

        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->model('GroupModel');
        //verificar se o grupo id é null - usar get grupo by id

        $data["grupo"] = $this->GroupModel->getGroupById($grupo_id);

        if(empty($data["grupo"])){
            $this->load->view('errors/404', $data); return null;
        }

        $this->load->view('templates/head', $data);
        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/memberRtg', $data); break;
        }
        $this->load->view('templates/footer');
    }

    
    //app/ficheiros/:grupoid
    public function ficheiros($grupo_id = null){
        $data["base_url"] = base_url();

        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->model('GroupModel');
        //verificar se o grupo id é null - usar get grupo by id

        $data["grupo"] = $this->GroupModel->getGroupById($grupo_id);

        if(empty($data["grupo"])){
            $this->load->view('errors/404', $data); return null;
        }

        $this->load->view('templates/head', $data);
        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'student': $this->load->view('student/ficheiros-grupo', $data); break;
        }
        $this->load->view('templates/footer');
    }


    //app/admin
    public function admin($page = 'home')
    {
        if (! file_exists(APPPATH.'views/admin/'.$page.'.php')){show_404();}

        $data["base_url"] = base_url();
        
        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->view('templates/head', $data);
        $this->load->view('admin/'.$page, $data);
        $this->load->view('templates/footer');
    }

     //app/adminsubject/:subjectid
     public function adminsubject($subject_id = null){
        $data["base_url"] = base_url();

        //verificar se a pessoa fez login
        if(is_null($this->session->userdata('role'))){
            $this->load->view('errors/403', $data); return null;
        }

        $this->load->model('SubjectModel');
        //verificar se o grupo id é null - usar get grupo by id

        $data["subject"] = $this->SubjectModel->getSubjectByID($subject_id);

        if(empty($data["subject"])){
            $this->load->view('errors/404', $data); return null;
        }

        $this->load->view('templates/head', $data);
        //escolher que página deve ser mostrada
        switch ($this->session->userdata('role')) {
            case 'admin': $this->load->view('admin/subject', $data); break;
        }
        $this->load->view('templates/footer');
    }


    //app/profile/:user_id
    public function profile($user_id = null)
    {
        $data["base_url"] = base_url();
        
        //verificar foi dado algum parâmetro
        if(is_null($user_id)) {
            $this->load->view('errors/404', $data); return null;}

        $this->load->model('UserModel');
        
        $data["user"] = $this->UserModel->getUserById($user_id);
        
        //verificar se o user existe
        if(is_null($data["user"])){
            $this->load->view('errors/404', $data); return null;}

        $this->load->helper('form');

        $this->load->view('templates/head', $data);
        //escolher que página deve ser mostrada
        switch ($this->session->userdata('id') == $user_id) {
            case true:  $this->load->view('app/profile_edit', $data); break;
            case false: $this->load->view('app/profile_show', $data); break;
        }
        $this->load->view('templates/footer');
    }

    public function uploadProfilePic()
    {
        $user_id = $this->session->userdata('id');
        $upload['upload_path'] = './uploads/profile/';
        $upload['allowed_types'] = 'jpg';
        $upload['file_name'] = $user_id;
        $upload['overwrite'] = true;

        $this->load->library('upload', $upload);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
            //print_r($error);
            header("Location: ".base_url()."app/profile/".$user_id);
        }
        else
        {
            header("Location: ".base_url()."app/profile/".$user_id);
        }
    }

    //app/chat/:chat_id
    public function chat($chatType=null, $user_id = null){
        $our_id = $this->session->userdata('id');

        $this->load->model('UserModel');
        $this->load->model('GroupModel');

        $data["base_url"] = base_url();
        
        if($chatType=="p"){
            $data["chatType"]=$chatType;
            if($this->UserModel->isValidUser($user_id)){
                $data["user_id"] = $user_id;
            }
        }
        if($chatType=="g"){
            $data["chatType"]=$chatType;
            if($this->GroupModel->isValidGroup($user_id,$our_id)){
                $data["user_id"] = $user_id;
            }
        } 
        
        $this->load->view('templates/head', $data);

        $this->load->view('app/private_chat', $data);

        $this->load->view('templates/footer');
    }









    //app/notifications
    public function notifications()
    {
        $data["base_url"] = base_url();

        $this->load->view('templates/head', $data);
        $this->load->view('app/notifications', $data); 
        $this->load->view('templates/footer');
    }
}


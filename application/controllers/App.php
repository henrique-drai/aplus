<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function student($page = 'home')
    {
        if (! file_exists(APPPATH.'views/student/'.$page.'.php')){show_404();}

        $data["base_url"] = base_url();

        $this->load->view('templates/head', $data);
        $this->load->view('student/'.$page, $data);
        $this->load->view('templates/footer');
    }

    public function teacher($page = 'home')
    {
        if (! file_exists(APPPATH.'views/teacher/'.$page.'.php')){show_404();}

        $data["base_url"] = base_url();

        $this->load->view('templates/head', $data);
        $this->load->view('teachert/'.$page, $data);
        $this->load->view('templates/footer');
    }

    public function admin($page = 'home')
    {
        if (! file_exists(APPPATH.'views/admin/'.$page.'.php')){show_404();}

        $data["base_url"] = base_url();

        $this->load->view('templates/head', $data);
        $this->load->view('admin/'.$page, $data);
        $this->load->view('templates/footer');
    }

    public function auth($page = 'home')
    {
        if (! file_exists(APPPATH.'views/auth/'.$page.'.php')){show_404();}

        $data["base_url"] = base_url();

        $this->load->view('templates/head', $data);
        $this->load->view('auth/'.$page, $data);
        $this->load->view('templates/footer');
    }
}


<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        if(is_null($this->session->userdata('role'))){ $this->load->view('errors/403'); }
    }

    public function index() {
        $this->load->view('templates/head');
        $this->load->view('database');
        $this->load->view('templates/footer'); 
    }

    public function small_script() {
        $this->load->model('ScriptModel');
        $this->load->helper('small_script');
        small_script($this->ScriptModel);
        $this->load->helper('large_script');
        large_script($this->ScriptModel);
    }

    public function large_script() {
        $this->load->model('ScriptModel');
        $this->load->helper('large_script');
        large_script($this->ScriptModel);
    }
}
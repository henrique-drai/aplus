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

    public function run() {
        $this->load->model('ScriptModel');
        $this->load->helper('database');
        database($this->ScriptModel);
    }
}
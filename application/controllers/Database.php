<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('url');
        $data["base_url"] = base_url();
        $this->load->view('templates/head', $data);
        $this->load->view('database', $data);
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

    public function smart_script() {
        $this->load->model('SmartModel');
        $this->load->helper('smart_script');
        smart_script($this->SmartModel);
    }
}
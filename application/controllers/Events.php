<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('EventModel');
    }

    //      events/new/ 
    public function new()
    {
        
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ProjectsModel');
    }

    //      projects/
    public function index()
    {
        
    }

    //      projects/new/:course_code
    public function new($course_code)
    {
        
    }

    //      projects/project/:project_id
    public function project($project_id)
    {
        
    }

    //      projects/rating/:project_id
    public function rating($project_id)
    {
        
    }

    //      projects/chat/:project_id
    public function chat($project_id)
    {
        
    }

}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Foruns extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ForumModel');
    }

    //      aplus.com/foruns/thread/:thread_id
    public function thread($thread_id)
    {
        
    }

    //      aplus.com/foruns/forum/:forum_id
    public function forum($forum_id)
    {
        
    }

}
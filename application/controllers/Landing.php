<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url');
        }

	public function index()
	{
                $data["base_url"] = base_url();

                $this->load->view('templates/head', $data);
                $this->load->view('landing', $data);
                $this->load->view('templates/footer');
        }
}
?>
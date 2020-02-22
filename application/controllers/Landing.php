<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index()
	{
                $this->load->view('templates/head');
                $this->load->view('landing');
                $this->load->view('templates/footer');

        // $this->load->database();
        // $query = $this->db->query('SELECT * FROM user');
        // echo json_encode($query->result());
        // $this->load->view('api/users');
	}
}
?>
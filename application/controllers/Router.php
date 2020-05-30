<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Router extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }

  //app/
  public function subjectById($id) {
    $id = htmlspecialchars($id);

    $this->load->model('SubjectModel');
    $result = $this->SubjectModel->getSubjectAndYearById($id);

    header("Location: " . base_url() . "subjects/subject/".$result->code."/".$result->inicio);      
  }   


}


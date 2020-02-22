<?php
class Api extends CI_Controller {

    public function getStudentByEmail($email = '')
    {
        $this->load->model('UserModel');
        echo json_encode($this->UserModel->getUserByEmail($email));
    }

}
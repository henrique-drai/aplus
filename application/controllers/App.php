<?php
class App extends CI_Controller {

    public function student($page = 'home')
    {
        if (! file_exists(APPPATH.'views/student/'.$page.'.php')){show_404();}

        $this->load->view('templates/head');
        $this->load->view('student/'.$page);
        $this->load->view('templates/footer');
    }

}


<?php

class dasbor extends CI_Controller {
    function __construct() {
        parent::__construct();
        if(!$this->autentikasi_model->apakah_login()) {
            redirect("/");
        }
    }
    
    function index() {
        $data['title'] = "Selamat Datang";
        $data['view'] = "welcome";
        $this->load->view("template_dasbor", $data);
    }
    
}
?>

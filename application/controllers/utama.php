<?php
class utama extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        // Cek apakah dia sudah login atau belum
        if($this->autentikasi_model->apakah_login()) {
            // Redirect ke halaman dasbor
            redirect("/dasbor");
        } else {
            // Redirect ke halaman login
            redirect("/login");
        }
    }
    
    
}
?>

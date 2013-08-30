<?php
class login extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
        // Kalau sudah login, tidak perlu menampilkan halaman login, langsung bawa ke dasbor (via utama)
        if($this->autentikasi_model->apakah_login()) {
            redirect("/");
        } else {
            // Tampilkan halaman login
            $this->load->view("template_login");
        }
    }
    
    function do_login() {
        // Lakukan proses validasi data
        
        $userid = $this->input->post("userid");
        $password = $this->input->post("password");
        
        $this->form_validation->set_rules("userid", "Nama Login", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_message("required", "%s belum diisi");
        $this->form_validation->set_error_delimiters("","<br/>");
        
        
        if($this->form_validation->run() == TRUE) {
            // Lakukan proses login dan lihat hasilnya
            $result = $this->autentikasi_model->lakukan_login($userid, $password);
            if($result == TRUE) {
                $data['hasil'] = TRUE;
            } else {
                $data['hasil'] = FALSE; 
                if($this->autentikasi_model->apakah_batas_login()) {
                   $data['pesan'] = "Batas login terpenuhi, silahkan mencoba beberapa saat lagi.";
                } else {
                    $data['pesan'] = "Nama login atau password salah<br/>Percobaan login ke-" . $this->autentikasi_model->lihat_jumlah_batas_login();

                }
            }
        } else {
            $data['hasil'] = FALSE;
            $data['pesan'] = validation_errors();
        }
        
        if($this->input->is_ajax_request()) {
            echo json_encode($data);
        } else {
            redirect("/");
        }
    }
    
    function do_logout() {
        
        $this->autentikasi_model->lakukan_logout();
        redirect("/");
    }
}
?>

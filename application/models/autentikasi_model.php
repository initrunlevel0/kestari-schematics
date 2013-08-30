<?php
class autentikasi_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function apakah_admin($userid, $password) {
        $password_tergaram = md5($password . strrev($password));
        $query = $this->db->get_where("admin", array("userid" => $userid, "password" => $password_tergaram));
        if($query->num_rows() == 1) {
            return TRUE;
        }
        
        return FALSE;
    }
    
    function apakah_login() {
       if($this->session->userdata("userid") && $this->session->userdata("secretkey")) {
           if($this->session->userdata("secretkey") == "novandiemanggantenggituloch") {
               return true;
           }
       }
       
       return false;
    }
    
    function ambil_nama_login() {
        return $this->session->userdata("userid");
    }
    
    function ganti_sandi($userid, $password) {
        $password_tergaram = md5($password . strrev($password));
        $this->db->where("userid", $userid);
        $this->db->update("admin", array("password" => $password_tergaram));
    }
    
    function lakukan_login($userid, $password) {
        if($this->apakah_admin($userid, $password) && !$this->apakah_batas_login()) {
            $this->session->sess_create();
            $this->session->set_userdata("userid", $userid);
            $this->session->set_userdata("secretkey", "novandiemanggantenggituloch");
            
            return true;
        } else {
            $this->tambahkan_batas_login();
            return false;
        }
    }
    
    function lakukan_logout() {
        $this->session->sess_destroy();
    }
    
    // Batas login
    function apakah_batas_login() {
        if($this->session->userdata("percobaanlogin")) {
            if($this->session->userdata("percobaanlogin") >= 10) {
                return true;
            }
        }
        
        return false;
    }
    
    function tambahkan_batas_login() {
        if($this->session->userdata("percobaanlogin")) {
            $percobaan_login = $this->session->userdata("percobaanlogin") + 1;
            $this->session->set_userdata("percobaanlogin", $percobaan_login);
        } else {
            $this->session->set_userdata("percobaanlogin", 1);
        }
    }
    
    function lihat_jumlah_batas_login() {
        if($this->session->userdata("percobaanlogin")) {
            return $this->session->userdata("percobaanlogin");
        } else {
            return 0;
        }
    }
   
}
?>

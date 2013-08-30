<?php
class nlc extends CI_Controller {
    function __construct() {
        parent::__construct();
        
        if(!$this->autentikasi_model->apakah_login()) {
            redirect("/");
        }
        $this->load->model("item_model");
        $this->load->model("peserta_model");
    }
    function registrasi_peserta() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->_do_registrasi();
        } else {
            $data["title"] = "Registrasi Peserta NLC";
            $data["view"] = "registrasi_nlc";
            $data["tempat_penyisihan"] = $this->item_model->daftar_tempat_penyisihan();
            $data["mode"] = "registrasi";
            $this->load->view("template_dasbor", $data);
        }
       
    }
    
    function _do_registrasi() {
        $hasil = true;
        $pesan = "";
        
        // Ambil data-data yang diperlukan untuk proses pendaftaran ini
        // Data Tim
        
        $nama_tim = $this->input->post("nama_tim");
        $asal_sekolah = $this->input->post("asal_sekolah");
        $tempat_penyisihan = $this->input->post("tempat_penyisihan");
        $password = $this->input->post("password");
        
        // Data Ketua
        $nama_lengkap_ketua = $this->input->post("nama_lengkap_ketua");
        $no_telepon_ketua = $this->input->post("no_telepon_ketua");
        $email_ketua = $this->input->post("email_ketua");
        
        // Data anggota 1
        $nama_lengkap_1 = $this->input->post("nama_lengkap_1");
        $no_telepon_1 = $this->input->post("no_telepon_1");
        $email_1 = $this->input->post("email_1");
        
        // Data anggota 2
        $nama_lengkap_2 = $this->input->post("nama_lengkap_2");
        $no_telepon_2 = $this->input->post("no_telepon_2");
        $email_2 = $this->input->post("email_2");
        
        
        // Proses unggahan berkas
        $config['upload_path'] = "./uploads/nlc";
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "1024";
        $config['overwrite'] = TRUE;
        
        
      
        // Pas Foto Ketua
        $config['file_name'] = $nama_tim . '_foto_ketua.png';
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('foto_ketua_img')) {
            $hasil = false;
            $pesan = "Galat dalam proses pengunggahan berkas";
        }
        
        
        // Pas Foto Anggota 1
        $config['file_name'] = $nama_tim . '_foto_1.png';
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('foto_1_img')) {
            $hasil = false;
            $pesan = "Galat dalam proses pengunggahan berkas";
        }
        
        // Pas Foto Anggota 2
        $config['file_name'] = $nama_tim . '_foto_2.png';
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('foto_2_img')) {
            $hasil = false;
            $pesan = "Galat dalam proses pengunggahan berkas";
        }
        
        
        // Cek kelengkapan form
        $this->form_validation->set_rules("nama_tim", "Nama Tim", "required");
        $this->form_validation->set_rules("asal_sekolah", "Asal Sekolah", "required");
        $this->form_validation->set_rules("tempat_penyisihan", "Tempat Penyisihan", "required");
       
        $this->form_validation->set_rules("password", "Kata Sandi", "required");
        
        $this->form_validation->set_rules("nama_lengkap_ketua", "Nama Lengkap Ketua", "required");
        $this->form_validation->set_rules("no_telepon_ketua", "Nomor Telepon Ketua", "required|callback_notelp_check");
        $this->form_validation->set_rules("email_ketua", "Surel Ketua", "required|callback_email_check");
        
        
        $this->form_validation->set_rules("nama_lengkap_1", "Nama Lengkap Anggota 1", "required");
        $this->form_validation->set_rules("no_telepon_1", "Nomor Telepon Anggota 1", "required|callback_notelp_check");
        $this->form_validation->set_rules("email_1", "Surel Anggota 1", "required|callback_email_check");
       
        
        $this->form_validation->set_rules("nama_lengkap_2", "Nama Lengkap Anggota 2", "required");
        $this->form_validation->set_rules("no_telepon_2", "Nomor Telepon Anggota 2", "required|callback_notelp_check");
        $this->form_validation->set_rules("email_2", "Surel Anggota 2", "required|callback_email_check");
       
        
        $this->form_validation->set_message("required", "%s belum diisi");
        $this->form_validation->set_message("notelp_check", "%s bukan merupakan nomor telepon yang benar");
        $this->form_validation->set_message("email_check", "%s bukan merupakan surel yang benar");
        $this->form_validation->set_error_delimiters("","<br/>");
        
        if($this->form_validation->run() == TRUE && $hasil == TRUE) {
            // Entrikan ke basis data dengan benar. HAHAY!
            $data = array(
                "nama_tim" => $nama_tim,
                "nama_sekolah" => $asal_sekolah,
                "tempat_lomba" => $tempat_penyisihan,
                "nama_ketua" => $nama_lengkap_ketua,
                "no_ketua" => $no_telepon_ketua,
                "email_ketua" => $email_ketua,
                "password" => $password,
                "nama_anggota1" => $nama_lengkap_1,
                "no_anggota1" => $no_telepon_1,
                "email_anggota1" => $email_1,
                "nama_anggota2" => $nama_lengkap_2,
                "no_anggota2" => $no_telepon_2,
                "email_anggota2" => $email_2,
                "bukti" => "Lengkap",
                "foto_1" => base_url("/uploads/nlc/".$nama_tim."_foto_ketua.png"),
                "foto_2" => base_url("/uploads/nlc/".$nama_tim."_foto_1.png"),
                "foto_3" => base_url("/uploads/nlc/".$nama_tim."_foto_2.png"),
                "tanggal_daftar" => date("Y-m-d"),
                "status" => 1
                );
            $this->peserta_model->tambahkan_peserta($data, "nlc");
            $data["no_peserta"] = sprintf('%06d', $this->db->insert_id());
            $data["nama_tim"] = $nama_tim;
            $data["asal_sekolah"] = $asal_sekolah;
            $data["tempat_penyisihan_val"] = $tempat_penyisihan;
            
            $data["nama_lengkap_ketua"] = $nama_lengkap_ketua;
            $data["no_telepon_ketua"] = $no_telepon_ketua;
            $data["email_ketua"] = $email_ketua;
            
            $data["nama_lengkap_1"] = $nama_lengkap_1;
            $data["no_telepon_1"] = $no_telepon_1;
            $data["email_1"] = $email_1;
            
            $data["nama_lengkap_2"] = $nama_lengkap_2;
            $data["no_telepon_2"] = $no_telepon_2;
            $data["email_2"] = $email_2;
            
            $data["title"] = "Pendaftaran Berhasil";
            $data["view"] = "sukses_nlc";
            
            $this->load->view("template_dasbor", $data);
            
        } else {
            $pesan = validation_errors() . $pesan;
            // Kembalikan ke view semula, tampilkan pesan galat dengan baik
            $data["pesan"] = $pesan;
            $data["nama_tim"] = $nama_tim;
            $data["asal_sekolah"] = $asal_sekolah;
            $data["tempat_penyisihan_val"] = $tempat_penyisihan;
            
            $data["nama_lengkap_ketua"] = $nama_lengkap_ketua;
            $data["no_telepon_ketua"] = $no_telepon_ketua;
            $data["email_ketua"] = $email_ketua;
            
            $data["nama_lengkap_1"] = $nama_lengkap_1;
            $data["no_telepon_1"] = $no_telepon_1;
            $data["email_1"] = $email_1;
            
            $data["nama_lengkap_2"] = $nama_lengkap_2;
            $data["no_telepon_2"] = $no_telepon_2;
            $data["email_2"] = $email_2;
                    
            
            
            $data["title"] = "Registrasi Peserta NLC";
            $data["view"] = "registrasi_nlc";
            $data["tempat_penyisihan"] = $this->item_model->daftar_tempat_penyisihan();
            $data["mode"] = "registrasi";
            $this->load->view("template_dasbor", $data);
        }
        
    }
    
    public function notelp_check($str) {
        $notelp_regex = "/^\d+/";
        if(preg_match($notelp_regex, $str) == 1) {
            return TRUE;
        }
        return FALSE;
        
    }
    
    public function email_check($str) {
        $email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        if(preg_match($email_regex, $str) == 1) {
            return TRUE;
        }
        return FALSE;
        
    }
    
    function verifikasi_peserta() {
        $data['peserta_belum_terverifikasi'] = $this->peserta_model->daftar_peserta_belum_diverifikasi("nlc");
        $data['title'] = "Verifikasikan Peserta";
        $data['view'] = "verifikasi_peserta_nlc";
        $this->load->view("template_dasbor", $data);
    }
    
    function do_verifikasi_peserta() {
        $id = $this->input->post("id");
        $this->peserta_model->verifikasikan_peserta($id, "nlc");
    }
    
    function lihat_peserta() {
        $data['peserta_semua'] = $this->peserta_model->daftar_peserta("nlc");
        $data['title'] = "Data Peserta";
        $data['view'] = "daftar_peserta_nlc";
        $this->load->view("template_dasbor", $data);
    }
    
    function detail_peserta() {
        $id = $this->input->get("id");
        if(!$id) {
            redirect("/nlc/lihat_peserta");
        }
        
        $data['peserta'] = $this->peserta_model->lihat_peserta($id, "nlc");
        $data['title'] = "NLC: Tim ". $data['peserta']['nama_tim'];
        $data['view'] = "detail_peserta";
        $this->load->view("template_dasbor", $data);
    }
    
    function edit_peserta() {
        $id = $this->input->post("id");
        $password = $this->input->post("password");
        
        $data_peserta = $this->peserta_model->lihat_peserta($id, "nlc");
        
        // Verifikasikan apakah password cocok dengan peserta tersebut
        if($password != $data_peserta["password"]) {
            redirect("/nlc/detail_peserta?id=".$id);
            return;
       }
        
        // Tampilkan form registrasi dalam mode "menyunting"
       
        $data['nomor_peserta'] = $id;
        $data['nama_tim'] = $data_peserta['nama_tim'];
        $data['asal_sekolah'] = $data_peserta['nama_sekolah'];
        $data['tempat_penyisihan'] = $data_peserta['tempat_lomba'];
        $data['password'] = $data_peserta['password'];
        
        $data['nama_lengkap_ketua'] = $data_peserta['nama_ketua'];
        $data['no_telepon_ketua'] = $data_peserta['no_ketua'];
        $data['email_ketua'] = $data_peserta['email_ketua'];
        $data['foto_ketua_img'] = $data_peserta['foto_1'];
        
        $data['nama_lengkap_1'] = $data_peserta['nama_anggota1'];
        $data['no_telepon_1'] = $data_peserta['no_anggota1'];
        $data['email_1'] = $data_peserta['email_anggota1'];
        $data['foto_1_img'] = $data_peserta['foto_2'];
        
        $data['nama_lengkap_2'] = $data_peserta['nama_anggota2'];
        $data['no_telepon_2'] = $data_peserta['no_anggota2'];
        $data['email_2'] = $data_peserta['email_anggota2'];
        $data['foto_2_img'] = $data_peserta['foto_3'];
        
        $data["title"] = "Sunting data tim";
        $data["mode"] = "menyunting";
        $data["view"] = "registrasi_nlc";
        $data["tempat_penyisihan"] = $this->item_model->daftar_tempat_penyisihan();
        $this->load->view("template_dasbor", $data);
        
    }
    
    function do_sunting() {
        // KODE DIAMBIL DARI FUNGSI do_registrasi()
        $hasil = true;
        $pesan = "";
        
        // Ambil data-data yang diperlukan untuk proses penyuntingan
        // Data Tim
        $nomor_peserta = $this->input->post("nomor_peserta");
        $nama_tim = $this->input->post("nama_tim");
        $asal_sekolah = $this->input->post("asal_sekolah");
        $tempat_penyisihan = $this->input->post("tempat_penyisihan");
        $password = $this->input->post("password");
        
        // Data Ketua
        $nama_lengkap_ketua = $this->input->post("nama_lengkap_ketua");
        $no_telepon_ketua = $this->input->post("no_telepon_ketua");
        $email_ketua = $this->input->post("email_ketua");
        
        // Data anggota 1
        $nama_lengkap_1 = $this->input->post("nama_lengkap_1");
        $no_telepon_1 = $this->input->post("no_telepon_1");
        $email_1 = $this->input->post("email_1");
        
        // Data anggota 2
        $nama_lengkap_2 = $this->input->post("nama_lengkap_2");
        $no_telepon_2 = $this->input->post("no_telepon_2");
        $email_2 = $this->input->post("email_2");
        
        
        // Proses unggahan berkas
        $config['upload_path'] = "./uploads/nlc";
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "1024";
        $config['overwrite'] = TRUE;
        
        
      
        // Pas Foto Ketua
        // Cek dulu apakah berkas sudah didefinisikan
        if(!empty($_FILES['foto_ketua_img']['name'])) {
            $config['file_name'] = $nama_tim . '_foto_ketua.png';
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('foto_ketua_img')) {
                $hasil = false;
                $pesan = "Galat dalam proses pengunggahan berkas";
            }
        } 
        
        
        
        // Pas Foto Anggota 1
        // Cek dulu apakah berkas sudah didefinisikan
        if(!empty($_FILES['foto_1_img']['name'])) {
            $config['file_name'] = $nama_tim . '_foto_1.png';
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('foto_1_img')) {
                $hasil = false;
                $pesan = "Galat dalam proses pengunggahan berkas";
            }
        }
        
        // Pas Foto Anggota 2
        // Cek dulu apakah berkas sudah didefinisikan
        if(!empty($_FILES['foto_2_img']['name'])) {
            $config['file_name'] = $nama_tim . '_foto_2.png';
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('foto_2_img')) {
                $hasil = false;
                $pesan = "Galat dalam proses pengunggahan berkas";
            }
        }
        
        
        // Cek kelengkapan form
        $this->form_validation->set_rules("nama_tim", "Nama Tim", "required");
        $this->form_validation->set_rules("asal_sekolah", "Asal Sekolah", "required");
        $this->form_validation->set_rules("tempat_penyisihan", "Tempat Penyisihan", "required");
       
        $this->form_validation->set_rules("password", "Kata Sandi", "required");
        
        $this->form_validation->set_rules("nama_lengkap_ketua", "Nama Lengkap Ketua", "required");
        $this->form_validation->set_rules("no_telepon_ketua", "Nomor Telepon Ketua", "required|callback_notelp_check");
        $this->form_validation->set_rules("email_ketua", "Surel Ketua", "required|callback_email_check");
        
        
        $this->form_validation->set_rules("nama_lengkap_1", "Nama Lengkap Anggota 1", "required");
        $this->form_validation->set_rules("no_telepon_1", "Nomor Telepon Anggota 1", "required|callback_notelp_check");
        $this->form_validation->set_rules("email_1", "Surel Anggota 1", "required|callback_email_check");
       
        
        $this->form_validation->set_rules("nama_lengkap_2", "Nama Lengkap Anggota 2", "required");
        $this->form_validation->set_rules("no_telepon_2", "Nomor Telepon Anggota 2", "required|callback_notelp_check");
        $this->form_validation->set_rules("email_2", "Surel Anggota 2", "required|callback_email_check");
       
        
        $this->form_validation->set_message("required", "%s belum diisi");
        $this->form_validation->set_message("notelp_check", "%s bukan merupakan nomor telepon yang benar");
        $this->form_validation->set_message("email_check", "%s bukan merupakan surel yang benar");
        $this->form_validation->set_error_delimiters("","<br/>");
        
        if($this->form_validation->run() == TRUE && $hasil == TRUE) {
            // Entrikan ke basis data dengan benar. HAHAY!
            $data = array(
                "nama_tim" => $nama_tim,
                "nama_sekolah" => $asal_sekolah,
                "tempat_lomba" => $tempat_penyisihan,
                "nama_ketua" => $nama_lengkap_ketua,
                "no_ketua" => $no_telepon_ketua,
                "email_ketua" => $email_ketua,
                "password" => $password,
                "nama_anggota1" => $nama_lengkap_1,
                "no_anggota1" => $no_telepon_1,
                "email_anggota1" => $email_1,
                "nama_anggota2" => $nama_lengkap_2,
                "no_anggota2" => $no_telepon_2,
                "email_anggota2" => $email_2,
                "bukti" => "Lengkap",
                
                "foto_2" => base_url("/uploads/nlc/".$nama_tim."_foto_1.png"),
                "foto_3" => base_url("/uploads/nlc/".$nama_tim."_foto_2.png"),
                "tanggal_daftar" => date("Y-m-d"),
                "status" => 1
                );
            
            if(!empty($_FILES['foto_ketua_img']['name'])) {
                $data["foto_1"] = base_url("/uploads/nlc/".$nama_tim."_foto_ketua.png");
            }
            
            if(!empty($_FILES['foto_1_img']['name'])) {
                $data["foto_2"] = base_url("/uploads/nlc/".$nama_tim."_foto_1.png");
            }
            
            if(!empty($_FILES['foto_2_img']['name'])) {
                $data["foto_3"] = base_url("/uploads/nlc/".$nama_tim."_foto_2.png");
            }
            
            $this->peserta_model->sunting_peserta($nomor_peserta, $data, "nlc");
            redirect('/nlc/detail_peserta?id'.$nomor_peserta);
            
        } else {
            $pesan = validation_errors() . $pesan;
            // Kembalikan ke view semula, tampilkan pesan galat dengan baik
            $data["pesan"] = $pesan;
            $data["nama_tim"] = $nama_tim;
            $data["asal_sekolah"] = $asal_sekolah;
            $data["tempat_penyisihan_val"] = $tempat_penyisihan;
            $data["password"] = $password;
            
            $data["nama_lengkap_ketua"] = $nama_lengkap_ketua;
            $data["no_telepon_ketua"] = $no_telepon_ketua;
            $data["email_ketua"] = $email_ketua;
            
            $data["nama_lengkap_1"] = $nama_lengkap_1;
            $data["no_telepon_1"] = $no_telepon_1;
            $data["email_1"] = $email_1;
            
            $data["nama_lengkap_2"] = $nama_lengkap_2;
            $data["no_telepon_2"] = $no_telepon_2;
            $data["email_2"] = $email_2;
                    
            
            
            $data["title"] = "Sunting data tim";
            $data["mode"] = "menyunting";
            $data["view"] = "registrasi_nlc";
            $data["tempat_penyisihan"] = $this->item_model->daftar_tempat_penyisihan();
            $this->load->view("template_dasbor", $data);
        }
        
    }
}
?>

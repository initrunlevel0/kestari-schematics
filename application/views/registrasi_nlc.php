<p>
    <?php if($mode == "registrasi") { ?>
    Pada halaman ini, Anda dapat mendaftarkan secara langsung peserta NLC yang terdaftar secara daring (offline).
    Peserta akan secara otomatis dianggap terverifikasi.
    <?php } else { ?>
    Pada halaman ini, Anda dapat menyunting data dari Tim <?php printf("%06d", $nomor_peserta); ?>.
    <?php } ?>
</p>
<?php if ($mode == "registrasi") { ?>
<form method="POST" action="" enctype="multipart/form-data">
<?php } else { ?>
<form method="POST" action="<?php echo site_url("nlc/do_sunting"); ?>" enctype="multipart/form-data">
<?php } ?>
    <div class="alert alert-error <?php if(!isset($pesan)) echo 'hide'; ?>" id="info-pendaftaran">
        <?php if(isset($pesan)) echo $pesan; ?>
    </div>
    <div class="page-header">
        <strong>Data tim</strong>
    </div>
    <?php if ($mode == "menyunting") { ?>
    <input type="hidden" name="nomor_peserta" value="<?php echo $nomor_peserta; ?>" />
    <?php } ?>
    <label>Nama Tim</label><input type="text" name="nama_tim" width="40" value="<?php if(isset($nama_tim)) echo $nama_tim ;?>"/>
    <label>Asal Sekolah</label><input type="text" name="asal_sekolah" width="40" value="<?php if(isset($asal_sekolah)) echo $asal_sekolah ;?>" />
    <label>Tempat Penyisihan</label>
    <select name="tempat_penyisihan">
        <?php foreach($tempat_penyisihan as $data) { ?>
        <option value="<?php echo $data['ket']; ?>" <?php if(isset($tempat_penyisihan_val)) if($tempat_penyisihan_val == $data['ket']) echo 'selected'; ?>><?php echo $data['ket']; ?></option>
        <?php } ?>
    </select>
    <label>Kata Sandi</label>
    <input type="text" name="password" id="password" value="<?php if(isset($password)) echo $password ;?>"/><br/><input type="button" class="btn" id="buat_password" value="Buat Kata Sandi Otomatis" />
    
    <div class="page-header">
        <strong>Data ketua</strong>
    </div>
    <label>Nama Lengkap</label><input type="text" name="nama_lengkap_ketua" value="<?php if(isset($nama_lengkap_ketua)) echo $nama_lengkap_ketua ;?>" />
    <label>Nomor Telepon</label><input type="text" name="no_telepon_ketua" value="<?php if(isset($no_telepon_ketua)) echo $no_telepon_ketua ;?>"/>
    <label>Surel</label><input type="text" name="email_ketua" value="<?php if(isset($email_ketua)) echo $email_ketua ;?>" />
    <label>Pas Foto</label><input type="file" name="foto_ketua_img" />
    <?php if($mode == "menyunting") { ?>
    <div class="thumbnail">
        <img src="<?php echo $foto_ketua_img; ?>" />
    </div>
    <?php } ?>
    
    
    <div class="page-header">
        <strong>Data anggota 1</strong>
    </div>
    <label>Nama Lengkap</label><input type="text" name="nama_lengkap_1"  value="<?php if(isset($nama_lengkap_1)) echo $nama_lengkap_1 ;?>"/>
    <label>Nomor Telepon</label><input type="text" name="no_telepon_1" value="<?php if(isset($no_telepon_1)) echo $no_telepon_1 ;?>"/>
    <label>Surel</label><input type="text" name="email_1" value="<?php if(isset($email_1)) echo $email_1 ;?>" />
    <label>Pas Foto</label><input type="file" name="foto_1_img" />
   <?php if($mode == "menyunting") { ?>
    <div class="thumbnail">
        <img src="<?php echo $foto_1_img; ?>" />
    </div>
    <?php } ?>
    
    <div class="page-header">
        <strong>Data anggota 2</strong>
    </div>
    <label>Nama Lengkap</label><input type="text" name="nama_lengkap_2" value="<?php if(isset($nama_lengkap_2)) echo $nama_lengkap_2 ;?>"/>
    <label>Nomor Telepon</label><input type="text" name="no_telepon_2" value="<?php if(isset($no_telepon_2)) echo $no_telepon_2 ;?>" />
    <label>Surel</label><input type="text" name="email_2" value="<?php if(isset($email_2)) echo $email_2 ;?>"/>
    <label>Pas Foto</label><input type="file" name="foto_2_img" />
    <?php if($mode == "menyunting") { ?>
    <div class="thumbnail">
        <img src="<?php echo $foto_2_img; ?>" />
    </div>
    <?php } ?>
    <br/>
    <div class="page-header">
        <strong>Proses Pendaftaran</strong>
    </div>
    
    <?php if($mode == "menyunting") { ?>
    <input type="submit" class="btn" value="Simpan Pembaharuan" id="submit" />
    <?php } else { ?>
    <p>Periksa kembali kebenaran data diatas, pastikan semua telah terisi dengan baik dan benar.</p>
    <p><strong>Berkas gambar yang diunggah harus berukuran dibawah 100 KB dan harus memiliki format gif/jpg/jpeg/png</strong></p>
    <input type="submit" class="btn" value="Proses Pendaftaran" id="submit" />
    <?php } ?>
</form>
<script>
    function check_form() {
        var count = 0;
        <?php if($mode == "menyunting") { ?>
        $("input[type!='file']").each(function(i) {
        <?php } else { ?>
        $("input").each(function(i) {        
        <?php } ?>
            
            if($(this).val() === "") {
                $("#submit").hide();
                count++;
            }
            
             
        });
        if(count === 0) {
            $("#submit").show();
            return true;
        } else {
            return false;
        }
    }
    $(document).ready(function() {
        $("#buat_password").click(function () {
            var char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var password = "";
            for(var i = 0; i < 6; i++ ) {
                password += char.charAt(Math.floor(Math.random() * char.length));
            }

            $("#password").val(password);
        });
        <?php if(!isset($password)) { ?>
        $("#buat_password").trigger("click");
        <?php } ?>
        $("input").change(function() {
            check_form();
        });
        
        $("form").submit(function() {
           //return check_form(); 
        });
        
        check_form();
    });
    
</script>

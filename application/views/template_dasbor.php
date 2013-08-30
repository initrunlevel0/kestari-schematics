<!DOCTYPE html>
<html lang="id">
    <head>
        <title>Kestari Schematics</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url("/assets/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("/assets/css/login.css"); ?>" rel="stylesheet" media="screen">
    </head>
    
    <body>
        
        
        <div class="container">
            <div class="navbar navbar-static-top navbar-inverse">
                <div class="navbar-inner">
                    <a class="brand" href="#">Kestari Schematics 2013</a>
                    <p class="navbar-text">Anda masuk sebagai <?php echo $this->autentikasi_model->ambil_nama_login(); ?> (<a href="<?php echo site_url("login/do_logout"); ?>">Keluar</a>)</p>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span3">
                    <div class="well">
                        <ul class="nav nav-list">
                            <li class="nav-header">NLC</li>
                            <li><a href="<?php echo site_url('/nlc/registrasi_peserta'); ?>">Registrasi Peserta</a></li>
                            <li><a href="<?php echo site_url('/nlc/verifikasi_peserta'); ?>">Verifikasi Peserta</a></li>
                            <li><a href="#">Ekspor data</a></li>
                            <li><a href="<?php echo site_url('/nlc/lihat_peserta'); ?>">Lihat peserta terverifikasi</a></li>
                            

                        </ul>
                    </div>
                </div>
                <div class="span7">
                    <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
                    <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>
                    <div class="page-header">
                        <h1><?php echo $title;?></h1>
                    </div>
                    <?php $this->load->view($view); ?>
                    
                </div>
                <div class="span2">
                    <img src="<?php echo base_url('/assets/img/novandi.png'); ?>">
                                
                    <strong>Mohon Perhatian</strong>
                    <p>Karena sistem ini masih uji coba, jadi jika ada masalah, laporkan bug nya ke Tim Web Schematics ya. Makasih<br/>-- Novandi</p>
                </div>
            </div>
        </div>
        
        
    </body>
</html>

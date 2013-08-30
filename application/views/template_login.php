<!DOCTYPE html>
<html lang="id">
    <head>
        <title>Masuk Kestari Schematics</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>" rel="stylesheet" media="screen">
        <link href="<?php echo base_url("/assets/css/bootstrap-responsive.css"); ?>" rel="stylesheet">
        <link href="<?php echo base_url("/assets/css/login.css"); ?>" rel="stylesheet" media="screen">
    </head>
    
    <body>
        
        <div class="container">
            
            <div id="login">
                <div class="row-fluid">
                    <div class="span8">
                        <div class="hero-unit">
                            <div class="row-fluid">
                                <div class="span3">
                                    <img src="<?php echo base_url('/assets/img/novandi.png'); ?>">
                                </div>
                                <div class="span9">
                                <h2>Selamat datang anak buahku</h2>
                                <p>Silahkan kawan-kawan, bersenang-senanglah!</p>
                                </div>
                            </div>
                    
                        </div>
                    </div>
                    <div class="span4">
                        <form class="well" method="POST" action="<?php echo site_url('/login/do_login'); ?>">
                            
                            <h2>Form masuk</h2>
                            <div class="alert hide" id="info-login">
                                
                            </div>
                            <label>Nama akun</label><input type="text" name="userid" />
                            <label>Kata Sandi</label><input type="password" name="password" /> <br/>
                            <input type="submit" value="Masuk" class="btn" />
                            
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
        <script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>
        <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>
        <script>
            $("form").submit(function() {
                $("#info-login").removeClass("alert-error");
                $("#info-login").fadeIn(100);
                $("#info-login").html("Memproses login...");
                $.post("<?php echo site_url('/login/do_login'); ?>", $(this).serialize(), function(data) {
                    if(data.hasil === true) {
                        
                        
                        window.location = "<?php echo site_url('/'); ?>";
                    } else {
                        $("#info-login").addClass("alert-error");
                        $("#info-login").html(data.pesan);
                    }
                }, "json");
                return false;
            });
        </script>
    </body>
</html>

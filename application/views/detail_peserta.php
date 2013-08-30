<div class="modal hide fade" id="modal_password">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3>Masukkan Kata Sandi Tim</h3>
        
    </div>
    <form id="suntingform" method="post" action="<?php echo site_url('/nlc/edit_peserta'); ?>">
        <div class="modal-body">
            <input type="hidden" name="id" value="<?php echo $peserta['id_nlc']; ?>"/>
            <input type="password" name="password" />

        </div>

        <div class="modal-footer">
            <input type="submit"class="btn btn-primary" value="Lakukan Penyuntingan">
        </div>
    </form>
</div>
<input type="button" class="btn" value="Sunting Data" onclick="doEdit()"/><br/>
<div class="well">
    <h3>Data Tim</h3>
    <table class="table-bordered table-striped">
        <tr>
            <th width="20%">Nomor Peserta</th>
            <td width="80%"><?php printf("%06d", $peserta['id_nlc']); ?> </td>
        </tr>
        <tr>
            <th>Nama Tim</th>
            <td><?php echo $peserta['nama_tim']; ?> </td>
        </tr>
        <tr>
            <th>Asal Sekolah</th>
            <td><?php echo $peserta['nama_sekolah']; ?> </td>
        </tr>
        <tr>
            <th>Tempat Penyisihan</th>
            <td><?php echo $peserta['tempat_lomba']; ?> </td>
        </tr>
        <tr>
            <th>Password Akses</th>
            <td><?php echo $peserta['password']; ?> </td>
        </tr>
        
    </table>
</div>
<div class="well">
    <h3>Data Ketua</h3>
    <table class="table-bordered table-striped">
        <tr>
            <th width="20%">Nama Lengkap</th>
            <td width="80%"><?php echo $peserta['nama_ketua']; ?> </td>
        </tr>
        <tr>
            <th>No Telp</th>
            <td><?php echo $peserta['no_ketua']; ?> </td>
        </tr>
        <tr>
            <th>Surel</th>
            <td><?php echo $peserta['email_ketua']; ?> </td>
        </tr>
        
        
    </table>
</div>
<div class="well">
    <h3>Data Anggota 1</h3>
    <table class="table-bordered table-striped">
        <tr>
            <th width="20%">Nama Lengkap</th>
            <td width="80%"><?php echo $peserta['nama_anggota1']; ?> </td>
        </tr>
        <tr>
            <th>No Telp</th>
            <td><?php echo $peserta['no_anggota1']; ?> </td>
        </tr>
        <tr>
            <th>Surel</th>
            <td><?php echo $peserta['email_anggota1']; ?> </td>
        </tr>
        
        
    </table>
</div>

<div class="well">
    <h3>Data Anggota 2</h3>
    <table class="table-bordered table-striped">
        <tr>
            <th width="20%">Nama Lengkap</th>
            <td width="80%"><?php echo $peserta['nama_anggota2']; ?> </td>
        </tr>
        <tr>
            <th>No Telp</th>
            <td><?php echo $peserta['no_anggota2']; ?> </td>
        </tr>
        <tr>
            <th>Surel</th>
            <td><?php echo $peserta['email_anggota2']; ?> </td>
        </tr>
        
        
    </table>
</div>
<?php $nama_tim = $peserta['nama_tim']; ?>
<ul class="thumbnails">
    <li class="span4">
        <div class="thumbnail">
            <img src="<?php echo base_url("/uploads/nlc/".$nama_tim."_foto_ketua.png"); ?>">
            <strong>Foto Ketua</strong>
        </div>
    </li>
    
   
    <li class="span4">
        <div class="thumbnail">
            <img src="<?php echo base_url("/uploads/nlc/".$nama_tim."_foto_1.png"); ?>">
            <strong>Foto Anggota 1</strong>
        </div>
    </li>
    
   
    <li class="span4">
        <div class="thumbnail">
            <img src="<?php echo base_url("/uploads/nlc/".$nama_tim."_foto_2.png"); ?>">
            <strong>Foto Anggota 2</strong>
        </div>
    </li>
   
    
</ul>
<script>
    function doEdit() {
        $("#modal_password").modal();
    }
</script>
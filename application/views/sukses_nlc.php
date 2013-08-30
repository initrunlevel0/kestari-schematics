<p>Pendaftaran peserta berhasil dilakukan. Berikut adalah data peserta baru yang telah didaftarkan : </p>
<table>
    <tr>
        <td><strong>Nomor Peserta</strong></td>
        <td><?php echo $no_peserta; ?></td>
    </tr>
    <tr>
        <td><strong>Nama Tim</strong></td>
        <td><?php echo $nama_tim; ?></td>
    </tr>
    <tr>
        <td><strong>Asal Sekolah</strong></td>
        <td><?php echo $asal_sekolah; ?></td>
    </tr>
    <tr>
        <td><strong>Tempat Penyisihan</strong></td>
        <td><?php echo $tempat_penyisihan_val; ?></td>
    </tr>
    <tr>
        <td><strong>Nama Lengkap Ketua</strong></td>
        <td><?php echo $nama_lengkap_ketua; ?></td>
    </tr>
    <tr>
        <td><strong>Nomor Telepon Ketua</strong></td>
        <td><?php echo $no_telepon_ketua; ?></td>
    </tr>
    <tr>
        <td><strong>Surel Ketua</strong></td>
        <td><?php echo $email_ketua; ?></td>
    </tr>
    <tr>
        <td><strong>Nama Lengkap Anggota 1</strong></td>
        <td><?php echo $nama_lengkap_1; ?></td>
    </tr>
    <tr>
        <td><strong>Nomor Telepon Anggota 1</strong></td>
        <td><?php echo $no_telepon_1; ?></td>
    </tr>
    <tr>
        <td><strong>Surel Anggota 1</strong></td>
        <td><?php echo $email_1; ?></td>
    </tr>
    <tr>
        <td><strong>Nama Lengkap Anggota 2</strong></td>
        <td><?php echo $nama_lengkap_2; ?></td>
    </tr>
    <tr>
        <td><strong>Nomor Telepon Anggota 2</strong></td>
        <td><?php echo $no_telepon_2; ?></td>
    </tr>
    <tr>
        <td><strong>Surel Anggota 2</strong></td>
        <td><?php echo $email_2; ?></td>
    </tr>
</table>

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
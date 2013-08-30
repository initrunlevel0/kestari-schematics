<p>Pada halaman ini, Anda dapat melihat semua peserta terdaftar. Silahkan klik pada nama tim bersangkutan melihat datanya lebih detail / menyunting isi datanya.</p>
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Nama Tim</th>
        <th>Asal Sekolah</th>
        <th>Tempat Penyisihan</th>
        <th>Keterangan</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach($peserta_semua as $peserta) { ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php printf("%06d", $peserta['id_nlc']); ?></td>
        <td><a href="<?php echo site_url('nlc/detail_peserta?id='.$peserta['id_nlc']); ?>"><?php echo $peserta['nama_tim']; ?></a></td>
        <td><?php echo $peserta['nama_sekolah']; ?></td>
        <td><?php echo $peserta['tempat_lomba']; ?></td>
        <td><?php //if($peserta['status']==0) echo "Belum Lengkap"; else echo "Sudah Lengkap"; ?>?</td>
        
    </tr>
    <?php $i++; } ?>
</table>
<script>
    $(document).ready(function() {
       $("input[type='button']").click(function() {
            var button = $(this);
            $.post("<?php echo site_url('/nlc/do_verifikasi_peserta');?>", "id="+$(this).attr('data-id'), function (data) {
                button.val("Terverifikasi!");
                button.parent().parent().addClass('success');
            });
        });
    });
    
       
</script>
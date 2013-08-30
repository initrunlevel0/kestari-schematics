<p>Pada halaman ini, Anda dapat memverifikasikan akun peserta NLC yang terdaftar secara daring. Silahkan klik tombol pada kolom Verifikasi untuk menyetujui verifikasi peserta.</p>
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Nama Tim</th>
        <th>Surel</th>
        <th>Password</th>
        <th>Bukti</th>
        <th>Verifikasi</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach($peserta_belum_terverifikasi as $peserta) { ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php printf("%06d", $peserta['id_nlc']); ?></td>
        <td><?php echo $peserta['nama_tim']; ?></td>
        <td><?php echo $peserta['email_ketua']; ?></td>
        <td><?php echo $peserta['password']; ?></td>
        <td><a href="<?php echo $peserta['bukti']; ?>">ini</a></td>
        <td><input type="button" class="btn" value="Verifikasi" data-id="<?php echo $peserta['id_nlc']; ?>" class="tombol_verifikasi"/></td>
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
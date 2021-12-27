<?php
include('koneksi.php');
if ($_POST) {
    $q = $_POST['search'];
    $sql_res = mysqli_query("select nama_pasien,alamat,tgl_daftar from pendaftaran where no_ktp like '%$q%' or nama_pasien like '%$q%' order by nama_pasien LIMIT 5");
    while ($row = mysqli_fetch_array($conn,$sql_res)) {
        $tgl_daftar = $row['tgl_daftar'];
        $nama = $row['nama_pasien'];
        $alamat = $row['alamat'];
        $b_id_pasien = '<strong>' . $q . '</strong>';
        $b_nama = '<strong>' . $q . '</strong>';
        $final_alamat = str_ireplace($q, $b_alamat, $alamat);
        $final_nama = str_ireplace($q, $b_nama, $nama);
        ?>
        <div class="show" align="left">
            <span class="id"><?php echo $final_alamat; ?></span>&nbsp;<br/>
            <span class="nama"><?php echo $final_nama ?></span>, <?php echo $alamat; ?><br/>
        </div>
        <?php
    }
}
?>
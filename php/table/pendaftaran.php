<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">mail_outline</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">List Pendaftaran</h4>
                <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal">
                    Laporan Pendaftaran
                </button>
                <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notice">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                <h5 class="modal-title" id="myModalLabel">Export</h5>
                            </div>
                            <div class="modal-body">
                                <form action='./export/export-pendaftaran.php' method='post'>
                                    <div class="form-group col-md-6">
                                        <label class="label-control">Mulai</label>
                                        <input type="date" name='mulai' class="form-control" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label-control">Sampai</label>
                                        <input type="date" name='sampai' class="form-control" required />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="label-control">Simpan dengan nama</label>
                                        <input type="text" name='nama_file' class="form-control" required />
                                    </div>
                                    <button type='submit' name='export' class='btn btn-info'>Export</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ----------------------Batas-------------------- -->
                    <form class="navbar-form navbar-right" action='index.php?url=pendaftaran' method='post' role="search">
                        <div class="form-group form-search is-empty">
                            <input type="text" name='cari' class="form-control" value='<?php if(isset($_POST['cari'])){ echo $_POST['cari'];}?>' placeholder=" Search ">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
                <!-- -----------------------Akhir-------------------- -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Datang</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include 'koneksi.php';
                                    $halaman = 5;
                                    $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                                    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                                    $sql = mysqli_query($conn,"select * from pendaftaran");
                                    $total = mysqli_num_rows($sql);
                                    $pages = ceil($total/$halaman);
                                    if(isset($_POST['cari']) && $_POST['cari']!= null ){
                                        $cari = $_POST['cari'];
                                        $query = mysqli_query($conn,"select * from pendaftaran where nama_pasien like '%".$cari."%' or no_kk like '%".$cari."%' or no_registrasi like '%".$cari."%' or nama_pasien like '%".$cari."%'")or die(mysqli_error($conn));
                                    }else{
                                        $query = mysqli_query($conn,"select * from pendaftaran LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                                    }
                                    if($total >0){
                                    $no =$mulai+1;
                                    while($tampilUmum = mysqli_fetch_array($query)){
                                        echo '<tr>';
                                        echo '<td class="text-center">'.$no.'</td>';
                                        echo '<td id="nama">'.$tampilUmum['nama_pasien'].'</td>';
                                        echo '<td>'.$tampilUmum['alamat_pasien'].'</td>';
                                        echo '<td>'.$tampilUmum['tgl_daftar'].'</td>';
                                        echo'
                                        <td class="td-actions text-right">
                                            <a rel="tooltip" title="Tambah Pasien Umum" class="btn btn-warning btn-round" href="index.php?url=pendaftaran&umum&id='.$tampilUmum['no_registrasi'].'">
                                                <i class="material-icons">group</i>
                                            </a>
                                            <a rel="tooltip" title="Tambah Pasien Hamil" class="btn btn-warning btn-round" href="index.php?url=pendaftaran&hamil&id='.$tampilUmum['no_registrasi'].'">
                                                <i class="material-icons">child_friendly</i>
                                            </a>
                                            <a rel="tooltip" title="Tambah Pasien KB" class="btn btn-warning btn-round" href="index.php?url=pendaftaran&kb&id='.$tampilUmum['no_registrasi'].'">
                                                <i class="material-icons">wc</i>
                                            </a>
                                            <a rel="tooltip" title="Tambah Pasien Imunisasi" class="btn btn-warning btn-round" href="index.php?url=pendaftaran&imunisasi&id='.$tampilUmum['no_registrasi'].'">
                                                <i class="material-icons">child_care</i>
                                            </a>';
                                            ?>
                                        </td>
                                    </tr> <?php
                                    $no++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                            <ul class="pagination pagination-primary">
                                <?php
                                if(isset($_POST['cari']) && $_POST['cari']!=null ){

                                }
                                else{
                                for ($i=1; $i<=$pages ; $i++){ ?>
                                <li class='
                                    <?php
                                        $page1 = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                                        if($page1 == $i){
                                            echo 'active';
                                        }
                                        else{
                                            echo '';
                                        }
                                    ?>'>
                                    <a id='bahan' href="index.php?url=pendaftaran&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                                </li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal umum  -->
<?php
if(isset($_GET['umum'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pendaftaran' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
                <h5 class="modal-title" id="myModalLabel">Tambah Pasien Umum</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">No Registrasi</label>
                        <input type="text" readonly name='no_registrasi' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>'>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Keluhan</label>
                        <input type="text" name='keluhan' class="form-control" required>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Tekanan Darah</label>
                        <input type="text" name='tekanan_darah' class="form-control" required>
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Berat Badan</label>
                        <input type="text" name='berat_badan' class="form-control" required>
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Suhu Badan</label>
                        <input type="text" name='suhu_badan' class="form-control" required>
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Diagnosa</label>
                        <input type="text" name='diagnosa' class="form-control" required>
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Terapi</label>
                        <input type="text" name='terapi' class="form-control" required>
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">Keterangan</label>
                        <textarea col='5' rows='4' type="text" name='keterangan' class="form-control" required></textarea>
                    </div>
                    <button type="submit" class='btn btn-primary' name='pasien_umum'>Tambah Pasien Umum</button>
                </form>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>
<!-- modal hamil -->
<?php
if(isset($_GET['hamil'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pendaftaran' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
                <h5 class="modal-title" id="myModalLabel">Detail Pasien Umum</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">No Registrasi</label>
                        <input type="text" readonly name='no_registrasi' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>'>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Hari Pertama Haid Terakhir</label>
                        <input type="date" id='bersih_modal' class="form-control" name='hpht' required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Hari Taksiran Persalinan</label>
                        <input type="date" id='bersih_modal' class="form-control" name='htp' required>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Ling. Lengan Kek</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='lingkar_lengan_kek' required >
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Ling. Lengan NonKek</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='lingkar_lengan_nonkek' required >
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Tinggi Badan</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='tinggi_badan' required >
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <select class="selectpicker" name='golongan darah' data-style="select-with-transition" data-size="7">
                            <option disabled selected>Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Riwayat Penyakit</label>
                        <input type="text" id='bersih_modal' class="form-control" name='riwayat_penyakit'  required>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Riwayat Alergi</label>
                        <input type="text" id='bersih_modal' class="form-control" name='riwayat_alergi' required >
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Hamil Ke</label>
                        <input type="number" id='kehamilan' onkeyup='percobaan()' class="form-control" name='hamil_ke' required>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Jumlah Persalinan</label>
                        <input  id='test' type="text" class="form-control" name='jumlah_persalinan' disabled>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Jumlah Keguguran</label>
                        <input  id='test1' type="text" class="form-control" name='jumlah_keguguran' disabled>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Anak Hidup</label>
                        <input type="text" id='test2' class="form-control" name='anak_hidup' disabled>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Anak Mati</label>
                        <input  id='test3' type="text" class="form-control" name='anak_mati' disabled>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Jarak Kehamilan</label>
                        <input  id='test4' type="text" class="form-control" name='jarak_kehamilan' disabled>
                    </div>
                    <button type="submit" class='btn btn-primary' name='pasien_hamil'>Tambah Pasien Hamil</button>
                </form>
            </div>
        </div>
        <?php }
    } ?>
    </div>
</div>
<!-- modal kb -->
<?php
if(isset($_GET['kb'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi ="'.$_GET['id'].'"');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pendaftaran' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
                <h5 class="modal-title" id="myModalLabel">Tambah Pasien KB</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">No Registrasi</label>
                        <input type="text" readonly name='no_registrasi' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>'>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Berat Badan</label>
                        <input type="text" id='bersih_modal' class="form-control" name='berat_badan_kb' required >
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Tensi Darah</label>
                        <input type="text" id='bersih_modal' class="form-control" name='tensi_darah_kb' required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="label-control">Tanggal Kembali</label>
                        <input type="date" name='tanggal_kembali' class="form-control" required />
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">Keterangan</label>
                        <input type="text" id='bersih_modal' class="form-control" name='keterangan_kb' required >
                    </div>
                    <button type="submit" class='btn btn-primary' name='pasien_kb'>Tambah Pasien KB</button>
                </form>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>
<!-- modal imunisasi -->
<?php
if(isset($_GET['imunisasi'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pendaftaran' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
                <h5 class="modal-title" id="myModalLabel">Tambah Pasien Imunisasi</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="#">
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">No Registrasi</label>
                        <input type="text" readonly name='no_registrasi' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>'>
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">Nama Anak</label>
                        <input type="text" id='bersih_modal' class="form-control" name='nama_anak' required >
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Berat Badan</label>
                        <input type="text" id='bersih_modal' class="form-control" name='berat_badan_imunisasi' required >
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Tinggi Badan</label>
                        <input type="text" id='bersih_modal' class="form-control" name='tinggi_badan' required>
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">Jenis Imunisasi</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='jenis_imunisasi' required>
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">Keterangan</label>
                        <input type="text" id='bersih_modal' class="form-control" name='keterangan' required>
                    </div>
                    <button type="submit" class='btn btn-primary' name='pasien_imunisasi'>Tambah Pasien Imunisasi</button>
                </form>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>


<?php
include 'koneksi.php';

// query tambah pasien umum
if(isset($_POST['pasien_umum'])){
    $tgl_daftar = (new \DateTime())->format('Y-m-d');
    $noreg = $_POST['no_registrasi'];
    $keluhan = $_POST['keluhan'];
    $bb = $_POST['berat_badan'];
    $tekanan = $_POST['tekanan_darah'];
    $suhu = $_POST['suhu_badan'];
    $diagnosa = $_POST['diagnosa'];
    $terapi = $_POST['terapi'];
    $ket = $_POST['keterangan'];

    $tPasUmum = mysqli_query($conn,"insert into pasien_umum(no_registrasi,keluhan,tekanan_darah,berat_badan,suhu_badan,diagnosa,terapi,keterangan,tgl_daftar) values('$noreg','$keluhan','$tekanan','$bb','$suhu','$diagnosa','$terapi','$ket','$tgl_daftar')");
    if($tPasUmum){
        echo '<script>
            swal({
              title: "Berhasil",
               text: "Berhasil Menambah Data !",
                icon: "success"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }else{
        echo '<script>
            swal({
              title: "Gagal",
               text: "Gagal Menambah Data",
                icon: "error"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}

// query tambah pasien kb
if(isset($_POST['pasien_kb'])){
    $noreg = $_POST['no_registrasi'];
    $bb = $_POST['berat_badan_kb'];
    $tensi = $_POST['tensi_darah_kb'];
    $tgl = $_POST['tanggal_kembali'];
    $ket = $_POST['keterangan_kb'];
    $tgl_daftar =  (new \DateTime())->format('Y-m-d');

    $tPasKB = mysqli_query($conn,"insert into pasien_kb(no_registrasi,berat_badan,tensi_darah,tgl_kembali,keterangan,stts,tgl_daftar) values('$noreg','$bb','$tensi','$tgl','$ket','KB','$tgl_daftar')");
    if($tPasKB){
        echo '<script>
            swal({
              title: "Berhasil",
               text: "Berhasil Menambah Data !",
                icon: "success"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }else{
        echo '<script>
            swal({
              title: "Gagal",
               text: "Gagal Menambah Data",
                icon: "error"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}

// query tambah pasien imunisasi
if(isset($_POST['pasien_imunisasi'])){
    $noreg = $_POST['no_registrasi'];
    $nama = $_POST['nama_anak'];
    $bb = $_POST['berat_badan_imunisasi'];
    $tinggi = $_POST['tinggi_badan'];
    $jenis = $_POST['jenis_imunisasi'];
    $ket = $_POST['keterangan'];
    $tgl_daftar =  (new \DateTime())->format('Y-m-d');

    $tPasKB = mysqli_query($conn,"insert into pasien_imunisasi(no_registrasi,berat_badan,tinggi_badan,nama_anak,jenis_imunisasi,keterangan,stts,tgl_daftar) values('$noreg','$bb','$tinggi','$nama','$jenis','$ket','Imunisasi','$tgl_daftar')");
    if($tPasKB){
        echo '<script>
            swal({
              title: "Berhasil",
               text: "Berhasil Menambah Data !",
                icon: "success"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }else{
        echo '<script>
            swal({
              title: "Gagal",
               text: "Gagal Menambah Data",
                icon: "error"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}

// query tambah pasien hamil
if(isset($_POST['pasien_hamil'])){
    $noreg = $_POST['no_registrasi'];
    $hpht = $_POST['hpht'];
    $htp = $_POST['htp'];
    $lingkar_lengan_kek = $_POST['lingkar_lengan_kek'];
    $lingkar_lengan_nonkek = $_POST['lingkar_lengan_nonkek'];
    $gol_darah = $_POST['golongan_darah'];
    $riwayat_penyakit = $_POST['riwayat_penyakit'];
    $riwayat_alergi = $_POST['riwayat_alergi'];
    $hamil_ke = $_POST['hamil_ke'];
    $jml_persalinan = $_POST['jumlah_persalinan'];
    $jml_keguguran = $_POST['jumlah_keguguran'];
    $anak_hidup = $_POST['anak_hidup'];
    $anak_mati = $_POST['anak_mati'];
    $jarak_kehamilan = $_POST['jarak_kehamilan'];
    $tinggi = $_POST['tinggi_badan'];
    $tgl_daftar =  (new \DateTime())->format('Y-m-d');

    $tPasKB = mysqli_query($conn,"insert into pasien_hamil
    (no_registrasi,hpht,htp,lingkar_lengan_kek,lingkar_lengan_nonkek,tinggi_badan,golongan_darah,riwayat_penyakit,riwayat_alergi,hamil_ke,jumlah_persalinan,jumlah_keguguran,anak_hidup,anak_mati,jarak_kehamilan,stts,tgl_daftar)
    values('$noreg','$hpht','$htp','$lingkar_lengan_kek','$lingkar_lengan_nonkek','$tinggi','$gol_darah','$riwayat_penyakit','$riwayat_alergi','$hamil_ke','$jml_persalinan','$jml_keguguran','$anak_hidup','$anak_mati','$jarak_kehamilan','Hamil','$tgl_daftar')");
    if($tPasKB){
        echo '<script>
            swal({
              title: "Berhasil",
               text: "Berhasil Menambah Data !",
                icon: "success"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }else{
        echo '<script>
            swal({
              title: "Gagal",
               text: "Gagal Menambah Data",
                icon: "error"
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}
?>
<script>
    function percobaan(){
        var parameter = document.getElementById('kehamilan').value;
        if(parameter<=1){
            var disabled=document.getElementById('test');
            var disabled1=document.getElementById('test1');
            var disabled2=document.getElementById('test2');
            var disabled3=document.getElementById('test3');
            var disabled4=document.getElementById('test4');
            disabled.setAttribute("disabled","");
            disabled1.setAttribute("disabled","");
            disabled2.setAttribute("disabled","");
            disabled3.setAttribute("disabled","");
            disabled4.setAttribute("disabled","");
        }
        else{
            var disabled=document.getElementById('test');
            var disabled1=document.getElementById('test1');
            var disabled2=document.getElementById('test2');
            var disabled3=document.getElementById('test3');
            var disabled4=document.getElementById('test4');
            disabled.removeAttribute("disabled","");
            disabled1.removeAttribute("disabled","");
            disabled2.removeAttribute("disabled","");
            disabled3.removeAttribute("disabled","");
            disabled4.removeAttribute("disabled","");
        }
    }
</script>

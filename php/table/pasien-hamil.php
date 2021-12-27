<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <form class="navbar-form navbar-right" action='index.php?url=pasien-hamil' method='post' role="search">
                <div class="form-group form-search is-empty">
                    <input type="text" name='cari' class="form-control" value='<?php if(isset($_POST['cari'])){ echo $_POST['cari'];}?>' placeholder=" Search ">
                    <span class="material-input"></span>
                </div>
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                </button>
            </form>
            <h4 class="card-title">Pasien Hamil</h4>
            <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal">
                    Laporan Pasien Hamil
                </button>
                <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notice">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                <h5 class="modal-title" id="myModalLabel">Export</h5>
                            </div>
                            <div class="modal-body">
                                <form action='./export/export-pashamil.php' method='post'>
                                    <div class="form-group col-md-6">
                                        <label class="label-control">Mulai</label>
                                        <input type="date" name='mulai' class="form-control"  required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label-control">Sampai</label>
                                        <input type="date" name='sampai' class="form-control"  required/>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="label-control">Simpan dengan nama</label>
                                        <input type="text" name='nama_file' class="form-control"  required/>
                                    </div>
                                    <button type='submit' name='export' class='btn btn-info'>Export</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-primary">
                        <th>No Registrasi</th>
                        <th>Nama</th>
                        <th>Hamil Ke</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    <?php
                    $halaman = 5;
                    $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                    $sql = mysqli_query($conn,"select * from pendaftaran inner join pasien_hamil on pendaftaran.no_registrasi = pasien_hamil.no_registrasi where pendaftaran.param=1");
                    $total = mysqli_num_rows($sql);
                    $pages = ceil($total/$halaman);
                    $no =$mulai+1;
                    if(isset($_POST['cari']) && $_POST['cari']!= null ){
                        $cari = $_POST['cari'];
                        $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_hamil on pendaftaran.no_registrasi = pasien_hamil.no_registrasi where pendaftaran.param=1 and nama_pasien like '%".$cari."%' or pasien_hamil.no_registrasi like '%".$cari."%' ")or die(mysqli_error($conn));
                    }else{
                        $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_hamil on pendaftaran.no_registrasi = pasien_hamil.no_registrasi where pendaftaran.param=1 LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                    }
                    while($data = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?php echo $data['no_registrasi']; ?></td>
                            <td><?php echo $data['nama_pasien']; ?></td>
                            <td><?php echo $data['hamil_ke']; ?></td>
                            <td class="td-actions">
                                <?php echo '<a rel="tooltip" title="Detail Kehamilan" class="btn btn-success btn-round" href="index.php?url=pasien-hamil&detail&id='.$data['no_registrasi'].'">';?>
                                    <i class="material-icons">info</i>
                                </a>
                                <?php echo '<a rel="tooltip" title="Info Kandungan" class="btn btn-info btn-round" href="index.php?url=detail-pasien&info&id='.$data['no_registrasi'].'">';?>
                                    <i class="material-icons">info</i>
                                </a>
                                <!-- <?php //echo '<a rel="tooltip" title="Tambah Kondisi Kandungan" class="btn btn-rose btn-round" href="index.php?url=pasien-hamil&tambah&id='.$data['no_registrasi'].'">';?>
                                    <i class="material-icons">child_friendly</i>
                                </a> -->
                            </td>
                        </tr>
                    <?php } ?>
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
                        <a id='bahan' href="index.php?url=pasien-hamil&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                    </li>
                    <?php } } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_GET['tambah'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pasien-hamil' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
                <h5 class="modal-title" id="myModalLabel">Tambah Kondisi Kandungan</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="">
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">No Registrasi</label>
                        <input type="text" readonly name='no_registrasi' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>'>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Keluhan</label>
                        <input type="text" name='keluhan' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Tekanan Darah</label>
                        <input type="text" name='tekanan_darah' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Umur Kehamilan</label>
                        <input type="text" name='umur_kehamilan' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Tinggi Fundus</label>
                        <input type="text" name='tinggi_fundus' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Letak Janin</label>
                        <input type="text" name='letak_janin' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Denyut Jantung</label>
                        <input type="text" name='denyut_jantung' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-3">
                        <label class="control-label">Hasil Periksa</label>
                        <input type="text" name='hasil_periksa' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Tindakan</label>
                        <input type="text" name='tindakan' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Nasehat</label>
                        <input type="text" name='nasihat' class="form-control">
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">Keterangan</label>
                        <textarea col='5' rows='4' type="text" name='keterangan' class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="label-control">Tanggal Datang</label>
                        <input type="date" name='tanggal_datang' class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="label-control">Tanggal kembali</label>
                        <input type="date" name='tanggal_kembali' class="form-control" />
                    </div>
                    <button type="submit" class='btn btn-primary' name='tambah'>Tambah Kondisi Pasien Hamil</button>        
                </form>
            </div>
        </div>
        <?php }} ?>
    </div>
</div>
<?php
if(isset($_GET['detail'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran inner join pasien_hamil on pendaftaran.no_registrasi = pasien_hamil.no_registrasi where pendaftaran.no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pasien-hamil' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
                <h5 class="modal-title" id="myModalLabel">Detail Pasien Hamil</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="#">
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">No Registrasi</label>
                        <input type="text" name='no_registrasi' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>' readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Hari Pertama Haid Terakhir</label>
                        <input type="date" id='bersih_modal' class="form-control" name='hpht' value='<?php echo $dataedit['hpht']; ?>' readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Hari Taksiran Persalinan</label>
                        <input type="date" id='bersih_modal' class="form-control" name='htp' value='<?php echo $dataedit['htp']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Ling. Lengan Kek</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='lingkar_lengan_kek' value='<?php echo $dataedit['lingkar_lengan_kek']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Ling. Lengan NonKek</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='lingkar_lengan_nonkek' value='<?php echo $dataedit['lingkar_lengan_nonkek']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Tinggi Badan</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='tinggi_badan' value='<?php echo $dataedit['tinggi_badan']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-12">
                        <label class="control-label">Golongan Darah</label>
                        <input type="text" id='bersih_modal' class="form-control" name='golongan_darah' value='<?php echo $dataedit['golongan_darah']; ?>' readonly >
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Riwayat Penyakit</label>
                        <input type="text" id='bersih_modal' class="form-control" name='riwayat_penyakit' value='<?php echo $dataedit['riwayat_penyakit']; ?>' readonly >
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Riwayat Alergi</label>
                        <input type="text" id='bersih_modal' class="form-control" name='riwayat_alergi' value='<?php echo $dataedit['riwayat_alergi']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Hamil Ke</label>
                        <input type="number" id='bersih_modal' class="form-control" name='hamil_ke' value='<?php echo $dataedit['hamil_ke']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Jumlah Persalinan</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='jumlah_persalinan' value='<?php echo $dataedit['jumlah_persalinan']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Jumlah Keguguran</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='jumlah_keguguran' value='<?php echo $dataedit['jumlah_keguguran']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Anak Hidup</label>
                        <input type="text" id='bersih_modal' class="form-control" name='anak_hidup' value='<?php echo $dataedit['anak_hidup']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Anak Mati</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='anak_mati' value='<?php echo $dataedit['anak_mati']; ?>' readonly>
                    </div>
                    <div class="form-group label-floating col-md-4">
                        <label class="control-label">Jarak Kehamilan</label>
                        <input  id='bersih_modal' type="text" class="form-control" name='jarak_kehamilan' value='<?php echo $dataedit['jarak_kehamilan']; ?>' readonly>
                    </div>
                    . 
                </form>
            </div>
        </div>
        <?php }
    } ?>
    </div>
</div>

<?php 
include 'koneksi.php';

if(isset($_POST['tambah'])){
    $noreg = $_POST['no_registrasi'];
    $tgl_datang = $_POST['tanggal_datang'];
    $keluhan = $_POST['keluhan'];
    $tekanan = $_POST['tekanan_darah'];
    $umur_hamil = $_POST['umur_kehamilan'];
    $tinggi = $_POST['tinggi_fundus'];
    $letak = $_POST['letak_janin'];
    $denyut = $_POST['denyut_jantung'];
    $hasil_periksa = $_POST['hasil_periksa'];
    $tindakan = $_POST['tindakan'];
    $nasihat = $_POST['nasihat'];
    $ket = $_POST['keterangan'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    $tDetail = mysqli_query($conn,"insert into detail_hamil values('$noreg','$tgl_datang','$keluhan','$tekanan','$umur_hamil','$tinggi','$letak','$denyut','$hasil_periksa','$tindakan','$nasihat','$ket','$tgl_kembali')");
    if($tDetail){
        echo '<script>
            swal({ 
              title: "Berhasil",
               text: "Berhasil Menambah Data !",
                icon: "success" 
              }).then(function() {
                window.location.href = "index.php?url=pasien-hamil";
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
                window.location.href = "index.php?url=pasien-hamil";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}
?>
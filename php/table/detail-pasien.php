<?php
if(isset($_GET['info'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="col-md-12">
<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">assignment</i>
    </div>
    <div class="card-content">
        <h4 class="card-title">Detail Pasien </h4>
        <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal">
             Laporan Detail Pasien
        </button>
                <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notice">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                <h5 class="modal-title" id="myModalLabel">Export</h5>
                            </div>
                            <div class="modal-body">
                                <form action='./export/export-det_hamil.php' method='post'>
                                    <div class="form-group col-md-12">
                                        <label class="label-control">Simpan dengan nama</label>
                                        <input type="text" name='nama_file' class="form-control" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="hidden" name='noreg' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>'/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="hidden" name='nm_pas' class="form-control" value='<?php echo $dataedit['nama_pasien']; ?>'/>
                                    </div>
                                    <button type='submit' name='export' class='btn btn-info'>Export</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

         <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal1">
            Tambah Diagnosa
        </button>
        <div class="modal fade" id="noticeModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <input type="date" name='tanggal_datang' class="form-control" readonly value='<?php echo (new \DateTime())->format('Y-m-d'); ?>'/>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="label-control">Tanggal kembali</label>
                        <input type="date" name='tanggal_kembali' class="form-control" />
                    </div>
                    <button type="submit" class='btn btn-primary' name='tambah'>Tambah Kondisi Pasien Hamil</button>        
                </form>
            </div>
         </div>
    </div>
</div>

        <div class="table-responsive">
            <table class="table">
                <thead class="text-primary">
                    <th><a href="index.php?url=pasien-hamil" class='btn btn-info'>Kembali</a></th>
                    <tr>
                    <th colspan = '12'>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">No Registrasi</label>
                        <input type="text" readonly name='noreg' class="form-control" value='<?php echo $dataedit['no_registrasi']; ?>'>
                    </div>
                    <div class="form-group label-floating col-md-6">
                        <label class="control-label">Nama Pasien</label>
                        <input type="text" readonly name='nm_pas' class="form-control" value='<?php echo $dataedit['nama_pasien']; ?>'>
                    </div>
                    </th>
                    </tr>
                    <th>Tanggal Datang</th>
                    <th>Keluhan</th>
                    <th>Tekanan Darah</th>
                    <th>Umur Kehamilan</th>
                    <th>Tinggi Fundus</th>
                    <th>Letak Janin</th>
                    <th>Denyut Jantung</th>
                    <th>Hasil Periksa</th>
                    <th>Tindakan</th>
                    <th>Nasihat</th>
                    <th>Ket</th>
                    <th>Tanggal Kembali</th>
                </thead>
                <tbody>
                <?php
                $idpasien = $_GET['id'];
                $halaman = 5;
                $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                $sql = mysqli_query($conn,"select * from detail_hamil where no_registrasi='".$_GET['id']."'");
                $total = mysqli_num_rows($sql);
                $pages = ceil($total/$halaman);
                $no =$mulai+1;
                $pasien = mysqli_query($conn,"select * from detail_hamil where no_registrasi='".$_GET['id']."'  LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                while($tampil = mysqli_fetch_assoc($pasien)){
                ?>
                    <tr>
                        <td><?php echo $tampil['tgl_datang'] ?></td>
                        <td><?php echo $tampil['keluhan'] ?></td>
                        <td><?php echo $tampil['tekanan_darah'] ?></td>
                        <td><?php echo $tampil['umur_kehamilan'] ?></td>
                        <td><?php echo $tampil['tinggi_fundus'] ?></td>
                        <td><?php echo $tampil['letak_janin'] ?></td>
                        <td><?php echo $tampil['denyut_jantung'] ?></td>
                        <td><?php echo $tampil['hasil_periksa'] ?></td>
                        <td><?php echo $tampil['tindakan'] ?></td>
                        <td><?php echo $tampil['nasihat'] ?></td>
                        <td><?php echo $tampil['keterangan'] ?></td>
                        <td><?php echo $tampil['tgl_kembali'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <ul class="pagination pagination-primary">
                <?php for ($i=1; $i<=$pages ; $i++){ ?>
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
                    <a id='bahan' href="index.php?url=detail-pasien&info&id=<?php echo $idpasien; ?>&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
    <?php }} ?>

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
                window.location.href="index.php?url=detail-pasien&info&id='.$_GET['id'].'";
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
                window.location.href = "index.php?url=detail-pasien&info&id='.$_GET['id'].'";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}
?>
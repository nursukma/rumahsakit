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
                        <form action='./export/export-det_umum.php' method='post'>
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
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                        <h5 class="modal-title" id="myModalLabel">Tambah Diagnosa</h5>
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
                        <button type="submit" class='btn btn-primary' name='pasien_umum'>Tambah Data</button>        
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="text-primary">
                    <th><a href="index.php?url=pasien-umum" class='btn btn-info'>Kembali</a></th>
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
                    <th>Keluhan</th>
                    <th>Tekanan Darah</th>
                    <th>Berat Badan</th>
                    <th>Suhu Badan</th>
                    <th>Diagnosa</th>
                    <th>Terapi</th>
                    <th>Keterangan</th>
                    <th>Tanggal Datang</th>
                </thead>
                <tbody>
                <?php
                $idpasien = $_GET['id'];
                $halaman = 5;
                $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                $sql = mysqli_query($conn,"select * from pasien_umum where no_registrasi='".$_GET['id']."'");
                $total = mysqli_num_rows($sql);
                $pages = ceil($total/$halaman);
                $no =$mulai+1;
                $pasien = mysqli_query($conn,"select * from pasien_umum where no_registrasi='".$_GET['id']."'  LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                while($tampil = mysqli_fetch_assoc($pasien)){
                ?>
                    <tr>
                        <td><?php echo $tampil['keluhan'] ?></td>
                        <td><?php echo $tampil['tekanan_darah'] ?></td>
                        <td><?php echo $tampil['berat_badan'] ?></td>
                        <td><?php echo $tampil['suhu_badan'] ?></td>
                        <td><?php echo $tampil['diagnosa'] ?></td>
                        <td><?php echo $tampil['terapi'] ?></td>
                        <td><?php echo $tampil['keterangan'] ?></td>
                        <td><?php echo $tampil['tgl_daftar'] ?></td>
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
                    <a id='bahan' href="index.php?url=detail-pasien-umum&info&id=<?php echo $idpasien; ?>&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
    <?php }} 
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
                    window.location.href = "index.php?url=detail-pasien-umum&info&id='.$_GET['id'].'";
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
                    window.location.href = "index.php?url=detail-pasien-umum&info&id='.$_GET['id'].'";
                    console.log("The Ok Button was clicked.");
                    });
                </script>';
        }
    }
    ?>
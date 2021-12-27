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
        <h4 class="card-title">Detail Pasien Imunisasi</h4>
        <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal">
            Laporan Detail Pasien Imunisasi
        </button>
        <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                        <h5 class="modal-title" id="myModalLabel">Export</h5>
                    </div>
                    <div class="modal-body">
                        <form action='./export/export-det_imun.php' method='post'>
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
                            <input type="text" readonly name='no_registrasi' class="form-control" value='<?php echo $_GET['id']; ?>'>
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
                        <button type="submit" class='btn btn-primary' name='pasien_imunisasi'>Tambah Data</button>        
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="text-primary">
                    <th><a href="index.php?url=pasien-imunisasi" class='btn btn-info'>Kembali</a></th>
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
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>Nama Anak</th>
                    <th>Jenis Imunisasi</th>
                    <th>Keterangan</th>
                    <th>Tanggal Datang</th>
                </thead>
                <tbody>
                <?php
                $idpasien = $_GET['id'];
                $halaman = 5;
                $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                $sql = mysqli_query($conn,"select * from pasien_imunisasi where no_registrasi='".$_GET['id']."'");
                $total = mysqli_num_rows($sql);
                $pages = ceil($total/$halaman);
                $no =$mulai+1;
                $pasien = mysqli_query($conn,"select * from pasien_imunisasi where no_registrasi='".$_GET['id']."'  LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                while($tampil = mysqli_fetch_assoc($pasien)){
                ?>
                    <tr>
                        <td><?php echo $tampil['berat_badan'] ?></td>
                        <td><?php echo $tampil['tinggi_badan'] ?></td>
                        <td><?php echo $tampil['nama_anak'] ?></td>
                        <td><?php echo $tampil['jenis_imunisasi'] ?></td>
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
                    <a id='bahan' href="index.php?url=detail-pasien-imunisasi&info&id=<?php echo $idpasien; ?>&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
    <?php }} 
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
                    window.location.href = "index.php?url=detail-pasien-imunisasi&info&id='.$_GET['id'].'";
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
                    window.location.href = "index.php?url=detail-pasien-imunisasi&info&id='.$_GET['id'].'";
                    console.log("The Ok Button was clicked.");
                    });
                </script>';
        }
    }
    ?>
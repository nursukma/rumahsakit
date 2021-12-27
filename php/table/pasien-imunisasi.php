<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <form class="navbar-form navbar-right" action='index.php?url=pasien-imunisasi' method='post' role="search">
                    <div class="form-group form-search is-empty">
                        <input type="text" name='cari' class="form-control" value='<?php if(isset($_POST['cari'])){ echo $_POST['cari'];}?>' placeholder=" Search ">
                        <span class="material-input"></span>
                    </div>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </form>
                <h4 class="card-title">Pasien Imunisasi</h4>
                <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal">
                    Laporan Pasien Imunisasi
                </button>
                <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notice">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                <h5 class="modal-title" id="myModalLabel">Export</h5>
                            </div>
                            <div class="modal-body">
                                <form action='./export/export-pasimun.php' method='post'>
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
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No Registrasi</th>
                            <th>Nama Pendaftar</th>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>Nama Anak</th>
                            <th>Jenis Imunisasi</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php 
                        $halaman = 5;
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        $sql = mysqli_query($conn,"select * from pendaftaran inner join pasien_imunisasi on pendaftaran.no_registrasi = pasien_imunisasi.no_registrasi where pendaftaran.param=1");
                        $total = mysqli_num_rows($sql);
                        $pages = ceil($total/$halaman);
                        $no =$mulai+1;
                        if(isset($_POST['cari']) && $_POST['cari']!= null ){
                            $cari = $_POST['cari'];
                            $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_imunisasi on pendaftaran.no_registrasi = pasien_imunisasi.no_registrasi where pendaftaran.param=1 and nama_pasien like '%".$cari."%' or pasien_imunisasi.no_registrasi like '%".$cari."%' ")or die(mysqli_error($conn));
                        }else{
                            $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_imunisasi on pendaftaran.no_registrasi = pasien_imunisasi.no_registrasi where pendaftaran.param=1 LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                        }
                        while ($data = mysqli_fetch_assoc($query)){?>
                            <tr>
                                <td><?php echo $data['no_registrasi'] ?></td>
                                <td><?php echo $data['nama_pasien'] ?></td>
                                <td><?php echo $data['berat_badan'] ?></td>
                                <td><?php echo $data['tinggi_badan'] ?></td>
                                <td><?php echo $data['nama_anak'] ?></td>
                                <td><?php echo $data['jenis_imunisasi'] ?></td>
                                <td><?php echo $data['keterangan'] ?></td>
                                <td class="td-actions">
                                <?php echo '
                                </a><a rel="tooltip" title="Info Pasien Imunisasi" class="btn btn-info btn-round" href="index.php?url=detail-pasien-imunisasi&info&id='.$data['no_registrasi'].'">';?>
                                    <i class="material-icons">info</i>
                                </a>
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
                        <a id='bahan' href="index.php?url=pasien-imunisasi&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                    </li>
                    <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal imunisasi -->
<?php
if(isset($_GET['imunisasi'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<!-- <div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pasien-imunisasi' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
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
                        window.location.href = "index.php?url=pasien-imunisasi";
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
                        window.location.href = "index.php?url=pasien-imunisasi";
                        console.log("The Ok Button was clicked.");
                        });
                    </script>';
            }
        } ?>
    </div>
</div> -->

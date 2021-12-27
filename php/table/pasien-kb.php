<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <form class="navbar-form navbar-right" action='index.php?url=pasien-kb' method='post' role="search">
                    <div class="form-group form-search is-empty">
                        <input type="text" name='cari' class="form-control" value='<?php if(isset($_POST['cari'])){ echo $_POST['cari'];}?>' placeholder=" Search ">
                        <span class="material-input"></span>
                    </div>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </form>
                <h4 class="card-title">Pasien KB</h4>
                <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal">
                    Laporan Pasien kb
                </button>
                <!-- <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notice">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                                <h5 class="modal-title" id="myModalLabel">Export</h5>
                            </div>
                            <div class="modal-body">
                                <form action='./export/export-paskb.php' method='post'>
                                    <div class="form-group col-md-6">
                                        <label class="label-control">Mulai</label>
                                        <input type="date" name='mulai' class="form-control" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label-control">Sampai</label>
                                        <input type="date" name='sampai' class="form-control"  required/>
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
                </div> -->
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No Registrasi</th>
                            <th>Nama</th>
                            <th>Berat Badan</th>
                            <th>Tensi Darah</th>
                            <th>Tanggal Kembali</th>
                            <th>Keterangan</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        <?php
                        $halaman = 5;
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        $sql = mysqli_query($conn,"select * from pendaftaran inner join pasien_kb on pendaftaran.no_registrasi = pasien_kb.no_registrasi where param=1");
                        $total = mysqli_num_rows($sql);
                        $pages = ceil($total/$halaman);
                        if(isset($_POST['cari']) && $_POST['cari']!= null ){
                            $cari = $_POST['cari'];
                            $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_kb on pendaftaran.no_registrasi = pasien_kb.no_registrasi where param=1 and nama_pasien like '%".$cari."%' or pasien_kb.no_registrasi like '%".$cari."%' ")or die(mysqli_error($conn));
                        }else{
                            $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_kb on pendaftaran.no_registrasi = pasien_kb.no_registrasi where param=1 LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                        }
                        $no =$mulai+1;
                        while ($data = mysqli_fetch_assoc($query)){?>
                            <tr>
                                <td><?php echo $data['no_registrasi'] ?></td>
                                <td><?php echo $data['nama_pasien'] ?></td>
                                <td><?php echo $data['berat_badan'] ?></td>
                                <td><?php echo $data['tensi_darah'] ?></td>
                                <td><?php echo $data['tgl_kembali'] ?></td>
                                <td><?php echo $data['keterangan'] ?></td>
                                <td class="td-actions">
                                <?php echo '
                                <a rel="tooltip" title="Info Pasien KB" class="btn btn-info btn-round" href="index.php?url=detail-pasien-kb&info&id='.$data['no_registrasi'].'">';?>
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
                        <a id='bahan' href="index.php?url=pasien-kb&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                    </li>
                    <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_GET['kb'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi ="'.$_GET['id'].'"');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pasien-kb' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
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
        <?php }}
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
                        window.location.href = "index.php?url=pasien-kb";
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
                        window.location.href = "index.php?url=pasien-kb";
                        console.log("The Ok Button was clicked.");
                        });
                    </script>';
            }
        }
        ?>
    </div>
</div>
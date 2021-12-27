<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <form class="navbar-form navbar-right" action='index.php?url=pasien-umum' method='post' role="search">
                    <div class="form-group form-search is-empty">
                        <input type="text" name='cari' class="form-control" value='<?php if(isset($_POST['cari'])){ echo $_POST['cari'];}?>' placeholder=" Search ">
                        <span class="material-input"></span>
                    </div>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </form>
                <h4 class="card-title">Pasien Umum</h4>
                <button class="btn btn-raised btn-round btn-primary" data-toggle="modal" data-target="#noticeModal">
                    Laporan Pasien Umum
                </button>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No Registrasi</th>
                            <th>Nama</th>
                            <th>Keluhan</th>
                            <th>Tekanan Darah</th>
                            <th>Berat Badan</th>
                            <th>Suhu Badan</th>
                            <th>Diagnosa</th>
                            <th>Terapi</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php 
                        $halaman = 5;
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        $sql = mysqli_query($conn,"select * from pendaftaran inner join pasien_umum on pendaftaran.no_registrasi = pasien_umum.no_registrasi where pendaftaran.param=1");
                        $total = mysqli_num_rows($sql);
                        $pages = ceil($total/$halaman);
                        if(isset($_POST['cari']) && $_POST['cari']!= null ){
                            $cari = $_POST['cari'];
                            $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_umum on pendaftaran.no_registrasi = pasien_umum.no_registrasi where param=1 and nama_pasien like '%".$cari."%' or pasien_umum.no_registrasi like '%".$cari."%' ")or die(mysqli_error($conn));
                        }else{
                            $query = mysqli_query($conn,"select * from pendaftaran inner join pasien_umum on pendaftaran.no_registrasi = pasien_umum.no_registrasi where param=1 LIMIT $mulai, $halaman ")or die(mysqli_error($conn));
                        }
                        $no =$mulai+1;
                        while ($data = mysqli_fetch_assoc($query)){?>
                            <tr>
                                <td><?php echo $data['no_registrasi'] ?></td>
                                <td><?php echo $data['nama_pasien'] ?></td>
                                <td><?php echo $data['keluhan'] ?></td>
                                <td><?php echo $data['tekanan_darah'] ?></td>
                                <td><?php echo $data['berat_badan'] ?></td>
                                <td><?php echo $data['suhu_badan'] ?></td>
                                <td><?php echo $data['diagnosa'] ?></td>
                                <td><?php echo $data['terapi'] ?></td>
                                <td><?php echo $data['keterangan'] ?></td>
                                <td class="td-actions">
                                <?php echo '
                                <a rel="tooltip" title="Info Pasien Umum" class="btn btn-info btn-round" href="index.php?url=detail-pasien-umum&info&id='.$data['no_registrasi'].'">';?>
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
                        <a id='bahan' href="index.php?url=pasien-umum&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                    </li>
                    <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_GET['umum'])){
    $tampilan = mysqli_query($conn,'select * from pendaftaran where no_registrasi="'.$_GET['id'].'" ');
    if($dataedit = mysqli_fetch_assoc($tampilan)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pasien-umum' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
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
<?php
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
                window.location.href = "index.php?url=pasien-umum";
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
                window.location.href = "index.php?url=pasien-umum";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}
?>
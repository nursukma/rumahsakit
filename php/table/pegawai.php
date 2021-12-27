
<?php
include 'koneksi.php';
error_reporting(0);
$autoIDuser = mysqli_query($conn,"select id_user from user");
if(mysqli_num_rows($autoIDuser) != 0){
    while($dataUser = mysqli_fetch_assoc($autoIDuser)){
        $arrayUser[] = substr($dataUser['id_user'],3);
    }
$nilaiUser = max($arrayUser);
}else{
$nilaiUser = 0;
}
$akhirUser = $nilaiUser+1;

if(isset($_POST['tambah'])){
    $tPegawai = mysqli_multi_query($conn,"insert into employee values('".$_POST['id_pegawai']."','".$_POST['nama_pegawai']."','".$_POST['notlp_pegawai']."','".$_POST['alamat_pegawai']."','1','".$_POST['id_user']."') ; insert into user values('".$_POST['id_user']."','".$_POST['username']."','".$_POST['password']."','Admin','1');");
    if($tPegawai){
        echo '<script>
            swal({
              title: "Berhasil",
               text: "Berhasil Menambah Data !",
                icon: "success"
              }).then(function() {
                window.location.href = "index.php?url=pegawai";
                console.log("The Ok Button was clicked.");
                });
            </script>';
        // }
    }else{
        echo '<script>
            swal({
              title: "Gagal",
               text: "Gagal Menambah Data",
                icon: "error"
              }).then(function() {
                window.location.href = "index.php?url=pegawai";
                console.log("The Ok Button was clicked.");
                });
            </script>';
}
}

if(isset($_GET['edit1'])){
    $uPegawai = mysqli_query($conn,"update employee set nama_pegawai='".$_POST['nama_pegawai']."',alamat_pegawai='".$_POST['alamat_pegawai']."',notlp_pegawai='".$_POST['notlp_pegawai']."' WHERE id_pegawai='".$_POST['id_pegawai']."'");
        if($uPegawai){
            echo '<script>
            swal({
              title: "Berhasil",
               text: "Berhasil Ubah Data !",
                icon: "success"
              }).then(function() {
                window.location.href = "index.php?url=pegawai";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }else{
        echo '<script>
            swal({
              title: "Gagal",
               text: "Gagal Ubah Data",
                icon: "error"
              }).then(function() {
                window.location.href = "index.php?url=pegawai";
                console.log("The Ok Button was clicked.");
                });
            </script>';
}
}
if(isset($_GET['delete'])){
    $id = $_GET['id'];
    $sql = mysqli_query($conn,"select * from employee where id_pegawai='".$id."'");
    $data = mysqli_fetch_array($sql);
    if($data['id_user'] == $_SESSION['id_user']){
        echo '<script>
            swal({
              title: "Peringatan",
               text: "Data Tidak Boleh di Hapus",
                icon: "error"
              }).then(function() {
                window.location.href = "index.php?url=pegawai";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }else{
        $dPegawai = mysqli_query($conn,"update employee set stts='0' where id_pegawai='".$data['id_pegawai']."'")or die(mysqli_error($conn));
        if($dPegawai){
            echo '<script>
            swal({
              title: "Berhasil",
               text: "Berhasil Hapus Data !",
                icon: "success"
              }).then(function() {
                window.location.href = "index.php?url=pegawai";
                console.log("The Ok Button was clicked.");
                });
            </script>';
        }else{
            echo '<script>
                swal({
                title: "Gagal",
                text: "Gagal Hapus Data",
                icon: "error"
                }).then(function() {
                window.location.href = "index.php?url=pegawai";
                console.log("The Ok Button was clicked.");
                });
                </script>';
        }
    }
}
$autoIDuser1 = mysqli_query($conn,"select id_pegawai from employee");
if(mysqli_num_rows($autoIDuser1) != 0){
    while($dataUser1 = mysqli_fetch_assoc($autoIDuser1)){
        $arrayUser1[] = substr($dataUser1['id_pegawai'],3);
    }
$nilaiUser1 = max($arrayUser1);
}else{
$nilaiUser1 = 0;
}
$akhirUser1 = $nilaiUser1+1;
echo '<script>console.log("'.$akhirUser1.'")</script>';
?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">people</i>
        </div>
        <div class="card-content">
            <form class="navbar-form navbar-right" action='index.php?url=pegawai' method='post' role="search">
                <div class="form-group form-search is-empty">
                    <input type="text" name='cari' class="form-control" value='<?php if(isset($_POST['cari'])){ echo $_POST['cari'];}?>' placeholder=" Search ">
                    <span class="material-input"></span>
                </div>
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                </button>
            </form>
            <h4 class="card-title">Pegawai</h4>
            <button class="btn btn-raised btn-round btn-info" data-toggle="modal" data-target="#noticeModal">
                Tambah Pegawai
            </button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Pegawai </th>
                            <th class='text-center'>Nama</th>
                            <th class='text-center'>Alamat</th>
                            <th class='text-center'>Nomer Telepon</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $halaman = 2;
                            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                            $tampilkanPegawai = mysqli_query($conn,"Select * from employee where stts='1'");
                            $total = mysqli_num_rows($tampilkanPegawai);
                            $pages = ceil($total/$halaman);
                            if(isset($_POST['cari']) && $_POST['cari']!= null ){
                                $cari = $_POST['cari'];
                                $query = mysqli_query($conn,"select * from employee where stts='1' and nama_pegawai like '%".$cari."%' ")or die(mysqli_error($conn));
                            }else{
                                $query = mysqli_query($conn,"select * from employee where stts='1' LIMIT $mulai, $halaman")or die(mysqli_error($conn));
                            }

                            $no =$mulai+1;
                            if($total > 0){
                                while($dataPegawai = mysqli_fetch_assoc($query)){
                                    echo '<tr>';
                                    echo '<td> <center>'.$no.'</center> </td>';
                                    echo '<td> <center>'.$dataPegawai['id_pegawai'].'</center> </td>';
                                    echo '<td> <center>'.$dataPegawai['nama_pegawai'].'</center> </td>';
                                    echo '<td> <center>'.$dataPegawai['alamat_pegawai'].'</center> </td>';
                                    echo '<td> <center>'.$dataPegawai['notlp_pegawai'].'</center> </td>';
                                    echo '<td class="td-actions"> <center> <a rel="tooltip" class="btn btn-success btn-round" href="index.php?url=pegawai&edit&idpegawai='.$dataPegawai['id_pegawai'].'">
                                    <i class="material-icons">edit</i></a>
                                    <button type="button" onclick="hapus(this.value)" value='.$dataPegawai['id_pegawai'].' rel="tooltip" class="btn btn-round btn-danger" name="del">
                                        <i class="material-icons">delete</i>
                                    </button> </center> </td>';
                                    echo '</tr>';

                                $no++;	//menambah jumlah nomor urut setiap row
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
                        <a id='bahan' href="index.php?url=pegawai&halaman=<?php echo $i; ?>" value='<?php echo $i;?>'><?php echo $i; ?></a>
                    </li>
                    <?php } } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                <h5 class="modal-title" id="myModalLabel">Tambah Pegawai</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="">
                <div class="form-group label-floating">
                    <label class="control-label">ID Pegawai</label>
                    <input type="text" id='bersih_modal' class="form-control" name='id_pegawai' value='PEG<?php echo $akhirUser1;?>' readonly>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Nama</label>
                    <input type="text" required id='bersih_modal' class="form-control" name='nama_pegawai'>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Alamat</label>
                    <input type="text" required id='bersih_modal' class="form-control" name='alamat_pegawai'>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Nomer Telepon</label>
                    <input type="text" required id='bersih_modal' class="form-control" name='notlp_pegawai'>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">ID User</label>
                    <input type="text" id='bersih_modal' class="form-control" name='id_user' value='USR<?php echo $akhirUser;?>' readonly>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Username</label>
                    <input maxLength='11' required id='bersih_modal' type="text" class="form-control" name='username'>
                    <span class="help-block">Maksimal panjang karakter 11.</span>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Password</label>
                    <input minLength='4' required id='bersih_modal' type="text" class="form-control" name='password'>
                    <span class="help-block">Minimal 4 karakter</span>
                </div>
                <button type="submit" class="btn btn-fill btn-rose" name='tambah'>Tambah</button>
            </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_GET['edit'])){
    $tampiledit = mysqli_query($conn,'select * from employee where id_pegawai="'.$_GET['idpegawai'].'" and stts=1');
    if($dataedit = mysqli_fetch_assoc($tampiledit)){
?>
<div class="modal fade in" id="noticeModal" style="display: block; padding-left: 16px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notice">
        <div class="modal-content">
            <div class="modal-header">
                <a href='index.php?url=pegawai' class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></a>
                <h5 class="modal-title" id="myModalLabel">Tambah Pegawai</h5>
            </div>
            <div class="modal-body">
            <form method="post" action="index.php?url=pegawai&edit1">
                <div class="form-group label-floating">
                    <label class="control-label">ID Pegawai</label>
                    <input type="text" id='bersih_modal' class="form-control" name='id_pegawai' value='<?php echo $dataedit['id_pegawai'] ?>' readonly>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Nama</label>
                    <input type="text" id='bersih_modal' class="form-control" name='nama_pegawai' value='<?php echo $dataedit['nama_pegawai'] ?>'>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Alamat</label>
                    <input type="text" id='bersih_modal' class="form-control" name='alamat_pegawai' value='<?php echo $dataedit['alamat_pegawai'] ?>'>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Nomer Telepon</label>
                    <input type="text" id='bersih_modal' class="form-control" name='notlp_pegawai' value='<?php echo $dataedit['notlp_pegawai'] ?>'>
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">ID User</label>
                    <input type="text" id='bersih_modal' class="form-control" name='id_user' value='<?php echo $dataedit['id_user'] ?>' readonly>
                </div>
                <button type="submit" class="btn btn-fill btn-rose" name='ubah'>Ubah</button>
            </form>
            </div>
        </div>
    </div>
</div>
    <?php }} ?>

<script>
function hapus(parameter) {
        swal({
  title: "Informasi",
  text: "Apakah Yakin Menghapus Data?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Ya",
  cancelButtonText: "Batal",
  closeOnConfirm: false,
  closeOnCancel: true
})
.then(function() {
 window.location.href = "index.php?url=pegawai&delete&id="+parameter+"";
});
}
</script>

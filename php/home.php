<?php 

include 'koneksi.php';
$sql = mysqli_query($conn,"SELECT nama_pegawai from employee where id_user='".$_SESSION['id_user']."'");
$data = mysqli_fetch_array($sql);

$jPendaftar = mysqli_query($conn,"Select * from pendaftaran where param=1") or die(mysqli_error($conn));
$dataPendaftar = mysqli_num_rows($jPendaftar);
?> 

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">&#xE894;</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Welcome</h4>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1"><h1>Selamat Datang, <?php  echo $data['nama_pegawai']; ?></h1></div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">&#xE894;</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Jumlah Data Pendaftar <?php echo $dataPendaftar; ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">&#xE894;</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Welcome</h4>
                
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">&#xE894;</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Welcome</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">&#xE894;</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Welcome</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">&#xE894;</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Welcome</h4>
            </div>
        </div>
    </div> -->
</div>
<?php 
include 'koneksi.php';
$no_reg = mysqli_query($conn,"select no_registrasi from pendaftaran");
if(mysqli_num_rows($no_reg) != 0){
    while($dataReg = mysqli_fetch_assoc($no_reg)){
        $arrayReg[] = substr($dataReg['no_registrasi'],3);
    }
$nilaiReg = max($arrayReg);
}else{
$nilaiReg = 0;
}
$akhirReg = $nilaiReg+1;
?>

<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">assignment</i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Pendaftaran</h4>
            <form method="post" action="">
                <div class="form-group label-floating col-md-12">
                    <label class="control-label">No Registrasi</label>
                    <input type="text" readonly name='no_registrasi' class="form-control" value='REG<?php echo $akhirReg; ?>'>
                </div>
                <div class="form-group label-floating col-md-4">
                    <label class="control-label">No KK</label>
                    <input type="text" name='no_kk' class="form-control" maxlength="16" required>
                </div>
                <div class="form-group label-floating col-md-4">
                    <label class="control-label">No KTP</label>
                    <input type="text" name='no_ktp' class="form-control" maxlength="16" required>
                </div>
                <div class="form-group label-floating col-md-4">
                    <label class="control-label">No BPJS</label>
                    <input type="text" name='no_bpjs' class="form-control" maxlength="16" required>
                </div>
                <div class="form-group label-floating col-md-4">
                    <label class="control-label">Nama</label>
                    <input type="text" name='nama' class="form-control" required>
                </div>
                <div class="form-group label-floating col-md-4">
                    <label class="control-label">Alamat</label>
                    <input type="text" name='alamat' class="form-control" required>
                </div>
                <div class="form-group label-floating col-md-4">
                    <label class="control-label">No Telp</label>
                    <input type="text" name='notlp' class="form-control" maxlength="13" required>
                </div>
                <div class="form-group label-floating col-md-12">
                    <select class="selectpicker" name='agama_pasien' data-style="select-with-transition" data-size="7" required>
                        <option disabled selected>Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katholik">Katholik</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="form-group label-floating col-md-12">
                    <select class="selectpicker" name='golongan_darah' data-style="select-with-transition" data-size="7" required>
                        <option disabled selected>Golongan Darah</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="form-group label-floating col-md-6">
                    <label class="control-label">Pendidikan</label>
                    <input type="text" name='pendidikan' class="form-control" maxlength="10" required>
                </div>
                <div class="form-group label-floating col-md-6">
                    <label class="control-label">Pekerjaan</label>
                    <input type="text" name='pekerjaan' class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="label-control">Tanggal Lahir</label>
                    <input type="date" name='tgl_lahir' class="form-control" />
                </div>
                <div class="form-group col-md-6">
                    <label class="label-control">Tanggal Datang</label>
                    <input type="date" name='tgl_daftar' class="form-control" value="<?php echo (new \DateTime())->format('Y-m-d'); ?>" readonly/>
                </div>
                <div class="col-md-12">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-rose" name='tambah'>Tambah Pendaftaran</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include 'koneksi.php';

if(isset($_POST['tambah'])){
    $noreg = $_POST['no_registrasi'];
    $noktp = $_POST['no_ktp'];
    $nokk = $_POST['no_kk'];
    $nobpjs = $_POST['no_bpjs'];
    $nama = $_POST['nama'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $notlp = $_POST['notlp'];
    $agama = $_POST['agama_pasien'];
    $gol_darah = $_POST['golongan_darah'];
    $pendidikan = $_POST['pendidikan'];
    $pekerjaan = $_POST['pekerjaan'];
    $tgl_daftar = $_POST['tgl_daftar'];

    $daftar = mysqli_query($conn,"insert into pendaftaran values('$noreg','$noktp','$nokk','$nobpjs','$nama','$tgl_lahir','$alamat','$notlp','$agama','$gol_darah','$pendidikan','$pekerjaan','$tgl_daftar','1')");
    if($daftar){
        echo '<script>
            swal({ 
              title: "Berhasil",
               text: "Berhasil Menambah Data !",
                icon: "success" 
              }).then(function() {
                window.location.href = "index.php?url=pendaftaran-tambah";
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
                window.location.href = "index.php?url=pendaftaran-tambah";
                console.log("The Ok Button was clicked.");
                });
            </script>';
    }
}
?>
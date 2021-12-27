<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">build</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Ubah Password</h4>
                <form method="POST" action="">
                    <div class="form-group label-floating">
                        <label class="control-label">Username</label>
                        <input type="text" name='username' class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Password Lama</label>
                        <input type="password" name='pass' class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Password Baru</label>
                        <input type="password" name='pass1' class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Konfirmasi Password Baru</label>
                        <input type="password" name='passbaru' class="form-control">
                    </div>
                    <button type="submit" class="btn btn-fill btn-rose" name='submit'>Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 

include 'koneksi.php';
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $passlama = $_POST['pass'];
    $passbaru = $_POST['pass1'];
    $konfirmasi = $_POST['passbaru'];

    if($passbaru != $konfirmasi){
        echo '<script>
            swal({ 
              title: "Peringatan",
               text: "Password Tidak Cocok",
                icon: "error" 
              });
            </script>';
    }else{
        $sql = mysqli_query($conn,"select * from user where username='$username' and id_user='".$_SESSION['id_user']."' and stts='1'");
        $row = mysqli_num_rows($sql);
        if($row != 0){
            $uUser = mysqli_query($conn,"update user set password='$konfirmasi' where id_user='".$_SESSION
            ['id_user']."' and stts='1'");
            
            echo '<script>
            swal({ 
              title: "Berhasil",
               text: "Berhasil Ubah Password !",
                icon: "success" 
              }).then(function() {
                window.location.href = "index.php?url=ubah";
                console.log("The Ok Button was clicked.");
                });
            </script>';
        }else{
            echo '<script>
            swal({ 
              title: "Peringatan",
               text: "Username Tidak Terdaftar",
                icon: "error" 
              });
            </script>';
        }
    }
}

?>        
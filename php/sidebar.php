<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href=# class="simple-text logo-mini"> 
        <i class="material-icons">email</i> 
        </a>
        <a href=# class="simple-text logo-normal">
        Bidan Ny.Lathoifah
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="assets/img/faces/person2.png" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        <?php 
                            include 'koneksi.php';
                            $sql = mysqli_query($conn,"SELECT nama_pegawai from employee where id_user='".$_SESSION['id_user']."'");
                            $data = mysqli_fetch_array($sql);
                            echo $data['nama_pegawai'];
                        ?>
                        <b class="caret"></b>
                    </span>
                </a>
                <!-- <div class="clearfix"></div> -->
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li id='ubah'>
                            <a href="index.php?url=ubah">
                                <span class="sidebar-mini"> <i class="material-icons">lock</i> </span>
                                <span class="sidebar-normal">Ubah Password </span>
                            </a>
                        </li>
                        <li id='logout'>
                            <a href="index.php?url=logout">
                                <span class="sidebar-mini">  <i class="material-icons">exit_to_app</i>  </span>
                                <span class="sidebar-normal"> Keluar </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li id='dashboard'>
                <a href="index.php?url=home">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li id='pegawai'>
                <a href="index.php?url=pegawai">
                    <i class="material-icons">people</i>
                    <p> Pegawai </p>
                </a>
            </li>
            <li id='pendaftaran'>
                <a data-toggle="collapse" href="#componentsExamples" class='collapsed'>
                    <i class="material-icons">apps</i>
                    <p> Pendaftaran
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li id='pendaftaran-list'>
                            <a href="index.php?url=pendaftaran">
                                <span class="sidebar-mini"> <i class="material-icons">list</i> </span>
                                <span class="sidebar-normal"> List Pendaftaran </span>
                            </a>
                        </li>
                        <li id='pendaftaran-tambah'>
                            <a href="index.php?url=pendaftaran-tambah">
                                <span class="sidebar-mini"> <i class="material-icons">library_add</i> </span>
                                <span class="sidebar-normal"> Tambah Pendaftaran </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li id='pasien'>
                <a data-toggle="collapse" href="#pasien-sidebar" class='collapsed'>
                    <i class="material-icons">accessible</i>
                    <p> Pasien
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pasien-sidebar">
                    <ul class="nav">
                        <li id='pasien-umum'>
                            <a href="index.php?url=pasien-umum">
                                <span class="sidebar-mini"> PU </span>
                                <span class="sidebar-normal"> Pasien Umum </span>
                            </a>
                        </li>
                        <li id='pasien-hamil'>
                            <a href="index.php?url=pasien-hamil">
                                <span class="sidebar-mini"> PH </span>
                                <span class="sidebar-normal"> Pasien Hamil </span>
                            </a>
                        </li>
                        <li id='pasien-kb'>
                            <a href="index.php?url=pasien-kb">
                                <span class="sidebar-mini"> PK </span>
                                <span class="sidebar-normal"> Pasien KB </span>
                            </a>
                        </li>
                        <li id='pasien-imunisasi'>
                            <a href="index.php?url=pasien-imunisasi">
                                <span class="sidebar-mini"> PI </span>
                                <span class="sidebar-normal"> Pasien Imunisasi </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>





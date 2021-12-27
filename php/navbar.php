<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <text class="navbar-brand" disabled href="#">
                <?php 
                if(isset($_GET['url'])){
                $url = $_GET['url'];
                if($url=='home'||$url==null){
                    echo 'Dashboard';
                }
                else if($url=='pegawai'){
                    echo 'Pegawai';
                }
                else if($url=='pendaftaran'){
                    echo 'Pendaftaran List';
                }
                else if($url=='pembayaran'){
                    echo 'Pembayaran';
                }
                else if($url=='ubah'){
                    echo 'Ubah Password';
                }
                else if($url=='pasien-umum'){
                    echo 'Pasien Umum';
                }
                else if($url=='pendaftaran-tambah'){
                    echo 'Pendaftaran Tambah';
                }
                else if($url=='pasien-kb'){
                    echo 'Pasien KB';
                }
                else if($url=='pasien-imunisasi'){
                    echo 'Pasien Imunisasi';
                }
                else if($url=='pasien-hamil'){
                    echo 'Pasien Hamil';
                }
                else if($url=='detail-pasien'){
                    echo 'Pasien Hamil';
                }
                else{
                    echo 'Dashboard';
                }
            }else{
                echo 'Dashboard';
            }
                ?>
            </text>
        </div>
    </div>
</nav>
<?php
$jalan = empty($_GET['url']) ? 'home' : $_GET['url'];
switch($jalan){
    case 'home':
        include 'home.php';
        break;
    case 'pegawai':
        include 'table/pegawai.php';
        break;
    case 'logout':
        include 'table/logout.php';
        break;
    case 'ubah':
        include 'table/ubah.php';
        break;
    case 'pendaftaran':
        include 'table/pendaftaran.php';
        break;
    case 'pendaftaran-tambah':
        include 'table/pendaftaran-tambah.php';
        break;
    case 'pasien-umum':
        include 'table/pasien-umum.php';
        break;
    case 'pasien-hamil':
        include 'table/pasien-hamil.php';
        break;
    case 'pasien-kb':
        include 'table/pasien-kb.php';
        break;
    case 'pasien-imunisasi':
        include 'table/pasien-imunisasi.php';
        break;
    case 'detail-pasien':
        include 'table/detail-pasien.php';
        break;
    case 'detail-pasien-umum':
        include 'table/detail-pasien-umum.php';
        break;
    case 'detail-pasien-kb':
        include 'table/detail-pasien-kb.php';
        break;
    case 'detail-pasien-imunisasi':
        include 'table/detail-pasien-imunisasi.php';
        break;
    default :
        include 'home.php';
}
?>
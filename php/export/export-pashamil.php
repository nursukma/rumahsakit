<?php
require_once "../vendor/autoload.php";
require_once "../koneksi.php";
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
 
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
 
$activeSheet->setCellValue('A1', 'No');
$activeSheet->setCellValue('B1', 'ID Pasien Hamil');
$activeSheet->setCellValue('C1', 'No Registrasi');
$activeSheet->setCellValue('D1', 'HPHT');
$activeSheet->setCellValue('E1', 'HTP');
$activeSheet->setCellValue('F1', 'Lingkar Lengan');
$activeSheet->setCellValue('G1', 'Lingkar Lengan nok Kek');
$activeSheet->setCellValue('H1', 'Tinggi Badan');
$activeSheet->setCellValue('I1', 'Golongan Darah');
$activeSheet->setCellValue('J1', 'Riwayat Penyakit');
$activeSheet->setCellValue('K1', 'Riwayat Alergi');
$activeSheet->setCellValue('L1', 'Hamil Ke');
$activeSheet->setCellValue('M1', 'Jumlah Persalinan');
$activeSheet->setCellValue('N1', 'Jumlah Keguguran');
$activeSheet->setCellValue('O1', 'Anak Hidup');
$activeSheet->setCellValue('P1', 'Anak Mati');
$activeSheet->setCellValue('Q1', 'Jarak Kehamilan');
$activeSheet->setCellValue('R1', 'Tanggal Datang');


$query = mysqli_query($conn,"SELECT * FROM pasien_hamil where tgl_daftar between '".$_POST['mulai']."' and '".$_POST['sampai']."'  ");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['id_pashamil']);
        $activeSheet->setCellValue('C'.$i , $row['no_registrasi']);
        $activeSheet->setCellValue('D'.$i , $row['hpht']);
        $activeSheet->setCellValue('E'.$i , $row['htp']);
        $activeSheet->setCellValue('F'.$i , $row['lingkar_lengan_kek']);
        $activeSheet->setCellValue('G'.$i , $row['lingkar_lengan_nonkek']);
        $activeSheet->setCellValue('H'.$i , $row['tinggi_badan']);
        $activeSheet->setCellValue('I'.$i , $row['golongan_darah']);
        $activeSheet->setCellValue('J'.$i , $row['riwayat_penyakit']);
        $activeSheet->setCellValue('K'.$i , $row['riwayat_alergi']);
        $activeSheet->setCellValue('L'.$i , $row['hamil_ke']);
        $activeSheet->setCellValue('M'.$i , $row['jumlah_persalinan']);
        $activeSheet->setCellValue('N'.$i , $row['jumlah_keguguran']);
        $activeSheet->setCellValue('O'.$i , $row['anak_hidup']);
        $activeSheet->setCellValue('P'.$i , $row['anak_mati']);
        $activeSheet->setCellValue('Q'.$i , $row['jarak_kehamilan']);
        $activeSheet->setCellValue('R'.$i , $row['tgl_daftar']);

        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
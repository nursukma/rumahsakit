<?php
require_once "../vendor/autoload.php";
require_once "../koneksi.php";
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
 
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
 
$activeSheet->setCellValue('A1', 'No Registrasi');
$activeSheet->setCellValue('B1', $_POST['noreg']);
$activeSheet->setCellValue('A2', 'Nama Pasien');
$activeSheet->setCellValue('B2', $_POST['nm_pas']);

$activeSheet->setCellValue('A4', 'No');
$activeSheet->setCellValue('B4', 'Tanggal Datang');
$activeSheet->setCellValue('C4', 'Keluhan');
$activeSheet->setCellValue('D4', 'Tekanan Darah');
$activeSheet->setCellValue('E4', 'Umur Kehamilan');
$activeSheet->setCellValue('F4', 'Tinggi Fundus');
$activeSheet->setCellValue('G4', 'Letak Janin');
$activeSheet->setCellValue('H4', 'Denyut Jantung');
$activeSheet->setCellValue('I4', 'Hasil Pemeriksaan');
$activeSheet->setCellValue('J4', 'Tindakan');
$activeSheet->setCellValue('K4', 'Nasihat');
$activeSheet->setCellValue('L4', 'Keterangan');
$activeSheet->setCellValue('M4', 'Tanggal Kembali');


$query = mysqli_query($conn,"SELECT * FROM detail_hamil where no_registrasi='".$_POST['noreg']."'");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 5;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['tgl_datang']);
        $activeSheet->setCellValue('C'.$i , $row['keluhan']);
        $activeSheet->setCellValue('D'.$i , $row['tekanan_darah']);
        $activeSheet->setCellValue('E'.$i , $row['umur_kehamilan']);
        $activeSheet->setCellValue('F'.$i , $row['tinggi_fundus']);
        $activeSheet->setCellValue('G'.$i , $row['letak_janin']);
        $activeSheet->setCellValue('H'.$i , $row['denyut_jantung']);
        $activeSheet->setCellValue('I'.$i , $row['hasil_periksa']);
        $activeSheet->setCellValue('J'.$i , $row['tindakan']);
        $activeSheet->setCellValue('K'.$i , $row['nasihat']);
        $activeSheet->setCellValue('L'.$i , $row['keterangan']);
        $activeSheet->setCellValue('M'.$i , $row['tgl_kembali']);
        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
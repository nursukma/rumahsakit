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
$activeSheet->setCellValue('B1', 'ID Pasien Umum');
$activeSheet->setCellValue('C1', 'No Registrasi');
$activeSheet->setCellValue('D1', 'Keluhan');
$activeSheet->setCellValue('E1', 'Tekanan Darah');
$activeSheet->setCellValue('F1', 'Berat Badan');
$activeSheet->setCellValue('G1', 'Suhu Badan');
$activeSheet->setCellValue('H1', 'Diagnosa');
$activeSheet->setCellValue('I1', 'Terapi');
$activeSheet->setCellValue('J1', 'Keterangan');
$activeSheet->setCellValue('K1', 'Tanggal Datang');


$query = mysqli_query($conn,"SELECT * FROM pasien_umum where tgl_daftar between '".$_POST['mulai']."' and '".$_POST['sampai']."'  ");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['id_pasumum']);
        $activeSheet->setCellValue('C'.$i , $row['no_registrasi']);
        $activeSheet->setCellValue('D'.$i , $row['keluhan']);
        $activeSheet->setCellValue('E'.$i , $row['tekanan_darah']);
        $activeSheet->setCellValue('F'.$i , $row['berat_badan']);
        $activeSheet->setCellValue('G'.$i , $row['suhu_badan']);
        $activeSheet->setCellValue('H'.$i , $row['diagnosa']);
        $activeSheet->setCellValue('I'.$i , $row['terapi']);
        $activeSheet->setCellValue('J'.$i , $row['keterangan']);
        $activeSheet->setCellValue('K'.$i , $row['tgl_daftar']);
        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
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
$activeSheet->setCellValue('B4', 'Berat Badan');
$activeSheet->setCellValue('C4', 'Tensi Darah');
$activeSheet->setCellValue('D4', 'Tanggal Kembali');
$activeSheet->setCellValue('E4', 'Keterangan');
$activeSheet->setCellValue('F4', 'Tanggal Datang');


$query = mysqli_query($conn,"SELECT * FROM pasien_kb where no_registrasi='".$_POST['noreg']."'");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 5;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['berat_badan']);
        $activeSheet->setCellValue('C'.$i , $row['tensi_darah']);
        $activeSheet->setCellValue('D'.$i , $row['tgl_kembali']);
        $activeSheet->setCellValue('E'.$i , $row['keterangan']);
        $activeSheet->setCellValue('F'.$i , $row['tgl_daftar']);
        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
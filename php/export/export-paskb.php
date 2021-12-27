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
$activeSheet->setCellValue('B1', 'ID Pasien KB');
$activeSheet->setCellValue('C1', 'No Registrasi');
$activeSheet->setCellValue('D1', 'Berat Badan');
$activeSheet->setCellValue('E1', 'Tensi Darah');
$activeSheet->setCellValue('F1', 'Tanggal Kembali');
$activeSheet->setCellValue('G1', 'Keterangan');
$activeSheet->setCellValue('H1', 'Tanggal Datang');


$query = mysqli_query($conn,"SELECT * FROM pasien_kb where tgl_daftar between '".$_POST['mulai']."' and '".$_POST['sampai']."'  ");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['id_paskb']);
        $activeSheet->setCellValue('C'.$i , $row['no_registrasi']);
        $activeSheet->setCellValue('D'.$i , $row['berat_badan']);
        $activeSheet->setCellValue('E'.$i , $row['tensi_darah']);
        $activeSheet->setCellValue('F'.$i , $row['tgl_kembali']);
        $activeSheet->setCellValue('G'.$i , $row['keterangan']);
        $activeSheet->setCellValue('H'.$i , $row['tgl_daftar']);
        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
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
$activeSheet->setCellValue('C4', 'Tinggi Badan');
$activeSheet->setCellValue('D4', 'Nama Anak');
$activeSheet->setCellValue('E4', 'Jenis Imunisasi');
$activeSheet->setCellValue('F4', 'Keterangan');
$activeSheet->setCellValue('G4', 'Tanggal Datang');


$query = mysqli_query($conn,"SELECT * FROM pasien_imunisasi where no_registrasi='".$_POST['noreg']."'");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 5;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['berat_badan']);
        $activeSheet->setCellValue('C'.$i , $row['tinggi_badan']);
        $activeSheet->setCellValue('D'.$i , $row['nama_anak']);
        $activeSheet->setCellValue('E'.$i , $row['jenis_imunisasi']);
        $activeSheet->setCellValue('F'.$i , $row['keterangan']);
        $activeSheet->setCellValue('G'.$i , $row['tgl_daftar']);
        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
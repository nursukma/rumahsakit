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
$activeSheet->setCellValue('B1', 'ID Pasien Imunisasi');
$activeSheet->setCellValue('C1', 'No Registrasi');
$activeSheet->setCellValue('D1', 'Berat Badan');
$activeSheet->setCellValue('E1', 'Tinggi Badan');
$activeSheet->setCellValue('F1', 'Nama Anak');
$activeSheet->setCellValue('G1', 'Jenis Imunisasi');
$activeSheet->setCellValue('H1', 'Keterangan');
$activeSheet->setCellValue('I1', 'Tanggal Datang');


$query = mysqli_query($conn,"SELECT * FROM pasien_imunisasi where tgl_daftar between '".$_POST['mulai']."' and '".$_POST['sampai']."'  ");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['id_pasimun']);
        $activeSheet->setCellValue('C'.$i , $row['no_registrasi']);
        $activeSheet->setCellValue('D'.$i , $row['berat_badan']);
        $activeSheet->setCellValue('E'.$i , $row['tinggi_badan']);
        $activeSheet->setCellValue('F'.$i , $row['nama_anak']);
        $activeSheet->setCellValue('G'.$i , $row['jenis_imunisasi']);
        $activeSheet->setCellValue('H'.$i , $row['keterangan']);
        $activeSheet->setCellValue('I'.$i , $row['tgl_daftar']);
        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
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
$activeSheet->setCellValue('B1', 'No Registrasi');
$activeSheet->setCellValue('C1', 'No KTP');
$activeSheet->setCellValue('D1', 'No KK');
$activeSheet->setCellValue('E1', 'No BPJS');
$activeSheet->setCellValue('F1', 'Nama Pasien');
$activeSheet->setCellValue('G1', 'Tgl Lahir');
$activeSheet->setCellValue('H1', 'Alamat');
$activeSheet->setCellValue('I1', 'No Telepon');
$activeSheet->setCellValue('J1', 'Agama');
$activeSheet->setCellValue('K1', 'Golongan Darah');
$activeSheet->setCellValue('L1', 'Pendidikan');
$activeSheet->setCellValue('M1', 'Pekerjaan');
$activeSheet->setCellValue('N1', 'Tanggal Datang');


$query = mysqli_query($conn,"SELECT * FROM pendaftaran where tgl_daftar between '".$_POST['mulai']."' and '".$_POST['sampai']."'  ");
$no=1;
if(mysqli_num_rows($query)> 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i , $no);
        $activeSheet->setCellValue('B'.$i , $row['no_registrasi']);
        $activeSheet->setCellValue('C'.$i , $row['no_ktp']);
        $activeSheet->setCellValue('D'.$i , $row['no_kk']);
        $activeSheet->setCellValue('E'.$i , $row['no_bpjs']);
        $activeSheet->setCellValue('F'.$i , $row['nama_pasien']);
        $activeSheet->setCellValue('G'.$i , $row['lahir_pasien']);
        $activeSheet->setCellValue('H'.$i , $row['alamat_pasien']);
        $activeSheet->setCellValue('I'.$i , $row['notlp_pasien']);
        $activeSheet->setCellValue('J'.$i , $row['agama_pasien']);
        $activeSheet->setCellValue('K'.$i , $row['goldarah_pasien']);
        $activeSheet->setCellValue('L'.$i , $row['pendidikan_pasien']);
        $activeSheet->setCellValue('M'.$i , $row['pekerjaan_pasien']);
        $activeSheet->setCellValue('N'.$i , $row['tgl_daftar']);
        $i++;
        $no++;
    }
}
 
$filename = $_POST['nama_file'].'.xlsx';
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
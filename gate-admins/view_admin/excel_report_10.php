<?php
include "../../cfg/general.php";
include "../../control/inc_function2.php";

$nim_10         = json_decode($_POST['nim_10'],True);
$user_name_10   = json_decode($_POST['user_name_10'],True);
$nilai_10       = json_decode($_POST['nilai_10'],True);
$awal          = $_POST['start'];
$akhir            = $_POST['end'];
$customer       = $_POST['param'];
   $field = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O'];
require_once "../../".$GLOBALS["xls-reader-dir"]."PHPExcel.php";

// create php excel object
$doc = new PHPExcel();
//set lebar kolom
$doc->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(4);
$doc->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(25);
$doc->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(20);
$doc->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(50);
$doc->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(12);
// set active sheet 
$doc->setActiveSheetIndex(0)->mergeCells('A1:E1')
            ->setCellValue('A1', 'DAFTAR PESERTA ');
$doc->setActiveSheetIndex(0)->mergeCells('A2:E2')
            ->setCellValue('A2', 'PELATIHAN DAN SERTIFIKASI KOMPETENSI TI - '.$customer);
$doc->setActiveSheetIndex(0)->mergeCells('A3:E3')
            ->setCellValue('A3', ' 10% NILAI TERTINGGI PERIODE '.tanggal_indo($awal).' Sampai '.tanggal_indo($akhir));

$doc->setActiveSheetIndex(0)
            ->setCellValue('A4', 'No')
            ->setCellValue('B4', 'No Sertifikasi')
            ->setCellValue('C4', 'NIM')
            ->setCellValue('D4', 'Nama')
            ->setCellValue('E4', 'Nilai');
$baris=5;
$nomor=1;
foreach ($nim_10 as $key => $value) {
    $doc->setActiveSheetIndex(0)->setCellValue($field[0].$baris,$nomor);    
    $doc->setActiveSheetIndex(0)->setCellValue($field[1].$baris,' ');   
    $doc->setActiveSheetIndex(0)->setCellValue($field[2].$baris,' '.$nim_10[$key]);    
    $doc->setActiveSheetIndex(0)->setCellValue($field[3].$baris,$user_name_10[$key]);    
    $doc->setActiveSheetIndex(0)->setCellValue($field[4].$baris,$nilai_10[$key]);    
   
    $baris++;
    $nomor++;
}
$doc->getActiveSheet()->getStyle("A4:E".$baris)->applyFromArray(
  array('borders' => 
        array('allborders' => 
            array('style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    )
);

//$doc->getActiveSheet()->fromArray($lulus);

//save our workbook as this file name
$filename = '10% Nilai Tertinggi '.$customer.' Periode '.tanggal_indo($awal).' - '.tanggal_indo($akhir).'.xls';
//mime type
header('Content-Type: application/vnd.ms-excel');
//tell browser what's the file name
header('Content-Disposition: attachment;filename="' . $filename . '"');

header('Cache-Control: max-age=0'); //no cache
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format

$objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');

//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>
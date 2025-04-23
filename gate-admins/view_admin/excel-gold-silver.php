<?php

include "../../cfg/general.php";
include "../../control/inc_function2.php";
$data = json_decode($_POST['isi'], True);
$start = $_POST['start'];
$end    = $_POST['end'];
$param    = $_POST['param'];
$field = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
$n_gold = 1;
$n_silver = 1;
$n_gagal = 1;
foreach ($data as $key => $value) {
	if ($value['nilai'] >= 70) {
		$gold_nim[$n_gold] = $value['nim'];    //nim
		$gold_nama[$n_gold] = trim($value['nama']);    //nama
		$gold_nilai[$n_gold] = $value['nilai'] . '%';   //nilai
		$n_gold++;
	} elseif ($value['nilai'] < 70) {
		if ($value['nilai'] < 50) {
			$gagal_nim[$n_gagal] = $value['nim'];  //nim
			$gagal_nama[$n_gagal] = trim($value['nama']);  //nama
			$gagal_nilai[$n_gagal] = $value['nilai'] . '%';  //nilai
			$n_gagal++;
		} else {
			$silver_nim[$n_silver] = $value['nim']; //nim
			$silver_nama[$n_silver] = $value['nama']; //nama
			$silver_nilai[$n_silver] = $value['nilai'] . '%'; //nilai
			$n_silver++;
		}
	}
}

require_once "../../" . $GLOBALS["xls-reader-dir"] . "PHPExcel.php";
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Trust")
	->setLastModifiedBy("Trust")
	->setTitle("Exam Report")
	->setSubject("Exam Report")
	->setDescription("Exam Report")
	->setKeywords("Exam Report")
	->setCategory("Exam Report");

array_multisort($gold_nama, SORT_ASC, SORT_STRING, $gold_nim, $gold_nilai);
array_multisort($silver_nama, SORT_ASC, SORT_STRING, $silver_nim, $silver_nilai);
// create php excel object
$doc = new PHPExcel();
//set lebar kolom
$doc->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(4);
$doc->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(25);
$doc->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(16);
$doc->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(37);
$doc->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(7);


$doc->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
$doc->getActiveSheet()->getRowDimension(1)->setRowHeight(42);
$doc->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
// set active sheet
$doc->setActiveSheetIndex(0)->mergeCells('A1:E1')
	->setCellValue('A1', 'DAFTAR PESERTA UJIAN TIK ' . $param . ' PERIODE ' . tanggal_indo($start) . ' Sampai ' . tanggal_indo($end));
//efek bold
$doc->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A2")->getFont()->setSize(16);
//GOLD
$doc->setActiveSheetIndex(0)->mergeCells('A2:E2')
	->setCellValue('A2', 'GOLD');
//efek bold

$doc->getActiveSheet()->getStyle("A3:E3")->getFont()->setBold(true);
$doc->setActiveSheetIndex(0)
	->setCellValue('A3', 'No')
	->setCellValue('B3', 'No Sertifikasi')
	->setCellValue('C3', 'NIM')
	->setCellValue('D3', 'Nama')
	->setCellValue('E3', 'Nilai');
$baris = 4;
$nomor = 1;
foreach ($gold_nim as $key => $value) {
	$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
	$doc->setActiveSheetIndex(0)->setCellValue($field[1] . $baris, ' ');
	$doc->setActiveSheetIndex(0)->setCellValue($field[2] . $baris, $gold_nim[$key]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[3] . $baris, $gold_nama[$key]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[4] . $baris, $gold_nilai[$key]);
	$baris++;
	$nomor++;
}

$baris = $baris + 2;
//SILVER
$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setSize(16);
$doc->setActiveSheetIndex(0)->mergeCells('A' . $baris . ':E' . $baris)
	->setCellValue('A' . $baris, 'SILVER');
$baris++;

$doc->getActiveSheet()->getStyle("A" . $baris . ":E" . $baris)->getFont()->setBold(true);
$doc->setActiveSheetIndex(0)
	->setCellValue('A' . $baris, 'No')
	->setCellValue('B' . $baris, 'No Sertifikasi')
	->setCellValue('C' . $baris, 'NIM')
	->setCellValue('D' . $baris, 'Nama')
	->setCellValue('E' . $baris, 'Nilai');
$nomor = 1;
$baris++;
foreach ($silver_nim as $key => $value) {
	$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
	$doc->setActiveSheetIndex(0)->setCellValue($field[1] . $baris, ' ');
	$doc->setActiveSheetIndex(0)->setCellValue($field[2] . $baris, $silver_nim[$key]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[3] . $baris, $silver_nama[$key]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[4] . $baris, $silver_nilai[$key]);

	$baris++;
	$nomor++;
}

$baris = $baris + 2;

// //efek bold
// $doc->getActiveSheet()->getStyle("A".$baris)->getFont()->setBold( true );
// $doc->getActiveSheet()->getStyle("A".$baris)->getFont()->setSize(16);
// //GAGAL
// $doc->setActiveSheetIndex(0)->mergeCells('A'.$baris.':I'.$baris)
//             ->setCellValue('A'.$baris, 'PESERTA TIDAK LULUS');
//             $baris++;

// //efek bold
// $doc->getActiveSheet()->getStyle("A".$baris.":I".$baris)->getFont()->setBold( true );
// $doc->setActiveSheetIndex(0)
//             ->setCellValue('A'.$baris, 'No')
//             ->setCellValue('B'.$baris, 'No Sertifikasi')
//             ->setCellValue('C'.$baris, 'NIM')
//             ->setCellValue('D'.$baris, 'Nama')
//             ->setCellValue('E'.$baris, 'Nilai');
// $baris++;
// $nomor=1;
// foreach ($gagal_nim as $key => $value) {
// 	$doc->setActiveSheetIndex(0)->setCellValue($field[0].$baris,$nomor);
// 	$doc->setActiveSheetIndex(0)->setCellValue($field[1].$baris,' ');
//     $doc->setActiveSheetIndex(0)->setCellValue($field[2].$baris,$gagal_nim[$key]);
//     $doc->setActiveSheetIndex(0)->setCellValue($field[3].$baris,$gagal_nama[$key]);
// 	$doc->setActiveSheetIndex(0)->setCellValue($field[4].$baris,$gagal_nilai[$key]);

// 	$baris++;
// 	$nomor++;
// }

$doc->getActiveSheet()->getStyle("A3:E" . $baris)->applyFromArray(
	array(
		'borders' =>
		array(
			'allborders' =>
			array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
//$doc->getActiveSheet()->fromArray($lulus);

//save our workbook as this file name
$filename = 'TABEL GOLD-SILVER ' . $param . '.xls';
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

<?php
include "../../cfg/general.php";
include "../../control/inc_function2.php";
$data = json_decode($_POST['isi'], True);
$invoice = json_decode($_POST['ujian_ke1'], True);
$remidi = json_decode($_POST['ujian_ke2'], True);
$examheader = json_decode($_POST['examheader']);
$start = $_POST['start'];
$end    = $_POST['end'];
$param    = $_POST['param'];
$count = count($lulus[1]);
$field = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];

require_once "../../" . $GLOBALS["xls-reader-dir"] . "PHPExcel.php";
$doc = new PHPExcel();
$doc->getProperties()->setCreator("Trust")
	->setLastModifiedBy("Trust")
	->setTitle("Exam Report")
	->setSubject("Exam Report")
	->setDescription("Exam Report")
	->setKeywords("Exam Report")
	->setCategory("Exam Report");

$doc->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(4);
$doc->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(5);
$doc->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(16);
$doc->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(37);
$doc->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
$doc->setActiveSheetIndex(0)->getColumnDimension('F')->setAutoSize(true);
$doc->setActiveSheetIndex(0)->getColumnDimension('G')->setAutoSize(true);
$doc->setActiveSheetIndex(0)->getColumnDimension('H')->setAutoSize(true);

$doc->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
$doc->getActiveSheet()->getRowDimension(1)->setRowHeight(42);
$doc->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
// set active sheet 
$doc->setActiveSheetIndex(0)->mergeCells('A1:H1')
	->setCellValue('A1', 'DAFTAR PESERTA UJIAN TIK ' . $param . ' PERIODE ' . tanggal_indo($start) . ' SAMPAI ' . tanggal_indo($end));

$doc->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A2")->getFont()->setSize(16);
$doc->setActiveSheetIndex(0)->mergeCells('A2:E2')
	->setCellValue('A2', 'UJIAN PERTAMA');
$doc->setActiveSheetIndex(0)
	->setCellValue('A3', 'No')
	->setCellValue('B3', 'Sesi')
	->setCellValue('C3', 'NIM')
	->setCellValue('D3', 'Nama')
	->setCellValue('E3', 'Nilai')
	// ->setCellValue('F3', $examheader[4])
	// ->setCellValue('G3', $examheader[5])
	// ->setCellValue('H3', $examheader[6]);
	->setCellValue('F3', 'Word')
	->setCellValue('G3', 'Excel')
	->setCellValue('H3', 'P.Point');
$baris = 4;
$nomor = 1;
foreach ($invoice as $key => $value) {
	$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
	$doc->setActiveSheetIndex(0)->setCellValue($field[1] . $baris, $value[0]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[2] . $baris, $value[1]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[3] . $baris, $value[2]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[4] . $baris, $value[6]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[5] . $baris, $value[5]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[6] . $baris, $value[3]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[7] . $baris, $value[4]);
	$baris++;
	$nomor++;
}

$baris = $baris + 2;

//efek bold
$doc->getActiveSheet()->getStyle("A" . $baris . ":T" . $baris)->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setSize(16);

$doc->setActiveSheetIndex(0)->mergeCells('A' . $baris . ':H' . $baris)
	->setCellValue('A' . $baris, 'PESERTA REMIDI (MENGULANG)');
$baris++;

$doc->getActiveSheet()->getStyle("A" . $baris . ":T" . $baris)->getFont()->setBold(true);
$doc->setActiveSheetIndex(0)
	->setCellValue('A' . $baris, 'No')
	->setCellValue('B' . $baris, 'Sesi')
	->setCellValue('C' . $baris, 'NIM')
	->setCellValue('D' . $baris, 'Nama')
	->setCellValue('E' . $baris, 'Nilai')
	->setCellValue('F' . $baris, 'Word')
	->setCellValue('G' . $baris, 'Excel')
	->setCellValue('H' . $baris, 'P.Point');
	// ->setCellValue('F', $examheader[4])
	// ->setCellValue('G', $examheader[5])
	// ->setCellValue('H', $examheader[6]);
	$baris++;
foreach ($remidi as $key => $value) {
	$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
	$doc->setActiveSheetIndex(0)->setCellValue($field[1] . $baris, $value[0]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[2] . $baris, $value[1]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[3] . $baris, $value[2]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[4] . $baris, $value[6]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[5] . $baris, $value[5]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[6] . $baris, $value[3]);
	$doc->setActiveSheetIndex(0)->setCellValue($field[7] . $baris, $value[4]);
	$baris++;
	$nomor++;
}

$doc->getActiveSheet()->getStyle("A3:H3")->getFont()->setBold(true);

$doc->getActiveSheet()->getStyle("A3:H" . $baris)->applyFromArray(
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
$filename = 'Invoice ' . $param . '.xls';
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

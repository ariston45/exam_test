<?php
include "../../cfg/general.php";
include "../../control/inc_function2.php";
$lulus = json_decode($_POST['lulus'], True);
$gagal = json_decode($_POST['gagal'], True);
$ujian_ke2 = json_decode($_POST['ujian_ke2'], True);
$examheader = json_decode($_POST['examheader']);
$start = $_POST['start'];
$end    = $_POST['end'];
$param    = $_POST['param'];
$list = array(1 => 'sesi', 'nim', 'nama', 'nilai', 'nilai_w', 'nilai_e', 'nilai_p');
$count = count($lulus[1]);
$field = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
// foreach ($examheader as $key => $value) {
// 	echo $key.'. '.$value.'<br>';
// }
// die();
require_once "../../" . $GLOBALS["xls-reader-dir"] . "PHPExcel.php";
$doc = new PHPExcel();
$doc->getProperties()->setCreator("Trust")
	->setLastModifiedBy("Trust")
	->setTitle("Exam Report")
	->setSubject("Exam Report")
	->setDescription("Exam Report")
	->setKeywords("Exam Report")
	->setCategory("Exam Report");

$doc->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A1")->getFont()->setSize(16);
$doc->getActiveSheet()->getRowDimension(1)->setRowHeight(42);
$doc->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
$doc->setActiveSheetIndex(0)->mergeCells('A1:H1')
	->setCellValue('A1', 'DAFTAR PESERTA UJIAN TIK ' . $param . ' PERIODE ' . tanggal_indo($start) . ' SAMPAI ' . tanggal_indo($end));

//set lebar kolom
$doc->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(4);
$doc->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(5);
$doc->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(16);
$doc->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(37);
$doc->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
$doc->setActiveSheetIndex(0)->getColumnDimension('F')->setAutoSize(true);
$doc->setActiveSheetIndex(0)->getColumnDimension('G')->setAutoSize(true);
$doc->setActiveSheetIndex(0)->getColumnDimension('H')->setAutoSize(true);

//efek bold
$doc->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A2")->getFont()->setSize(16);

$doc->setActiveSheetIndex(0)->mergeCells('A2:H2')
	->setCellValue('A2', 'PESERTA LULUS');

//efek bold
$doc->getActiveSheet()->getStyle("A3:I3")->getFont()->setBold(true);
$doc->setActiveSheetIndex(0)
	->setCellValue('A3', 'No')
	->setCellValue('B3', 'Sesi')
	->setCellValue('C3', 'NIM')
	->setCellValue('D3', 'Nama')
	->setCellValue('E3', 'Nilai')
	// ->setCellValue('F3', $examheader[2])
	// ->setCellValue('G3', $examheader[0])
	// ->setCellValue('H3', $examheader[1]);
	->setCellValue('F3', 'Word')
	->setCellValue('G3', 'Excel')
	->setCellValue('H3', 'P.Point');
$baris = 4;
$nomor = 1;
foreach ($lulus as $key => $value) {
	$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
	for ($i = 1; $i <= $count; $i++) {
		$doc->setActiveSheetIndex(0)->setCellValue($field[$i] . $baris, $value[$list[$i]]);
	}
	$baris++;
	$nomor++;
}

$baris = $baris + 2;

//efek bold
$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setSize(16);
$doc->setActiveSheetIndex(0)->mergeCells('A' . $baris . ':H' . $baris)
	->setCellValue('A' . $baris, 'PESERTA TIDAK LULUS');
$baris++;

//efek bold
$doc->getActiveSheet()->getStyle("A" . $baris . ":I" . $baris)->getFont()->setBold(true);
$doc->setActiveSheetIndex(0)
	->setCellValue('A' . $baris, 'No')
	->setCellValue('B' . $baris, 'Sesi')
	->setCellValue('C' . $baris, 'NIM')
	->setCellValue('D' . $baris, 'Nama')
	->setCellValue('E' . $baris, 'Nilai')
	// ->setCellValue('F'. $baris, $examheader[4])
	// ->setCellValue('G'. $baris, $examheader[5])
	// ->setCellValue('H'. $baris, $examheader[6]);
	->setCellValue('F' . $baris, 'Word')
	->setCellValue('G' . $baris, 'Excel')
	->setCellValue('H' . $baris, 'P.Point');
$baris++;
foreach ($gagal as $key => $value) {
	$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
	for ($i = 1; $i <= $count; $i++) {
		$doc->setActiveSheetIndex(0)->setCellValue($field[$i] . $baris, $value[$list[$i]]);
	}
	$baris++;
	$nomor++;
}

$baris = $baris + 2;

//efek bold
$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setBold(true);
$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setSize(16);
$doc->setActiveSheetIndex(0)->mergeCells('A' . $baris . ':H' . $baris)
	->setCellValue('A' . $baris, 'PESERTA UJIAN KE 2');
$baris++;

//efek bold
$doc->getActiveSheet()->getStyle("A" . $baris . ":H" . $baris)->getFont()->setBold(true);
$doc->setActiveSheetIndex(0)
	->setCellValue('A' . $baris, 'No')
	->setCellValue('B' . $baris, 'Sesi')
	->setCellValue('C' . $baris, 'NIM')
	->setCellValue('D' . $baris, 'Nama')
	->setCellValue('E' . $baris, 'Nilai')
	// ->setCellValue('F'. $baris, $examheader[4])
	// ->setCellValue('G'. $baris, $examheader[5])
	// ->setCellValue('H'. $baris, $examheader[6]);
	->setCellValue('F' . $baris, 'Word')
	->setCellValue('G' . $baris, 'Excel')
	->setCellValue('H' . $baris, 'P.Point');
$baris++;
$nomor = 1;
foreach ($ujian_ke2 as $key => $value) {
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
$filename = $param . '.xls';
//mime type
header('Content-Type: application/vnd.ms-excel');
//tell browser what's the file name
header('Content-Disposition: attachment;filename="Report - ' . $filename . '"');

header('Cache-Control: max-age=0'); //no cache
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format

$objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');

//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');

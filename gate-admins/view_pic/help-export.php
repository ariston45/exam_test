<?php
// die('hai');
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
function dataVoucher($idV)
{
	$sql1 = 'select b.program_name,c.cust_name from transact_voucher a inner join programs b on a.id_program=b.id_program inner join customer c on a.id_customer = c.id_customer where a.id_voucher ="' . $idV . '" ';
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	$dataVoucher = mysqli_fetch_array($res1);
	return $dataVoucher;
}
function dataSchedule($idG)
{
	$sql1 = 'select a.date, a.start_time from exam_schedule a inner join exam_group b on a.exam_group = b.exam_code where b.group_name = "' . $idG . '"';
	//echo $sql1.'<br>';
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	$dataSchedule = mysqli_fetch_array($res1);
	return $dataSchedule;
}
function dataCustomer($idC)
{
	$sql1 = 'select cust_name from customer where id_customer = "' . $idC . '"';
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	$dataCustomer = mysqli_fetch_array($res1);
	return $dataCustomer;
}
function outputXLS($header, $field, $filename, $start, $end)
{
	require_once "../../" . $GLOBALS["xls-reader-dir"] . "PHPExcel.php";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Trust")
		->setLastModifiedBy("Trust")
		->setTitle("Exam Report")
		->setSubject("Exam Report")
		->setDescription("Exam Report")
		->setKeywords("Exam Report")
		->setCategory("Exam Report");
	$index = ['0' => 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

	//tabel
	$styleArray = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => 'FFFFFF')
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		)
	);
	$styleJudul = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '000000'),
			'size' => 16
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		)
	);
	$sheet_id = 0;

	foreach ($field as $kode_ujian => $field_desc) {
		//echo $kode_ujian;
		//print_r($objPHPExcel->getActiveSheet()->setTitle($kode_ujian));
		//isinya
		if ($kode_ujian != '0') {
			$sbtr = substr($kode_ujian, 0, 2);
			if ($sbtr == 'VC') {
				$id_voucher  = explode('.', $kode_ujian);
				$dataVoucher = dataVoucher($id_voucher[0]);
				$judul = $dataVoucher[1] . ' - ' . $dataVoucher[0];
				$subjudul = "Periode : " . tanggal_indo($start) . " Sampai " . tanggal_indo($end);
				if ($id_voucher[1] != null) {
					$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A3:H3')->applyFromArray($styleJudul);
					$objPHPExcel->setActiveSheetIndex($sheet_id)
						->mergeCells('A3:H3')->setCellValue('A3', 'Peserta Kesempatan ke - ' . $id_voucher[1]);
				}
			} else {
				$a = explode('.', $kode_ujian);
				$dataCustomer = dataCustomer($a[0]);
				$judul = "Nilai Customer " . $dataCustomer[0];
				$subjudul = "Periode : " . tanggal_indo($start) . " Sampai " . tanggal_indo($end);
			}
		}
		$baris = 2;
		if ($kode_ujian != '0') {
			$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A1:H1')->applyFromArray($styleJudul);
			$objPHPExcel->setActiveSheetIndex($sheet_id)
				->mergeCells('A1:H1')->setCellValue('A1', $judul);
			$baris++;
		}
		if ($kode_ujian != '0') {
			$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A2:H2')->applyFromArray($styleJudul);
			$objPHPExcel->setActiveSheetIndex($sheet_id)
				->mergeCells('A2:H2')->setCellValue('A2', $subjudul);
			$baris++;
		}
		foreach ($field_desc as $no_key => $isi) {
			//membuat header dan setting header
			if ($no_key == 1) {
				foreach ($header as $header_key => $header_value) {
					$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key] . $baris)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key] . $baris)->getFill()->getStartColor()->setRGB('215967');
					$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[$header_key] . $baris)->applyFromArray($styleArray);
					$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension($index[$header_key])->setAutoSize(true);
					$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[$header_key] . $baris, $header_value);
				}
				$baris++;
			}
			//isi komolomnya
			$objPHPExcel->setActiveSheetIndex($sheet_id)
				->setCellValue($index[0] . $baris, $no_key);
			foreach ($isi as $key => $value) {
				$objPHPExcel->setActiveSheetIndex($sheet_id)
					->setCellValue($index[$key + 1] . $baris, $value);
			}
			$baris++;
		}
		$objPHPExcel->createSheet();
		$objPHPExcel->getActiveSheet($sheet_id)->setTitle('Sheet ' . ($sheet_id + 1));

		$sheet_id++;
	}
	$objPHPExcel->setActiveSheetIndex(0);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
}
function ExamOutputXLS($header, $field, $filename, $start, $end)
{
	require_once "../../" . $GLOBALS["xls-reader-dir"] . "PHPExcel.php";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Trust")
		->setLastModifiedBy("Trust")
		->setTitle("Exam Report")
		->setSubject("Exam Report")
		->setDescription("Exam Report")
		->setKeywords("Exam Report")
		->setCategory("Exam Report");
	$index = ['0' => 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

	//tabel
	$styleArray = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => 'FFFFFF')
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	);
	$styleJudul = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '000000'),
			'size' => 16
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,

		)
	);
	$styleBorder = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	);
	$sheet_id = 0;
	$objPHPExcel->createSheet();

	foreach ($field as $kode_ujian => $field_desc) {
		//echo $kode_ujian;
		//print_r($objPHPExcel->getActiveSheet()->setTitle($kode_ujian));
		//isinya
		if ($kode_ujian != '0') {
			$sbtr = substr($kode_ujian, 0, 2);
			if ($sbtr == 'VC') {
				$id_voucher  = explode('.', $kode_ujian);
				$dataVoucher = dataVoucher($id_voucher[0]);
				$judul = $dataVoucher[1] . ' - ' . $dataVoucher[0];
				$subjudul = "Periode : " . tanggal_indo($start) . " Sampai " . tanggal_indo($end);
				if ($id_voucher[1] != null) {
					if ($id_voucher[1] == 1) {
						$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A3:I3')->applyFromArray($styleJudul);
						$objPHPExcel->setActiveSheetIndex($sheet_id)
							->mergeCells('A3:I3')->setCellValue('A3', 'Peserta Exam');
						$baris = 2;
					} elseif ($id_voucher[1] == 2) {
						if ($baris == 0) {
							$baris = 2;
						}
						$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A' . ($baris + 1) . ':I' . ($baris + 1))->applyFromArray($styleJudul);
						$objPHPExcel->setActiveSheetIndex($sheet_id)
							->mergeCells('A' . ($baris + 1) . ':I' . ($baris + 1))->setCellValue('A' . ($baris + 1), 'Peserta Re-Exam');
					}
				}
			} else {
				$a = explode('.', $kode_ujian);
				$dataCustomer = dataCustomer($a[0]);
				$judul = "Nilai Customer " . $dataCustomer[0];
				$subjudul = "Periode : " . tanggal_indo($start) . " Sampai " . tanggal_indo($end);
			}
		}
		if ($kode_ujian != '0') {
			$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A1:I1')->applyFromArray($styleJudul);
			$objPHPExcel->setActiveSheetIndex($sheet_id)
				->mergeCells('A1:I1')->setCellValue('A1', $judul);
			$baris++;
		}
		if ($kode_ujian != '0') {
			$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A2:I2')->applyFromArray($styleJudul);
			$objPHPExcel->setActiveSheetIndex($sheet_id)
				->mergeCells('A2:I2')->setCellValue('A2', $subjudul);
			$baris++;
		}
		foreach ($field_desc as $no_key => $isi) {
			//membuat header dan setting header
			if ($no_key == 1) {
				foreach ($header as $header_key => $header_value) {
					$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key] . $baris)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key] . $baris)->getFill()->getStartColor()->setRGB('215967');
					$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[$header_key] . $baris)->applyFromArray($styleArray);
					//$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension($index[$header_key])->setWidth(15);
					$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension($index[$header_key])->setAutoSize(true);
					$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[$header_key] . $baris, $header_value);
				}
				$baris++;
			}
			//isi komolomnya
			$objPHPExcel->setActiveSheetIndex($sheet_id)
				->setCellValue($index[0] . $baris, $no_key);
			$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[0] . $baris)->applyFromArray($styleBorder);

			foreach ($isi as $key => $value) {
				$objPHPExcel->setActiveSheetIndex($sheet_id)
					->setCellValue($index[$key + 1] . $baris, $value);
				$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[$key + 1] . $baris)->applyFromArray($styleBorder);
			}
			$baris++;
		}
		$objPHPExcel->getActiveSheet($sheet_id)->setTitle('Sheet ' . ($sheet_id + 1));
		$objPHPExcel->getActiveSheet($sheet_id)->getStyle('E4:G999')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('E')->setAutoSize(false);
		$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('F')->setAutoSize(false);
		$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('G')->setAutoSize(false);
		$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('E')->setWidth('11');
		$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('F')->setWidth('11');
		$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('G')->setWidth('10');
		$objPHPExcel->getActiveSheet($sheet_id)->getRowDimension(1)->setRowHeight(-1);

		//$sheet_id++;
	}
	$objPHPExcel->setActiveSheetIndex(0);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
}
function ExamGelombang($header, $id_voucher, $start, $end)
{
	$examheader = json_decode($_POST['examheader'], True);
	$examlulus = json_decode($_POST['examlulus'], True);
	$examgagal = json_decode($_POST['examgagal'], True);
	$reexamlulus = json_decode($_POST['reexamlulus'], True);
	$reexamgagal = json_decode($_POST['reexamgagal'], True);
	$ujian_ke2 = json_decode($_POST['ujian_ke2'], True);
	$start = $_POST['start'];
	$end    = $_POST['end'];
	$param    = $_POST['param'];
	$list = array(1 =>'waktu', 'nim', 'nama', 'nilai_w', 'nilai_e', 'nilai_p', 'nilai', 'status');
	// $count = count($lulus[1]) + 1;
	$field = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
	// print_r($lulus);
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

	$dataVoucher = dataVoucher($id_voucher);
	$judul = $dataVoucher[1] . ' - ' . $dataVoucher[0];
	$subjudul = "Periode : " . tanggal_indo($start) . " Sampai " . tanggal_indo($end);
	$styleJudul = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '000000'),
			'size' => 16
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		)
	);
	$doc->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleJudul);
	$doc->setActiveSheetIndex()->mergeCells('A1:I1')->setCellValue('A1', $judul);
	$doc->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleJudul);
	$doc->setActiveSheetIndex()->mergeCells('A2:I2')->setCellValue('A2', $subjudul);

	//set lebar kolom
	$doc->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(4);
	$doc->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(10);
	$doc->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(20);
	$doc->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(37);
	$doc->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(12);
	$doc->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(12);
	$doc->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(12);
	$doc->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(12);
	$doc->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);

	//efek bold
	$doc->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);
	$doc->getActiveSheet()->getStyle("A3")->getFont()->setSize(16);

	$doc->setActiveSheetIndex(0)->mergeCells('A3:J3')
		->setCellValue('A3', 'Peserta Exam');

	//efek header
	$styleArray = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => 'FFFFFF')
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'wrap' => true,
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	);
	$doc->getActiveSheet()->getStyle("A4:I4")->getFont()->setBold(true);
	$doc->getActiveSheet()->getStyle("A4:I4")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$doc->getActiveSheet()->getStyle("A4:I4")->getFill()->getStartColor()->setRGB('215967');
	$doc->getActiveSheet()->getStyle("A4:I4")->applyFromArray($styleArray);
	$doc->setActiveSheetIndex(0)
		->setCellValue('A4', 'No')
		->setCellValue('B4', 'Date')
		->setCellValue('C4', 'ID Student')
		->setCellValue('D4', 'Student Name')
		->setCellValue('E4', $examheader[2])
		->setCellValue('F4', $examheader[0])
		->setCellValue('G4', $examheader[1])
		->setCellValue('H4', 'Average')
		->setCellValue('I4', 'Status');
	$baris = 5;
	$nomor = 1;
	foreach ($examlulus as $key => $value) {
		$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
		for ($i = 1; $i <= 9; $i++) {
			$doc->setActiveSheetIndex(0)->setCellValue($field[$i] . $baris, $value[$list[$i]]);
		}
		$baris++;
		$nomor++;
	}
	foreach ($examgagal as $key => $value) {
		$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
		for ($i = 1; $i <= 9; $i++) {
			$doc->setActiveSheetIndex(0)->setCellValue($field[$i] . $baris, $value[$list[$i]]);
		}
		$baris++;
		$nomor++;
	}

	$baris = $baris + 2;

	//efek bold
	$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setBold(true);
	$doc->getActiveSheet()->getStyle("A" . $baris)->getFont()->setSize(16);
	$doc->setActiveSheetIndex(0)->mergeCells('A' . $baris . ':J' . $baris)
		->setCellValue('A' . $baris, 'PESERTA Re-Exam');
	$baris++;

	//efek bold
	$doc->getActiveSheet()->getStyle("A" . $baris . ":I" . $baris)->getFont()->setBold(true);
	$doc->getActiveSheet()->getStyle("A" . $baris . ":I" . $baris)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$doc->getActiveSheet()->getStyle("A" . $baris . ":I" . $baris)->getFill()->getStartColor()->setRGB('215967');
	$doc->getActiveSheet()->getStyle("A" . $baris . ":I" . $baris)->applyFromArray($styleArray);
	$doc->getActiveSheet()->getStyle("A" . $baris . ":I" . $baris)->getFont()->setBold(true);
	$doc->setActiveSheetIndex(0)
		->setCellValue('A' . $baris, 'No')
		->setCellValue('B' . $baris, 'Date')
		->setCellValue('C' . $baris, 'ID Student')
		->setCellValue('D' . $baris, 'Student Name')
		->setCellValue('E' . $baris, 	$examheader[2])
		->setCellValue('F' . $baris, 	$examheader[0])
		->setCellValue('G' . $baris, 	$examheader[1])
		->setCellValue('H' . $baris, 'Average')
		->setCellValue('I' . $baris, 'Status');
	$baris++;
	foreach ($reexamlulus as $key => $value) {
		$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
		for ($i = 1; $i <= 9; $i++) {
			$doc->setActiveSheetIndex(0)->setCellValue($field[$i] . $baris, $value[$list[$i]]);
		}
		$baris++;
		$nomor++;
	}
	foreach ($reexamgagal as $key => $value) {
		$doc->setActiveSheetIndex(0)->setCellValue($field[0] . $baris, $nomor);
		for ($i = 1; $i <= 9; $i++) {
			$doc->setActiveSheetIndex(0)->setCellValue($field[$i] . $baris, $value[$list[$i]]);
		}
		$baris++;
		$nomor++;
	}

	$baris = $baris + 2;
	$doc->getActiveSheet()->getStyle('F4:H999')->getAlignment()->setWrapText(true);
	$doc->getActiveSheet()->getStyle("A4:I" . $baris)->applyFromArray(
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
}
if (isset($_POST['param'])) {
	$nama = json_decode($_POST['nama'], True);
	$isi	= json_decode($_POST['isi'], True);
	$start = $_POST['start'];
	$end	= $_POST['end'];
	$ksort = ksort($isi);
	if (isset($_POST['report']) and $_POST['report'] == 1) {
		// die('disini');
		ExamOutputXLS($nama, $isi, $_POST['param'], $start, $end);
	} else if (isset($_POST['report']) and $_POST['report'] == 2) {
		// die('digelombang');
		ExamGelombang($nama, $_POST['voucher'], $start, $end);
	} else {
		// die('disana');
		outputXLS($nama, $isi, $_POST['param'], $start, $end);
	}
}

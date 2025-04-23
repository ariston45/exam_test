<?php
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
function dataVoucher($idV){
	$sql1 = 'select b.program_name,c.cust_name from transact_voucher a inner join programs b on a.id_program=b.id_program inner join customer c on a.id_customer = c.id_customer where a.id_voucher ="'.$idV.'" ';
	$res1 = mysqli_query($GLOBALS['link'],$sql1) or die(mysqli_error($GLOBALS['link']).'<br>'.$sql1);
	$dataVoucher = mysqli_fetch_array($res1);
	return $dataVoucher;
}
function dataSchedule($idG){
	$sql1 = 'select a.date, a.start_time from exam_schedule a inner join exam_group b on a.exam_group = b.exam_code where b.group_name = "'.$idG.'"';
	//echo $sql1.'<br>';
	$res1 = mysqli_query($GLOBALS['link'],$sql1) or die(mysqli_error($GLOBALS['link']).'<br>'.$sql1);
	$dataSchedule = mysqli_fetch_array($res1);
	return $dataSchedule;
}
function dataCustomer($idC){
	$sql1 = 'select cust_name from customer where id_customer = "'.$idC.'"';
	$res1 = mysqli_query($GLOBALS['link'],$sql1) or die(mysqli_error($GLOBALS['link']).'<br>'.$sql1);
	$dataCustomer = mysqli_fetch_array($res1);
	return $dataCustomer;
}
function outputXLS($header,$field,$filename,$start,$end){
	require_once "../../".$GLOBALS["xls-reader-dir"]."PHPExcel.php";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Trust")
							 ->setLastModifiedBy("Trust")
							 ->setTitle("Exam Report")
							 ->setSubject("Exam Report")
							 ->setDescription("Exam Report")
							 ->setKeywords("Exam Report")
							 ->setCategory("Exam Report");
$index = ['0'=>'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','Q','R','S','T','U','V','W','X','Y','Z'];
 
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
$sheet_id=0;
	
foreach ($field as $kode_ujian => $field_desc) {
	//echo $kode_ujian;
	//print_r($objPHPExcel->getActiveSheet()->setTitle($kode_ujian));
	//isinya
	if ($kode_ujian!='0') {
		$sbtr = substr($kode_ujian,0,2);
		if ($sbtr == 'VC') {
			$id_voucher  = explode('.',$kode_ujian) ;
			$dataVoucher = dataVoucher($id_voucher[0]);
			$judul = $dataVoucher[1].' - '.$dataVoucher[0];
			$subjudul = "Periode : ".tanggal_indo($start)." Sampai ".tanggal_indo($end);
			if ($id_voucher[1]!=null) {
				$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A3:H3')->applyFromArray($styleJudul);
				$objPHPExcel->setActiveSheetIndex($sheet_id)
				->mergeCells('A3:H3')->setCellValue('A3','Peserta Kesempatan ke - '.$id_voucher[1]);
			}
		}else{
			$a = explode('.', $kode_ujian);
			$dataCustomer = dataCustomer($a[0]);
			$judul = "Nilai Customer ".$dataCustomer[0];
			$subjudul = "Periode : ".tanggal_indo($start)." Sampai ".tanggal_indo($end);
		}
	}
	$baris=2;
	if ($kode_ujian!='0') {
		$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A1:H1')->applyFromArray($styleJudul);
		$objPHPExcel->setActiveSheetIndex($sheet_id)
		->mergeCells('A1:H1')->setCellValue('A1',$judul);
		$baris++;
	}
	if ($kode_ujian!='0') {
		$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A2:H2')->applyFromArray($styleJudul);
		$objPHPExcel->setActiveSheetIndex($sheet_id)
		->mergeCells('A2:H2')->setCellValue('A2',$subjudul);
		$baris++;
	}
	foreach ($field_desc as $no_key => $isi) {
		//membuat header dan setting header
		if ($no_key==1) {
			foreach ($header as $header_key => $header_value) {
				$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key].$baris)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key].$baris)->getFill()->getStartColor()->setRGB('215967');
				$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[$header_key].$baris)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension($index[$header_key])->setAutoSize(true);
				$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[$header_key].$baris,$header_value );
			}
			$baris++;
		}
		//isi komolomnya
			$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[0].$baris,$no_key );
		foreach ($isi as $key => $value) {
			$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[$key+1].$baris,$value );
		}
		$baris++;
	}
	$objPHPExcel->createSheet();
	$objPHPExcel->getActiveSheet($sheet_id)->setTitle('Sheet '.($sheet_id+1));

	$sheet_id++;
}		
	$objPHPExcel->setActiveSheetIndex(0);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
}
function ExamOutputXLS($header,$field,$filename,$start,$end){
	require_once "../../".$GLOBALS["xls-reader-dir"]."PHPExcel.php";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Trust")
							 ->setLastModifiedBy("Trust")
							 ->setTitle("Exam Report")
							 ->setSubject("Exam Report")
							 ->setDescription("Exam Report")
							 ->setKeywords("Exam Report")
							 ->setCategory("Exam Report");
$index = ['0'=>'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','Q','R','S','T','U','V','W','X','Y','Z'];
 
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
$sheet_id=0;
	$objPHPExcel->createSheet();
	
foreach ($field as $kode_ujian => $field_desc) {
	//echo $kode_ujian;
	//print_r($objPHPExcel->getActiveSheet()->setTitle($kode_ujian));
	//isinya
	if ($kode_ujian!='0') {
		$sbtr = substr($kode_ujian,0,2);
		if ($sbtr == 'VC') {
			$id_voucher  = explode('.',$kode_ujian) ;
			$dataVoucher = dataVoucher($id_voucher[0]);
			$judul = $dataVoucher[1].' - '.$dataVoucher[0];
			$subjudul = "Periode : ".tanggal_indo($start)." Sampai ".tanggal_indo($end);
			if ($id_voucher[1]!=null) {
				if ($id_voucher[1]==1) {
					$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A3:H3')->applyFromArray($styleJudul);
				$objPHPExcel->setActiveSheetIndex($sheet_id)
				->mergeCells('A3:H3')->setCellValue('A3','Peserta Exam');
				$baris=2;

				}elseif ($id_voucher[1]==2) {
					if ($baris == 0) {
						$baris = 2;
					}
					$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A'.($baris+1).':H'.($baris+1))->applyFromArray($styleJudul);
				$objPHPExcel->setActiveSheetIndex($sheet_id)
				->mergeCells('A'.($baris+1).':H'.($baris+1))->setCellValue('A'.($baris+1),'Peserta Re-Exam');
				}
				
			}
		}else{
			$a = explode('.', $kode_ujian);
			$dataCustomer = dataCustomer($a[0]);
			$judul = "Nilai Customer ".$dataCustomer[0];
			$subjudul = "Periode : ".tanggal_indo($start)." Sampai ".tanggal_indo($end);
		}
	}
	if ($kode_ujian!='0') {
		$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A1:H1')->applyFromArray($styleJudul);
		$objPHPExcel->setActiveSheetIndex($sheet_id)
		->mergeCells('A1:H1')->setCellValue('A1',$judul);
		$baris++;
	}
	if ($kode_ujian!='0') {
		$objPHPExcel->getActiveSheet($sheet_id)->getStyle('A2:H2')->applyFromArray($styleJudul);
		$objPHPExcel->setActiveSheetIndex($sheet_id)
		->mergeCells('A2:H2')->setCellValue('A2',$subjudul);
		$baris++;
	}
	foreach ($field_desc as $no_key => $isi) {
		//membuat header dan setting header
		if ($no_key==1) {
			foreach ($header as $header_key => $header_value) {
				$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key].$baris)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getSheet($sheet_id)->getStyle($index[$header_key].$baris)->getFill()->getStartColor()->setRGB('215967');
				$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[$header_key].$baris)->applyFromArray($styleArray);
				//$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension($index[$header_key])->setWidth(15);
				$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension($index[$header_key])->setAutoSize(true);
				$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[$header_key].$baris,$header_value );
			}
			$baris++;
		}
		//isi komolomnya
			$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[0].$baris,$no_key );
				$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[0].$baris)->applyFromArray($styleBorder);

		foreach ($isi as $key => $value) {
			$objPHPExcel->setActiveSheetIndex($sheet_id)
						->setCellValue($index[$key+1].$baris,$value );
				$objPHPExcel->getActiveSheet($sheet_id)->getStyle($index[$key+1].$baris)->applyFromArray($styleBorder);

		}
		$baris++;
	}
	$objPHPExcel->getActiveSheet($sheet_id)->setTitle('Sheet '.($sheet_id+1));
	$objPHPExcel->getActiveSheet($sheet_id)->getStyle('D4:F999')->getAlignment()->setWrapText(true); 
	$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('D')->setAutoSize(false);
	$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('E')->setAutoSize(false);
	$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('F')->setAutoSize(false);
	$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('D')->setWidth('11');
	$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('E')->setWidth('11');
	$objPHPExcel->getActiveSheet($sheet_id)->getColumnDimension('F')->setWidth('10');
	$objPHPExcel->getActiveSheet($sheet_id)->getRowDimension(1)->setRowHeight(-1);

	//$sheet_id++;
}		
	$objPHPExcel->setActiveSheetIndex(0);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
}
// if (isset($_GET['param'])) {
// 	$nama 	= json_decode($_GET['nama'],True);
// 	$isi	= json_decode($_GET['isi'],True);
// 	switch ($_GET['param']) {
// 		case 'exam':
// 			//print_r($isi);
// 			outputXLS($nama,$isi,$_GET['param']);
// 			break;
		
// 		default:
// 			outputXLS($nama,$isi,$_GET['param']);
			
// 			break;
// 	}
// }
if (isset($_POST['param'])) {
	$nama = json_decode($_POST['nama'],True);
	$isi	= json_decode($_POST['isi'],True);
	$start= $_POST['start'];
	$end	= $_POST['end'];
	$ksort = ksort($isi);
	if (isset($_POST['report'])) {
			ExamOutputXLS($nama,$isi,$_POST['param'],$start,$end);
	}else{
			outputXLS($nama,$isi,$_POST['param'],$start,$end);
	}
	// switch ($_POST['param']) {
	// 	case 'exam':
	// 		//print_r($header);
	// 		outputXLS($nama,$isi,$_POST['param'],$start,$end);
	// 		break;
		
	// 	default:
	// 		outputXLS($nama,$isi,$_POST['param'],$start,$end);
			
	// 		break;
	// }
}

?>
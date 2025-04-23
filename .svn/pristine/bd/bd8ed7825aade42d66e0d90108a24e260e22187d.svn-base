<?php
require_once "../../classes/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
// Set workbook properties
$spreadsheet->getProperties()->setCreator('Rob Gravelle')
  ->setLastModifiedBy('TRUST')
  ->setTitle('A Simple Excel Spreadsheet')
  ->setSubject('PhpSpreadsheet')
  ->setDescription('A Simple Excel Spreadsheet generated using PhpSpreadsheet.')
  ->setKeywords('Microsoft office 2013 php PhpSpreadsheet')
  ->setCategory('Report Exam');
/////////////////////////////////////////////////////////////////////////////////////////////////
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$idg = $_GET['idg'];
$filename = $name = $_GET['name'];
$date1 = $_GET['d1'];
$date2 = $_GET['d2'];
$programs = $_GET['pro'];
$idses = $_SESSION['admin_group'];
if (isset($date1) != true or isset($date2) != true) {
  echo ('hahah');
}
// function savingLog1($note, $dt1, $dt2, $prog)
// {
//   $id_customer = $_SESSION['admin_group'];
//   $id_user = $_SESSION["admin_id"];
//   $date = date("dmy");
//   $sel_id = "SELECT MAX(CONVERT(SUBSTRING_INDEX(a.id_report,'.',-1),UNSIGNED INTEGER)) as val FROM customer_log_report a 
// 	WHERE SUBSTRING_INDEX(a.id_report,'.',1) = '$id_customer'";
//   $run_id = mysqli_query($GLOBALS['link'], $sel_id) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sel_id);
//   $val_id = mysqli_fetch_array($run_id);
//   $id_report = $val_id[0];
//   $new_id = $id_report + 1;
//   $id = $id_customer . '.' . $date . '.' . $new_id;
//   $sql = "INSERT INTO `customer_log_report`(`id_report`,`id_creator`,`note`,`dt_1`,`dt_2`,`program`) 
// 	VALUES ('$id','$id_user','$note','$dt1','$dt2','$prog')";
//   $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
// }

function lastReport1($amn)
{
	// $amn = 10;
  $id = $_SESSION['admin_group'];
  $sql = "SELECT a.id_report,SUBSTRING_INDEX(SUBSTRING_INDEX(a.id_report,'.',2),'.',-1) date,a.note,b.fname,a.dt_1,a.dt_2,a.program 
	FROM customer_log_report a LEFT JOIN users b ON a.id_creator=b.id_user 
	WHERE SUBSTRING_INDEX(a.id_report,'.',1) = '$id' ORDER BY CONVERT(SUBSTRING_INDEX(a.id_report,'.',-1),UNSIGNED INTEGER) ASC 
	LIMIT $amn ";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function groupSub1($id)
{
  $sql = "SELECT GROUP_CONCAT(aa.subject_name) result FROM 
	(SELECT c.subject_name FROM programs a 
	INNER JOIN program_detail b ON a.id_program = b.id_program 
	LEFT JOIN subject_ls c ON b.id_subject = c.id_subject WHERE a.id_program ='$id') aa";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $row = mysqli_fetch_array($res);
  return $row[0];
}

function sumPar1($id)
{
  $sql = "SELECT COUNT(b.id_student) FROM exam_group a INNER JOIN exam_session b ON a.exam_code = b.exam_code 
	WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.',2),'.',-1) = '$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  $num = $dat[0];
  return $num;
}

function sumGrad1($id, $num, $min, $a, $b)
{
  $sql = "SELECT COUNT(aa.id_student) FROM (SELECT a.exam_code, b.id_student, ROUND((SUM(b.percentage_true)/$num)*100,2) val 
	FROM exam_session a INNER JOIN  exam_percentage b ON a.id_student=b.id_student WHERE a.start_time BETWEEN '$a' AND '$b' GROUP BY b.id_student ORDER BY a.exam_code ASC) aa WHERE aa.val >=$min";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  return $dat[0];
}

function sumUngrad1($id, $num, $min, $a, $b)
{
  $sql = "SELECT COUNT(aa.id_student) FROM (SELECT a.exam_code, b.id_student, ROUND((SUM(b.percentage_true)/$num)*100,2) val 
	FROM exam_session a INNER JOIN  exam_percentage b ON a.id_student=b.id_student WHERE a.start_time BETWEEN '$a' AND '$b' GROUP BY b.id_student ORDER BY a.exam_code ASC) aa WHERE aa.val <$min";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  return $dat[0];
}

function progReport1($id, $a, $b)
{
  $id_prog = $id;
  $data_a = $a;
  $data_b = $b;
  $period = date('d/M/Y', strtotime($data_a)) . '-' . date('d/M/Y', strtotime($data_b));
  if ($id_prog != 1) {
    $sql = "SELECT a.exam_code,c.program_name,c.sum_question,c.pass_grade,c.id_program 
		FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code=b.exam_group LEFT JOIN programs c ON SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.',2),'.',-1)=c.id_program  
		WHERE b.`status` != 'init' AND c.id_program='$id_prog' AND b.date BETWEEN '$data_a' AND '$data_b' GROUP BY a.exam_code";
  } else {
    $sql = "SELECT a.exam_code,c.program_name,c.sum_question,c.pass_grade,c.id_program 
		FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code=b.exam_group LEFT JOIN programs c ON SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.',2),'.',-1)=c.id_program  
		WHERE b.`status` != 'init' AND b.date BETWEEN '$data_a' AND '$data_b' GROUP BY a.exam_code";
  }
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$styleArray = [
  'borders' => [
    'outline' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['argb' => '000000'],
    ],
    'inside' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['argb' => '000000'],
    ]
  ],
  'fill' => [
    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    'rotation' => 90,
    'startColor' => [
      'argb' => '2E7D32',
    ],
  ],
  'font' => [
    'bold' => true,
    'color' => [
      'argb' => 'FFFFFF',
    ]
  ],
];
$styleArray_1 = [
  'borders' => [
    'outline' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['argb' => '000000'],
    ],
    'inside' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['argb' => '000000'],
    ]
  ],
];
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$num = 0;$a = 2 ; $h = 1;
$views = cekViewResult($idses);
$view = mysqli_fetch_array($views);;
if ($view[2] == 'true') {
  $spreadsheet->createSheet(0)->setTitle('Statistik');
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $h, 'Statistik Program Periode' . $date1 . ' / ' . $date2)->getColumnDimension('A')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $a, 'No')->getColumnDimension('A')->setAutoSize(true); // looping header 
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $a, 'Program')->getColumnDimension('B')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $a, 'Period')->getColumnDimension('C')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $a, 'Subjects')->getColumnDimension('D')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . $a, 'Participants')->getColumnDimension('F')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $a, 'Graduations')->getColumnDimension('G')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $a, 'Ungraduations')->getColumnDimension('H')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('H' . $a, 'Percent of Graduations')->getColumnDimension('I')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':H' . $a)->applyFromArray($styleArray);
  $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
  $data_1 = progReport1($programs, $date1, $date2);
  $no = 1;
  while ($row = mysqli_fetch_array($data_1)) {
    $a = 3;
    $col_1 = array();
    $programname = $row[1];
    $id = $row[4];
    $subject = groupSub1($id);
    $par = sumPar1($row[4]);
    $n_grad = sumGrad1($row[0], $row[2], $row[3], $date1, $date2);
    $n_ungrad = sumUngrad1($row[0], $row[2], $row[3], $date1, $date2);
    $pgrad = ($n_grad / $par) * 100 . ' %';
    $n = number_format((float)$pgrad, 2, '.', '') . ' %';
  // die();
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, $no)->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, $programname)->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, $date1 . ' / ' . $date2)->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, $subject)->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, $par)->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('F' . $a, $n_grad)->getColumnDimension('F')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('G' . $a, $n_ungrad)->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('H' . $a, $n)->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':H' . $a)->applyFromArray($styleArray_1);
    $no++;
    $a++;
  }
} else {
  $spreadsheet->createSheet(0)->setTitle('Statistik');
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $h, 'Statistik Program Periode' . $date1 . ' / ' . $date2)->getColumnDimension('A')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $a, 'No')->getColumnDimension('A')->setAutoSize(true); // looping header 
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $a, 'Program')->getColumnDimension('B')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $a, 'Period')->getColumnDimension('C')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $a, 'Subjects')->getColumnDimension('D')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . $a, 'Participants')->getColumnDimension('F')->setAutoSize(true);
  $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':E' . $a)->applyFromArray($styleArray);
  $spreadsheet->getActiveSheet()->mergeCells('A1:E1');
  $data_1 = progReport1($programs, $date1, $date2);
  $no = 1;
  while ($row = mysqli_fetch_array($data_1)) {
    $a = 3;
    $col_1 = array();
    $programname = $row[1];
    $id = $row[4];
    $subject = groupSub1($id);
    $par = sumPar1($row[4]);
    $n_grad = sumGrad1($row[0], $row[2], $row[3], $date1, $date2);
    $n_ungrad = sumUngrad1($row[0], $row[2], $row[3], $date1, $date2);
    $pgrad = ($n_grad / $par) * 100 . ' %';
    $n = number_format((float)$pgrad, 2, '.', '') . ' %';
  // die();
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, $no)->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, $programname)->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, $date1 . ' / ' . $date2)->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, $subject)->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, $par)->getColumnDimension('E')->setAutoSize(true);
    $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':E' . $a)->applyFromArray($styleArray_1);
    $no++;
    $a++;
  }
}
// die();
$sheetIndex = $spreadsheet->getIndex(
  $spreadsheet->getSheetByName('Worksheet')
);
$spreadsheet->removeSheetByIndex($sheetIndex);
$spreadsheet->setActiveSheetIndex(0);
// die();
/////////////////////////////////////////////////////////////////////////////////////////////////
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
// Redirect output to a client's web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
// new code:
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
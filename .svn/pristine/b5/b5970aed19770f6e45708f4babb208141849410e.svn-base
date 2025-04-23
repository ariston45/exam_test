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
if (isset($date1) != true or isset($date2) != true) {
  echo ('hahah');
}
$idses = $_SESSION["admin_group"];
// die();
function setGroupProgram($id)
{
  $sql = "SELECT a.exam_code FROM exam_group a WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.',2),'.',-1) = '$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function nameProg($id)
{
  $sql = "SELECT a.program_name FROM programs a WHERE a.id_program = '$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  return $dat[0];
}

function setSubject($id)
{
  $sql = "SELECT a.id_program, b.subject_name 
	FROM program_detail a INNER JOIN subject_ls b ON a.id_subject= b.id_subject WHERE a.id_program = '$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function setProgram($idg, $date1, $date2, $programs)
{
  $date_1 = $date1;
  $date_2 = $date2;
  $program = $programs;
  if ($program != 1) {
    $sql = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.','2'),'.','-1') id_program 
     FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code = b.exam_group INNER JOIN
     (SELECT aa.exam_code FROM exam_session aa GROUP BY aa.exam_code) c ON a.exam_code=c.exam_code
     WHERE 
     SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.','2'),'.','-1') = '$program' AND 
     b.date BETWEEN '$date_1' AND '$date_2' GROUP BY SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.','2'),'.','-1')";
  } else {
    $sql = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.','2'),'.','-1') id_program 
     FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code = b.exam_group INNER JOIN
     (SELECT aa.exam_code FROM exam_session aa GROUP BY aa.exam_code) c ON a.exam_code=c.exam_code
     WHERE 
     b.date BETWEEN '$date_1' AND '$date_2' GROUP BY SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.','2'),'.','-1')";
  }
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function setGroup($id, $a, $b)
{
  $sql = "SELECT a.exam_code,a.id_student,b.classroom,b.proctor,b.date 
  FROM exam_session a INNER JOIN exam_schedule b ON a.exam_code = b.exam_group 
  INNER JOIN exam_group c ON a.exam_code=c.exam_code WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(c.group_name,'.',2),'.',-1) = '$id' 
  AND b.date BETWEEN '$a' AND '$b'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function studentName($id)
{
  $sql = "SELECT a.fname FROM students a WHERE SUBSTRING_INDEX(a.our_id,'.',1) = '{$_SESSION['admin_group']}' AND a.idstudents='$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  return $dat[0];
}

function className($id)
{
  $sql = "SELECT a.name_class FROM exam_class a WHERE a.id_class='$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  return $dat[0];
}

function procName($id)
{
  $sql = "SELECT a.fname FROM users a WHERE a.id_user='$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  return $dat[0];
}

function setLulus($prog)
{
  $sql = "SELECT a.pass_grade,a.sum_question FROM programs a WHERE a.id_program='$prog'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $r = mysqli_fetch_array($res);
  $dat = array($r[0], $r[1]);
  return $dat;
}

function setNilai($idg, $ids)
{
  $sql = "SELECT a.percentage_true FROM exam_percentage a WHERE SUBSTRING_INDEX(a.id_student,'.',1) = '$ids' AND a.exam_code='$idg'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function setNote($idg, $ids, $prog)
{
  $sql = "SELECT SUM(a.percentage_true) n,id_student FROM exam_percentage a 
  WHERE a.exam_code = '$idg' AND SUBSTRING_INDEX(a.id_student,'.',1) = '$ids' 
  GROUP BY a.id_student";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  $n = $dat[0];
  $gr = setLulus($prog);
  $nilai = $n/$gr[1]*100;
  $nilai_str = number_format((float)$nilai, 2, '.', '') . ' %';
  if ($nilai >= $gr[0]) {
    $note = 'Lulus';
  } else {
    $note = 'Tidak Lulus';
  }
  $arr = array($nilai_str, $note);
  // echo($sql);
  // die();
  return $arr;
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

$arr = array();
$prog = setProgram($idg, $date1, $date2, $programs);
$acc = mysqli_num_rows($prog);
if ($acc == 0) {
  echo ("Data None !");
} else {
  $num = 0;
  $views = cekViewResult($idses);
  $view = mysqli_fetch_array($views);
  if ($view[2] == 'true'){
    while ($dat = mysqli_fetch_array($prog)) { #looping program dalam sheet
      $id_program = $dat[0];
      $nameprogram = nameProg($id_program);
      $spreadsheet->createSheet($num)->setTitle($nameprogram); //looping program
      $a = 2;
      $r = 1;
    // $ar_group = setGroupProgram($result);
    // while ($gr = mysqli_fetch_array($ar_group)) { #looping group
      $col = array();
      if ($filename == false) {
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $r, 'Report ' . $nameprogram . ' Period ' . $date1 . ' / ' . $date2)->getColumnDimension('A')->setAutoSize(true);
      } else {
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $r, $filename . '(Period ' . $date1 . '/' . $date2 . ')')->getColumnDimension('A')->setAutoSize(true);
      }
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, 'No')->getColumnDimension('A')->setAutoSize(true); // looping header 
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, 'Group')->getColumnDimension('B')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, 'Date')->getColumnDimension('C')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, 'Class')->getColumnDimension('D')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, 'Proctor')->getColumnDimension('F')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('F' . $a, 'ID')->getColumnDimension('G')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('G' . $a, 'Name')->getColumnDimension('H')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('H' . $a, 'Percentage')->getColumnDimension('I')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('I' . $a, 'Status')->getColumnDimension('J')->setAutoSize(true);
      $par = "J";
      $subs = setSubject($id_program);
      while ($subfil = mysqli_fetch_array($subs)) { # looping subject
        $spreadsheet->setActiveSheetIndex($num)->setCellValue($par . $a, $subfil[1])->getColumnDimension($par)->setAutoSize(true);
        $col[] = $par;
        $par++;
      }
      $col = max($col);
      $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':' . $col . $a)->applyFromArray($styleArray);
      $data_1 = setGroup($id_program, $date1, $date2);
      $no = 1;
      $a++;
      while ($row = mysqli_fetch_array($data_1)) {
        $col_1 = array();
        $idg = $row[0];
        $ids = $row[1];
        $id = implode('.', array_slice(explode('.', $ids), 0, 1));
        $id_class = $row[2];
        $id_proctor = $row[3];
        $date = $row[4];
        $studentname = studentName($id);
        $classname = className($id_class);
        $proctorname = procName($id_proctor);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, $no)->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, $idg)->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, $date)->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, $classname)->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, $proctorname)->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('F' . $a, $id)->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('G' . $a, $studentname)->getColumnDimension('G')->setAutoSize(true);
        $nn = setNote($idg, $id, $id_program);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('H' . $a, $nn[0])->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('I' . $a, $nn[1])->getColumnDimension('I')->setAutoSize(true);
        $idx = 1;
        $par = "J";
        $nilai = setNilai($idg, $id);
        while ($row = mysqli_fetch_array($nilai)) {
          $val = $row[0];
          $arr[$idx] = $par;
          $spreadsheet->setActiveSheetIndex($num)->setCellValue($par . $a, $val)->getColumnDimension($par)->setAutoSize(true);
          $col_1[] = $par;
          $par++;
          $idx++;
        }
        $col_1 = max($col_1);
        $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':' . $col . $a)->applyFromArray($styleArray_1);
        $no++;
        $a++;
      }
      $num++;
      $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
    }
  }else {
    while ($dat = mysqli_fetch_array($prog)) { #looping program dalam sheet
      $id_program = $dat[0];
      $nameprogram = nameProg($id_program);
      $spreadsheet->createSheet($num)->setTitle($nameprogram); //looping program
      $a = 2;
      $r = 1;
      $col = array();
      if ($filename == false) {
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $r, 'Report ' . $nameprogram . ' Period ' . $date1 . ' / ' . $date2)->getColumnDimension('A')->setAutoSize(true);
      } else {
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $r, $filename . '(Period ' . $date1 . '/' . $date2 . ')')->getColumnDimension('A')->setAutoSize(true);
      }
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, 'No')->getColumnDimension('A')->setAutoSize(true); // looping header 
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, 'Group')->getColumnDimension('B')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, 'Date')->getColumnDimension('C')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, 'Class')->getColumnDimension('D')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, 'Proctor')->getColumnDimension('F')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('F' . $a, 'ID')->getColumnDimension('G')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('G' . $a, 'Name')->getColumnDimension('H')->setAutoSize(true);
      // $spreadsheet->setActiveSheetIndex($num)->setCellValue('H' . $a, 'Percentage')->getColumnDimension('I')->setAutoSize(true);
      // $spreadsheet->setActiveSheetIndex($num)->setCellValue('I' . $a, 'Status')->getColumnDimension('J')->setAutoSize(true);
      // $par = "J";
      // $subs = setSubject($id_program);
      // while ($subfil = mysqli_fetch_array($subs)) { # looping subject
      //   $spreadsheet->setActiveSheetIndex($num)->setCellValue($par . $a, $subfil[1])->getColumnDimension($par)->setAutoSize(true);
      //   $col[] = $par;
      //   $par++;
      // }
      $col = "G";
      $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':' . $col . $a)->applyFromArray($styleArray);
      $data_1 = setGroup($id_program, $date1, $date2);
      $no = 1;
      $a++;
      while ($row = mysqli_fetch_array($data_1)) {
        $col_1 = array();
        $idg = $row[0];
        $ids = $row[1];
        $id = implode('.', array_slice(explode('.', $ids), 0, 1));
        $id_class = $row[2];
        $id_proctor = $row[3];
        $date = $row[4];
        $studentname = studentName($id);
        $classname = className($id_class);
        $proctorname = procName($id_proctor);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, $no)->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, $idg)->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, $date)->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, $classname)->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, $proctorname)->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('F' . $a, $id)->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('G' . $a, $studentname)->getColumnDimension('G')->setAutoSize(true);
        // $nn = setNote($idg, $id, $id_program);
        // $spreadsheet->setActiveSheetIndex($num)->setCellValue('H' . $a, $nn[0])->getColumnDimension('H')->setAutoSize(true);
        // $spreadsheet->setActiveSheetIndex($num)->setCellValue('I' . $a, $nn[1])->getColumnDimension('I')->setAutoSize(true);
        // $idx = 1;
        // $par = "J";
        // $nilai = setNilai($idg, $id);
        // while ($row = mysqli_fetch_array($nilai)) {
        //   $val = $row[0];
        //   $arr[$idx] = $par;
        //   $spreadsheet->setActiveSheetIndex($num)->setCellValue($par . $a, $val)->getColumnDimension($par)->setAutoSize(true);
        //   $col_1[] = $par;
        //   $par++;
        //   $idx++;
        // }
        $col_1 = 'G';
        $spreadsheet->setActiveSheetIndex($num)->getStyle('A' . $a . ':' . $col . $a)->applyFromArray($styleArray_1);
        $no++;
        $a++;
      }
      $num++;
      $spreadsheet->getActiveSheet()->mergeCells('A1:J1');
    }
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
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
if (isset($date1)!=true OR isset($date2)!=true) {
  echo('hahah');
}
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
  $sql = "SELECT a.exam_code,b.id_program,b.subject_name,b.id_subject
  FROM exam_group a LEFT JOIN (SELECT aa.id_program,bb.subject_name,aa.id_subject 
FROM program_detail aa JOIN subject_ls bb ON aa.id_subject = bb.id_subject) b 
  ON SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.',2),'.',-1) = b.id_program 
  WHERE a.exam_code='$id'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function setData($idg, $date1, $date2, $programs)
{
  $date_1 = $date1;
  $date_2 = $date2;
  $program = $programs;
  if ($program != 1) {
    $sql = "SELECT a.exam_code,SUBSTRING_INDEX( SUBSTRING_INDEX( a.group_name, '.', '2' ), '.', '-1' ) id_program, c.program_name,
    b.classroom,b.proctor,b.date,b.start_time 
    FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code = b.exam_group
    LEFT JOIN programs c ON SUBSTRING_INDEX( SUBSTRING_INDEX( a.group_name, '.', '2' ), '.', '-1' ) = c.id_program
    WHERE SUBSTRING_INDEX( SUBSTRING_INDEX( a.group_name, '.', 2 ), '.',- 1 ) = '$program'  AND b.date BETWEEN '$date_1' AND '$date_2'";
  } else {
    $sql = "SELECT a.exam_code, SUBSTRING_INDEX( SUBSTRING_INDEX( a.group_name, '.', '2' ), '.', '-1' ) id_program,c.program_name,
    b.classroom,b.proctor,b.date,b.start_time 
    FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code = b.exam_group
    LEFT JOIN programs c ON SUBSTRING_INDEX( SUBSTRING_INDEX( a.group_name, '.', '2' ), '.', '-1' ) = c.id_program
    WHERE b.date BETWEEN '$date_1' AND '$date_2'";
  }
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function setDataInfo($id)
{
  $sql = "SELECT a.exam_code,SUBSTRING_INDEX( a.id_student, '.', 1 ) id,b.fname,c.date,c.name_class, c.fname
  FROM
    exam_session a
    LEFT JOIN students b ON SUBSTRING_INDEX( a.id_student, '.', 1 ) = b.idstudents
    LEFT JOIN (
    SELECT
      aa.exam_group,
      aa.date,
      aa.start_time,
      bb.name_class,
      cc.fname,
      aa.token 
    FROM
      exam_schedule aa
      INNER JOIN exam_class bb ON aa.classroom = bb.id_class
      INNER JOIN users cc ON aa.proctor = cc.id_user 
    ) c ON a.exam_code = c.exam_group 
  WHERE
    a.exam_code = $id";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}

function setNilai($idg, $ids)
{
  $sql = "SELECT a.percentage_true FROM exam_percentage a WHERE SUBSTRING_INDEX(a.id_student,'.',1) = '$ids' AND a.exam_code=$idg";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $res;
}
function setNote($idg, $ids, $prog)
{
  $sql = "SELECT SUM(a.percentage_true) nilai ,id_student FROM exam_percentage a 
  WHERE a.exam_code = '$idg' AND SUBSTRING_INDEX(a.id_student,'.',1) = '$ids' 
  GROUP BY a.id_student";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  $dat = mysqli_fetch_array($res);
  $nilai = $dat[0];
  $grade = setLulus($prog);
  if ($nilai >= $prog) {
    $note = 'Lulus';
  } else {
    $note = 'Tidak Lulus';
  }
  $arr = array($nilai, $note);
  return $arr;
}

function setLulus($prog)
{
  $sql = "SELECT a.pass_grade FROM programs a WHERE a.id_program='$prog'";
  $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
  return $n;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$styleArray = [
  'borders' => [
    'outline' => [
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['argb' => '000000'],
    ],
    'inside' =>[
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
    'inside' =>[
      'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
      'color' => ['argb' => '000000'],
    ]
  ],
];


$arr = array();
$prog = setData($idg, $date1, $date2, $programs);
$acc = mysqli_num_rows($prog);
while ($row = mysqli_fetch_array($prog)) {
  $arr[] = $row[1];
}
$results = array_unique($arr);
sort($results);
$cnt = count($results);
if ($acc == 0) {
  echo ("Data None !");
} else {
  foreach ($results as $num => $result) { #looping program dalam sheet
    $num++;
    $nameprogram = nameProg($result);
    $spreadsheet->createSheet($num)->setTitle($nameprogram); //looping program
    $a = 1;
    $r = 1;
    $ar_group = setGroupProgram($result);
    while ($gr = mysqli_fetch_array($ar_group)) { #looping group
      $col = array();
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, 'Group ' . $gr[0])->getColumnDimension('A')->setAutoSize(true); // looping header 
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, 'No')->getColumnDimension('B')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, 'Date')->getColumnDimension('C')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, 'Kelas')->getColumnDimension('D')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, 'Program')->getColumnDimension('E')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('F' . $a, 'Proktor')->getColumnDimension('F')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('G' . $a, 'ID')->getColumnDimension('G')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('H' . $a, 'Nama')->getColumnDimension('H')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('I' . $a, 'Nilai')->getColumnDimension('I')->setAutoSize(true);
      $spreadsheet->setActiveSheetIndex($num)->setCellValue('J' . $a, 'Keterangan')->getColumnDimension('J')->setAutoSize(true);
      $par = "K";
      $subs = setSubject($gr[0]);
      while ($subfil = mysqli_fetch_array($subs)) { # looping subject
        $spreadsheet->setActiveSheetIndex($num)->setCellValue($par . $a, $subfil[2])->getColumnDimension($par)->setAutoSize(true);
        $col[] = $par;
        $par++;
      }
      $col = max($col);
      $spreadsheet->setActiveSheetIndex($num)->getStyle('A'.$a.':'.$col.$a)->applyFromArray($styleArray);
      $data_1 = setDataInfo($gr[0]);
      $no = 1;
      $a++;
      while ($row = mysqli_fetch_array($data_1)) {
        $col_1 = array();
        $idg = $row[0];
        $id = $row[1];
        $student = $row[2];
        $date = $row[3];
        $class = $row[4];
        $proctor = $row[5];
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('A' . $a, '')->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('B' . $a, $no)->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('C' . $a, $date)->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('D' . $a, $class)->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('E' . $a, $nameprogram)->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('F' . $a, $proctor)->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('G' . $a, $id)->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('H' . $a, $student)->getColumnDimension('H')->setAutoSize(true);
        $nn = setNote($idg, $id, $result);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('I' . $a, $nn[0])->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->setActiveSheetIndex($num)->setCellValue('J' . $a, $nn[1])->getColumnDimension('J')->setAutoSize(true);
        $idx = 1;
        $par = "K";
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
        $spreadsheet->setActiveSheetIndex($num)->getStyle('B'.$a.':'.$col.$a)->applyFromArray($styleArray_1);
        $no++;
        $a++;
      }
      $a++;
    }
    $num++;
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
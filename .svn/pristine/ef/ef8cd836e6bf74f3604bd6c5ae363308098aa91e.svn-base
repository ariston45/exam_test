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
$program = $_GET['pro'];

function selClass($id)
{
        $sql = "SELECT a.name_class FROM exam_class a WHERE a.id_class = '$id'";
        $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
        $dat = mysqli_fetch_array($res);
        return $dat[0];
}

function selProgram($id)
{
        $sql = "SELECT a.program_name FROM programs a WHERE a.id_program = '$id'";
        $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
        $dat = mysqli_fetch_array($res);
        return $dat[0];
}

function selProctor($id)
{
        $sql = "SELECT a.fname FROM users a WHERE a.id_user = '$id'";
        $res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
        $dat = mysqli_fetch_array($res);
        return $dat[0];
}

function exportXLS($id_g, $name, $date_1, $date_2, $program)
{
        $date_1 = "2018-11-26";
        $date_2 = "2018-11-28";
        $program = 1;
        if ($program != 1) {
                $sql = "SELECT b.exam_code,a.classroom,SUBSTRING_INDEX(SUBSTRING_INDEX(b.group_name,'.','2'),'.','-1') id_program,a.proctor,a.date,a.start_time 
    FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code = b.exam_group
    WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(a.group_name,'.','2'),'.','-1') = '$program' AND 
    b.date BETWEEN '$date_1' AND '$date_2'";
        } else {
                $sql = "SELECT b.exam_code,a.classroom,SUBSTRING_INDEX(SUBSTRING_INDEX(b.group_name,'.','2'),'.','-1') id_program,a.proctor,a.date,a.start_time 
    FROM exam_group a INNER JOIN exam_schedule b ON a.exam_code = b.exam_group
    WHERE b.date BETWEEN '$date_1' AND '$date_2'";
        }
        while ($row = mysqli_fetch_array($res)) {
                $idg = $row[0];
                $class = selClass($row[1]);
                $program = selProgram($row[2]);
                $proctor = selProctor($row[3]);
                $datetime = $row[4] . ' ' . $row[5];
        }
}
//////////////////////////////////////////////////////////////////////////////////////////////
if (isset($idq)) {

}

$spreadsheet->getActiveSheet(0)->setTitle('Main Page');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . '1', 'No');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . '1', 'Tanggal');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . '1', 'Kelas');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . '1', 'Program');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . '1', 'Grup');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . '1', 'Proktor');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . '1', 'ID');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('H' . '1', 'Nama');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('I' . '1', 'Nilai');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . '1', 'Keterangan');

// $spreadsheet->createSheet(1)->setTitle('Simple_1');
// $spreadsheet->setActiveSheetIndex(1)->setCellValue('A1', 'This');
// $spreadsheet->setActiveSheetIndex(1)->setCellValue('B2', 'is');
// $spreadsheet->setActiveSheetIndex(1)->setCellValue('C1', 'a');
// $spreadsheet->setActiveSheetIndex(1)->setCellValue('D2', 'test.');

// $spreadsheet->createSheet(2)->setTitle('Simple_2');
// $spreadsheet->setActiveSheetIndex(2)->setCellValue('A1', 'This');
// $spreadsheet->setActiveSheetIndex(2)->setCellValue('B2', 'is');
// $spreadsheet->setActiveSheetIndex(2)->setCellValue('C1', 'a');
// $spreadsheet->setActiveSheetIndex(2)->setCellValue('D2', 'test.');

$spreadsheet->setActiveSheetIndex(0);
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
//new code:
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>
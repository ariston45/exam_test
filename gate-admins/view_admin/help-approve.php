<?php
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
/*********************************************/
$date_now = date_create('now')->format('Y-m-d H:i:s');
$students = $_POST['remidial'];
$id_prog = $_POST['id_prog'];
$cust_group = $_POST['cust_group'];
$margin = $_POST['margin'];
$nim = $_POST['nim'];
foreach ($students as $key => $id) { # loop id peserta
  $sql_a = "SELECT max(prioritas) as max_prioritas,max(notif) as max_notif FROM user_test WHERE user_id = '$id' AND id_program='$id_prog[$key]'";
  $exe_a = mysqli_query($GLOBALS['link'], $sql_a) or die(mysqli_error($GLOBALS['link']));
  $dataUser = mysqli_fetch_array($exe_a);
  $notif = $dataUser['max_notif'] + 1;
  $prog = sqlValue($id_prog[$key]);
  for ($i = 1; $i <= $margin[$key]; ++$i) { #loop margin ujian
    $ids = $id.'.'. $i;
    $prioritas = $dataUser['max_prioritas'] + $i;
    if ($i == 1) {
      $status = 1;
    } else {
      $status = 0;
    }
    $sql_b = "INSERT INTO user_test(user_id,id_peserta,status,prioritas,notif,eff_date,id_program) VALUES('$id','$ids','$status','$prioritas','$notif','$date_now','$prog')";
    mysqli_query($GLOBALS['link'], $sql_b) or die(mysqli_error($GLOBALS['link']));
  }
  $sql_c = "DELETE FROM students_remidial WHERE nim = '$id' AND program='$id_prog[$key]'";
  mysqli_query($GLOBALS['link'], $sql_c) or die(mysqli_error($GLOBALS['link']));
}
$sql_d = "DELETE FROM students_remidial WHERE nim = '' AND fname=''";
mysqli_query($GLOBALS['link'], $sql_d) or die(mysqli_error($GLOBALS['link']));
header("location:". $_SERVER['HTTP_REFERER']);
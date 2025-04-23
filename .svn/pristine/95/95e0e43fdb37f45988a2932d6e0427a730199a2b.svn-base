<?php
$id = $_GET['id'];
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$sql = "SELECT COUNT(a.id_session) n FROM exam_session a WHERE a.exam_code='$id'";
$res = mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error($GLOBALS['link']).'<br>'.$sql);
$dat = mysqli_fetch_array($res);
$num = $dat[0];
echo($num);
?>
<?php
$id = $_GET['id'];
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$result=showStueExam($id);
echo $result;
?>
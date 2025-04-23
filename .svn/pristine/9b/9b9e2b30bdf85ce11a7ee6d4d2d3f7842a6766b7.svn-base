<?php
//  test
	include "cfg/general.php";
	include "control/inc_function.php";
	include "control/inc_function2.php";
	connectdb();
if (studentLoginCek()){
		logLogout($_SESSION["user_id"]);
	}
	$_SESSION["user_id"]="";
	$_SESSION["id_peserta"]="";
	$_SESSION["user_name"]="";
	$_SESSION["user_group"]="";
	$_SESSION["exam_group"]="";
	session_destroy();
	header('location:log.php');
	// ok
	//tes
?>
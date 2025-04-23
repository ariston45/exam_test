<?php
	session_start();
	$_SESSION["admin_id"]="";
	$_SESSION["admin_name"]="";
	$_SESSION["admin_group"]="";
	session_destroy();
	header('location:index.php');
?>
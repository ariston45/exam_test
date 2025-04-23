<?php
include "../../cfg/general.php";
include "../../control/inc_function.php";
connectdb();
//global $link;
$cust_name=$_POST['cust_name'];
$qry = "SELECT cust_name FROM customer WHERE cust_name='$cust_name' ";
$sql = mysqli_query($GLOBALS['link'],$qry)or die($GLOBALS['link']);
$cek = mysqli_num_rows($sql);

    if ($cek > 0){
		echo 1;
		//echo "Id subject atau nama Subject sudah yang anda masukan sudah ada";
	}else {
		echo 0;
	//echo "Id subject atau nama Subject Berhasil Disimpan";
		//mysqli_query($conn,"INSERT INTO subject_ls(id,nama,email, password)
		//VALUES ('','$nama','$email','$password')");
	}
?>
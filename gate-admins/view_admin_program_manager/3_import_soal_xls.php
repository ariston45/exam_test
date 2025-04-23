<?php
//include "3_import_soal_xls_cmd.php";

$cmd="init"; 
if (isset($_POST["cmd"])){
	$cmd=$_POST["cmd"];
}
if ($cmd=="batal"){
	//init page, display upload form
	batal_import();
	$cmd="init";
}

if ($cmd=="init"){
	//init page, display upload form
	print_upload_form();
}

if ($cmd=="upload"){
	$kode_soal=$_POST["kode_soal"];
	//if (kode_soal_exist($kode_soal)){
	if (1==0){ //kode soal diabaikan
		echo "kode soal sudah terdaftar di system!";
		print_upload_form();
	}else{
		$kode_mapel=$_POST["subject"];
		$filename=uploaded();
		if ($filename!=""){
			$cmd="import";
		}else{
			print_upload_form();
		}
	}
}

if ($cmd=="import"){
	$_SESSION["import_id"]=$filename;
	$ext = strtolower(array_pop(explode(".", $filename)));
	if ($ext=="xls"){
		require_once "../".$GLOBALS["xls-reader-dir"]."PHPExcel.php";
		import_excel($filename);
		$cmd="preview";
		print_form_reload();
		$js="<script language=\"javascript\"> \r\n
				alert(\"Upload berhasil, klik ok!\"); \r\n
				document.f_reload.cmd.value=\"preview\"; \r\n
				document.f_reload.submit(); \r\n
				</script> \r\n
				";
		echo $js;
		
	}else{
		echo ("<script LANGUAGE='JavaScript'>
		    window.alert('Maaf, format file tidak didukung!');
		    window.location.href='';
		    </script>");
	}
}

if ($cmd=="preview"){
	//preview soal
	preview_soal();
	print_finish_button();
}

if ($cmd=="finish"){
	finish_import();
}
include "footer.php";
?>
<script>
	$(function(){
		$( "#btsubmit" ).button();
		$( "#bt_selesai" ).button();
		$( "#bt_batal" ).button();
		$( "#kode_mapel" ).selectmenu();
	})
</script>	

</body>
</html>
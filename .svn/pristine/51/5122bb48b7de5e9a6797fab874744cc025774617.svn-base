<?php
include "cfg/general.php";
include "control/inc_function.php";
include "control/inc_function2.php";
include "halaman_ujian_cmd.php";
connectdb();
$cmd="cekKodeUjian"; //default
if (!isset($_POST["cmd"])){
	//called from login,, collect student data
	if (!cekStudentLogin()){
		header('location:login.php');
	}
	$user_id=$_SESSION["user_id"];
	$id_peserta=$_SESSION["id_peserta"];
	$user_name=$_SESSION["user_name"];
	$user_group=$_SESSION["user_group"];
}else{
	$cmd=$_POST["cmd"];
	$user_id=$_POST["user_id"];
	$id_peserta=$_POST["id_peserta"];
	//echo "peserta".$id_peserta;
	$user_name=$_POST["user_name"];
}
$js="";
?>
<html>
	<head>
		<title>Exam</title>
		<link rel="stylesheet" href="css/general.css">
		<link rel="stylesheet" href="classes/jquery-ui/themes/themes/cupertino/jquery-ui.css">
		<script src="classes/jquery-ui/js/external/jquery/jquery.js"></script>
  	<script src="classes/jquery-ui/js/jquery-ui.js"></script>
  	<script src="js/function.js"></script>
  	<style>
  		#bgwaitdiv {
  			position:relative;
  			align:center;
  			width:600;
  			height:630;
				background:#fff url('img/wait.png');
				background-size:600px 630px;
				border:1px solid #069;
				-webkit-border-radius:3px;
				-moz-border-radius:3px;
				border-radius:3px;
  		}
  		#btstartdiv {
  			position:absolute;
  			top:550;
  			right:50;
  		}
  		#customsoal{
  			font:normal 12px/150% Arial, Helvetica, sans-serif;
  			align:center;
  			width:90%;
  			background:#fff;
				border:1px solid #009B4C;
				-webkit-border-radius:3px;
				-moz-border-radius:3px;
				border-radius:3px;
  		}
  		#customsoal table tbody td{
  			padding:3px 10px;
  			color:#00557F;
  			font:normal 12px/150% Arial, Helvetica, sans-serif;
  		}
  		
  		#customsoal table thead th{
  			padding:3px 10px;
  			color:#00557F;
  			border-bottom:1px dashed #009B4C;
  			font:bold 14px/150% Arial, Helvetica, sans-serif;
  		}
  		
  		#customsoal table .headinfo th {
  			padding:3px 10px;
  			color:#00557F;
  			border:0;
  			font:bold 14px/150% Arial, Helvetica, sans-serif;
  		}
  		#customsoal table tfoot td{
  			padding:3px 10px;
  			color:#00557F;
  			border-top:1px dashed #009B4C;
  		}
  		
  		#exam_page {
  			width:100%;
  			height:100%;
  			position:relative;
  		}
  		
  		#exam_f img {
  			border:0;
  			width:100%;
  		}
  		#exam_h img {
  			border:0;
  			width:100%;
  		}
  		
  		#menit,#detik{
  			width:30;
  			text-align:right;
  			border:0;
  			color:red;
  		}
  		
  		body {
  			margin:0;
  		}
  		#bgresultdiv {
  			position:relative;
  			align:center;
  			width:600;
  			height:630;
				background:#fff url('img/results.png');
				background-size:600px 630px;
			}
			#bgreviewdiv {
  			position:relative;
  			align:center;
  			width:900;
  			height:630;
				background:#fff;
				background-size:600px 630px;
			}
  		#resultdiv {
  			position:absolute;
  			top:200;
  			left:50;
  		}
  		#resultdiv table thead th {
  			text-align:left;
  			font:bold 20px/150% Arial, Helvetica, sans-serif;
  		}
  		#resultdiv table tbody td {
  			align:left;
  			font:bold 14px/150% Arial, Helvetica, sans-serif;
  		}
  	</style>
	</head>
<body >
<?php
	switch ($cmd){
		case "cekKodeUjian":
			$kodeUjian=getKodeUjian();
			if ($kodeUjian==""){
				//belum punya kode ujian
echo ("<script LANGUAGE='JavaScript'>
    window.alert('Please Login Again');
    window.location.href='logout.php';
    </script>");
//tidak di pakek_____________________________
				die('Error Kode Ujian');
				$cmd2="";
				if (isset($_POST["cmd2"])){
					$cmd2=$_POST["cmd2"];
				}
				if ($cmd2=="pilihJadwal"){
					pilihJadwal();
				}else{
					pilihJadwal();
					//viewJadwal();
				}
//___________________________________________
			}else{
				$remainingtime=0; //value will be updated inside getStatusUjian() function
				//cek session ujian
				if (cekSession()) {
					print_r('Redirect to exam');
				}else {
					$row = getDataExam();
					//print_r($row);
					echo "
						<form action=\"\" method=\"POST\" >
							<input name=\"program_id\" value=".$row[3].">
							<input name=\"voucher_id\" value=".$row[2].">
							<input name=\"exam_group\" value=".$row[0].">
							<input name=\"participant_id\" value=".$row[1].">
							<input name=\"cmd\" value=\"start\">
							<button class=\"btn btn-sm btn-successs\">Start Exam</button>
						</form>
					"	;
					print_r('Redirect to Start Exam Page');
				}
				//jika sudah ada dan end timenya kosong maka melanjutkan
				//jika belum ada maka muncul tombol start
			}
			break;
		case "start":
			$participant_id=$_POST['participant_id'];
			$exam_group=$_POST['exam_group'];
			$program_id=$_POST['program_id'];
			$voucher_id=$_POST['voucher_id'];
			generateQuestion($program_id,$exam_group,$participant_id);
			sessionUjian($exam_group,$participant_id);
			useVoucher($voucher_id,$exam_group,$participant_id);
			die('redirect halaman mengerjakan ujian');
			// $kodeUjian=$_POST["kodeUjian"];
			// //generate soal
			// $retv=generateSoal();
			// switch ($retv){
			// case 0:
			// 	//start session
			// 	$token=generateSession();
			// 	$remainingtime=getRemainingTime();
			// 	//show soal
			// 	$nomorSoal=1;
			// 	viewSoal();
			// 	//start counter
			// 	startCounter();
			// 	break;
			// case 1: //komposisi soal blm disetting
			// 	$startbutton_state="";
			// 	printPleaseWaitPage($startbutton_state);
			// 	$js="alert('Error:komposisi Soal belum disetting!');";
			// 	break;
			// case 2: //soal blm diupload
			// 	$startbutton_state="";
			// 	printPleaseWaitPage($startbutton_state);
			// 	$js="alert('Error:Soal tidak tersedia!');";
			// 	break;
			//}
			break;
		case "jawab":
			//update jawaban
			$kodeUjian=$_POST["kodeUjian"];
			$token=$_POST["token"];
			$nomorSoal=intVal($_POST["nomorSoal"]);
			$jumlahSoal=$_POST["jumlahSoal"];
			$remainingtime=getRemainingTime();
			if (!validateToken()){
				die();	
			}
			if (isset($_POST["jawaban"])){
				$jawaban=$_POST["jawaban"];
				updateJawaban();
			}
			$cmd2=$_POST["cmd2"];
			switch ($cmd2){
				case "viewsoal":
					viewSoal();
					startCounter();
					break;
				case "prev":
					$nomorSoal--;
					viewSoal();
					startCounter();
					break;
				case "next":
					$nomorSoal++;
					viewSoal();
					startCounter();
					break;
				case "review":
					reviewJawaban();
					break;
				case "selesai":
					endSession();
					$berhasil=viewResult();
					if (!$berhasil){
						activateNextId();
					}
					break;
			}
			
			break;
	}
?>
<script language="javascript">
	<?php echo $js; ?>
</script>
</body>
</html>

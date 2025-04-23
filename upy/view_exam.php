<?php
include "../cfg/general.php";
include "../control/inc_function.php";
include "../control/inc_function2.php";
include "view_exam_cmd.php";
connectdb();
$cmd = "cekKodeUjian"; //default
if (!isset($_POST["cmd"])) {
	//called from login,, collect student data
	if (!cekStudentLogin()) {
		header('location:../log.php');
	}
	$user_id = $_SESSION["user_id"];
	$id_peserta = $_SESSION["id_peserta"];
	$user_name = $_SESSION["user_name"];
	$user_group = $_SESSION["user_group"];
	$exam_group = $_SESSION["exam_group"];
} else {
	$cmd = $_POST["cmd"];
	$user_id = $_POST["user_id"];
	$id_peserta = $_POST["id_peserta"];
	//echo "peserta".$id_peserta;
	$user_name = $_POST["user_name"];
}
$js = "";
?>
<html>

<body>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="icon" href="../assets/img/icon.png" type="image/gif" sizes="16x16">
		<script src="../assets/js/jquery-1.11.1.min.js"></script>
  	<script src="../assets/js/bootstrap.min.js"></script>
		<style>
			* {
				box-sizing: border-box;
			}

			/* Create two equal columns that floats next to each other */
			.column-left {
				float: left;
				margin-left: 5%;
				width: 60%;
				padding: 10px;
				height: 445px;
				/* Should be removed. Only for demonstration */

			}

			.column-right {
				background-color: #373737;
				float: left;
				width: 28%;
				padding: 10px;
				margin-top: 10px;
				height: 445px;
				border-radius: 10px;
				/* Should be removed. Only for demonstration */
			}

			.notice {
				color: #000;
				text-shadow: 0px 0px 6px #fff;
				background-color: #fff;
				border-radius: 10px;
				font-size: 12px;
				padding: 5px 15px;
			}


			/* Clear floats after the columns */
			table {
				background: #fff;
				border-radius: 5px;
				margin-left: auto;
				margin-right: auto;
				width: 90%;
				font-weight: 600;
			}

			td {
				padding-left: 5px;
				height: 25px;
			}

			@media only screen and (max-width: 600px) {
				.bgbg{
			    /* background-size: 200%; */
			    padding-top: 0px;
			    background-repeat: no-repeat;
			    background-size: auto;
			    background-position-x: center;
			  }
				.modal-dialog{
					width: fit-content;
				}
				.column-left{
					margin-left: 0;
					float: unset;
			    width: unset;
			    height: unset;
			  }
			  .column-right{
			  	margin: 10px;
			  	float: unset;
   			  width: unset;
			  }
			  .contain-row{
			  	display: flex;
			  }
			  .col6-head{
			  	width: 50%;
    			text-align: center;
			  }
			}
		</style>
	</head>

	<body>

		<?php
		switch ($cmd) {
			case "cekKodeUjian":
				$kodeUjian = getKodeUjian(); //kode ujian sesuai token dan memastikan sebagai peserta
				if ($kodeUjian == "") {
					//belum punya kode ujian
					echo ("<script LANGUAGE='JavaScript'>
				    window.alert('Please Login Again');
				    window.location.href='../logout.php';
				    </script>");
					die('Error Kode Ujian');
				} else {
					$remainingtime = 0; //value will be updated inside getStatusUjian() function
					//cek session ujian
					if (cekSession()) { //cek sesi ujian untuk melanjutkan ujian
						header("location:exam.php");
						//print_r('Redirect to exam');
					} else {

						if (cekOpportunity()) {
							if ($res = cekSessionExist()) {
								cancelLogin($_SESSION['id_peserta'], $_SESSION['exam_group']);
								$n = cekPermitCust();
								$idses = $_SESSION['cust_group'];
								$views = cekViewResult($idses);
								$view = mysqli_fetch_array($views);;
								if ($view[2] == 2) {
									echo "<h3 style='text-align:center;color:red;'>Mohon Maaf Anda Sudah mengikuti ujian</h3>";
									viewResultExam($res);
								} else {
									$v = viewResultNone();
									echo ($v);
								}
								die();
							} else {
								$rs = mysqli_query($GLOBALS['link'], "SELECT id_schedule from covid_exam_schedule where exam_group=" . $_SESSION['exam_group']);
								$row = mysqli_fetch_row($rs);
								$varToken = CovidcekTimeSchedule($row[0]);
								if ($varToken[0]==1) { } else if ($varToken[0] == 2) {
									cancelLogin($_SESSION['id_peserta'], $_SESSION['exam_group']);
									echo ("<script LANGUAGE='JavaScript'>
										window.alert('Your token is not ready to use \\nIt can be used on ".tanggal_indo($varToken[1])." 07:00 WIB');
										window.location.href='../upy_logout.php';
										</script>");
									die('Error Time Ujian');
								}else if ($varToken[0] == 0) {
									cancelLogin($_SESSION['id_peserta'], $_SESSION['exam_group']);
									echo ("<script LANGUAGE='JavaScript'>
										window.alert('Login time is Limit \\nPlease Contact Administrator');
										window.location.href='../upy_logout.php';
										</script>");
									die('Error Time Ujian');
								}

								echo '
								 <div class="modal fade" id="modal_confirm" role="dialog" data-backdrop="false" data-keyboard="false" style="background:#00000094">
							    <div class="modal-dialog">
								    <div class="modal-content modal-danger ">
							        <div class="modal-header" style="
								            background-color: #d9534f;
								            border-radius: 5px 5px 0px 0px;
								            color : #fff;
								            padding: 10px 15px;
								        ">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h4 class="modal-title">Confirmation</h4>
							        </div>
							        <div class="modal-body" style="padding-bottom:30px;">
												<h4>Anda akan ujian sebagai : </h4>
												<div style ="text-align:center">
												<h2>'.$_SESSION["user_name"].'</h2>
												<h4>'.$_SESSION["user_id"].'</h4><br>
												<form id="form-cancel" action="" method="POST" style="margin:0px;">
													<input type="hidden" name="exam_group" value='.$_SESSION["exam_group"].'>
													<input type="hidden" name="participant_id" value='.$_SESSION["id_peserta"].'>
													<input type="hidden" name="cmd" value="cancel">
												</form>
												<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Continue</button>
												<button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById(\'form-cancel\').submit();">Cancel</button>
												</div>
							        </div>
  						      </div>
					        </div>
					      </div>

								<script type="text/javascript">
								        $("#modal_confirm").modal("show");
								</script>
								';

								// echo ("<script LANGUAGE='JavaScript'>
								// 			window.alert('Login Success');
								// 			</script>");
								echo "<div class='bgbg' style=\"background-image:url('../assets/img/class.png');\">";
								startPage();
								echo "</div>";
								die();
							}
						} else {
							

							$res = cekSessionExist();
		////////// PATCH ERROR EXAM PARTICIPANT KADALUARSA/////////
							if (!$res) {
								global $id_peserta,$exam_group;
						    $sql = "update exam_participants set exam_group = '".sqlValue($exam_group)."' where id_student = '".sqlValue($id_peserta)."'";
						    $rs = mysqli_query($GLOBALS['link'], $sql) or die('1'.$sql.mysqli_error($GLOBALS['link']));
						    header("Refresh:0");
						    die();
							}
		//////////////////////////////////////////////////////////
							cancelLogin($_SESSION['id_peserta'], $_SESSION['exam_group']);
							$n = cekPermitCust();
							$idses = $_SESSION['cust_group'];
							$views = cekViewResult($idses);
							$view = mysqli_fetch_array($views);;
							if ($view[2] == 2) {
								echo "<h3 style='text-align:center;color:red;'>Mohon Maaf Anda Sudah mengikuti ujian</h3>";
								viewResultExam($res);
							} else {
								$v = viewResultNone();
								echo ($v);
							}
						}
					}
				}
				break;
			case "start":
				echo "<body style='text-align:center;background: #7e8683;'>
			<br>
			<br>
			<h2>Please Wait ..... <span id='count'></span></h2>

				<img style='margin-top:7%;margin-bottom:3%;width:70px;' src='../assets/img/loading.gif'>
				<br>
				<br>
				<br>
			<h2>Generate Exam</h2>
				  </body>

				 ";
				//	 die();
				$participant_id = $_POST['participant_id'];
				$exam_group = $_POST['exam_group'];
				$program_id = $_POST['program_id'];
				$voucher_id = $_POST['voucher_id'];
				$kesempatan = explode('.', $participant_id);
				if (checkVoucher($voucher_id) or  $kesempatan[1] != 1) {
					clearQuestion($exam_group, $participant_id);
					generateQuestion($program_id, $exam_group, $participant_id);
					sessionUjian($exam_group, $participant_id, $program_id);
					$ex = explode('.', $participant_id);
					//jika ujian pertama maka voucher akan berkurang
					if ($ex[1] == 1) {
						useVoucher($voucher_id, $exam_group, $participant_id);
					}
					//show soal
					header("location:exam.php");
				} else {
					cancelLogin($participant_id, $exam_group);
					echo "<script type=\"text/javascript\">
					alert('All voucher have been used, you can\'t start exam \\nPlease contact administrator');
					window.location.href = '../logout.php'
				</script>";
				}
				echo "
			<script>
				var counter = 30;
				setInterval(function(){
					counter--;
			    if(counter < 0) {
			    	window.location.reload(1);
			    } else {
		        document.getElementById('count').innerHTML = counter;
         	}
				}, 1000);

			</script>
			";
				die('redirect halaman mengerjakan ujian');
				break;
			case 'cancel':
				$participant_id = $_POST['participant_id'];
				$exam_group = $_POST['exam_group'];
				cancelLogin($participant_id, $exam_group);
				header("location:../upy_logout.php");
				break;
		}
		?>
	</body>

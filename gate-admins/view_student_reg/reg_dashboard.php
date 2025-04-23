<?php
// header('location:view_pic/pic_dashboard.php?pg=pic_dashboard');
if (isset($_POST['cmd'])) {
	switch ($_POST['cmd']) {
		case 'Search':
			$_SESSION['valin'] = $_POST['valin'];
			echo "<script>window.location.href = window.location.href;</script>";
			break;
		case 'Clear Student':
			$_SESSION['valin'] = "";
			unset($_SESSION['idstu']);
			echo "<script>window.location.href = window.location.href;</script>";
			break;
		case 'amount':
			$_SESSION['amount'] = $_POST['amn'];
			// echo "<script>window.location.href = window.location.href;</script>";
			break;
		default:
			# code...
			break;
	}
}
$amn = 10;
if (isset($_SESSION['amount'])) {
	$amn = $_SESSION['amount'];
}
// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$stu_count = countStudent();
$vou_pre = vouPre();
$vou_post = vouPost();
$exam_count = finishExamCount();
$report_count = reportCount();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<style type="text/css">
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #fff4e4;
}
</style>
<div class="row">
	<div class="col-lg-12">
		<h4>Dashboard</h4>
	</div>
</div>
<!--============================================================================================================================== -->
<div class="row">
	<div class="col-md-12" id="panel1">
		<div class="panel panel-default"  >
			<div class="panel-heading dark-overlay">Search Students</div>
			<div class="panel-body">
				<form class="" method="post" action="">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Find students with NIM or Name </span>
									<input type="text" name="valin" class="form-control input-sm" placeholder="nim or name" aria-describedby="basic-addon1" style="max-width: 250px;">
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<button type="submit" name="cmd" value="Search" class="btn btn-warning"><i class="fa fa-search"></i> Search </button>
						</div>
					</div>
      	</form>
				<?php
			$table =
				'<table id="tbStudents" class="table-striped"><thead><tr>
						<th scope = "col" > No </th>
						<th scope = "col" > NIM </th>
						<th scope = "col" > Name </th>
						<th scope = "col" > Email </th>
						</tr></thead><tbody>';
			$no = 1;
			$id_g = $_SESSION['admin_group'];
			$valin = $_SESSION['valin'];
			if ($_SESSION['valin'] != '') {
				foreach (showStudents($id_g, $valin) as $r) {
					$id = $r[0];
					$n = viewEquExm($id);
					$table .= '<tr><td>' . $no . '</td><td>' . $id . '</td><td>' . $r[1] . '</td><td>' . $r[2] . '</td>
					</tr>';
					$no++;
				}
			}
			$table .= '</tbody></table>';
			if ($valin != null) {
				echo ('<p class=" text-left"><i>You have searched for data with the keyword "' . $valin . '". 
						To reset keywords, please click reset button.
						<form action="" method="post">
						<input type="submit" name="cmd" class="btn btn-warning btn-xs" value="Clear Student"></i>
						</form></p>');
				echo $table;
			} else {
				echo ('<p class=" text-left"><i>*You can input id or name.</i></p>');
			}
			?>
			</div>
		</div>
	</div>
<!--============================================================================================================================== -->

<!--============================================================================================================================== -->
	
<!--============================================================================================================================== -->
	
<!--============================================================================================================================== -->
</div>
<!-- 1 -->

<!--  -->
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script> -->
<script>
var a = document.getElementById("panel1");
var b = document.getElementById("panel2");
var c = document.getElementById("panel3");
var d = document.getElementById("panel4");
a.style.display = "block";
b.style.display = "none";
c.style.display = "none";
d.style.display = "none";
function func1(){
	var num = '1';
	if (num == '1') {
		a.style.display = "block";
		b.style.display = "none";
		c.style.display = "none";
		d.style.display = "none";
	}
}
function func2(){
	var num = '2';
	if (num == '2') {
		a.style.display = "none";
		b.style.display = "block";
		c.style.display = "none";
		d.style.display = "none";
	}
}
function func3(){
	var num = '3';
	if (num == '3') {
		a.style.display = "none";
		b.style.display = "none";
		c.style.display = "block";
		d.style.display = "none";
	}
}
function func4(){
	var num = '4';
	if (num == '4') {
		a.style.display = "none";
		b.style.display = "none";
		c.style.display = "none";
		d.style.display = "block";
	}
}
</script>
<script>
  $(document).ready(function() {
    $('#tbExam').DataTable({
      "columnDefs":[
        {"width": "2%", "targets":0},
        {"width": "15%", "targets":1},
        {"width": "8%", "targets":2}
      ]
    });
  });
</script>
<script>
	$(document).ready(function() {
		$('#tbStudents').DataTable({
      "paging": false,
      "columnDefs":[
        {"width": "2%", "targets":0},
        {"width": "27%", "targets":1},
        {"width": "27%", "targets":2},
        {"width": "27%", "targets":3},
        {"width": "7%", "targets":4},
        {"width": "10%", "targets":5}
      ]
		});
		$('#tbExamFinish').DataTable({
      "columnDefs":[
        {"width": "2%", "targets":0},
        {"width": "15%", "targets":1},
        {"width": "8%", "targets":2}
      ]
    });
		$('#tbVouchers').DataTable({
      "paging": false,
      "columnDefs":[
        {"width": "2%", "targets":0},
        {"width": "23%", "targets":1},
				{"width": "23%", "targets":2},
				{"width": "23%", "targets":3},
        {"width": "23%", "targets":4}
      ]
    });
	});
</script>
<script>
	$(document).ready(function() {
		$('#tblastreport').DataTable({
      "columnDefs":[
        {"width": "4%", "targets":0},
        {"width": "32%", "targets":1},
        {"width": "32%", "targets":3},
        {"width": "32%", "targets":4},
      ]
    });
	});
</script>
<!--/.row-->
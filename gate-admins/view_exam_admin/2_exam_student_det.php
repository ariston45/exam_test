<?php
$ids = $_GET['ids'];
if (isset($ids)) {
	$r = datStudent($ids);
	$n = datlastExam($ids);
}
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Search':
      $id_g = $_SESSION['admin_group'];
      $valin = $_POST['valin'];
      break;
    default:
			# code...
      break;
  }
}
?>
<div class="row">
	<div class="col-lg-12">
		<h4></h4>
	</div>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Student Detail</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info-costum">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-2">
										<b>ID (NIM / NISN)</b>
									</div>
									<div class="col-md-4">
										: <?=$r[0]?>
									</div>
									<div class="col-md-2">
										<b>Exam</b>
									</div>
									<div class="col-md-4">
										: <?=$n[2]?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<b>Name</b>
									</div>
									<div class="col-md-4">
										: <?=$r[1]?>
									</div>
									<div class="col-md-2">
										<b>Last Exam</b>
									</div>
									<div class="col-md-4">
										: <?=$n[1]?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<b>Email</b>
									</div>
									<div class="col-md-4">
										: <?=$r[2]?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<?php
					$no=0;
					$dataProgram = showVoucher($_SESSION['admin_group'],' group by a.id_program');
					while ($row = mysqli_fetch_array($dataProgram)) {
						$no++;
						echo "<h3>".$row[2]." </h3><br>";
						$table =
			            '<table class="table table-xs table-bordered" id="tbStudents'.$no.'"><thead><tr>
			              <th scope = "col" > No </th>
			              <th scope = "col" > Program </th>
			              <th scope = "col" > Schedule </th>
			              <th scope = "col" > Result </th>
			              </tr></thead><tbody>';
			              $no = 1;
			              $notif =0;
			            foreach (recordExamStu($ids,$row[5]) as $r) {
						  $date = $r[2].' '.$r[3];
						  if ($notif != $r[6]) {
						  $table .= "
						  <tr>
						    <td colspan = '4' style='color: #a21212;font-weight: 800;text-align: center;border-top: 1px solid red;border-bottom: 1px solid red;''>Re-Registration (RESET)</td>
						  </tr>";
						  	$notif = $r[6];
						  }
						 				$table .=
                          '<tr>
			              	<td>'.$no.'</td>
			              	<td>'.$r[1].'</td>
			              	';
			              	if ($r[2]!=null) {
			              		$table .='<td>'.$date.'</td>
			              	<td><button type="button"  data-id="'.$r[0].'" data-group="'.$r[4].'" data-toggle="modal" data-target="#result" class="btn btn-xs btn-info"><i class="fa fa-search-plus"></i> View</button>';
			              	}else{
			              		$table.='<td colspan="2" align="center"> Sistem Lama';
			              	}
			              $table .= '</td>
			               </tr>';
                    ++$no;
			            }
			            $table .= '</tbody></table>'; 
									echo($table);
					}
					// <button type="button"  data-id="['.$r[0].','.$r[4].']" data-toggle="modal" data-target="#result" class="btn btn-xs btn-info"><i class="fa fa-search-plus"></i> View</button>
            
            ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="result" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
	  	<div class="fetched-data"></div>
	</div>
</div></div>
<!--======================-->
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script>
	$(document).ready(function(){
		$('#result').on('show.bs.modal', function (e) {
			var rowid_1 = $(e.relatedTarget).data('id');
			var rowid_2 = $(e.relatedTarget).data('group');
			$.ajax({
			type : 'get',
			url  : 'view_pic/2_pic_studentres.php', //Here you will fetch records 
			data : {id:rowid_1,group:rowid_2},   //Pass $id
			success : function(data){
			  $('.fetched-data').html(data);//Show fetched data from database
			}
			});
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#tbStudents1').DataTable({
			"searching": false,
      "columnDefs":[
        {"width": "10%", "targets":0},
        {"width": "30%", "targets":1},
        {"width": "45%", "targets":2},
        {"width": "15%", "targets":3},
      ]
    });
	});
	$(document).ready(function() {
		$('#tbStudents2').DataTable({
			"searching": false,
      "columnDefs":[
        {"width": "10%", "targets":0},
        {"width": "30%", "targets":1},
        {"width": "45%", "targets":2},
        {"width": "15%", "targets":3},
      ]
    });
	});
	$(document).ready(function() {
		$('#tbStudents3').DataTable({
			"searching": false,
      "columnDefs":[
        {"width": "10%", "targets":0},
        {"width": "30%", "targets":1},
        {"width": "45%", "targets":2},
        {"width": "15%", "targets":3},
      ]
    });
	});
	$(document).ready(function() {
		$('#tbStudents4').DataTable({
			"searching": false,
      "columnDefs":[
        {"width": "10%", "targets":0},
        {"width": "30%", "targets":1},
        {"width": "45%", "targets":2},
        {"width": "15%", "targets":3},
      ]
    });
	});
	$(document).ready(function() {
		$('#tbStudents5').DataTable({
			"searching": false,
      "columnDefs":[
        {"width": "10%", "targets":0},
        {"width": "30%", "targets":1},
        {"width": "45%", "targets":2},
        {"width": "15%", "targets":3},
      ]
    });
	});
	$(document).ready(function() {
		$('#tbStudents6').DataTable({
			"searching": false,
      "columnDefs":[
        {"width": "10%", "targets":0},
        {"width": "30%", "targets":1},
        {"width": "45%", "targets":2},
        {"width": "15%", "targets":3},
      ]
    });
	});
</script>
<?php
// die();
$today = timeVar();
$id_customer = $_GET['CC'];
if (isset($_GET['Sche'])) {
	$id = $_GET['Sche'];
	$tokenRandom = generatePassword();
	$update = updateExamToken($tokenRandom, $id, $today[1]);
	//$status = updateStatus($id);
	echo "
		<script type='text/javascript'>
		$(document).ready(function(){
		document.getElementById('token').innerHTML = '$update';
		$('#Show_token').modal('show');
		});
		</script>";
	//header('location:?pg=pic_exam');
}
if (isset($_POST['cmd'])) {
	switch ($_POST['cmd']) {
		case 'Submit':
			$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$dob = $_POST['dob'];
			$pob = $_POST['pob'];
			$pword = $_POST['pword'];
			$pword_c = $_POST['pword_check'];
			$role = $_POST['role'];
			$uname = $_POST['username'];
			if ($pword == $pword_c) {
				$id_g = $id_customer;
				$new_id = newIdUser($id_g);
				addUsers($name, $address, $phone, $email, $dob, $pob, $pword, $pword_c, $id_g, $new_id, $role, $uname);
			} else {
				echo "<script>window.alert('Your password does not match, please try again.')</script>";
			}
			break;
		case 'Update PIC':
			$id = $_POST['id'];
			$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			updatePIC($id, $name, $address, $phone, $email);
			break;
		case 'Update':
			$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$dob = $_POST['dob'];
			$pob = $_POST['pob'];
			$pword = $_POST['pword'];
			$pword_c = $_POST['pword_check'];
			$uname = $_POST['username'];
			$id = $_POST['id'];
			$role = $_POST['role'];
			updateUser($id, $name, $dob, $pob, $address, $phone, $email, $role, $uname);
			if (isset($pword) or isset($pword_c)) {
				if ($pword == $pword_c) {
					setPass($id, $pword_c);
				} else {
					echo "<script>window.alert('Your password does not match, please try again.')</script>";
				}
			}
			break;
		case 'UpdateCustomer':
			$today = date("Ymd");
			$id = $_POST['id'];
			$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$result = $_POST['vires'];
			if ($_FILES['logo']['name'] != null) {
				$type = explode('.', $_FILES['logo']['name']);
				$namaFile = "logo-" . $name . $today . "." . $type[1];
				$namaSementara = $_FILES['logo']['tmp_name'];
				$dirUpload = "../assets/img/logo/";
				$terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);
			} else {
				$namaFile = $_POST['logo_lama'];
			}
			updateCustomer($id, $name, $address, $phone, $email, $namaFile, $result);
			break;
		default:
			# code...
			break;
	}
}
?>

<div class="row">
	<div class="col-lg-12">
		<h1></h1>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Detail Customer <?= $id_customer ?>
			</div>
			<div class="panel-body">
				<?php
				$result = editCustomer($id_customer);
				$row = mysqli_fetch_array($result);
				echo "	<div class='col-md-6'>
						<a href=\"?pg=admin_customer\" class=\"btn btn-xs btn-danger\" ><i class=\"fa fa-arrow-left\" ></i> Back</a>
						<button type=\"button\" class=\"btn btn-xs btn-primary\"  data-id='" . $row[0] . "'' data-toggle=\"modal\" data-target=\"#edit_cust\"><i class=\"fa fa-edit\"></i>  Edit</button>
						<table style=\"height: 100px;margin-top:10px;\">
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Id Customer</td>
							<td style=\" width: 20px;\">:</td>
							<td>" . $row[0] . "</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Customer Name</td>
							<td >:</td>
							<td>" . $row[1] . "</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Address</td>
							<td>:</td>
							<td>" . $row[2] . "</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Phone</td>
							<td>:</td>
							<td>" . $row[3] . "</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Email</td>
							<td>:</td>
							<td>" . $row[4] . "</td>
						</tr>
					   </table>
					  	</div>
					   	<div class='col-md-6' style='text-align:right;'>
							<img style='height:125px;border:1px groove;' src='../assets/img/logo/" . $row[5] . "'>
						</div>
					";
				?>

				<div class="col-md-12">
					<hr style="    border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
					<h3>User</h3>
					<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>
						Add User</button><br><br>
					<div class="table-responsive">
						<table class="table table-xs table-bordered" id="tbUser">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col">Name</th>
									<th scope="col">Address</th>
									<th scope="col">Phone</th>
									<th scope="col">Email</th>
									<th scope="col">Role</th>
									<th scope="col">Option</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$result = cekUser($id_customer);
								while ($row = mysqli_fetch_array($result)) {
									$option = "<button type=\"button\" class=\"btn btn-xs btn-primary\"  data-id='" . $row[0] . "' data-toggle=\"modal\" data-target=\"#edit_user\"><i class=\"fa fa-edit\"></i>  Edit</button> ";
									echo "
									<tr>
										<td>" . $no . "</td>
										<td>" . $row[1] . "</td>
										<td>" . $row[2] . "</td>
										<td>" . $row[3] . "</td>
										<td>" . $row[4] . "</td>
										<td>" . $row[5] . "</td>
										<td>" . $option . "</td>
										</tr>";
									$no++;
								}?>
							</tbody>
						</table>
					</div>
					<hr style="    border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
					<h3>Exam Schedule</h3>
					<a href="?pg=create_exam&id_customer=<?= $id_customer ?>" class="btn btn-xs btn-primary"><i
							class="fa fa-plus"></i> Create Exam</a><br><br>
					<div class="table-responsive">
						<table class="table table-xs table-bordered" id="tbExam">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Date</th>
									<th scope="col">Start</th>
									<th scope="col">Proctor</th>
									<th scope="col">Token</th>
									<th scope="col">Status</th>
									<th scope="col">Alocated</th>
									<th scope="col">Option</th>
								</tr>
							</thead>
							<tbody><?php
							$no = 1;
							$result = showExam($id_customer, null);
							while ($rowSche = mysqli_fetch_array($result)) {
								if ($rowSche[5] == 'pause') {
									$token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Hold</button>";
								} else if ($rowSche[4] != null) {
									$token = "<button type=\"button\" class=\"btn btn-xs btn-block btn-warning \" onclick=\"show_token('$rowSche[4]')\" >$rowSche[4]</button>";
								} else {
									if (cekTimeSchedule($rowSche[0])) {
										$token = "<a href=\"?pg=detail_customer&CC=" . $id_customer . "&Sche=" . $rowSche[0] . " \"><button type=\"button\" class=\"btn btn-xs btn-danger btn-block \"><i class=\"fa fa-key\"></i>  Generate</button></a>";
										//$token="<button type=\"button\" onclick=\"generate_token(".$rowSche[0].")\" class=\"btn btn-xs btn-danger btn-block \"><i class=\"fa fa-key\"></i>  Generate</button>";
									} else {
										if ($rowSche[1] == $today[0] and $rowSche[2] > $today[1]) {
											$token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Not Ready</button>";
										} else if ($rowSche[1] > $today[0]) {
											$token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Not Ready</button>";
										} else {
											$token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Expired</button>";
										}
									}
								}
								$today = timeVar();
								echo '
                  <tr>
                    <td>' . $no . '</td>
                    <td>' . date('d.M.Y', strtotime($rowSche[1])) . '</td>
                    <td>' . $rowSche[2] . '</td>
                    <td>' . $rowSche[3] . '</td>
                    <td>' . $token . '</td>
                    <td>' . $rowSche[5] . '</td>
                    <td>' . $rowSche[6] . '</td>
                    <td>';
								$expTime = date('H:i:s', strtotime("+15 minutes", strtotime($rowSche[2])));
								if ($rowSche[5] != 'init') {
									echo '<a href="?pg=schedule_detail&CC=' . $rowSche[0] . '"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-info-circle"></i>  Detail</button></a> ';
								} else if ($rowSche[5] == 'init' and $expTime >= $today[1] and $rowSche[1] >= $today[0]) {
									echo '<a href="?pg=exam_edit&CC=' . $rowSche[0] . '&id_g=' . $id_customer . '"><button type="button" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>  Edit</button></a> ';
								}
								echo '</td>
                  </tr>';
								$no++;
							} ?>
							</tbody>
						</table>
					</div>
					<hr style="    border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
					<h3>Students</h3>
					<div class="row">
						<div class="col-md-6">
							<a href="?pg=add_student&id_customer=<?= $id_customer ?>" class="btn btn-xs btn-primary"><i
									class="fa fa-plus"></i> Add Student</a>
						</div>
						<div class="col-md-6" style="text-align: right;">
							<form action="" method="POST">
								<input type="hidden" name="valin" class="form-control input-sm" value="Student not yet an exam">
								<button type="submit" name="cmd" class="btn btn-xs btn-success" value="Search"> <i
										class="fa fa-search"></i> Student not yet an exam</button>
							</form>
						</div>
					</div>
					<div class="table-responsive">
						<?php
						$table =
							'<table class="table table-xs table-bordered" id="tbStudents"><thead><tr>
              <th scope = "col" > No </th>
              <th scope = "col" > NIM </th>
              <th scope = "col" > Name </th>
              <th scope = "col" > Email </th>
              <th scope = "col" > Option </th>
              </tr></thead><tbody>';
						$no = 1;
						$id_g = $_SESSION['admin_group'];
						$valin = $_SESSION['valin'];
						if ($_POST['valin'] == 'Student not yet an exam') {
							foreach (showStudentUnexapAdmin($id_customer) as $r) {
								$id = $r[0];
								//$n = viewEquExm($id);
								$table .= '<tr><td>' . $no . '</td><td>' . $id . '</td><td>' . $r[1] . '</td><td>' . $r[2] . '</td> <td>
								<a href="?pg=pic_student_det&ids=' . $r[0] . '">
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-search-plus"></i> View</button>
								</a>
								</td>
								</tr>';
								$no++;
							}
						} else {
							foreach (showStudentsAll($id_customer) as $r) {
								$id = $r[0];
								//$n = viewEquExm($id);
								$table .= '<tr><td>' . $no . '</td><td>' . $id . '</td><td>' . $r[1] . '</td><td>' . $r[2] . '</td> <td>
								<a href="?pg=pic_student_det&cst='. $id_customer.'&ids=' . $r[0] . '">
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-search-plus"></i> View</button>
								</a>
								</td>
								</tr>';
								$no++;
							}
						}
						// die($id_g); 
						$table .= '</tbody></table>';
						echo $table;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal edit customer -->
<div class="modal fade" id="edit_cust" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="fetched-data"></div>
		</div>
	</div>
</div>
<!-- Modal edit pic -->
<div id="edit_user" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="fetched-data"></div>
		</div>
	</div>
</div>
<!-- Modal edit pic -->
<div class="modal fade" id="edit_pic" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="fetched-data"></div>
		</div>
	</div>
</div>
<!-- Modal Add User -->
<div id="add_user" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add New User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<form action="" method="post" autocomplete="off">
							<div class="form-group">
								<label>Name</label>
								<input name="name" type="text" class="form-control" value="" placeholder="name lastname" id="name">
							</div>
							<div class="form-group">
								<label>Place of Birt</label>
								<input name="pob" type="text" class="form-control" value="" placeholder="City">
							</div>
							<div class="form-group">
								<label>Date of Birth</label>
								<div class="controls input-append date form_date" data-date-format="yyyy-mm-dd"
									data-link-field="dtp_input1" data-date="1980-01-01">
									<input class="form-control" name="dob" placeholder="yyyy-mm-dd">
									<span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
							<div class="form-group">
								<label>Address</label>
								<input name="address" type="text" class="form-control" value="" placeholder="Jalan no.1">
							</div>
							<div class="form-group">
								<label>Phone</label>
								<input name="phone" type="text" class="form-control" value="" placeholder="+62852xx">
							</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label>
							<input name="email" type="text" class="form-control" value="" placeholder="example@email.com">
						</div>
						<div class="form-group">
							<label>Select Role</label>
							<select name="role" id="" class="form-control">
								<option value="Exam Administrator">Exam Administrator</option>
								<option value="Student Register">Student Register</option>
								<option value="Proctor">Proctor</option>
							</select>
						</div>
						<div class="form-group">
							<label>Username Login</label>
							<input name="username" type="text" class="form-control" value="" placeholder="username">
						</div>
						<div class="form-group">
							<label>Set Password</label>
							<input name="pword" type="password" class="form-control" value="" placeholder="***">
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input name="pword_check" type="password" class="form-control" value="" placeholder="***">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<input type="submit" name="cmd" class="btn btn-primary btn-sm" value="Submit">
			</div>
			</form>
		</div>
	</div>
</div>
<div id="Show_token" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Token Session</h4>
			</div>
			<div class="modal-body">
				<div class="row" style="text-align: center;text-shadow: 0px -2px 2px #000;">
					<h1 id='token' style="font-size: 75px;"></h1>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.form_date').datetimepicker({
		language: 'fr',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
</script>
<script>
	$(document).ready(function () {
		$('#edit_cust').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
			$.ajax({
				type: 'get',
				url: 'view_admin/1_edit_customer.php', //Here you will fetch records
				data: 'id=' + rowid, //Pass $id
				success: function (data) {
					$('.fetched-data').html(data);//Show fetched data from database
				}
			});
		});
	});
	$(document).ready(function () {
		$('#edit_pic').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
			$.ajax({
				type: 'get',
				url: 'view_admin/1_edit_pic.php', //Here you will fetch records
				data: 'id=' + rowid, //Pass $id
				success: function (data) {
					$('.fetched-data').html(data);//Show fetched data from database
				}
			});
		});
	});
	$(document).ready(function () {
		$('#edit_user').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
			$.ajax({
				type: 'get',
				url: 'view_admin/1_edit_user.php', //Here you will fetch records
				data: 'id=' + rowid, //Pass $id
				success: function (data) {
					$('.fetched-data').html(data);//Show fetched data from database
				}
			});
		});
	});
	$(document).ready(function () {
		$('#tbUser').DataTable();
	});
	$(document).ready(function () {
		$('#tbExam').DataTable();
	});
	$(document).ready(function () {
		$('#tbStudents').DataTable();
	});

	function show_token($tokenRandom) {
		document.getElementById('token').innerHTML = $tokenRandom;
		$('#Show_token').modal('show');
	}
</script>
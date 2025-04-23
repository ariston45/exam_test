<?php
if (isset($_GET['CC'])) {
	$id_v = $_GET['CC'];
	$result = showExamVoucher($id_v);
	if ($row = mysqli_fetch_array($result)) {
		$createID = 1;
		if ($row[4] == 'Postpaid') {
			$max_stue = 900;
		} else {
			if ($row[3] > 0) {
				$max = $row[3];
			} else {
				$max = 0;
			}
			$max_stue = maxParticipant($max, $row[5]);
		}
	}
	if ($row[4] = 'Prepaid' and $row[3] <= 0) {
		$voucher = 0;
	} else {
		$voucher = $row[3];
	}
}
if (isset($createID)) {
	$newName = genGroupName($id_v);
}
if (isset($_POST['cmd'])) {
	switch ($_POST['cmd']) {
		case 'Submit':
			//header('location:?pg=pic_exam_schedule');
			$id_voucher = $id_v;
			$group_name = $_POST['gname'];
			$date = $_POST['date'];
			$time = $_POST['time'];
			$dur = showDuration($id_v);
			// Khusus UPY Minta waktu ujian 90 Menit        
			if ($_SESSION['admin_group'] == 'C0019' && $row[5] == 'P0007') {
				$duration = 90;
			} else {
				$duration = $dur;
			}
			$proctor = $_POST['proctor'];
			$class = $_POST['class'];
			$quota = $_POST['plans_quota'];
			$insert_group = createExamGroup($id_voucher, $group_name, $quota);
			if ($insert_group) {
				createSchedule($date, $time, $duration, $proctor, $insert_group[b], $class);
			}
			echo '
			<script>window.location.href ="dashboard.php?pg=pic_exam_schedule"</script>
			';
			// header('location:?pg=pic_exam_schedule');
			// die();
			break;
		default:
			// code...
			break;
	}
}

?>
<!-- Extra CSS for Time Picker -->
<link rel="stylesheet" type="text/css" href="../assets/css/clock-picker/bootstrap-clockpicker.min.css">
<div class="row">
	<div class="col-lg-12">
		<h4></h4>
	</div>
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Create Schedule Exam</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<label class="label-head">Information</label>
						<div class="panel panel-info-costum">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-3">
										<b>Program Name</b>
									</div>
									<div class="col-md-3">
										: <?= $row[2]; ?>
									</div>
									<div class="col-md-3">
										<b>Duration</b>
									</div>
									<div class="col-md-3">
										<!-- Khusus UPY Minta waktu ujian 90 Menit -->
										: <?php if ($_SESSION['admin_group'] == 'C0019' && $row[5] == 'P0007') {
											echo '90';
										} else {
											echo $row[7];
										} ?> Minutes
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<b>Remaining Voucher</b>
									</div>
									<div class="col-md-3">
										: <?= $max; ?>
									</div>
									<div class="col-md-3">
										<b>Pass Grade</b>
									</div>
									<div class="col-md-3">
										: <?= $row[6]; ?>
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label class="label-head">Setup Exam</label>
						<div class="panel panel-info-costum">
							<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
								<div class="panel-body">
									<div class="form-group">
										<input type="hidden" value="<?= $row[0]; ?>" name="voucher">
										<input type="hidden" value="<?= $row[3]; ?>" name="quota">
										<input type="hidden" value="<?= $row[2]; ?>" name="program">
										<input type="hidden" value="<?= $newName; ?>" name="gname" required="">
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Date Schedule </label>
												<div class="controls input-append date form_date" data-date-format="yyyy-mm-dd"
													data-link-field="dtp_input1">
													<input class="form-control" name="date" placeholder="YYYY-MM-DD" required>
													<span class="add-on"><i class="icon-remove"></i></span>
													<span class="add-on"><i class="icon-th"></i></span>
												</div>
												<input type="hidden" id="dtp_input1" value="" required="" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Start Time </label>
												<div class="input-group clockpicker" data-autoclose="true">
													<input type="text" name="time" class="form-control" placeholder="HH:MM" required="">
													<span class="input-group-addon">
														<span class="glyphicon glyphicon-time"></span>
													</span>
												</div>
												<input type="hidden" id="dtp_input3" value="" />
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Maximum Participant</label>
										<input type="range" class="form-control-range" name="plans_quota" id="ageInputId" value="0" min="0"
											max="<?= $max_stue; ?>" oninput="ageOutputId.value = ageInputId.value" style="max-width: 465px;">
										<input type="number" id="ageOutputId" class="form-control input-sm" name="plans_quota" value="0"
											style="max-width: 465px;" max="<?= $max_stue; ?>">
									</div>
									<div class="row" style="margin-bottom: 10px;">
										<label style="width: 100%;padding: 0px 15px;">Classroom</label>
										<div class="col-md-9">
											<select class="form-control" name="class" required="" style="max-width: 750px;">
												<?php $result = showClass();
												while ($dat = mysqli_fetch_array($result)) {
													echo "<option value='" . $dat[0] . "'>" . $dat[2] . '</option>';
												} ?>
											</select>
										</div>
										<div class="col-md-3" style="padding: 7px 0px;">
											<a href="?pg=pic_classroom">Create Classroom</a>
										</div>
									</div>
									<div class="row" style="margin-bottom: 10px;">
										<label style="width: 100%;padding: 0px 15px;">Proctor</label>
										<div class="col-md-9">
											<select class="form-control" name="proctor" required="" style="max-width: 750px;">
												<?php $result = showProctor($_SESSION['admin_group']);
												while ($dat = mysqli_fetch_array($result)) {
													echo "<option value='" . $dat[0] . "'>" . $dat[1] . '</option>';
												} ?>
											</select>
										</div>
										<div class="col-md-3" style="padding: 7px 0px;">
											<a href="?pg=pic_user">Create Proctor</a>
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="label-sub">Duration</label>
										<input class="form-control input-sm" name="duration" value="90" required="" style="max-width: 250px;">
									</div> -->
									<br>
									<p class="text-right">
										<a href="?pg=pic_exam_create" class="btn btn-warning btn-sm">Cancel</a>
										<input type="submit" class="btn btn-primary btn-sm" name="cmd" value="Submit">
									</p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--======================-->

<!--<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script type="text/javascript" src="../assets/js/jquery-1.8.3.min.js" charset="UTF-8"></script> -->
<script type="text/javascript" src="../assets/js/jquery-1.12.0.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<!-- Extra JS for Time Picker -->
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
	$('.form_time').datetimepicker({
		language: 'id',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
	});
	// $(function () {
	// 	$('#datetimepicker').datetimepicker({
	// 		format:"DD-MMMM-YYYY hh:mm A",
	// 	});
	// 	$('#datepicker').datetimepicker({
	// 		format: 'YYYY-MM-DD',
	// 	});
	// 	$('#timepicker').datetimepicker({
	// 		format: 'HH:mm'
	// 	});
	// });
</script>
<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker();
	});
</script>
<script type="text/javascript" src="../assets/js/clock-picker/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/clock-picker/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
	$('.clockpicker').clockpicker()
		.find('input').change(function () {
			console.log(this.value);
		});
	var input = $('#single-input').clockpicker({
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		donetext: 'Done',
		'default': 'now'

	});

	// Manually toggle to the minutes view
	$('#check-minutes').click(function (e) {
		// Have to stop propagation here
		e.stopPropagation();
		input.clockpicker('show')
			.clockpicker('toggleView', 'minutes');
	});
	if (/mobile/i.test(navigator.userAgent)) {
		$('input').prop('readOnly', true);
	}
</script>
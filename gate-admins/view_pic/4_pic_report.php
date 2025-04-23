<style>
	div.scroll {
		border: 1px ridge;
		height: 150px;
		overflow: auto;
	}

	div.scroll div {
		margin-left: 10px;
	}

	.menu {
		border-radius: 0px;
		margin-bottom: -4px;
	}

	.actived {
		background-color: #000;
	}

	input[type=radio] {
		display: none;
	}

	input[type=radio]+label {
		display: inline-block;
		margin: -2px;
		padding: 4px 12px;
		margin-bottom: 0;
		font-size: 14px;
		line-height: 20px;
		color: #333;
		text-align: center;
		text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
		vertical-align: middle;
		cursor: pointer;
		background-color: #f5f5f5;
		background-image: -moz-linear-gradient(top, #fff, #e6e6e6);
		background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#e6e6e6));
		background-image: -webkit-linear-gradient(top, #fff, #e6e6e6);
		background-image: -o-linear-gradient(top, #fff, #e6e6e6);
		background-image: linear-gradient(to bottom, #fff, #e6e6e6);
		background-repeat: repeat-x;
		border: 1px solid #ccc;
		border-color: #e6e6e6 #e6e6e6 #bfbfbf;
		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		border-bottom-color: #b3b3b3;
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
		filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
		-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	}

	input[type=radio]:checked+label {
		background-image: none;
		outline: 0;
		-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
		-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
		box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
		background-color: #8ad919;
	}

	.nav-pills {
		padding: 0px;
		padding-bottom: 0;
	}

	.nav-pills>li.active>a,
	.nav-pills>li.active>a:focus {
		border-bottom: 0px;
	}

	.nav>li>a:hover,
	.nav>li>a:focus,
	.nav .open>a,
	.nav .open>a:hover,
	.nav .open>a:focus {
		text-decoration: none;
		background-color: rgb(255, 255, 255);
		background: #134469;
		;
	}

	.nav-pills>li.active>a,
	.nav-pills>li.active>a:focus,
	.nav-pills>li.active>a:hover {
		border: 0px;
		background: #134469;
		color: #fff;
	}

	.nav-pills>li {
		margin: 1px;
	}

	.nav-pills>li>a {
		border-radius: 1px;
	}

	.checkbox>label>input[type=radio] {
		display: -webkit-inline-box;
		margin-left: -15px;
		margin-right: 5px;
	}
</style>
<script type="text/javascript">
	function evalbyCust() {
		var group = document.by_cust.customer;
		for (var i = 0; i < group.length; i++) {
			if (group[i].checked)
				break;
		}
		if (i == group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("by_cust").submit();
	}

	function evalbyVoucher() {
		var group = document.by_voucher.voucher;
		for (var i = 0; i < group.length; i++) {
			if (group[i].checked)
				break;
		}
		if (i == group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("by_voucher").submit();
	}

	function evalbyTrans() {
		var group = document.by_trans.voucher;
		for (var i = 0; i < group.length; i++) {
			if (group[i].checked)
				break;
		}
		if (i == group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("by_trans").submit();
	}

	function evalbyExam() {
		var group = document.by_exam.exam;
		var id_cust = document.getElementById('E_program').value;
		for (var i = 0; i < group.length; i++) {
			if (group[i].checked)
				break;
		}
		if (id_cust == 'C0061')
			document.by_exam.cmd.value = 'exam_ub';

		if (i == group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("by_exam").submit();
	}

	function eval10byExam() {
		var group = document.persen_by_exam.exam;
		var id_cust = document.getElementById('10program').value;
		for (var i = 0; i < group.length; i++) {
			if (group[i].checked)
				break;
		}
		if (i == group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("persen_by_exam").submit();
	}

	function evalbyProgram() {
		var group = document.by_program.program;
		for (var i = 0; i < group.length; i++) {
			if (group[i].checked)
				break;
		}
		if (i == group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("by_program").submit();
	}
</script>
<link rel="stylesheet" href="../assets/css/autocomplete/jquery-ui-1.10.0.custom.css">
<div class="row">
	<div class="col-lg-12">
		<h1></h1>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Report Exam</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<form role="form" id="by_exam" name="by_exam" action="?pg=admin_showReport" method="POST" autocomplete="off">
							<input type="hidden" class="form-control" id="E_program" name="program2" required="" value="<?php echo $_SESSION['admin_group'] ?>">
							<div class="form-group">
								<div class="row">
									<div class="col-md-2">
										<label>Periode</label>
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-sm-6">
												<div>Date Start: </div>
												<div class="controls input-append date form_date1" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
													<input class="form-control" name="date_start" id="date_start" placeholder="YYYY-MM-DD" readonly required>
													<span class="add-on"><i class="icon-remove"></i></span>
													<span class="add-on"><i class="icon-th"></i></span>
												</div>
												<input type="hidden" id="dtp_input1" value="" required="" />
											</div>
											<div class="col-sm-6">
												<div>Date end: </div>
												<div class="controls input-append date form_date2" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
													<input class="form-control" name="date_end" id="date_end" placeholder="YYYY-MM-DD" readonly required>
													<span class="add-on"><i class="icon-remove"></i></span>
													<span class="add-on"><i class="icon-th"></i></span>
												</div>
												<input type="hidden" id="dtp_input1" value="" required="" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-2">
										<label>Porogram</label>
									</div>
									<div class="col-md-10">
										<div>Select one:</div>
										<select name="exam[]" id="" class="form-control input-sm" style="width:60%;">
											<?php
											$res = editExamVoucher($_SESSION['admin_group']);
											while ($dat = mysqli_fetch_array($res)) {
												echo "<option value='" . $dat[0] . "'>" . $dat[2] . "</option>";
											} ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-10">
										<input type="hidden" name="cmd" value="exam">
										<input type="checkbox" name="athome" value="Y"> <label>Exam at Home</label>
									</div>
								</div>
							</div>
							<div class="form-group" style="text-align: right;">
								<input type="reset" class="btn btn-sm btn-warning" name="reset" value="Cancel">
								<input type="submit" class="btn btn-sm btn-primary" name="Submit" value="Submit" data-toggle="modal" data-target="#info_submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="info_submit" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Reporting</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12" style="text-align: center;font-size: 20px;">
						Please wait a moment, the data is being processed.
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
			</div>
			</form>
		</div>
	</div>
</div>
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script type="text/javascript" src="../assets/js/autocomplete/jquery-ui-1.10.0.custom.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.form_date1').datetimepicker({
		language: 'fr',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
	$('.form_date2').datetimepicker({
		language: 'fr',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});

	$("#checkAll").click(function() {
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	function selectAllcust(source) {
		checkboxes = document.getElementsByName('customer[]');
		for (var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}

	function selectAllvoucher(source) {
		checkboxes = document.getElementsByName('voucher[]');
		for (var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}

	function selectAllexam(source) {
		checkboxes = document.getElementsByName('exam[]');
		for (var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}

	function selectAllprogram(source) {
		checkboxes = document.getElementsByName('program[]');
		for (var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
</script>
<script>
	// Add active class to the current button (highlight it)
	function changeBox1() {
		var id = document.getElementById('V_program').value;
		//alert(id);
		$.ajax({
			type: 'get',
			url: 'view_admin/help-report.php', //Here you will fetch records
			data: {
				id: id,
				variable: 'by_voucher'
			}, //Pass $id
			success: function(data) {
				//alert(data);
				document.getElementById('box1').innerHTML = data;
			}
		});
	}

	function changeBox2() {
		var id = document.getElementById('E_program').value;
		var start = document.getElementById('date_start').value;
		var end = document.getElementById('date_end').value;
		//alert(id);
		$.ajax({
			type: 'get',
			url: 'view_admin/help-report.php', //Here you will fetch records
			data: {
				id: id,
				variable: 'by_exam',
				start: start,
				end: end
			}, //Pass $id
			success: function(data) {
				//alert(data);
				document.getElementById('box2').innerHTML = data;
			}
		});
	}

	function changeBox3() {
		var id = document.getElementById('V_trans_program').value;
		//alert(id);
		$.ajax({
			type: 'get',
			url: 'view_admin/help-report.php', //Here you will fetch records
			data: {
				id: id,
				variable: 'by_voucher'
			}, //Pass $id
			success: function(data) {
				//alert(data);
				document.getElementById('box3').innerHTML = data;
			}
		});
	}

	function changeBox4() {
		var id = document.getElementById('10program').value;
		var start = document.getElementById('10date_start').value;
		var end = document.getElementById('10date_end').value;
		//alert(id);
		$.ajax({
			type: 'get',
			url: 'view_admin/help-report.php', //Here you will fetch records
			data: {
				id: id,
				variable: 'by_exam',
				start: start,
				end: end
			}, //Pass $id
			success: function(data) {
				//alert(data);
				document.getElementById('box4').innerHTML = data;
			}
		});
	}
	$(document).ready(function() {
		var ac_config = {
			source: "view_admin/auto-customer.php",
			select: function(event, ui) {
				$("#txt-program").val(ui.item.subject_group);
				$("#10program").val(ui.item.id_subject);
			},
			minLength: 1
		};
		$("#txt-program").autocomplete(ac_config);
	});
</script>
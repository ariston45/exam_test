<?php
if (isset($_POST['cmd'])) {
	switch ($_POST['cmd']) {
		case 'Submit':
			$sama = 0;
			$name = $_POST['name'];
			$tot = $_POST['tot'];
			$margin = $_POST['margin'];
			$passgrade = $_POST['passgrade'];
			$subject = $_POST['subject_labels'];
			for ($i = 0; $i < count($subject); ++$i) {
				for ($j = $i + 1; $j < count($subject); ++$j) {
					if ($subject['new' . $i]['subject_id'] == $subject['new' . $j]['subject_id']) {
						++$sama;
					}
				}
			}
			$duration = $_POST['duration'];
			if ($sama == 0 && count($subject) != 0) {
				addProgram($name, $subject, $margin, $tot, $duration, $passgrade);
			} else {
				echo
					"<script LANGUAGE='JavaScript'>
					window.alert(\"Inputan Subject Anda Salah !\");
					</script>";
			}
			break;
		case 'Update':
			$id = $_POST['id'];
			$tot = $_POST['tot'];
			$no_id = $_POST['no_id'];
			$name = $_POST['name'];
			$margin = $_POST['margin'];
			$duration = $_POST['duration'];
			$subject = $_POST['subject'];
			$percent = $_POST['percent'];
			updateProgram($id, $name, $subject, $margin, $percent, $no_id, $tot, $duration);
			break;
		case 'Delete':
			$id = $_POST['id'];
			deleteProgram($id);
			break;
		default:
			break;
	}
}
?>
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script src="../assets/js/jquery.repeatable.js"></script>
<div class="row">
	<div class="col-lg-12">
		<h4></h4>
	</div>
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">Programs</div>
			<div class="panel-body">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_program" type="button"><i
						class="fa fa-plus-square-o"></i> Create Program</button><br><br>
				<table class="table table-bordered table-xs" id="tbProgram">
					<thead>
						<tr>
							<th>No.</th>
							<th>Id Program</th>
							<th>Name</th>
							<th>Sum of Questions</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$result = showAllProgram();
						while ($row = mysqli_fetch_array($result)) {
							// data-id="' . $row[0] . '" data-toggle="modal" data-target="#edit_program"
							echo '
							<tr>
							<td>' . $no . '</td>
							<td>' . $row[0] . '</td>
							<td>' . $row[1] . '</td>
							<td>' . $row[2] . '</td>
							<td><a href="?pg=detail_programs&CC=' . $row[0] . '" class="btn btn-xs btn-info" > <i class="fa fa-info-circle"></i> Detail</a>
							<button type="button" class="btn btn-xs btn-primary" onclick="actEditProg(\''.$row[0].'\')" style="margin-right: 3px;" ><i class="fa fa-edit"></i>  Edit</button>';
							if ($_SESSION["admin_level"] == "Administrator") {
								echo '<button type="button" class="btn btn-xs btn-danger " data-id="' . $row[0] . '"  data-toggle="modal" data-target="#delete_program"><i class="fa fa-trash"></i>  Delete</button>';
							}
							echo '</td></tr>';
							++$no;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- modal add program -->
	<div class="modal fade" id="add_program" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create Program</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<form role="form" id="add_cust" action="" method="POST">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Name</label>
									<input class="form-control" name="name" value="<?= $name; ?>" required>
								</div>
								<div class="form-group">
									<label>Sum of Questions</label>
									<input class="form-control" type="number" name="tot" value="<?= $tot; ?>">
								</div>
								<div class="form-group">
									<label>Duration</label>
									<input class="form-control" type="number" name="duration" value="<?= $duration; ?>"
										placeholder='On Minutes' required>
								</div>
								<div class="form-group">
									<label>Pass Grade</label>
									<input class="form-control" type="number" name="passgrade" value="<?= $passgrade; ?>" max='100'
										required>
								</div>
								<div class="form-group">
									<label>Exam Opportunity</label>
									<select class="form-control" name="margin">
										<?php
										for ($i = 1; $i <= 5; ++$i) {
											if ($margin == $i) {
												echo "<option value='" . $i . "' selected>" . $i . '</option>';
											} else {
												echo "<option value='" . $i . "'>" . $i . '</option>';
											}
										}
										?>
									</select>
								</div>
								<fieldset class="subject_labels">
									<?php if (isset($_POST['name'])) {
										echo "<span id='warning' style=\"color: #ff6b3e\">Silahkan Masukan Lagi Subject Program</span>";
									} ?>
									<div class="repeatable"></div>
									<div class="form-group" style="text-align:center;">
										<input type="button" value="Add Subject" onclick="warning_hide()" class="btn btn-sm btn-success add"
											align="center">
									</div>
								</fieldset>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" name="cmd" class="btn btn-primary" value="Submit">
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- modal edit program -->
	<div class="modal fade" id="edit_program" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div id="fetched-form-edit-program"></div>
			</div>
		</div>
	</div>
	<!-- modal delete program -->
	<div class="modal fade" id="delete_program" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="fetched-data"></div>
			</div>
		</div>
	</div>
	<script>
		function actEditProg(id) {
			$.ajax({
				type: 'get',
				url: 'view_admin/2_edit_program.php', //Here you will fetch records
				data: {
					'id': id
				},
				success: function (data) {
					$('#fetched-form-edit-program').html(data);//Show fetched data from database
					$('#edit_program').modal('show');
				}
			});
		}
		function removeSubject($key) {
			$("#subject_" + $key).remove();
		}
		function addSubject() {
			
			var options = '<option value="">=== Select Subject ===</option>';
			for (var i = 0; i < subjectOptions.length; i++) {
				options += '<option value="' + subjectOptions[i].id_subject + '">' + subjectOptions[i].subject_name + '</option>';
			}
			var new_key = $('#subject_list .row').length;
			$('#subject_list').append(`
			<div class="row" id="subject_`+new_key+`">
				<div class="col-sm-12">
					<label>New Subject</label>
				</div>
				<div class="col-sm-7">
					<select class="form-control" name="subject[]">
						`+options+
					`</select>
				</div>
				<div class="col-sm-3">
					<div class="input-group">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">C</button>
						</span>
						<input class="form-control" type="number" name="percent[]" value="">
					</div>
					<input class="form-control" type="hidden"  name="no_id[]" value="">
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-danger" id="remove_subject" onclick="removeSubject(`+new_key+`)"><i class="fa fa-trash"></i></button>
				</div>
			</div>`);
		}
	</script>
	<script>
		function warning_hide() {
			document.getElementById('warning').style.display = "none";
		}
		$(document).ready(function () {
			$('#tbProgram').DataTable();
		});
	</script>
	<script>
		$(document).ready(function () {
			$('#edit_program').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('id');
				$.ajax({
					type: 'get',
					url: 'view_admin/2_edit_program.php', //Here you will fetch records
					data: 'id=' + rowid, //Pass $id
					success: function (data) {
						$('.fetched-data').html(data);//Show fetched data from database
					}
				});
			});
		});

		$(document).ready(function () {
			$('#delete_program').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('id');
				$.ajax({
					type: 'get',
					url: 'view_admin/2_delete_program.php', //Here you will fetch records
					data: 'id=' + rowid, //Pass $id
					success: function (data) {
						$('.fetched-data').html(data);//Show fetched data from database
					}
				});
			});
		});
	</script>

	<script type="text/template" id="subject_labels">
		<div class="field-group row">
			<div class="col-lg-7">
				<label for="subject_id_{?}">Subject</label>
				<select class="form-control" name="subject_labels[{?}][subject_id]" value="{subject_id}" id="subject_id_{?}">
					<?php
					$result = showSubject();
					while ($row = mysqli_fetch_array($result)) {
						echo "<option value='" . $row[0] . "'>" . $row[1] . '</option>';
					}?>
				</select>
			</div>
			<div class="col-lg-3">
				<label for="percent_{?}">Total Question</label>
				<input type="text" class="span2 form-control" name="subject_labels[{?}][percent]" value="{percent}" id="percent_{?}" required="">
			</div>
			<div class="col-lg-2">
			<label for="">Action</label><br>
				<input type="button" class="btn btn-sm btn-danger span-2 delete" value="Remove" />
			</div>
		</div>
	</script>

	<script>
		$(function () {
			$(".subject_labels .repeatable").repeatable({
				addTrigger: ".subject_labels .add",
				deleteTrigger: ".subject_labels .delete",
				template: "#subject_labels",
				startWith: 1
			});
		});
	</script>
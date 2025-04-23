<?php //die('Sorry Not Ready to use');
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id = $_GET['id'];
$program = detailPrograms($id);
$result = mysqli_fetch_array($program);
$dataSubject = showSubject();
$dataSubject_arr = mysqli_fetch_all($dataSubject, MYSQLI_ASSOC);
$subject_arr = array();
foreach ($dataSubject_arr as $key => $value) {
	$subject_arr[$key] = [
		"id_subject" => $value['id_subject'],
		"subject_name" => $value['subject_name'],
	];
}
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Edit Program</h4>
</div>
<form role="form" id="edit_program" action="" method="POST">
	<div class="modal-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Name</label>
					<input class="form-control"  name="name" value="<?=$result['program_name']?>">
					<input class="form-control" type="hidden" name="id" value="<?= $result['id_program'] ?>">
				</div>
				<div class="form-group">
					<label>Sum of Questions</label>
					<input class="form-control" type="number" name="tot" value="<?= $result['sum_question'] ?>">
				</div>
				<div class="form-group">
					<label>Duration</label>
					<input class="form-control" type="number"  name="duration" value="<?= $result['duration'] ?>" placeholder='On Minutes' required>
				</div>
				<div class="form-group">
					<label>Exam Opportunity</label>
					<select class="form-control" name="margin">
					<?php
						for ($i = 1; $i <= 5; $i++) {
							if ($result['margin'] == $i) {
								echo "<option value='" . $i . "' selected>" . $i . "</option>";
							} else {
								echo "<option value='" . $i . "'>" . $i . "</option>";
							}
						}
					?>
					</select>
				</div>
				<div class="form-group">
					<label>Pass Grade</label>
					<input class="form-control" type="number" name="passgrade" value="<?= $result['pass_grade'] ?>" max='100' required>
				</div>
				<div class="form-group" id="subject_list">
					<?php
					$cnr = showSubjectList($id);
					$cnr_array = mysqli_fetch_array($cnr);
					foreach ($cnr as $key => $value) { ?>
					<div class="row" id="subject_<?=$key?>">
						<div class="col-sm-12">
							<label>Subject <?= $key + 1 ?></label>
						</div>
						<div class="col-sm-7">
							<select class="form-control" name="subject[]">
								<option value="<?=$value['id_subject']?>"><?=$value['subject_name']?> (selected)</option>
								<?php
								foreach ($subject_arr as $skey => $list) { ?>
									<option value="<?=$list['id_subject']?>"><?= $list['subject_name']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-3">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">C</button>
								</span>
								<input class="form-control" type="number" name="percent[]" value="<?= $value['percent'] ?>">
							</div>
							<input class="form-control" type="hidden"  name="no_id[]" value="<?= $value['id'] ?>">
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn btn-danger" id="remove_subject" onclick="removeSubject(<?=$key?>)"><i class="fa fa-trash"></i></button>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary" id="add_subject" onclick="addSubject()"><i class="fa fa-plus"></i> Add Subject</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
		<input type="submit" name="cmd" class="btn btn-sm btn-success" value="Update">
	</div>
</form>
<script>
	var subjectOptions = <?php echo json_encode($subject_arr); ?>;
</script>

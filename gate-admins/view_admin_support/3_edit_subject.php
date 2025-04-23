<?php
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id = $_GET['id'];
$rs = editSubject($id);
$result = mysqli_fetch_array($rs);
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Edit Subject</h4>
</div>
<form role="form" id="add_subject" action="" method="POST">
	<div class="modal-body">
		<div class="form-group">
			<label>Subject id</label>
			<input class="form-control" name="id" value="<?= $result[1] ?>" readonly>
		</div>
		<div class="form-group">
			<label>Subject Group</label>
			<input class="form-control" type="text" name="subject_group" id="e_subject_group_<?=$result[1]?>" value="<?= $result[4] ?>" />
		</div>
		<div class="form-group">
			<label>Subject Name</label>
			<input class="form-control" name="name" value="<?= $result[2] ?>">
		</div>
		<div class="form-group">
			<label>Level</label>
			<select name="level" class="form-control">
				<?php
				for ($x = 0; $x < 5; $x++) {
					if ($x == $result[3]) {
						echo "<option value=" . $x . " selected> " . $x . "</option>";
					} else {
						echo "<option value=" . $x . "> " . $x . "</option>";
					}
				}
				?>
			</select>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
		<input type="submit" name="cmd" class="btn btn-sm btn-success" value="Update Subject">
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function () {
		var ac_config = {
			source: "view_admin_support/help-subject-group.php",
			select: function (event, ui) {
				$("#e_subject_group_<?=$result[1]?>").val(ui.item.subject_group);
				$("#id_<?= $result[1] ?>").val(ui.item.id_subject);
			},
			minLength: 1
		};
		$("#e_subject_group_<?=$result[1]?>").autocomplete(ac_config);
	});

</script>
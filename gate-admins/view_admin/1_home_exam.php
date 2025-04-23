<?php 
include '../../cfg/general.php';
include '../../control/inc_function.php';
include '../../control/inc_function2.php';
connectdb();
$id = $_GET['id'];
$rs_config = cek_athome_config($id);
$rs = editCustomer($id);
$result = mysqli_fetch_array($rs);
if ($rs_config[1]==0) {		
	$status = "<b style='color:red;'>Disable</b>";		
}else if ($rs_config[1]==1) {
	$status = "<b style='color:#098801;'>Active</b>";		
}
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Set Home Exam (Token Active 1 Day)</h4>
</div>
<div class="modal-body">
	<form role="form" action="" method="POST" enctype="multipart/form-data">
	<div class="modal-body">
		<div class="form-group">
			<label>Name</label>
			<input class="form-control" type="" name="id_customer" value="<?= $result[0]; ?>">
			<input class="form-control" name="name" value="<?= $result[1]; ?>">
		</div>
		
		<div class="form-group">
			<label>Set Fitur Home Exam Schedule</label><br>
			<d>Status : <?=$status?></d>
			<select name="at_home_config" id="" class="form-control">
				<option value="0" <?php if ($rs_config[1]==0) {		echo "selected";		}?>>Disable </option>
				<option value="1" <?php if ($rs_config[1]==1) {		echo "selected";		}?>>Active</option>
			</select>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
		<input type="hidden" name="cmd" class="btn btn-sm btn-success" value="SetAthome">
		<input type="submit" class="btn btn-sm btn-success" value="Save">
	</div>
</form>
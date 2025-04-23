<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_GET['id'];
$rs= editProgram($id);
$result = mysqli_fetch_array($rs);
?>
	
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Delete Program</h4>
</div>
<form method="post">
<div class="modal-body">
	 are you sure you want to delete the data :<br>
	 <b>Id Program</b> : <?=$result[0]?><br>
	 <b>Name</b> : <?=$result[1]?><br>
<br></div>
	<input class="form-control" type="hidden" name="id" value=<?=$result[0]?>>
	<div class="modal-footer">
	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
	<input type="submit" name="cmd" class="btn btn-sm btn-danger" value="Delete">
	</div> 
</form>	
				


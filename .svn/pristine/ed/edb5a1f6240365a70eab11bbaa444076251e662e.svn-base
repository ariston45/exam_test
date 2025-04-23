<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_GET['id'];
$rs= editSubject($id);
$result = mysqli_fetch_array($rs);
?>
				 <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Delete Custommer</h4>
			        </div>
			        <div class="modal-body">
 are you sure you want to delete the data :<br>
 <b>Subject id</b> : <?=$result[1]?><br>
 <b>Subject Name</b> : <?=$result[2]?><br>
 <b>Level</b> : <?=$result[3]?><br>
		
<br>	</div>
<form method="post">
	<input class="form-control" type="hidden" name="id" value=<?=$result[0]?>>
	<input class="form-control" type="hidden" name="id_subject" value=<?=$result[1]?>>
	<div class="modal-footer">
	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
	<input type="submit" name="cmd" class="btn btn-sm btn-danger" value="Delete Subject">
	</div> 
</form>	
				


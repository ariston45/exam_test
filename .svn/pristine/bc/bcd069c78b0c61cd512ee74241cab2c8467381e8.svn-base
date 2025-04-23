<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_GET['id'];
$rs= editQuestion($id);
$result = mysqli_fetch_array($rs);
?>
				 <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Delete Question</h4>
			        </div>   
			        <div class="modal-body">
			        	
  are you sure you want to delete the data :<br>
 <b>Question</b> : <?=str_replace("<img src=\"","<img style=\"max-width:230px;\" src=\"../".$GLOBALS["img-soal-dir"],$result[3])?><br>
		</div> 
<form method="post">
	<input class="form-control" type="hidden" name="id" value='<?=$result[0]?>'>
	<input class="form-control" type="hidden" name="cmd" value='Delete Question'>
	<div class="modal-footer">
	<input type="submit" class="btn btn-sm btn-danger" value="Delete Question">
	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
	</div> 
</form>	
				


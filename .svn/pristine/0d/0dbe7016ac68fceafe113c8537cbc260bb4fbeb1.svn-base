<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_POST['id'];
$rs= editVoucher($id);
$result = mysqli_fetch_array($rs);
?>
<div class="modal-header" style="background: #f9243f;">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Delete Voucher</h4>
</div>
<div class="modal-body">
		Are you sure you want to delete the data :<br>
 		<b>Id Voucher</b> : <?=$result[0]?><br>
 		<b>Name</b> : <?=$result[1]?><br>
 		<b>Program</b> : <?=$result[2]?><br>
 		<b>Total</b> : <?=$result[3]?>
</div>
<form method="post">
		<input class="form-control" type="hidden" name="id" value=<?=$result[0]?>>
<div class="modal-footer">
	<input type="submit" name="cmd" class="btn btn-sm btn-danger" value="Delete"> 
	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
	
</div> 
	</form>	
				


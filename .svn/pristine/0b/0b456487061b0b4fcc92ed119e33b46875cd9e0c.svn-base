<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id = $_GET['id'];
$res = editUser($id);
$result = mysqli_fetch_array($res);
$id = $_SESSION["admin_group"];
?>
<div class="modal-header">
	<h4 class="modal-title">Delete User</h4>
</div>
<form action="" method="post">
<div class="modal-body">
  <p class="text-center">Are you sure delete this user ?</p>
  <input type="hidden" name="id" value="<?=$result[0]?>">
</div>	
<div class="modal-footer">
 	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	<input type="submit" name="cmd" class="btn btn-primary btn-sm" value="Delete">
</div>
</form>



<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$class = $_GET['id'];
$n = detClass($class);
?>
<div class="modal-header">
  <h4 class="modal-title">Edit Class</h4>
</div>
<form action="" method="post">
<div class="modal-body">
  <div class="form-group">
    <label>Class Name</label>
    <input type="text" class="form-control input-sm" name="class_name" value="<?=$n?>">
    <input type="hidden" class="form-control input-sm" name="class" value="<?=$class?>">
  </div>
</div>	
<div class="modal-footer">
  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
  <input type="submit" name="cmd" class="btn btn-primary btn-sm" value="Update">
</div>
</form>



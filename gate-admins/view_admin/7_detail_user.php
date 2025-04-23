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
	<h4 class="modal-title">Detail User</h4>
</div>
<form action="" method="post">
<div class="modal-body">
  <div class="row">
    <div class="col-md-4">Fullname</div>
    <div class="col-md-8"><?= $result[1]; ?></div>
  </div>
  <div class="row">
    <div class="col-md-4">Place / Date of Birth</div>
    <div class="col-md-8"><?= $result[4]; ?>, <?= $result[3]; ?></div>
  </div>
  <div class="row">
    <div class="col-md-4">Address</div>
    <div class="col-md-8"><?= $result[4]; ?></div>
  </div>
  <div class="row">
    <div class="col-md-4">Username</div>
    <div class="col-md-8"><?= $result[7]; ?></div>
  </div>
  <div class="row">
    <div class="col-md-4">Role Access</div>
    <div class="col-md-8"><?= $result[8]; ?></div>
  </div>
  <div class="row">
    <div class="col-md-4">Phone</div>
    <div class="col-md-8"><?= $result[5]; ?></div>
  </div>
  <div class="row">
    <div class="col-md-4">Email</div>
    <div class="col-md-8"><a href="mailto:<?= $result[6]; ?>" target="_top"><?= $result[6]; ?></a></div>
  </div>
</div>	
<div class="modal-footer">
	<input type="submit" name="cmd" class="btn btn-primary btn-sm" value="Ok">
</div>
</form>

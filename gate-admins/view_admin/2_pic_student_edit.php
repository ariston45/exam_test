<?php
$nim = $_GET['ids'];
$cst = $_GET['cst'];
$dataStudent = datStudent($nim);
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Update':
      $id =  $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $our_id = $_POST['our_id'];
      $ExUpdate = updateDataStudentAdmin($id,$name,$email,$our_id);
      // die();
      echo ("<script LANGUAGE='JavaScript'>
              window.alert('Succesfully Updated');
              window.location.href='?pg=pic_student_det&cst=".$cst."&ids=".$id."';
            </script>");
      break;
    
    default:
      # code...
      break;
  }
}
?>
<style>
#tb1
table, td, th {  
  border: 1px solid #ddd;
	text-align: center;
	font-size: 12px;
}
table {
  border-collapse: collapse;
  width: 100%;
}
#tb1 th{
	background-color: #1769aa;
	color :#fff;
}
#tb1 th,td {
  padding: 2px;
}
.dataTables_wrapper .dataTables_length {
float: left;
}
</style>
<div class="row">
	<div class="col-lg-12">
		<h4></h4>
  </div>
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Students Update</div>
			<div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <h4>Registration Student<h4>
            <form action="" method ="POST">
              <div class="form-group">
                <h5>ID (NIM / NISN)</h5>
                <input type="text" class="form-control" name="id" value="<?php echo $dataStudent[0] ?>" required>
                <input type="hidden" name="our_id" value="<?= $dataStudent[3]?>" readonly>
              </div>
              <div class="form-group">
                <h5>Name</h5>
                <input type="text" class="form-control" name="name" value="<?php echo $dataStudent[1] ?>" required>
              </div>
              <div class="form-group">
                <h5>Email</h5>
                <input type="text" class="form-control" name="email" value="<?php echo $dataStudent[2] ?>" required>
              </div>
              <br>
              <a href="?pg=pic_student" class="btn btn-sm btn-default"> Cancel</a>
              <input type="submit" class="btn btn-sm btn-info" name="cmd" Value="Update">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--======================-->
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<!--/.row-->
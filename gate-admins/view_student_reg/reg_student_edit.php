<?php
$nim = $_GET['ids'];
$dataStudent = datStudent($nim);
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Update':
      $id =  $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $ExUpdate = updateDataStudent($id,$name,$email);
      echo ("<script LANGUAGE='JavaScript'>
              window.alert('Succesfully Updated');
              window.location.href='?pg=reg_student_det&ids=".$id."';
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
			<div class="panel-heading">Students Register</div>
			<div class="panel-body">
				    <div class="row">
              <div class="col-md-6">
                <h4>Registration Student<h4>
                <form action="" method ="POST">
                  <div class="form-group">
                    <h5>ID (NIM / NISN)</h5>
                    <input type="text" class="form-control" name="id" value="<?php echo $dataStudent[0] ?>" required readonly="">
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
            <?php
            if (isset($_SESSION['idstu'])) {
              $vp = resPoint($_SESSION['idstu']);
              echo $vp;
              echo'<br>
              <form action="" method="Post">
                <button type="submit" class="btn btn-Warning btn-xs" value="Clear" name="cmd">Clear Chace</button>
              </form>';
            }
            ?>
            <hr>
           <?php
            echo $view_1;
            echo $view_4;
            echo $view_2;
            echo $view_3;
           ?>
          </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--======================-->
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script>
	$(document).ready(function() {
		$('#tbStudents').DataTable({
      "paging": true,
      "columnDefs":[
        {"width": "2%", "targets":0},
        {"width": "27%", "targets":1},
        {"width": "27%", "targets":2},
        {"width": "27%", "targets":3},
        {"width": "7%", "targets":4},
        {"width": "10%", "targets":5}
      ]
    });
	});
</script>

<!--/.row-->
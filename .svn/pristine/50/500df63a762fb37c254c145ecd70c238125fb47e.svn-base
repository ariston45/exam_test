<?php
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Search':
      if ($_POST['valin'] == true) {
        $_SESSION['valin'] = $_POST['valin'];
      } else {
        $_SESSION['valin'] = "All students";
      }
      echo "<script>window.location.href = window.location.href;</script>";
      break;
    case 'Clear':
      $_SESSION['valin'] = "";
      unset($_SESSION['idstu']);
      echo "<script>window.location.href = window.location.href;</script>";
      break;
    case 'Upload';
    $filename = fileSetup();
    if ($filename != "") {
      $inst = "import";
        //echo $filename;
    }
      // echo $$filename;
    if ($inst == "import") {
      $_SESSION["import_id"] = $filename;
      $ext = strtolower(array_pop(explode(".", $filename)));
      if ($ext == "xls") {
        require_once "../" . $GLOBALS["xls-reader-dir"] . "PHPExcel.php";
        import_excel_students($filename);
        saveStudents($filename);
        unset($filename);
      } else {
        $js = "<script language=\"javascript\"> \r\n
          alert(\"Sorry, the file format is unsupported.\"); \r\n
          </script> \r\n
          ";
        echo $js;
      }
    }
    header("location:dashboard.php?pg=pic_student");
    echo "<script>window.location.href = window.location.href;</script>";
    break;
  case 'Reset':
    resetImport();
    break;
  case 'Register':
    $id = $_SESSION['idstu'] = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $n = savePointStudent($id, $name, $email);
    if ($n == true) {
      echo '<script>alert("Data well inputed on database.");</script>';
      echo "<script>window.location.href = window.location.href;</script>";
    } else {
      echo '<script>alert("Data can not input on database ' . $_POST['cmd'] . '.");</script>';
      echo "<script>window.location.href = window.location.href;</script>";
    }
    break;
  case 'Clear':
    session_unset($_SESSION['idstu']);
    break;
  case 'submit_remidi':
    $arr = $_POST['id_cek'];
    $arrs = $_POST['id_all'];
    updateStudentRemidi($arr, $arrs);
    break;
  default:
    break;
}
}
$view_1 = resStudent($_SESSION["import_id"]); //addins
$view_2 = resStudentRej($_SESSION["import_id"]); //addins
$view_3 = resStudentDup($_SESSION["import_id"]); //addins
$view_4 = resRemidial($_SESSION["import_id"]);

$ck_re = resRemidial($_SESSION["import_id"]);
if ($row = mysqli_num_rows($ck_re) != 0) {
  $ck = 1;
}
$ck_up = resViewStudent($_SESSION["import_id"]);
if ($row = mysqli_num_rows($ck_up) != 0) {
  $ck = 1;
}
$ck_re = resViewStudentReject($_SESSION["import_id"]);
if ($row = mysqli_num_rows($ck_re) != 0) {
  $ck = 1;
}
$ck_du = resViewStudentDupli($_SESSION["import_id"]);
if ($row = mysqli_num_rows($ck_du) != 0) {
  $ck = 1;
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
                    <h5>ID (NIM)</h5>
                    <input type="text" class="form-control" name="id" required>
                  </div>
                  <div class="form-group">
                    <h5>Name</h5>
                    <input type="text" class="form-control" name="name" required>
                  </div>
                  <div class="form-group">
                    <h5>Email</h5>
                    <input type="text" class="form-control" name="email" required>
                  </div>
                  <br>
                  <input type="reset" class="btn btn-sm btn-default" name="cmd" value="Cancel">
                  <input type="submit" class="btn btn-sm btn-info" name="cmd" Value="Register">
                </form>
              </div>
            </div>
            <?php
            if (isset($_SESSION['idstu'])) {
              $vp = resPoint($_SESSION['idstu']);
              echo $vp;
              echo '<br>
              <form action="" method="Post">
                <button type="submit" class="btn btn-Warning btn-xs" value="Clear" name="cmd">Clear Chace</button>
              </form>';
            }
            ?>
            <hr>
            <div class="row">
              <div class="col-sm-6">
              <h5>Upload students with excel (.xls) format. For example file click <a href="../assets/sample_file/example.xls" download>here.</a> </h5>
                <form action="" method="POST" enctype="multipart/form-data" >
                  <label class="btn btn-default btn-sm" for="my-file-selector">
                  <input name="file1" id="my-file-selector" type="file" style="display:none" onchange="$('#upload-file-info').html(this.files[0].name)">
                  Browse file
                  </label>
                  <input type="submit" class="btn btn-primary btn-sm" value="Upload" name="cmd">
                  &nbsp;<span class='label label-default' id="upload-file-info"></span>
                </form>
                <?php 
                if ($ck == 1) {
                  echo '<br>
                  <form action="" method="Post">
                  <button type="submit" class="btn btn-Warning btn-xs" value="Reset" name="cmd">Clear Chace</button>
                  </form>';
                }
                ?>
              </div>
            </div>
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
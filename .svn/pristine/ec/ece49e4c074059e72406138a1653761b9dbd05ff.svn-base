<?php
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Search':
      if ($_POST['valin']==true) {
        $_SESSION['valin'] = $_POST['valin'];
      }else {
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
        $inst ="import";
        echo $$filename;
      }
      // echo $$filename;
      if ($inst=="import") {
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
      break;
    case 'Reset':
      resetImport();
      break;
    case 'Register':
      $id = $_SESSION['idstu'] = $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $n = savePointStudent($id,$name,$email);
      if ($n == true) {
        echo '<script>alert("Data well inputed on database.");</script>';
        echo "<script>window.location.href = window.location.href;</script>";
      }else {
        echo '<script>alert("Data can not input on database '.$_POST['cmd'].'.");</script>';
        echo "<script>window.location.href = window.location.href;</script>";
      }
      break;
    case 'Clear':
      session_unset($_SESSION['idstu']); 
      break;
    case 'remidial':
      $prog = $_POST['program'];
      $user_remidial = userRemidial($prog,$_SESSION['admin_group']);
      break;
    case 'submit_remidial':
      $prog = $_POST['program'];
      $user = $_POST['remidial'];
      $cust_group = $_SESSION['admin_group'];
      sendUserRemidial($user,$prog,$cust_group);
      $user_remidial = userRemidial($prog,$_SESSION['admin_group']);
        echo '<script>alert("Data peserta remidial sudah di Ajukan");</script>';

      break;
    default:
			# code...
      break;
  }
}
$view_1 = resStudent();
$view_2 = resStudentRej();
$view_3 = resStudentDup();
$ck_up = resViewStudent();
if($row = mysqli_num_rows($ck_up) != 0){$ck = 1;}
$ck_re = resViewStudentReject();
if($row = mysqli_num_rows($ck_re) != 0){$ck = 1;}
$ck_du = resViewStudentDupli();
if($row = mysqli_num_rows($ck_du) != 0){$ck = 1;}
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
			<div class="panel-heading">Students Remidial</div>
			<div class="panel-body">
				  <div class="row">
              <div class="col-sm-5">
              <form action="" method="post" id=program>
                  <div class="form-group">
                    <label>Program</label>
                    <input type="hidden" name="cmd" value="remidial">
                    <select class="form-control " name='program' onchange="submit()">
                      <option class="form-control " value=0>-</option>     
                      <?php
                       $voucher = showVoucher($_SESSION['admin_group']);
                        while ($row=mysqli_fetch_array($voucher)) {
                          if ($row[5]==$prog) {
                            echo "<option class=\"form-control input-sm\" value='".$row[5]."'' selected>".$row[2]."</option>";
                          }else{
                            echo "<option class=\"form-control input-sm\" value='".$row[5]."''>".$row[2]."</option>";
                          }
                        }
                      ?>               
                    </select>
                  </div>
                  
              </form>  
              </div><!-- /.col-lg-5 -->
            <div class="col-md-12">
              <?php
            if (isset($user_remidial)) {
              echo "<form id='remedial' method='POST' action=''>";
              echo "<input type='hidden' name='cmd' value='submit_remidial'>";
              echo "<input type='hidden' name='program' value='$prog'>";
              echo "<table class=\"table table-xs\" id=\"tbStudentRemidial\">";
              $no=1;
              echo "
              <thead>
                <tr>
                  <th scope='col'>No</th>
                  <th scope='col'>NIM</th>
                  <th scope='col'>Nama</th>
                  <th scope='col'>Program</th>
                  <th scope='col'>Ajukan</th>
                </tr>
              </thead>";
                while ($row = mysqli_fetch_array($user_remidial)) {
                  $dataProgram = mysqli_fetch_array(editProgram($row[4]));
                  echo "
                  <tr>
                    <td>$no</td>
                    <td>".$row[0]."</td>
                    <td>".$row[1]."</td>
                    <td>".$dataProgram[1]."</td>
                    ";
                  if ($row[5]=='Y') {
                    echo "<td><input type=\"checkbox\" name='remidial[]' value='$row[0]' checked=\"checked\"></td>";
                  }else{
                    echo "<td><input type=\"checkbox\" name='remidial[]' value='$row[0]' ></td>";
                  }
                echo "
                  </tr>
                ";
                $no++;
                }
              echo "</table>
              <br>
              <input class='btn btn-xs btn-primary' type='submit' value='Submit'>
              </form>";
            }
            ?>
            </div>
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
    $('#tbStudentRemidial').DataTable();
  });
</script>
<!--/.row-->
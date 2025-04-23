<?php
$id_cust = $_GET['id_cust'];
$id_prog = $_GET['prog'];
$user_remidial = userRemidial($id_prog,$id_cust,"submited = 'Y'");
switch (isset($_POST['cmd'])) {
	case 'approve':
		$user = $_POST['remidial'];
		$margin = $_POST['margin'];
		$nim = $_POST['nim'];
     	approveUserRemidial($nim,$user,$id_prog,$cust_group,$margin);
      echo ("<script LANGUAGE='JavaScript'>
            window.alert('Success');
            </script>");
		$user_remidial = '';
		break;
	
	default:
		# code...
		break;
}
?>
<link rel="stylesheet" href="../assets/css/autocomplete/jquery-ui-1.10.0.custom.css">
	<script src='../assets/js/jquery-1.12.0.min.js'></script>
    <script type="text/javascript" src="../assets/js/autocomplete/jquery-ui-1.10.0.custom.min.js"></script>
<div class="row">
	<div class="col-md-12" style="padding-top: 20px;">
		<div class="panel panel-info">
			<div class="panel-heading">Approval Remidial</div>
			<div class="panel-body">
			   <form id='remedial' method='POST' action=''>
             <input type='hidden' name='cmd' value='approve'>
              <input type='hidden' name='program' value='$prog'>
              <table class="table table-xs" id="tbStudentRemidial">
             <?php
              $no=1;
              echo "
              <thead>
                <tr>
                  <th scope='col'>No</th>
                  <th scope='col'>NIM</th>
                  <th scope='col'>Nama</th>
                  <th scope='col'>Program</th>
                  <th scope='col'>Approve</th>
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
                    echo "<td><input type=\"checkbox\" name='remidial[]' value='$row[0]' checked=\"checked\">
                    	<input type='hidden' name='nim[]' value='$row[0]'>
                    	<input type='hidden' name='margin[]' value='$row[3]'>
                    	</td>";
                  }else{
                  	echo "<td><input type=\"checkbox\" name='remidial[]' value='$row[0]' >
                    	<input type='hidden' name='margin[]' value='$row[3]'>
                    	<input type='hidden' name='nim[]' value='$row[0]'>
                    	</td>";
                  }
                echo "
                  </tr>
                ";
                $no++;
                }
              echo "</table>
              <br>
              <input class='btn btn-xs btn-danger' type='submit' value='Approve'>
              </form>";
              ?>
			</div>
		</div>
	</div>
</div> 		

			<script src='../assets/js/jquery-1.12.0.min.js'></script>
			<script>
			  $(document).ready(function() {
			    $('#tbStudentRemidial').DataTable();
			  });
			</script>
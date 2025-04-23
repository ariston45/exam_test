<?php
$user_remidial = ListUserRemidial();
switch (isset($_POST['cmd'])) {
	case 'approve':
		$user = $_POST['remidial'];
		$id_prog = $_POST['id_prog'];
		$cust_group = $_POST['cust_group'];
		$margin = $_POST['margin'];
		$nim = $_POST['nim'];
		approveUserRemidial($nim, $user, $id_prog, $cust_group, $margin);
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
			<div class="panel-heading">Approval Remidial </div>
			<div class="panel-body">
				<form id='remedial' method='POST' action='view_admin/help-approve.php'>
					<input type='hidden' name='cmd' value='approve'>
					<input type='hidden' name='program' value='$prog'>
					<table class="table table-xs" id="tbStudentRemidial">
						<thead>
							<tr>
								<th scope='col'>No</th>
								<th scope='col'>Customer</th>
								<th scope='col'>NIM</th>
								<th scope='col'>Nama</th>
								<th scope='col'>Program</th>
								<th scope='col'>Approve</th>
							</tr>
						</thead>
						<?php
						$no = 1;
						while ($row = mysqli_fetch_array($user_remidial)) {
							$id_cust = explode('.', $row[2]);
							$dataCustomer = mysqli_fetch_array(editCustomer($id_cust[0]));
							$dataProgram = mysqli_fetch_array(editProgram($row[4]));
							echo "<tr>
								<td>$no</td>
								<td>" . $dataCustomer[1] . "</td>
								<td>" . $row[0] . "</td>
								<td>" . $row[1] . "</td>
								<td>" . $dataProgram[1] . "</td>";
							if ($row[5] == 'Y') {
								echo "<td><input type=\"checkbox\" name='remidial[]' value='$row[0]' checked=\"checked\">
								<input type='hidden' name='cust_group[]' value='$dataCustomer[0]'>
								<input type='hidden' name='id_prog[]' value='$dataProgram[0]'>
								<input type='hidden' name='nim[]' value='$row[0]'>
								<input type='hidden' name='margin[]' value='$row[3]'></td>";
							} else {
								echo "<td><input type=\"checkbox\" name='remidial[]' value='$row[0]' >
								<input type='hidden' name='cust_group[]' value='$dataCustomer[0]'>
								<input type='hidden' name='id_prog[]' value='$dataProgram[0]'>
								<input type='hidden' name='margin[]' value='$row[3]'>
								<input type='hidden' name='nim[]' value='$row[0]'></td>";
							}
							echo "</tr>";
							$no++;
						} ?>
					</table><br>
					<input class='btn btn-xs btn-danger' type='submit' value='Approve'>
				</form>
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
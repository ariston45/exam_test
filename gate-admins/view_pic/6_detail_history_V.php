<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_GET['id'];
$ar=explode('.',$id);
?>

		
<div class="row" style="margin-top: 15px;">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Detail Exam</div>
			<div class="panel-body">
				<a href="?pg=pic_detail_voucher&id=<?=$ar[0]?>" class="btn btn-danger btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
				<?php
			  $result=historyDetail($ar[0],$ar[1]);
				if (mysqli_num_rows($result)) {
					
				?>
				<div style="text-align: center;">
				<h4>First Chance</h4>
				<hr style=" margin-top: 1px;margin-bottom: 0px;   border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
			  <table class="table table-xs table-bordered" id="tbDetail" style="width: 100%;">
			    <thead>
				    <tr>
				    	<th scope="col">No.</th>
				    	<th scope="col">Student Id</th>
				    	<th scope="col">Student Name</th>
				    	<th scope="col">Date</th>
				    </tr>
				</thead>
				<tbody>
			    <?php
			    $no=1;
			    $result=historyDetail($ar[0],$ar[1]);
				while($row = mysqli_fetch_array($result)){
					$idStudent = explode('.',$row[4] );
					$dataStudent = getDataStudent($idStudent[0]);
				echo "
				<tr>
					<td>".$no."</td>
					<td>".$dataStudent[1]."</td>
					<td>".$dataStudent[0]."</td>
					<td>".$row[3]."</td>
				</tr>

				";
				$no++;
				}
			    ?>
					</tbody>
			  </table>
				</div>
			<?php
				}
			  $result=historyReExamDetail($ar[0],$ar[1]);
				if (mysqli_num_rows($result)) {
					
			?>
			<div style="text-align: center;">
				<h4>Remedial Chance</h4>
				<hr style=" margin-top: 1px;margin-bottom: 0px;   border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
			  <table class="table table-xs table-bordered" id="tbDetailRe" style="width: 100%;">
			    <thead>
				   <tr>
				    	<th scope="col">No.</th>
				    	<th scope="col">Student Id</th>
				    	<th scope="col">Student Name</th>
				    	<th scope="col">Date</th>
				    </tr>
				</thead>
				<tbody>
			    <?php
			    $no=1;
			    $result=historyDetail($ar[0],$ar[1]);
				while($row = mysqli_fetch_array($result)){
					$idStudent = explode('.',$row[4] );
					$dataStudent = getDataStudent($idStudent[0]);
				echo "
				<tr>
					<td>".$no."</td>
					<td>".$dataStudent[1]."</td>
					<td>".$dataStudent[0]."</td>
					<td>".$row[3]."</td>
				</tr>

				";
				$no++;
				}
			    ?>
					</tbody>
			  </table>
				</div>
			<?php
			# code...
				}
			?>
			</div>
			</div>
		</div>
 	</div>
</div>
	<script>
		$(document).ready(function() {
			$('#tbDetail').DataTable({
				
				"lengthChange": false
			});
			
		} );
		$(document).ready(function() {
			$('#tbDetailRe').DataTable({
				
				"lengthChange": false
			});
			
		} );
	</script>
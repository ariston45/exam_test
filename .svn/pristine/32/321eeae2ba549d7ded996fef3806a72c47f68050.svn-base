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
				<a href="?pg=detail_voucher&id=<?=$ar[0]?>" class="btn btn-danger btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
		  <table class="table table-xs" id="tbDetail" style="width: 100%;">
		    <thead>
			    <tr>
			    	<th scope="col">No.</th>
			    	<th scope="col">Exam Code</th>
			    	<th scope="col">Student Id</th>
			    	<th scope="col">Date</th>
			    </tr>
			</thead>
			<tbody>
		    <?php
		    $no=1;
		    $result=historyDetail($ar[0],$ar[1]);
			while($row = mysqli_fetch_array($result)){
				
			echo "
			<tr>
				<td>".$no."</td>
				<td>".$row[1]."</td>
				<td>".$row[4]."</td>
				<td>".$row[3]."</td>
			</tr>

			";
			$no++;
			}
		    ?>
				</tbody>
		  </table>
		</div>
	</div>
  </div>
</div>
	<script>
		$(document).ready(function() {
			$('#tbDetail').DataTable({
				"searching": false,
				"lengthChange": false
			});
			
		} );
	</script>
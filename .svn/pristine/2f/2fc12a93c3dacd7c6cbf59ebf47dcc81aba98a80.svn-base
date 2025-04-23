<?php

if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Submit':
	  $id_g  = $_SESSION['admin_group'];
      $name  = $_POST['name'];
      $date1 = $_POST['date1'];
      $date2 = $_POST['date2'];
      createReport($id_g,$nama,$date1,$date2);
      //header('location:?pg=pic_exam');
      break;
    default:
			# code...
      break;
  }
}
?>
<div class="row">
	<div class="col-lg-12">
		<h4></h4>
	</div>
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Report</div>
			<div class="panel-body">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Creater_report" type="button">Create Report</button><br><br>
				<table class="table table-xs" id="tbReport">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Program</th>
							<th scope="col">Detail</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no = 1;
						$id_g = $_SESSION['admin_group'];
						$result = showVoucher($id_g,'group by c.program_name');
						while ($row = mysqli_fetch_array($result)) {
							echo '
							<tr>
								<td>' . $no . '</td>
								<td>' . $row[2] . '</td>
								<td> 
								<a href="?pg=pic_report&CC='.$row[5].'" class="btn btn-xs btn-success"> <i class="fa fa-search-plus"></i> View</a>
								</td>
							</tr>';
						$no++;
						}
					?>
					</tbody>
				</table>


			</div>
		</div>
	</div>
</div>
<!-- MODAL Create report -->
			<div class="modal fade" id="Creater_report" role="dialog">
		    <div class="modal-dialog">
		    <!-- Modal content-->
			<div class="modal-content">
			    <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Create Report</h4>
			        </div>
			        <div class="modal-body">
			          <form role="form" id="add_cust" action="" method="POST" autocomplete="off" >
			          	<div class="form-group">
							<label>Name</label>
							<input class="form-control"  name="name">
						</div>
						<div class="form-group">
							<label>Date</label>
							<div class="row">
								<div class="col-md-5">
									<div class="controls input-append date form_date1"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
									<input class="form-control" name="date1"  placeholder="YYYY-MM-DD" required>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
									</div>
									<input type="hidden" id="dtp_input1" value="" required="" />
								</div>
								<div class="col-md-2" style="text-align: center;"> To </div>
								<div class="col-md-5">
									<div class="controls input-append date form_date2"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
									<input class="form-control" name="date2"  placeholder="YYYY-MM-DD" required>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
									</div>
									<input type="hidden" id="dtp_input1" value="" required="" />
								</div>
							</div>
						</div>
			          
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			            <input type="submit" name="cmd" class="btn btn-sm btn-success" value="Submit">
			        </div> </form>
			      </div>
		        </div>
			</div>
		</div>
<!--======================-->
<script src='../assets/js/jquery-1.12.0.min.js'></script>

  <script>
	$(document).ready(function() {
		$('#tbReport').DataTable({
			"columnDefs": [
    	{ "orderable": false, "targets": 2 }
  	]});
	});
</script>

<!--/.row-->
	
<!--======================-->
<!-- Extra JS for Time Picker -->
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
   $('.form_date1').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    }); 
   $('.form_date2').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>
<?php
if (isset($_POST['cmd'])) {
	switch ($_POST['cmd']) {
		case 'Submit':
			$today = date("Y-m-d H:i:s");
			$customer = $_POST['customer'];
			$program = $_POST['program'];
			$amount = $_POST['amount'];
			$type = $_POST['type'];
			addVoucher($customer, $program, $amount, $today, $type);
			break;
		case 'Delete':
			$id = $_POST['id'];
			deleteVoucher($id);
			break;
		case 'top-up':
			$id_v = $_POST['id_voucher'];
			$topup = $_POST['top-up'];
			$inv_num = $_POST['invoice_num'];
			$inv_date = $_POST['invoice_date'];
			topUpVoucher($id_v, $topup, $inv_num, $inv_date);
			break;
		default:
				# code...
			break;
	}
}
?>
<!--  -->
<div class="row">
	<div class="col-lg-12">
		<h4>Dashboard</h4>
	</div>
</div>	
<div class="row">	
	<div class="col-md-12" id="sum">
		<div class="panel panel-warning">
			<div class="panel-heading">Customer</div>
			<div class="panel-body">
				<table class="table table-bordered table-xs" id="tbVoucher">
					<thead>
			    	<tr>
			        <th scope="col">No.</th>
			        <th scope="col">Customer Name</th>
			      	<th scope="col">Program</th>
			        <th scope="col">Type</th>
			        <th scope="col">Saldo</th>
			        <th scope="col" width="20%">Option</th>
			      </tr>
			    </thead>
					<tbody>
					<?php
					$no = 1;
					$result = showAllVoucher($id);
					while ($row = mysqli_fetch_array($result)) {
						echo '
							<tr>
								<td>' . $no . '</td>
								<td>' . $row[1] . '</td>
								<td>' . $row[2] . '</td>
								<td>' . $row[4] . '</td>
								<td>' . $row[3] . '</td>
								<td>
									<a href ="?pg=detail_voucher&id=' . $row[0] . '" > <button type="button" class="btn btn-xs btn-info "><i class="fa fa-table"></i>  Stock Card</button></a> 
									<button type="button" class="btn btn-xs btn-primary "  data-id="' . $row[0] . '" data-toggle="modal" data-target="#topup_voucher"><i class="fa fa-shopping-cart"></i>  Transaksi</button> &nbsp
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
<!--  -->
<!-- 1 -->
<!-- 2 -->
<!-- Modal create voucher -->
			<div class="modal fade" id="add_cust" role="dialog">
		    <div class="modal-dialog">
		    <!-- Modal content-->
			<div class="modal-content">
			    <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Create Voucher</h4>
			        </div>
			        <div class="modal-body">
			          <form role="form" id="add_cust" action="" method="POST" enctype="multipart/form-data">
			          	<div class="form-group">
							<label>Customer</label>
								<input type="text" name="customer_name" value="<?= $data[1] ?>" id="txtCust" class="form-control" readonly/>
								<input type="hidden" name="customer" value="<?= $id ?>" id="id" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Program Name</label>
								<select class="form-control" name="program">
								<?php
							$result = showAllProgram();
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
							}
							?> 
								</select>
						</div>
			          	<div class="form-group">
							<label>Voucher Amount</label>
							<input class="form-control" type="number"  name="amount">
						</div>
						<div class="form-group">
							<label>Type Voucher &nbsp :</label>
							<input type="radio" id="radio1" name="type" value="Prepaid" checked>
						       <label for="radio1">Pre Paid</label>
						    <input type="radio" id="radio2" name="type" value="Postpaid">
						       <label for="radio2">Post Paid</label>
						</div>
						
			         
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			            <input type="submit" name="cmd" class="btn btn-sm btn-primary" value="Submit">
			        </div> </form>
			      </div>
		        </div>
			</div>
		</div>
<!-- modal delete voucher -->
			<div class="modal fade" id="delete_voucher" role="dialog">
		    <div class="modal-dialog">
		        <!-- Modal content-->
			      <div class="modal-content">
			        
			          	<div class="fetched-data"></div> 
			      </div>
		        </div>
			</div>
<!-- Modal edit voucher -->
			<div class="modal fade" id="topup_voucher" role="dialog">
		    <div class="modal-dialog">
		        <!-- Modal content-->
			      <div class="modal-content">
			        	<div class="fetched-data"></div> 			          
			      </div>
		        </div>
			</div>


			<script>
			$(document).ready(function() {
				$('#tbVoucher').DataTable();
			} );
			</script>
			
			<script>
			  $(document).ready(function(){
			    $('#topup_voucher').on('show.bs.modal', function (e) {
			        var rowid = $(e.relatedTarget).data('id');
			        $.ajax({
			            type : 'get',
			            url : 'view_admin/4_topup_voucher.php', //Here you will fetch records 
			            data :  'id='+ rowid, //Pass $id
			            success : function(data){
			            $('.fetched-data').html(data);//Show fetched data from database
			            }
			        });
			     });
			});
			  $(document).ready(function(){
			    $('#delete_voucher').on('show.bs.modal', function (e) {
			        var rowid = $(e.relatedTarget).data('id');
			        $.ajax({
			            type : 'get',
			            url : 'view_admin/4_delete_voucher.php', //Here you will fetch records 
			            data :  'id='+ rowid, //Pass $id
			            success : function(data){
			            $('.fetched-data').html(data);//Show fetched data from database
			            }
			        });
			     });
			});
			  $(document).ready(function(){
		         var ac_config = {
		             source: "view_admin/server.php",
		             select: function(event, ui){
		                 $("#txtCust").val(ui.item.cust_name);
		                 $("#id").val(ui.item.id);
		             },
		             minLength:1
		         };
		         $("#txtCust").autocomplete(ac_config);
		        });
			</script>


				


		<!--/.row-->
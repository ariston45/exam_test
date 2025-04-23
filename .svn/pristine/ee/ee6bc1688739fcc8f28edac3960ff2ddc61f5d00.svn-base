<?php
	if (isset($_POST['cmd'])) {
		switch ($_POST['cmd']) {
			case 'Submit':  
				$today = date("Y-m-d H:i:s");
				$customer = $_POST['customer'];
				$program = $_POST['program'];
				$amount = $_POST['amount'];
				$type = $_POST['type'];
				addVoucher($customer,$program,$amount,$today,$type);
				break;
			case 'Delete':
				$id = $_POST['id'];
				deleteVoucher($id);
				break;
			case 'top-up':
				$id = $_POST['id_voucher'];
				$topup = $_POST['top-up'];
				topUpVoucher($id,$topup);
				break;
			default:
				# code...
				break;
		}
	}
?>
<style>
input[type=radio] {
		display:none;
	}

input[type=radio] + label {
		display:inline-block;
		margin:-2px;
		padding: 3px 10px;
		margin-bottom: 0;
		font-size: 14px;
		font-weight: 400;
		line-height: 20px;
		border-radius: 4px;
		color: #333;
		text-align: center;
		vertical-align: middle;
		cursor: pointer;
		background-color: #f5f5f5;
		background-image: -moz-linear-gradient(top,#fff,#e6e6e6);
		background-image: -webkit-gradient(linear,0 0,0 100%,from(#fff),to(#e6e6e6));
		background-image: -webkit-linear-gradient(top,#fff,#e6e6e6);
		background-image: -o-linear-gradient(top,#fff,#e6e6e6);
		background-image: linear-gradient(to bottom,#fff,#e6e6e6);
		background-repeat: repeat-x;
		border: 1px solid #ccc;
		border-color: #e6e6e6 #e6e6e6 #bfbfbf;
		border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
		border-bottom-color: #b3b3b3;
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe6e6e6',GradientType=0);
		filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
		-webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
		-moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
		box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
	}

	 input[type=radio]:checked + label{
		background-image: none;
		color: #fff;
		outline: 0;
		background-color:#30a5ff;
	}

</style>
<link rel="stylesheet" href="../assets/css/autocomplete/jquery-ui-1.10.0.custom.css">
	<script src='../assets/js/jquery-1.12.0.min.js'></script>
    <script type="text/javascript" src="../assets/js/autocomplete/jquery-ui-1.10.0.custom.min.js"></script>
<div class="row">
	<div class="col-lg-12">

		<h4><?php echo $_POST['cmd'] ;?></h4>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Voucher</div>
			<div class="panel-body">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_cust" type="button">Create Voucher</button><br><br>
				<table class="table table-xs" id="tbVoucher">
					<thead>
			            <tr>
			                <th scope="col">No.</th>
			                <th scope="col">Customer Name</th>
			                <th scope="col">Program</th>
			                <th scope="col">Type</th>
			                <th scope="col">Saldo</th>
			                <th scope="col">Option</th>
			            </tr>
			        </thead>
					<tbody>
						<?php
							$no = 1;
							$result=showVoucher();
							while($row = mysqli_fetch_array($result)){
								echo '
								<tr>
									<td>'.$no.'</td>
									<td>'.$row[1].'</td>
									<td>'.$row[2].'</td>
									<td>'.$row[4].'</td>
									<td>'.$row[3].'</td>
									<td>
									<a href ="?pg=detail_voucher&id='.$row[0].'" > <button type="button" class="btn btn-xs btn-info "><i class="fa fa-info-circle"></i>  Detail</button></a> &nbsp
									<button type="button" class="btn btn-xs btn-primary "  data-id="'.$row[0].'" data-toggle="modal" data-target="#topup_voucher"><i class="fa fa-plus"></i>  Top Up</button> &nbsp
									<button type="button" class="btn btn-xs btn-danger " data-id="'.$row[0].'"  data-toggle="modal" data-target="#delete_voucher"><i class="fa fa-trash"></i>  Delete</button></td>
									
								</tr>
								';
								$no++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
 		

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
								<input type="text" name="customer_name" id="txtCust" class="form-control"/>
								<input type="hidden" name="customer" id="id" class="form-control"/>
						</div>
						<div class="form-group">
							<label>Invoice Number</label>
							<input type="text" class="form-control"  name="invoice_num" required="">
						</div>
						<div class="form-group">
							<label>Invoice Date</label>
							<div class="controls input-append date form_date"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
							<input class="form-control" name="invoice_date" placeholder="yyyy-mm-dd" required>
							<span class="add-on"><i class="icon-th"></i></span>
							</div>
						</div>
						<div class="form-group">
							<label>Program Name</label>
								<select class="form-control" name="program">
								<?php
									$result=showAllProgram();
									while($row = mysqli_fetch_array($result)){
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
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
			
			<script type="text/javascript">
			   $('.form_date').datetimepicker({
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
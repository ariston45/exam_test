<style type="text/css">
	.panel-widget {
    margin-bottom: 0px;
}
</style>
<?php
if (isset($_POST['cmd'])) {
		switch ($_POST['cmd']) {
			case 'top-up':
				$id = $_POST['id_voucher'];
				$topup = $_POST['top-up'];
				topUpVoucher($id,$topup);
				break;
			case 'Add PIC':  
				$id = $_POST['id'];
				$name = $_POST['name'];
				$address = $_POST['address'];
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				  $result = addPIC($id,$name,$address,$phone,$email);
				  if ($result!=null) {
				  	echo "	<div class=\"col-lg-12\">
								<h4><br></h4>
							</div>
				  		  <div class=\"col-md-4\">
						   <div class=\"panel panel-warning\">
							<div class=\"panel-heading\">Register Success</div>
							  <div class=\"panel-body\">
								<table>
									<tr>
										<td style=\"width:100px;\"><b> User_Name  </b></td>
										<td style=\"width:10px;\"> : </td>
										<td> ".$result['id_user']."</td>
									</tr>
									<tr>
										<td><b> Password  </b></td>
										<td> : </td>
										<td> ".$result['pass']."</td>
									</tr>
								</table>
							  </div>
							</div>
						   </div>
						  </div>";
						  die();
				  }
				break;
			default:
				# code...
				break;
		}
	}

?>		
<div class="row" style="margin-top: 15px;">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Dashboard</div>
			<div class="panel-body">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<a href="#tab1" data-toggle="tab">
							<div class="row no-padding"><em class="fa fa-xl fa-users color-blue"></em>
								<div class="large">Customer</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<a href="#tab2" data-toggle="tab">
							<div class="row no-padding"><em class="fa fa-xl fa-tasks color-orange"></em>
								<div class="large">Programs</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<a href="#tab3" data-toggle="tab">
							<div class="row no-padding"><em class="fa fa-xl fa-ticket color-teal"></em>
								<div class="large">Voucher</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding">
							<a href="#tab4" data-toggle="tab">
								<em class="fa fa-xl fa-flag-o color-red"></em>
								<div class="large">Reports</div>
							</a>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
</div>
<div class="panel panel-default">
	<div class="panel-body tabs">
		<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
			<h4>Customer</h4>
			<table class="table table-bordered table-xs" id="tbCustomer" style="width: 100%;">
					<thead>
			            <tr>
			                <th scope="col">No.</th>
			                <th scope="col">Name</th>
			                <th scope="col">Address</th>
			                <th scope="col">Phone</th>
			                <th scope="col">Email</th>
			                <th scope="col">Option</th>
			            </tr>
			        </thead>
					<tbody>
						<?php
							$no = 1;
							$result=showCustomer();
							while($row = mysqli_fetch_array($result)){
								$rs=cekPIC($row[0]);
								if (mysqli_num_rows($rs)>0) {
									$pic = mysqli_fetch_array($rs);
									$button_pic = '<a href="?pg=detail_customer&CC='.$row[0].'" class="btn btn-xs btn-info"> <i class="fa fa-info-circle"></i> Detail</a>';
								} else {
									$button_pic = '<button type="button" class="btn btn-xs btn-success" data-id="'.$row[0].'"   data-toggle="modal"  data-target="#add_pic"><i class="fa fa-plus"></i> Add PIC</button>';
								}
								
								if ($row[0]!='C0000') {
								echo '
								<tr>
									<td>'.$no.'</td>
									<td>'.$row[1].'</td>
									<td>'.$row[2].'</td>
									<td>'.$row[3].'</td>
									<td>'.$row[4].'</td>
									<td>'.$button_pic.'</td>
								</tr>
								';
								$no++;
								}
							}
						?>
					</tbody>
				</table>
		</div>
		<div class="tab-pane fade" id="tab2">
			<h4>Programs</h4>
			<table class="table table-bordered table-xs" id="tbProgram" style="width: 100%;">
				<thead>
		            <tr>
		                <th>No.</th>
		                <th>Id Program</th>
		                <th>Name</th>
		                <th>Sum of Questions</th>
		                <th>Options</th>
		            </tr>
		        </thead>
				<tbody>
				<?php
					$no = 1;
					$result=showAllProgram();
					while($row = mysqli_fetch_array($result)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row[0].'</td>
							<td>'.$row[1].'</td>
							<td>'.$row[2].'</td>
							<td><a href="?pg=detail_programs&CC='.$row[0].'" class="btn btn-xs btn-info" > <i class="fa fa-info-circle"></i> Detail</a></td>
						</tr>
						';
						$no++;
					}
				?>
			</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="tab3">
			<h4>Voucher</h4>
			<table class="table table-bordered table-xs" id="tbVoucher" style="width: 100%">
				<thead>
			    <tr>
			      <th scope="col">No.</th>
			      <th scope="col">Customer Name</th>
			      <th scope="col">Program</th>
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
				<td>'.$row[3].'</td>
				<td>
				<a href ="?pg=detail_voucher&id='.$row[0].'" > <button type="button" class="btn btn-xs btn-info "><i class="fa fa-info-circle"></i>  Stock Card</button></a> &nbsp
				<button type="button" class="btn btn-xs btn-primary "  data-id="'.$row[0].'" data-toggle="modal" data-target="#topup_voucher"><i class="fa fa-shopping-cart"></i>  Transaksi</button> &nbsp
				</td>					
				</tr>';
				$no++;
				}
				?>
				</tbody>
		</table>
		</div>
		<div class="tab-pane fade" id="tab4">
			<?php include 'view_admin/5_0report.php';?>
			<!-- <h4>Reports</h4> -->
		</div>
		</div>
	</div>
</div><!--/.panel-->
		<!--/.row-->

<!-- Modal Add PIC -->
			<div class="modal fade" id="add_pic" role="dialog">
				<div class="modal-dialog">
		        <!-- Modal content-->
			      <div class="modal-content">
			        
			          	<div class="fetched-data"></div> 
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
<script src='../assets/js/jquery-1.12.0.min.js'></script>
			<script>
			$(document).ready(function() {
				$('#tbVoucher').DataTable();
			} );
			$(document).ready(function() {
				$('#tbCustomer').DataTable();
			} );
			$(document).ready(function() {
				$('#tbProgram').DataTable();
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
			    $('#add_pic').on('show.bs.modal', function (e) {
			        var rowid = $(e.relatedTarget).data('id');
			        $.ajax({
			            type : 'get',
			            url : 'view_admin/1_add_pic.php', //Here you will fetch records 
			            data :  'id='+ rowid, //Pass $id
			            success : function(data){
			            $('.fetched-data').html(data);//Show fetched data from database
			            }
			        });
			     });
			}); 
			</script>		
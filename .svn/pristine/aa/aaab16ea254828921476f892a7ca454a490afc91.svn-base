<?php
$id = $_SESSION["admin_group"];
$data = mysqli_fetch_array(editCustomer($id));
	
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
		<div class="panel-heading">Programs</div>
			<div class="panel-body">
				<table class="table table-bordered table-xs" id="tbVoucher">
					<thead>
		        <tr>
		          <th scope="col">No.</th>
		          <th scope="col">Program</th>
		          <th scope="col">Type</th>
		          <th scope="col">Saldo</th>
		          <th scope="col">Option</th>
	          </tr>
		      </thead>
					<tbody>
					<?php
					$no = 1;
					$result=showVoucher($id);
					while($row = mysqli_fetch_array($result)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row[2].'</td>
							<td>'.$row[4].'</td>
							<td>'.$row[3].'</td>
							<td>
							<a href ="?pg=pic_detail_voucher&id='.$row[0].'" >
								<button type="button" class="btn btn-xs btn-info "><i class="fa fa-table"></i>  Stock Card</button></a>
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
			<script>
			$(document).ready(function() {
				$('#tbVoucher').DataTable();
			} );
			</script>
			
			<script>
			
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
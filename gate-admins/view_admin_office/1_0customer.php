<?php
	if (isset($_POST['cmd'])) {
		switch ($_POST['cmd']) {
			case 'Submit':
			 if ($_POST['duplicate']=='duplicate') {
			  	echo ("	<script LANGUAGE='JavaScript'>
						    window.alert(\"Duplicate Customer Name\");
						</script>");
			  }else{
					$today = date("Ymd");
					$name = $_POST['name'];
					$address = $_POST['address'];
					$phone = $_POST['phone'];
					$email = $_POST['email'];
					$result = $_POST['vires'];
					$type = explode('.',$_FILES['logo']['name']);
					$namaFile = "logo-".$name.$today.".".$type[1];
					$namaSementara = $_FILES['logo']['tmp_name'];
					$dirUpload = "../assets/img/logo/";
					$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

					if ($terupload) {
						addCustomer($name,$address,$phone,$email,$namaFile,$result);
					} else {
						echo "Upload Gagal!";
					}
				}
				break;
			case 'UpdateCustomer':
				$id = $_POST['id'];
				$name = $_POST['name'];
				$address = $_POST['address'];
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				$result = $_POST['vires'];
				if ($_FILES['logo']['name']!=null) {
					$type = explode('.',$_FILES['logo']['name']);
					$namaFile = "logo-".$name.$today.".".$type[1];
					$namaSementara = $_FILES['logo']['tmp_name'];
					$dirUpload = "../assets/img/logo/";
					$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
				} else {
					$namaFile=$_POST['logo_lama'];
				}
				updateCustomer($id,$name,$address,$phone,$email,$namaFile,$result);
				break;
			case 'Delete':
				$id = $_POST['id'];
				deleteCustomer($id);
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

<div class="row">
	<div class="col-lg-12">
		<h4></h4>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Customer</div>
			<div class="panel-body">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_cust" type="button"><i class="fa fa-plus"></i> Add Customer</button><br><br>
				<table class="table table-bordered table-xs" id="tbCustomer">
					<thead>
						<tr>
							<th scope="col">No.</th>
			        <th scope="col">Name</th>
			        <th scope="col">Phone</th>
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
									$button_pic = '<a href="?pg=detail_customer&CC='.$row[0].'" class="btn btn-xs btn-info" style="padding-left: 10px;padding-right: 10px;"> <i class="fa fa-info-circle"></i> Detail</a>';
								} else {
									$button_pic = '<button type="button" class="btn btn-xs btn-success" data-id="'.$row[0].'"   data-toggle="modal"  data-target="#add_pic" ><i class="fa fa-plus"></i> Add PIC</button>';
								}

								if ($row[0]!='C0000') {
								echo '
								<tr>
									<td>'.$no.'</td>
									<td>'.$row[1].'</td>
									<td>'.$row[3].'</td>
									<td>'.$button_pic.'&nbsp&nbsp
									<button type="button" class="btn btn-xs btn-primary "  data-id="'.$row[0].'" data-toggle="modal" data-target="#edit_cust" style="padding-left: 13px;padding-right: 13px;"><i class="fa fa-edit"></i>  Edit</button> &nbsp

								</tr>
								';
								$no++;
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- ADD MODAL -->
			<div class="modal fade" id="add_cust" role="dialog">
		    <div class="modal-dialog">
		    <!-- Modal content-->
			<div class="modal-content">
			    <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Add Customer</h4>
			        </div>
			        <div class="modal-body">
			          <form role="form" id="add_cust" action="" method="POST" enctype="multipart/form-data">
			      <div class="form-group">
							<label>Customer Name</label>
							<span id="opt"></span>
							<input type="hidden" class="form-control" id="duplicate" name="duplicate">
							<input class="form-control" id="cust_name" name="name"  onkeyup="cek()" required="">
						</div>
			      <div class="form-group">
							<label>Address</label>
							<input class="form-control"  name="address" required="">
						</div>
			          	<div class="form-group">
							<label>Phone</label>
							<input class="form-control"  name="phone" required="">
						</div>
			          	<div class="form-group">
							<label>Email</label>
							<input class="form-control"  name="email" required="" >
						</div>
						<div class="form-group">
							<label>View Result</label>
							<select name="vires" id="" class="form-control">
								<option value="0">Not Display</option>
								<option value="1">Display on Admin</option>
								<option value="2">Display for All User</option>
							</select>
						</div>
						<div class="form-group">
									<label>File Logo</label>
									<input type="file" name="logo" required="">
									<p class="help-block">Example block-level help text here.</p>
						</div>

			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
			            <input type="submit" name="cmd" class="btn btn-sm btn-success" value="Submit">
			        </div> </form>
			      </div>
		        </div>
			</div>
		</div>
<!-- Modal Add PIC -->
			<div class="modal fade" id="add_pic" role="dialog">
				<div class="modal-dialog">
		      <!-- Modal content-->
			   	<div class="modal-content">
			    <div class="fetched-data"></div>
			    </div>
		      </div>
			</div>

<!-- modal delete customer -->
			<div class="modal fade" id="delete_cust" role="dialog">
		    <div class="modal-dialog">
		        <!-- Modal content-->
			      <div class="modal-content">
			        <div class="fetched-data"></div>
			      </div>
		        </div>
			</div>
<!-- Modal edit customer -->
			<div class="modal fade" id="edit_cust" role="dialog">
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
				$('#tbCustomer').DataTable({
					"columnDefs":[
		        {"width": "2%", "targets":0},
		        {"width": "18%", "targets":2},
		        {"width": "25%", "targets":3}
		      ]
				});
			} );
			</script>

			<script>
			  $(document).ready(function(){
			    $('#edit_cust').on('show.bs.modal', function (e) {
			        var rowid = $(e.relatedTarget).data('id');
			        $.ajax({
			            type : 'get',
			            url : 'view_admin/1_edit_customer.php', //Here you will fetch records
			            data :  'id='+ rowid, //Pass $id
			            success : function(data){
			            $('.fetched-data').html(data);//Show fetched data from database
			            }
			        });
			     });
			});

			  $(document).ready(function(){
			    $('#delete_cust').on('show.bs.modal', function (e) {
			        var rowid = $(e.relatedTarget).data('id');
			        $.ajax({
			            type : 'get',
			            url : 'view_admin/1_delete_customer.php', //Here you will fetch records
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
		function cek(){
				document.getElementById('opt').innerHTML = '<img style="margin-left:10px; width:10px;" src="../assets/img/loading-2.gif">';
				var cust_name = document.getElementById('cust_name').value;
				//alert(subject_name);
				$.ajax({
					type	:'POST',
					url 	:'view_admin/help-customer.php',
					data	:'cust_name='+cust_name,
					success	:function(data){
						//alert('data');
						if(data > 0){
							var element = document.getElementById("cust_name");
							element.classList.remove("true");
							element.classList.add("wrong");
							document.getElementById('duplicate').value='duplicate';
							document.getElementById('opt').style.color='red';
							document.getElementById('opt').innerHTML='Duplicate Customer Name';
						}else{
							var element = document.getElementById("cust_name");
							element.classList.remove("wrong");
							element.classList.add("true");
							document.getElementById('duplicate').value='';
							document.getElementById('opt').innerHTML='&#x2714';
							document.getElementById('opt').style.color='green';
						}
//						alert(data);
//						$('#pesan').html(data);
					}
				});
			}
			</script>

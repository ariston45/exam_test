<?php
	$id_customer=$_GET['CC'];
	if (isset($_POST['cmd'])) {
		switch ($_POST['cmd']) {
			case 'Submit':
				$name = $_POST['name'];
				$address = $_POST['address'];
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				$dob = $_POST['dob'];
				$pob = $_POST['pob'];
				$pword = $_POST['pword'];
				$pword_c = $_POST['pword_check'];
				$role = $_POST['role'];
				$uname = $_POST['username'];
			if($pword == $pword_c){
				$id_g = $id_customer;
				$new_id = newIdUser($id_g);
				addUsers($name,$address,$phone,$email,$dob,$pob,$pword,$pword_c,$id_g,$new_id,$role,$uname);
			}else{
				echo "<script>window.alert('Your password does not match, please try again.')</script>";
			}
			break;
			case 'Update PIC':  
				$id = $_POST['id'];
				$name = $_POST['name'];
				$address = $_POST['address'];
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				updatePIC($id,$name,$address,$phone,$email);
			break;
			case 'Update':
			$name = $_POST['name'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$dob = $_POST['dob'];
			$pob = $_POST['pob'];
			$pword = $_POST['pword'];
			$pword_c = $_POST['pword_check'];
			$uname = $_POST['username'];
			$id = $_POST['id'];
			if ($role != null) {
				$role = $_POST['role'];
				updateUser_1($id, $name, $dob, $pob, $address, $phone, $email, $role, $uname);
			} else {
				updateUser_2($id, $name, $dob, $pob, $address, $phone, $email, $uname);
			}
			if (isset($pword) OR isset($pword_c)) {
				if ($pword == $pword_c) {
					setPass($id,$pword_c);
				}else{
					echo "<script>window.alert('Your password does not match, please try again.')</script>";
				}
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
		<h1></h1>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Detail Customer <?=$id_customer?>
			</div>
			<div class="panel-body">
				
				<?php
			$result=editCustomer($id_customer);
			$row = mysqli_fetch_array($result);
				echo "	<div class='col-md-6'>
						<a href=\"?pg=admin_customer\" class=\"btn btn-xs btn-danger\" ><i class=\"fa fa-arrow-left\"></i> Back</a>
						<table style=\"height: 100px;margin-top:10px;\">
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Id Customer</td>
							<td style=\" width: 20px;\">:</td>
							<td>".$row[0]."</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Customer Name</td>
							<td >:</td>
							<td>".$row[1]."</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Address</td>
							<td>:</td>
							<td>".$row[2]."</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Phone</td>
							<td>:</td>
							<td>".$row[3]."</td>
						</tr>
						<tr>
							<td style=\" width: 150px;font-weight: 700;\">Email</td>
							<td>:</td>
							<td>".$row[4]."</td>
						</tr>
					   </table>
					  	</div>
					   	<div class='col-md-6' style='text-align:right;'>
							<img style='height:125px;border:1px groove;' src='../assets/img/logo/".$row[5]."'>
						</div>
					";

			
		?>	
			
		<div class="col-md-12">
		<hr style="    border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
			
		<h3>User  <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</button></h3>
		<div class="table-responsive">
			<table class="table table-xs table-bordered" id="tbUser">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Name</th>
				    		<th scope="col">Address</th>
							<th scope="col">Phone</th>
							<th scope="col">Email</th>
							<th scope="col">Role</th>
							<th scope="col">Option</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no = 1;
						$result=cekUser($id_customer);
						while($row = mysqli_fetch_array($result)){
							$option="<button type=\"button\" class=\"btn btn-xs btn-primary\"  data-id='".$row[0]."' data-toggle=\"modal\" data-target=\"#edit_user\"><i class=\"fa fa-edit\"></i>  Edit</button> ";
						
						echo "
						<tr>
							<td>".$no."</td>
							<td>".$row[1]."</td>
							<td>".$row[2]."</td>
							<td>".$row[3]."</td>
							<td>".$row[4]."</td>
							<td>".$row[5]."</td>
							<td>".$option."</td>
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
</div>
</div>
<!-- Modal edit pic -->
			<div id="edit_user" class="modal fade">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
				  	<div class="fetched-data"></div>
				</div>
			</div></div>
<!-- Modal edit pic -->
			<div class="modal fade" id="edit_pic" role="dialog">
		    <div class="modal-dialog">
		        <!-- Modal content-->
			      <div class="modal-content">
			        
			        	<div class="fetched-data"></div>       
			   
		        </div>
			</div>
			</div>
<!-- Modal Add User -->

<div id="add_user" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
	  	<div class="modal-header">
	    	<h4 class="modal-title">Add New User</h4>
	    </div>
	    <div class="modal-body">
				<div class="row">
				<div class="col-md-6">
				<form action="" method="post" autocomplete="off">
					<div class="form-group">
						<label>Name</label>
						<input name="name" type="text" class="form-control" value="" placeholder="name lastname" id="name">
					</div>
					<div class="form-group">
						<label>Place of Birt</label>
						<input name="pob" type="text" class="form-control" value="" placeholder="City">
					</div>
					<div class="form-group">
						<label>Date of Birth</label>
						<div class="controls input-append date form_date"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-date="1980-01-01">
						<input class="form-control" name="dob" placeholder="yyyy-mm-dd" required>
						<span class="add-on"><i class="icon-th"></i></span>
						</div>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input name="address" type="text" class="form-control" value="" placeholder="Jalan no.1">
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input name="phone" type="text" class="form-control" value="" placeholder="+62852xx">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input name="email" type="text" class="form-control" value="" placeholder="example@email.com">
					</div>
					<div class="form-group">
						<label>Select Role</label>
						<select name="role" id="" class="form-control">
							<option value="Exam Administrator">Exam Administrator</option>
							<option value="Student Register">Student Register</option>
							<option value="Proctor">Proctor</option>
						</select>
					</div>
					<div class="form-group">
						<label>Username Login</label>
						<input name="username" type="text" class="form-control" value="" placeholder="username">
					</div>
					<div class="form-group">
						<label>Set Password</label>
						<input name="pword" type="password" class="form-control" value="" placeholder="***">
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input name="pword_check" type="password" class="form-control" value="" placeholder="***">
					</div>
				</div>
				</div>
				</div>	
		  <div class="modal-footer">
		   	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		    <input type="submit" name="cmd" class="btn btn-primary btn-sm" value="Submit">
		  </div>
		</form>
	</div>
</div></div>
<script src='../assets/js/jquery-1.12.0.min.js'></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
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
			    $('#edit_pic').on('show.bs.modal', function (e) {
			        var rowid = $(e.relatedTarget).data('id');
			        $.ajax({
			            type : 'get',
			            url : 'view_admin/1_edit_pic.php', //Here you will fetch records 
			            data :  'id='+ rowid, //Pass $id
			            success : function(data){
			            $('.fetched-data').html(data);//Show fetched data from database
			            }
			        });
			     });
			});
		 $(document).ready(function(){
			$('#edit_user').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
				$.ajax({
					type : 'get',
				  url  : 'view_pic/1_edit_user.php', //Here you will fetch records 
				  data : 'id='+ rowid, //Pass $id
				  success : function(data){
				  	$('.fetched-data').html(data);//Show fetched data from database
				  }
				});
			});
		});
	$(document).ready(function() {
		$('#tbUser').DataTable();
	});
</script>

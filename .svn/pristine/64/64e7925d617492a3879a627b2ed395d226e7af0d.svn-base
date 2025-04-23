<?php //die('ndase');
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_GET['id'];
$rs= editPIC($id);
$result = mysqli_fetch_array($rs);
?>				<div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Edit PIC</h4>
			        </div>
			        <form role="form" id="edit_program" action="" method="POST">
			     <div class="modal-body">
				   			<div class="form-group">
									<label>Id User</label>
									<input class="form-control"  name="id" value="<?=$id?>" readonly>
								</div>
								<div class="form-group">
									<label>Name</label>
									<input class="form-control"  name="name" value="<?=$result[0]?>">
								</div>
								<div class="form-group">
									<label>Address</label>
									<input class="form-control"  name="address" value="<?=$result[1]?>">
								</div>
								<div class="form-group">
									<label>Phone</label>
									<input class="form-control"  name="phone" value="<?=$result[2]?>">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control"  name="email" value="<?=$result[3]?>">
								</div>
			        		</div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        	<input type="submit" name="cmd" class="btn btn-success" value="Update PIC">
			        </div> </form>



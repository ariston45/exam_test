<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_POST['id'];
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Transaksi Voucher</h4>
</div>
<form role="form" action="" method="POST" autocomplete="off">
<div class="modal-body">
		<div class="form-group">
			<label>Voucher ID</label>
			<input class="form-control"  name="id_voucher" value=<?=$id?> readonly>
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
			<label>Top-up</label>
			<input type="number" class="form-control"  name="top-up" required="">
			<input type="hidden" class="form-control"  name="cmd" value="top-up" >
		</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
	<input type="submit" class="btn btn-sm btn-success" value="Submit">
</div> 
</form> 	

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
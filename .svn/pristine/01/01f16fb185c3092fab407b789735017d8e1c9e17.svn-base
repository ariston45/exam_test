<?php
	$id_customer = $_GET['CC'];
?>
<style type="text/css">
	div.scroll {
	   border: 1px ridge;
	   height: 150px;
	   overflow: auto;
	}
</style>
<script type="text/javascript">
	function evalbyVoucher(){
		var group = document.by_voucher.voucher;
		for (var i=0; i<group.length; i++) {
			if (group[i].checked)
			break;
		}
		if (i==group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("by_voucher").submit();
	}
</script>
<div class="row">
	<div class="col-lg-12">
		<h1></h1>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
				<!-- Heading -->
			<div class="panel-heading">Report</div>
			<div class="panel-body">
				<!-- Isi Container -->
			<div class="row">
				<div class="col-lg-12">
					<button class="btn btn-xs btn-danger" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left" ></i> Back</button>
					<form role="form" id="by_voucher" name="by_voucher" action="?pg=admin_showReport" method="POST" autocomplete="off" >
				    	<div class="form-group">
							<label>Periode</label>
							<div class="row">
								<div class="col-md-2">Start Date : </div>
								<div class="col-md-4">
								<div class="controls input-append date form_date1"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
									<input class="form-control" name="date_start"  placeholder="YYYY-MM-DD" required>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
								<div class="col-md-2" >End Date : </div>
								<div class="col-md-4" >
									<div class="controls input-append date form_date2"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
									<input class="form-control" name="date_end"  placeholder="YYYY-MM-DD" required>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Voucher</label>
							<input type="checkbox" id="selectall" onClick="selectAllvoucher(this)">Check All
							<div class="scroll" id="box1" >
							<?php
								$result=showVoucher($id_customer);
								while($row = mysqli_fetch_array($result)){
									if ($row[0]!='C0000') {
									echo "
									<div class=\"checkbox\">
										<label>
										  <input  type=\"checkbox\" id=\"voucher\" name=\"voucher[]\" value=\"$row[0]\">$row[0] - $row[2]
										</label>
									</div>
									";
									}
								}
							?>
							</div>
						</div>
						<input type="hidden" name="cmd" value="voucher_history">
						<div class="form-group" style="text-align: center;">
							<input type="button" class="btn btn-sm btn-primary" name="Submit" value="Submit" onclick="evalbyVoucher()">
							<input type="Reset" class="btn btn-sm btn-warning" name="reset" value="Reset">
						</div>
					  </form>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

<script src='../assets/js/jquery-1.12.0.min.js'></script>

<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
	function selectAllvoucher(source) {
		checkboxes = document.getElementsByName('voucher[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
	function changeBox1(){
	var id = document.getElementById('V_program').value;
	//alert(id);
	  $.ajax({
		type : 'get',
		url  : 'view_admin/help-report.php', //Here you will fetch records 
		data : {id:id,variable:'by_voucher'}, //Pass $id
		success :function(data){
   			//alert(data);
   			document.getElementById('box1').innerHTML=data;
		}
	});
	
}
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
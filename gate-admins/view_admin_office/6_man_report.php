<?php
    $id_customer = $_GET['CC'];
?>
<style>
	div.scroll {
	   border: 1px ridge;
	   height: 150px;
	   overflow: auto;
	}
	div.scroll div{
		margin-left: 10px;
	}
	.menu{
		border-radius: 0px;
		margin-bottom:-4px;
	}
	.actived{
		background-color: #000;
	}

	input[type=radio] {
		display:none;
	}

	input[type=radio] + label {
		display:inline-block;
		margin:-2px;
		padding: 4px 12px;
		margin-bottom: 0;
		font-size: 14px;
		line-height: 20px;
		color: #333;
		text-align: center;
		text-shadow: 0 1px 1px rgba(255,255,255,0.75);
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
		outline: 0;
		-webkit-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
		-moz-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
		box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
			background-color:#8ad919;
	}
	.nav-pills {
    padding: 0px;
    padding-bottom: 0;
	}
	.nav-pills>li.active>a, .nav-pills>li.active>a:focus{
	    border-bottom: 0px;
	}
	.nav > li > a:hover, .nav > li > a:focus, .nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
    text-decoration: none;
    background-color:  rgb(255, 255, 255);
    background: #134469;;
	}
	.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
		border: 0px;
	    background: #134469;
	    color: #fff;
	}
	.nav-pills>li {
	    margin: 1px;
	}
	.nav-pills>li>a {
    border-radius: 1px;
	}
	.checkbox>label>input[type=radio]{
		display: -webkit-inline-box;
		margin-left: -15px;
    margin-right: 5px;
	}
</style>
<script type="text/javascript">
	function evalbyExam(){
		var group = document.by_exam.exam;
		for (var i=0; i<group.length; i++) {
			if (group[i].checked)
			break;
		}
		if (i==group.length)
			return alert("No Checkbox is checked");
		else
			document.getElementById("by_exam").submit();
	}
</script>
<div class="row" >
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
		              <form role="form" id="by_exam" name="by_exam" action="?pg=admin_showReport" method="POST" autocomplete="off" >
						<div class="form-group">
							<label>Judul</label>
							<input class="form-control" type="text" id="judul" name="judul"  required="">
						</div>
				    	<div class="form-group">
				    		
							<label>Periode</label>
							<div class="row">
								<div class="col-md-2">Start Date : </div>
								<div class="col-md-4">
								<div class="controls input-append date form_date1"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
									<input class="form-control" name="date_start" id="date_start"  placeholder="YYYY-MM-DD" required>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
									</div>
									<input type="hidden" id="dtp_input1" value="" required="" /></div>
								<div class="col-md-2" >End Date : </div>
								<div class="col-md-4" >
									<div class="controls input-append date form_date2"  data-date-format="yyyy-mm-dd" data-link-field="dtp_input1">
									<input class="form-control" name="date_end" id="date_end"  placeholder="YYYY-MM-DD" required>
									<span class="add-on"><i class="icon-remove"></i></span>
									<span class="add-on"><i class="icon-th"></i></span>
									</div>
									<input type="hidden" id="dtp_input1" value="" required="" /></div>
							</div>
						</div>
						<input type="hidden" id="E_program" name="program2" value="<?=$id_customer?>">
						<div class="form-group">
							<label>Exam</label>
							<input type="checkbox" id="selectall" onClick="selectAllexam(this)">Check All
							<div class="scroll" id="box2" >

							</div>
						</div>
						<?php
						if ($id_customer == 'C0061') {
							echo '<input type="hidden" name="cmd" value="exam_ub">';
						}else{
							echo '<input type="hidden" name="cmd" value="exam">';
						}
						?>
						<div class="form-group" style="text-align: center;">
							<input type="button" class="btn btn-sm btn-primary" name="Submit" value="Submit" onclick="evalbyExam()">
							<input type="Reset" class="btn btn-sm btn-warning" name="reset" value="Cancel">
						</div>
					  </form>
		            </div>

		</div>
	</div>
</div>
</div>
  <script src='../assets/js/jquery-1.12.0.min.js'></script>

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

 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 function selectAllcust(source) {
		checkboxes = document.getElementsByName('customer[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
function selectAllvoucher(source) {
		checkboxes = document.getElementsByName('voucher[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
function selectAllexam(source) {
		checkboxes = document.getElementsByName('exam[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
function selectAllprogram(source) {
		checkboxes = document.getElementsByName('program[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
	}
</script>
<script>
// Add active class to the current button (highlight it)

$(document).ready(function(){
	var id = document.getElementById('E_program').value;
	var start = document.getElementById('date_start').value;
	var end = document.getElementById('date_end').value;
	//alert(id);
	  $.ajax({
		type : 'get',
		url  : 'view_admin/help-report.php', //Here you will fetch records
		data : {id:id,variable:'by_exam',start:start,end:end}, //Pass $id
		success :function(data){
   			//alert(data);
   			document.getElementById('box2').innerHTML=data;
		}
	});
});
function changeBox2(id){
	var id = document.getElementById('E_program').value;
	var start = document.getElementById('date_start').value;
	var end = document.getElementById('date_end').value;
	//alert(id);
	  $.ajax({
		type : 'get',
		url  : 'view_admin/help-report.php', //Here you will fetch records
		data : {id:id,variable:'by_exam',start:start,end:end}, //Pass $id
		success :function(data){
   			//alert(data);
   			document.getElementById('box2').innerHTML=data;
		}
	});

}
</script>


		<!--/.row-->

<?php
if (isset($_GET['CC'])) {
	$id_s = $_GET['CC'];	
}
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Release':
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
		<div class="panel panel-default">
			<div class="panel-heading"><a href="?pg=pic_exam" class="btn btn-xs btn-danger"><i class="fa fa-arrow-left"></i> Back</a> &nbspSchedule</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-info-costum">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-3">
										<b>Token</b>
									</div>
									<div class="col-md-3">
										: <?= $dat[1] ?>
									</div>
									<div class="col-md-3">
										<b>Alocate</b>
									</div>
									<div class="col-md-3">
										: <?= $dat[2] ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<b>Program</b>
									</div>
									<div class="col-md-3">
										: <?= $dat[3] ?>
									</div>
									<div class="col-md-3">
										<b>Started</b>
									</div>
									<div class="col-md-3">
										: <span id="data_in"></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<b>Proctor</b>
									</div>
									<div class="col-md-3">
										: <?= $dat[4] ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
        <!-- <button type="button" class="btn btn-outline btn-info btn-sm" data-toggle="modal" data-target="#addclass">Generate Token</button><br><br> -->
        <span id="output"></span>
				<?php
        // $result=showStueExam($id);
        //  echo $result;
			?>
			</div>
		</div>
	</div>
</div>
<!--======================-->
<script src='../assets/js/jquery-1.8.3.min.js'></script>
<script>
	$(document).ready(function(){
		var id = "<?php echo ($dat[0]) ?>";
		function data() {
      $.ajax({
        type : 'GET',
        url  : 'view_pic/3_pic_datastarted.php', //Here you will fetch records 
        data : {id:id},   //Pass $id
        success : function(data){
          document.getElementById("data_in").innerHTML=data;
        }
      });
    }
		data();
    setInterval(function() {
      data(); 
    },5000);
	});
</script>
<script>
	$(document).ready(function(){
		var idg = "<?php echo ($dat[0]) ?>";
		function datapar() {
      $.ajax({
        type : 'GET',
        url  : 'view_pic/3_pic_dataparticipant.php', //Here you will fetch records 
        data : {id:idg},   //Pass $id
        success : function(data){
          $('#output').html(data);
        }
      });
    }
		datapar();
    setInterval(function() {
      datapar(); 
    },50000);
	});
</script>
<script>
	$(document).ready(function() {
		$('#tbStudents').DataTable({});
	});
	function release($id){
		var r = confirm('Apakah anda akan menghapus login NIM : '+$id);
		if (r == true) {
		   	$.ajax({
		        type : 'GET',
		        url  : 'view_pic/help-student-action.php', //Here you will fetch records 
		        data : {cmd:'release',id:$id},   //Pass $id
		        success : function(data){
		        	alert('Berhasil merelease user '+$id+'\nUser bisa login ulang untuk melanjutkan ujian');
		        }
		      });
		} 
	}
	// function restart($id){
	// 	var r = confirm('Apakah anda akan merestart sesi ujian NIM : '+$id);
	// 	if (r == true) {
	// 	   	$.ajax({
	// 	        type : 'GET',
	// 	        url  : 'view_pic/help-student-action.php?cmd=restart', //Here you will fetch records 
	// 	        data : {cmd:'restart',id:$id},   //Pass $id
	// 	        success : function(data){
	// 	        	alert(data);
	// 	        }
	// 	      });
	// 	} 
	// }
</script>

<!--/.row-->
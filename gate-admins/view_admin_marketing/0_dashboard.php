<?php
// header('location:view_pic/pic_dashboard.php?pg=pic_dashboard');
print_r("Dashboard Not Ready");
if (isset($_POST['cmd'])) {
	switch ($_POST['cmd']) {
		case 'Search':
			$a = $_POST['q'];
			header('location:https://www.google.com/search?q='.$a.'');
			break;
		default:
			# code...
			break;
	}
}
?>
<div class="row">
	<div class="col-lg-12">
		<h4>Dashboard</h4>
	</div>
	<div class="col-md-12">
		<div class="panel panel-blue">
			<!-- <div class="panel-heading dark-overlay">Blue Panel</div> -->
			<div class="panel-body">
				<form class="" method="post" action="">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Find students with NIM or Name </span>
									<input type="text" name="q" class="form-control input-sm" placeholder="nim or name" aria-describedby="basic-addon1" style="max-width: 250px;">
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<button onclick="tum()" type="submit" name="cmdx" value="Search" class="btn btn-warning"><i class="fa fa-search"></i> Search </button>
						</div>
					</div>
      	</form>
			</div>
		</div>
	</div>
</div>
<!--  -->
<div class="row">	
	<div class="col-md-12" id="sum">
		<div class="panel panel-warning">
			<div class="panel-heading">Schedules</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div>
</div>
<!--  -->
<!-- 1 -->
<!-- 2 -->

<script>
function tum() {
var x = document.getElementById("sum");
if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>


				


		<!--/.row-->
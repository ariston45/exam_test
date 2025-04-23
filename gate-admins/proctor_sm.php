<ul class="nav menu">
	<li <?php if (!isset($_GET['pg']) or $_GET['pg'] == 'proc_dashboard' or $_GET['pg'] == 'proc_sch_detail_a') {
    echo 'class="active"';
} ?>>
		<a href="?pg=proc_dashboard"><em class="fa fa-dashboard">&nbsp;</em> Active Schedule</a>
	</li>
	<?php 
  //dirumah
	$rs_config = cek_athome_config($_SESSION['admin_group']);
  if ($rs_config[1]==1) { ?>
				<li <?php if (isset($_GET['pg']) and $_GET['pg'] == 'home_proc_exam' or $_GET['pg'] == 'home_proc_sch_detail_a') {
    echo 'class="active"';
} ?>>
		<a href="?pg=home_proc_exam"><em class="fa fa-calendar-o">&nbsp;</em> Home Active Schedules</a>
	</li>
			<?php } ?>
	<li <?php if (isset($_GET['pg']) and $_GET['pg'] == 'proc_exam' or $_GET['pg'] == 'proc_sch_detail') {
    echo 'class="active"';
} ?>>
		<a href="?pg=proc_exam"><em class="fa fa-clock-o">&nbsp;</em> All Exam Schedules</a>
	</li>
	<!-- <li <?php# if (isset($_GET['pg']) and $_GET['pg'] == 'proc_report') {echo 'class="active"';} ?>>
		<a href="?pg=proc_report"><em class="fa fa-file-text-o">&nbsp;</em> Report</a>
	</li> -->
	<!-- <li><a href="logout.php"><em class="fa fa-toggle-off">&nbsp;</em>Logout</a></li> -->
	
</ul>

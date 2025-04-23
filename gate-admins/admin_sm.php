		<?php
			$sql = "SELECT a.notif FROM exam_schedule a INNER JOIN exam_group b on a.exam_group=b.exam_code where a.status = 'finish' AND a.notif =0 AND SUBSTRING_INDEX(SUBSTRING_INDEX(b.group_name,'.',2),'.',-1) != 'P0005'";
    	$res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']));
    	if (mysqli_num_rows($res)>0) {
    		$flag = '<l class="notif"> New ! </l>';
    	}

		?>
		<ul class="nav menu">
			<li <?php 
				if (!isset($_GET['pg']) or 
					$_GET['pg']=='admin_dashboard') 
				{echo 'class="active"';}?> >
				<a href="?pg=admin_dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='users') 
				{echo 'class="active"';}?>>
				<a href="?pg=users"><em class="fa fa-user-circle-o">&nbsp;</em> Users Admin</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='admin_customer'or 
					$_GET['pg']=='detail_customer'or 
					$_GET['pg']=='create_exam'or 
					$_GET['pg']=='exam_edit'or 
					$_GET['pg']=='add_student'or 
					$_GET['pg']=='create_exam_schedule'or
					$_GET['pg']=='pic_student_det') 
				{echo 'class="active"';}?>>
				<a href="?pg=admin_customer"><em class="fa fa-users">&nbsp;</em> Customer</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and 
					$_GET['pg']=='admin_man_cust'or
					$_GET['pg']=='man_voucher'or
					$_GET['pg']=='man_report'or
					$_GET['pg']=='man_activity'or 
					$_GET['pg']=='approve_remidial'or 
					$_GET['pg']=='detail_exam'or 
					$_GET['pg']=='detail_voucher') 
				{	echo 'class="active"';}?>>
				<a href="?pg=admin_man_cust"><em class="fa fa-clone ">&nbsp;</em> Manage Customer</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='schedule'or 
					$_GET['pg']=='schedule_detail' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=schedule"><em class="fa fa-calendar-o">&nbsp; </em> Exam Schedule</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='home_schedule'or 
					$_GET['pg']=='home_schedule_detail' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=home_schedule"><em class="fa fa-calendar-check-o ">&nbsp; </em>Home Exam Schedule</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='admin_program' or 
					$_GET['pg']=='detail_programs') 
				{	echo 'class="active"';}?>>
				<a href="?pg=admin_program"><em class="fa fa-tasks">&nbsp;</em> Program</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='admin_soal'or
					$_GET['pg']=='import_soal' or
					$_GET['pg']=='view_question' or
					$_GET['pg']=='add_question' ) 
				{echo 'class="active"';}?>>
				<a href="?pg=admin_soal"><em class="fa fa-toggle-off">&nbsp;</em>Question Bank </a>
			</li>
			
			<!-- <li <?php if (isset($_GET['pg'])and $_GET['pg']=='admin_voucher'or$_GET['pg']=='detail_voucher') {	echo 'class="active"';}?>>
				<a href="?pg=admin_voucher"><em class="fa fa-archive">&nbsp;</em>Voucher Manager</a>
			</li> -->
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='admin_report' or 
					$_GET['pg']=='admin_showReport' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=admin_report"><em class="fa fa-flag-o">&nbsp; </em> Report</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='exam_status' or 
					$_GET['pg']=='exam_status_detail' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=exam_status"><em class="fa fa-list-ul">&nbsp; </em> Exam Report <?=$flag?></a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='approve'or 
					$_GET['pg']=='remidial' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=approve"><em class="fa fa-retweet">&nbsp; </em>Approve Re-Registrasi</a>
			</li>
			<!-- 
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li> -->
		</ul>
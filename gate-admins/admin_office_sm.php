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
					$_GET['pg']=='admin_customer'or 
					$_GET['pg']=='detail_customer') 
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
					$_GET['pg']=='admin_report' or 
					$_GET['pg']=='admin_showReport' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=admin_report"><em class="fa fa-flag-o">&nbsp; </em> Report </a>
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
				<a href="?pg=approve"><em class="fa fa-retweet">&nbsp; </em> Approve Re-Registrasi</a>
			</li>
		</ul>
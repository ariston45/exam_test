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
					$_GET['pg']=='admin_customer'or 
					$_GET['pg']=='detail_customer') 
				{echo 'class="active"';}?>>
				<a href="?pg=admin_customer"><em class="fa fa-users">&nbsp;</em> Customer</a>
			</li>
			<li <?php 
				if (isset($_GET['pg']) and
					$_GET['pg']=='customer'or 
					$_GET['pg']=='customer_stock'or 
					$_GET['pg']=='customer_detail'or 
					$_GET['pg']=='customer_program') 
				{echo 'class="active"';}?>>
				<a href="?pg=customer"><em class="fa fa-users">&nbsp;</em> Manage Customer</a>
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
					$_GET['pg']=='admin_soal'or
					$_GET['pg']=='import_soal' or
					$_GET['pg']=='view_question' or
					$_GET['pg']=='add_question' ) 
				{echo 'class="active"';}?>>
				<a href="?pg=admin_soal"><em class="fa fa-toggle-off">&nbsp;</em> Question Bank</a>
			</li>
			<!-- <li <?php 
				//if (isset($_GET['pg'])and
				//	$_GET['pg']=='admin_report' or 
				//	$_GET['pg']=='admin_showReport' ) 
				//{	echo 'class="active"';}?>>
				<a href="?pg=admin_report"><em class="fa fa-flag-o">&nbsp; </em> Report</a>
			</li> -->
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='exam_status' or 
					$_GET['pg']=='exam_status_detail' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=exam_status"><em class="fa fa-list-ul">&nbsp; </em> Exam Report <?=$flag?></a>
			</li>
		</ul>
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
					$_GET['pg']=='customer'or 
					$_GET['pg']=='customer_stock'or 
					$_GET['pg']=='customer_detail'or 
					$_GET['pg']=='customer_program') 
				{echo 'class="active"';}?>>
				<a href="?pg=customer"><em class="fa fa-users">&nbsp;</em> Customer</a>
			</li>
			
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='exam_status' or 
					$_GET['pg']=='exam_status_detail' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=exam_status"><em class="fa fa-list-ul">&nbsp; </em> New Report <?=$flag?> </a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='exam_progress' or 
					$_GET['pg']=='exam_status_detail' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=exam_progress"><em class="fa fa-hourglass-half">&nbsp; </em> In Progress Report  </a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='exam_rptfinish' or 
					$_GET['pg']=='exam_status_detail' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=exam_rptfinish"><em class="fa fa-check-square">&nbsp; </em> Finish Report  </a>
			</li>
		</ul>
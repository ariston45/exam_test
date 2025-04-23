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
					$_GET['pg']=='detail_voucher') 
				{	echo 'class="active"';}?>>
				<a href="?pg=admin_man_cust"><em class="fa fa-clone ">&nbsp;</em> Manage Customer</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='admin_report' or 
					$_GET['pg']=='admin_showReport' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=admin_report"><em class="fa fa-flag-o">&nbsp; </em> Report</a>
			</li>
		</ul>
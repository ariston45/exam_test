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
					$_GET['pg']=='admin_soal'or
					$_GET['pg']=='import_soal' or
					$_GET['pg']=='view_question' or
					$_GET['pg']=='add_question' ) 
				{echo 'class="active"';}?>>
				<a href="?pg=admin_soal"><em class="fa fa-toggle-off">&nbsp;</em> Bank Soal</a>
			</li>
			<li <?php 
				if (isset($_GET['pg'])and
					$_GET['pg']=='admin_report' or 
					$_GET['pg']=='admin_showReport' ) 
				{	echo 'class="active"';}?>>
				<a href="?pg=admin_report"><em class="fa fa-flag-o">&nbsp; </em> Report</a>
			</li>
		</ul>
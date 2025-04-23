		<ul class="nav menu">
			<li <?php if (!isset($_GET['pg'])or$_GET['pg']=='ExA_dashboard'or$_GET['pg']== 'ExA_detail_voucher') {	echo 'class="active"';}?> >
				<a href="?pg=ExA_dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li <?php if (isset($_GET['pg']) 
				AND $_GET['pg'] == 'ExA_create' 
				OR $_GET['pg'] == 'pic_create_exam'
				OR $_GET['pg'] == 'ExA_exam_create'
				OR $_GET['pg'] == 'ExA_exam_schedule'
				OR $_GET['pg'] == 'ExA_exam_result' 
				OR $_GET['pg'] == 'ExA_result_detail' 
				OR $_GET['pg'] == 'ExA_sch_detail') {echo 'class="active"';} ?>>
				<a data-toggle="collapse" href="#sub-item-2">
					<em class="fa fa-navicon">&nbsp;</em> Exam 
					<span data-toggle="collapse" class="icon pull-right">
						<em class="fa fa-plus" style="padding-top: 6px;"></em>
					</span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li <?php if (isset($_GET['pg']) AND $_GET['pg'] == 'pic_exam') {echo 'class="active"';} ?>>
					<a class="" href="?pg=ExA_exam_create">
						<span class="fa fa-book">&nbsp;</span> Create Exam
					</a></li>
					<li><a class="" href="?pg=ExA_exam_schedule">
						<span class="fa fa-calendar">&nbsp;</span> Exam Schedule
					</a></li>
					<li><a class="" href="?pg=ExA_exam_result">
						<span class="fa fa-list-ol">&nbsp;</span> Exam Result
					</a></li>
				</ul>
			</li>
			<!-- <li <?php if (isset($_GET['pg'])and$_GET['pg']=='ExA_exam'or$_GET['pg']=='ExA_create' or $_GET['pg']=='ExA_sch_detail'or$_GET['pg']=='ExA_detail_voucher' ) {	echo 'class="active"';}?>>
				<a href="?pg=ExA_exam"><em class="fa fa-book">&nbsp;</em> Exam</a></li> -->
			<li <?php if (isset($_GET['pg']) AND $_GET['pg']=='ExA_student' OR $_GET['pg'] == 'ExA_student_det') {	echo 'class="active"';}?>>
				<a href="?pg=ExA_student"><em class="fa fa-users">&nbsp;</em> Student</a></li>
			<li <?php if (isset($_GET['pg']) AND $_GET['pg']=='ExA_report') {	echo 'class="active"';}?>>
				<a href="?pg=ExA_report"><em class="fa fa-file-text-o">&nbsp;</em> Report</a></li>
		</ul>
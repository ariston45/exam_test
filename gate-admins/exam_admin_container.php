<?php
	switch ($_GET['pg']) {
		case 'ExA_dashboard':
			include 'view_exam_admin/0_dashboard.php';
			break;
		case 'ExA_exam':
			include 'view_exam_admin/1_exam_exam.php';
			break;	
		case 'ExA_create':
			include 'view_exam_admin/1_exam_create.php';
			break;
		case 'ExA_exam_create':
			include 'view_exam_admin/1_exam_created.php';
			break;
		case 'ExA_exam_schedule':
			include 'view_exam_admin/1_exam_schedule.php';
			break;
		case 'ExA_exam_result':
			include 'view_exam_admin/1_exam_result.php';
			break;
		case 'ExA_sch_detail':
			include 'view_exam_admin/1_exam_sch_detail.php';
			break;
		case 'ExA_sch_edit':
			include 'view_exam_admin/1_exam_schedule_edit.php';
			break;
		case 'ExA_result_detail':
			include 'view_exam_admin/1_exam_result_detail.php';
			break;
		case 'ExA_student':
			include 'view_exam_admin/2_exam_student.php';
			break;
		case 'ExA_student_det':
			include 'view_exam_admin/2_exam_student_det.php';
			break;
		case 'ExA_sch_detail':
			include 'view_exam_admin/3_pic_sch_detail.php';
			break;
		case 'ExA_detail_voucher':
			include 'view_exam_admin/6_exam_voucher_his.php';
			break;
		case 'ExA_report':
			include 'view_exam_admin/4_exam_report.php';
			break;

		case 'st_home_schedule':
			include 'view_exam_admin/7_exam_exam_schedule.php';
			break;
		case 'st_home_create_exam':
			include 'view_exam_admin/7_exam_create_exam.php';
			break;
		case 'st_home_exam_edit':
			include 'view_exam_admin/7_exam_exam_edit.php';
			break;
		case 'st_home_sch_detail':
			include 'view_exam_admin/7_exam_sch_detail.php';
			break;
		case 'st_home_result_detail':
			include 'view_exam_admin/7_exam_result_detail.php';
			break;
		case 'st_home_exam_result':
			include 'view_exam_admin/7_exam_exam_result.php';
			break;
		case 'st_home_create':
			include 'view_exam_admin/7_exam_exam_create.php';
			break;
		default:
			include 'view_exam_admin/0_dashboard.php';
			break;
	}
?>
<?php
	switch ($_GET['pg']) {
		case 'admin_dashboard':
			include 'view_admin_office/0_dashboard.php';
			break;
		case 'admin_customer':
			include 'view_admin_office/1_0customer.php';
			break;
		case 'detail_customer':
			include 'view_admin_office/1_detail_customer.php';
			break;
		case 'admin_voucher':
			include 'view_admin_office/4_0voucher.php';
			break;
		case 'detail_voucher':
			include 'view_admin_office/4_detail_voucher.php';
			break;
		case 'detail_exam':
			include 'view_admin_office/4_detail_history_V.php';
			break;
		case 'admin_showReport':
			include 'view_admin_office/5_1show_report.php';
			break;	
		case 'admin_man_cust':
			include 'view_admin_office/6_0customer.php';
			break;	
		case 'man_voucher':
			include 'view_admin_office/6_1man_voucher.php';
			break;
		case 'approve_remidial':
			include 'view_admin_office/6_2man_user_remidial.php';
			break;	
		case 'admin_report':
			//include '../assets/error-404/index.html';
			//include 'view_admin_office/5_man_report.php';
			include 'view_admin_office/5_0report.php';
			break;	
		case 'man_report':
			//include '../assets/error-404/index.html';
			include 'view_admin_office/6_man_report.php';
			break;	
		case 'approve_remidial':
			include 'view_admin/6_2man_user_remidial.php';
			break;
		case 'approve':
			include 'view_admin/9_approve_user_remidial.php';
			break;
		case 'exam_status':
			//include '../assets/error-404/index.html';
			include 'view_admin_office/8_schedule_status.php';
			break;
		case 'exam_status_detail':
			include 'view_admin_office/8_schedule_status_detail.php';
			break;
		case 'admin_adminTopUp':
			include 'view_admin/4_topup_voucher.php';
			break;

		default:
			include 'view_admin_office/0_dashboard.php';
			break;
	}
?>
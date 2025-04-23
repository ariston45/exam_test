<?php
	switch ($_GET['pg']) {
		case 'customer':
			include 'view_admin_marketing/1_customer.php';
			break;	
		case 'customer_detail':
			include 'view_admin_marketing/1_detail_customer.php';
			break;	
		case 'customer_stock':
			//include '../assets/error-404/index.html';
			include 'view_admin_marketing/1_detail_voucher.php';
			break;	
		case 'customer_stock_detail':
			include 'view_admin_marketing/1_detail_history_V.php';
			break;
		case 'customer_program':
			include 'view_admin_marketing/1_man_voucher.php';
			break;
		case 'exam_status':
			//include '../assets/error-404/index.html';
			include 'view_admin_marketing/8_schedule_status.php';
			break;
		case 'exam_rptfinish':
			//include '../assets/error-404/index.html';
			include 'view_admin_marketing/8_schedule_exam_rptfinish.php';
			break;
		case 'exam_progress':
			//include '../assets/error-404/index.html';
			include 'view_admin_marketing/8_schedule_exam_progress.php';
			break;
		case 'exam_status_detail':
			include 'view_admin_marketing/8_schedule_status_detail.php';
			break;

		case 'report':
//			include 'view_admin/7_user.php';
			break;
		default:
			include 'view_admin_marketing/1_customer.php';
			break;
	}
?>
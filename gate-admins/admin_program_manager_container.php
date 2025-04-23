<?php
	switch ($_GET['pg']) {
		case 'admin_dashboard':
			include 'view_admin_program_manager/0_dashboard.php';
			break;
		case 'admin_customer':
			include 'view_admin_program_manager/1_0customer.php';
			break;
		case 'detail_customer':
			include 'view_admin_program_manager/1_detail_customer.php';
			break;
		case 'admin_program':
			include 'view_admin_program_manager/2_0program.php';
			break;
		case 'detail_programs':
			include 'view_admin_program_manager/2_detail_programs.php';
			break;
		case 'admin_soal':
			include 'view_admin_program_manager/3_0soal.php';
			break;
		case 'view_question':
			include 'view_admin_program_manager/3_view_question.php';
			break;
		case 'add_question':
			include 'view_admin_program_manager/3_add_question.php';
			break;	
		case 'import_soal':
			include 'view_admin_program_manager/3_import_soal_xls.php';
			break;
		case 'admin_voucher':
			include 'view_admin_program_manager/4_0voucher.php';
			break;
		case 'detail_voucher':
			include 'view_admin_program_manager/4_detail_voucher.php';
			break;
		case 'admin_report':
			include 'view_admin_program_manager/5_0report.php';
			break;
		case 'admin_showReport':
			include 'view_admin_program_manager/5_1show_report.php';
			break;	
		case 'admin_man_cust':
			include 'view_admin_program_manager/6_0customer.php';
			break;	
		case 'man_voucher':
			include 'view_admin_program_manager/6_1man_voucher.php';
			break;	
		case 'man_report':
			//include '../assets/error-404/index.html';
			include 'view_admin_program_manager/6_man_report.php';
			break;	
		case 'man_activity':
			include '../assets/error-404/index.html';
			//include 'view_admin_program_manager/6_0customer.php';
			break;
		case 'users':
			include 'view_admin_program_manager/7_user.php';
			break;
		case 'auto':
			include 'view_admin_program_manager/help-export.php';
			break;
		default:
			include 'view_admin_program_manager/1_0customer.php';
			break;
	}
?>
<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();

switch ($_GET['variable']) {
	case 'by_voucher':
		$id = $_GET['id'];
		$result=showVoucher($id,'');
			while($row = mysqli_fetch_array($result)){
				if ($row[0]!='C0000') {
				echo "
					<div class=\"checkbox\">
					<label>
					<input  type=\"checkbox\" id=\"voucher\" name=\"voucher[]\" value=\"$row[0]\">$row[1] - $row[2]
					</label>
					</div>
				";
			}
		}
		break;
	case 'report_history':
		$id = $_GET['id'];
		$result=showHistoryReport($id);
			echo '<table class="table table-striped">';
			echo "<tr>
							<th>No </th>
							<th>Date / Time</th>
							<th>Status </th>
						</tr>
					 ";
			$no=1;
			while($row = mysqli_fetch_array($result)){
			$tanggal = explode(' ', $row[2]);
			echo "<tr>
							<td>$no </td>
							<td>".tanggal_indo($tanggal[0])." / ".$tanggal[1]."</td>
							<td>".$row[1]."</td>
						</tr>
					 ";
					 $no++;
			}
			echo "</table>";
		break;
	case 'by_exam':
		$id = $_GET['id'];
		$start = $_GET['start'];
		$end = $_GET['end'];
		if ($id=='null') {
			$sql = " SELECT a.id_schedule,b.group_name,a.date,c.cust_name,d.program_name FROM exam_schedule a INNER JOIN exam_group b on a.exam_group=b.exam_code 	INNER JOIN customer c on SUBSTRING_INDEX(a.proctor,'.',1) =c.id_customer inner join programs d on SUBSTRING_INDEX(SUBSTRING_INDEX(group_name,'.',2),'.',-1) = d.id_program where a.date>='$start' and a.date<='$end' ORDER BY a.id_schedule DESC";
		}else {
			$sql = "SELECT a.id_schedule,b.group_name,a.date,c.cust_name,d.program_name FROM exam_schedule a INNER JOIN exam_group b on a.exam_group=b.exam_code 	INNER JOIN customer c on SUBSTRING_INDEX(a.proctor,'.',1) =c.id_customer inner join programs d on SUBSTRING_INDEX(SUBSTRING_INDEX(group_name,'.',2),'.',-1) = d.id_program  where c.id_customer ='$id' AND a.date>='$start' and a.date<='$end' ORDER BY a.id_schedule DESC";
		}
		$result = editExamVoucher($id );
			while($row = mysqli_fetch_array($result)){
				if ($row[0]!='C0000') {
				echo "
					<div class=\"checkbox\">
					<label>
					<input  type=\"radio\" id=\"exam\" name=exam[] value=\"$row[0]\">$row[2]
					</label>
					</div>
				";
			}
		}
		break;
	
	default:
		# code...
		break;
}
	
?>
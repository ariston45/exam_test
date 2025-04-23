<style type="text/css">
	#tbl th {
		background-color: #1769aa;
		color: #fff;
	}

	table,
	td,
	th {
		border: 1px solid #565656;
		text-align: center;
		font-size: 12px;
	}

	table {
		border-collapse: collapse;
		width: 100%;
	}

	th,
	td {
		padding: 2px;
	}
</style>
<?php
function dataSchedule($idG)
{
	$sql1 = 'SELECT a.date, a.start_time from exam_schedule a inner join exam_group b on a.exam_group = b.exam_code where b.group_name = "' . $idG . '"';
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	$dataSchedule = mysqli_fetch_array($res1);
	return $dataSchedule;
}
function CoviddataSchedule($idG)
{
	$sql1 = 'SELECT a.date, a.start_time from covid_exam_schedule a inner join exam_group b on a.exam_group = b.exam_code where b.group_name = "' . $idG . '"';
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	$dataSchedule = mysqli_fetch_array($res1);
	return $dataSchedule;
}
function dataVoucher($start, $end, $idV)
{
	$sql1 = "SELECT b.exam_code,b.group_name from exam_schedule a inner join exam_group b on a.exam_group=b.exam_code where a.date >= '" . $start . "' and a.date <= '" . $end . "' and b.id_voucher = '$idV'";
	//echo $sql1;
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	//$dataVoucher = mysqli_fetch_array($res1);
	return $res1;
}
function CoviddataVoucher($start, $end, $idV)
{
	$sql1 = "SELECT b.exam_code,b.group_name from covid_exam_schedule a inner join exam_group b on a.exam_group=b.exam_code where a.date >= '" . $start . "' and a.date <= '" . $end . "' and b.id_voucher = '$idV'";
	//echo $sql1;
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	//$dataVoucher = mysqli_fetch_array($res1);
	return $res1;
}
function dataCustomer($idC)
{
	$sql1 = "SELECT * from customer where id_customer = '$idC'";
	//echo $sql1;
	$res1 = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql1);
	$dataCustomer = mysqli_fetch_array($res1);
	return $dataCustomer;
}
function setLulus($prog)
{
	$sql = "SELECT a.pass_grade,a.sum_question FROM programs a WHERE a.id_program='$prog'";
	$res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
	$r = mysqli_fetch_array($res);
	$dat = array($r[0], $r[1]);
	return $dat;
}

function setNilai($idg, $ids)
{
	$sql = "SELECT  sum(percentage_true),(sum(a.percentage_true)+sum(a.percentage_false)+sum(a.percentage_null)) total, subject_group FROM exam_percentage a 
	inner join subject_ls b on a.id_subject = b.id_subject
	WHERE a.id_student = '$ids' AND a.exam_code='$idg' group by b.subject_group";
	$res = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']) . '<br>' . $sql);
	return $res;
}
if (isset($_POST['cmd'])) {
	if (isset($_POST['athome'])) {
		/** Home Exam */
		switch ($_POST['cmd']) {
			case 'exam_ub':
				/** UB Setup */
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$exam = $_POST['exam'];
				if (isset($_POST['desc'])) {
					$exam = json_decode($exam, true);
					$id_report = $_POST['id_report'];
					$gelombang = $_POST['desc'];
				} else {
					$gelombang = $_POST['judul'];
				}
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				$field = array();
				$no_1 = 1;
				$no_2 = 1;
				foreach ($exam as $key => $value) {
					$dataVoucher = CoviddataVoucher($start, $end, $value);
					$no = 1;
					$sesi = 0;
					$n_lulus = 1;
					$n_gagal = 1;
					while ($rows = mysqli_fetch_array($dataVoucher)) {
						$exIdGroup		= explode('.', $rows[1]);
						$id_program 	= $exIdGroup[1];
						$dataSchedule = CoviddataSchedule($value);
						$tanggal_indo = tanggal_indo($dataSchedule[0]);
						$result 			= admRpt_Exam($start, $end, $rows[0]);
						// $n 						= subjectls($id_program);
						$dataCustomer = dataCustomer($exIdGroup[0]);
						if (mysqli_num_rows($result) != 0) {
							$sesi++;
						}
						while ($row = mysqli_fetch_row($result)) {
							$nNilai = setNilai($row[3], $row[6]);
							$t = 0;
							while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
								$val = ($rNilai[0] / $rNilai[1]) * 100;
								$namaSbj[$t] = $rNilai[2];
								$nilaiSbj[$t] = number_format((float)$val, 2, '.', '');
								$t++;
							}
							/**Khusus UB*/
							if ($row[4] >= 50) {
								$lulus[$n_lulus] = [
									'sesi'    => $sesi,
									'nim'     => ' ' . $row[2],
									'nama'    => $row[1],
									'nilai'   => number_format((float)$row[4], 2, '.', ''),
									'nilai_w' => $nilaiSbj[2],
									'nilai_e' => $nilaiSbj[0],
									'nilai_p' => $nilaiSbj[1]
								];
								$n_lulus++;
							} elseif ($row[4] < 50) {
								$gagal[$n_gagal] = [
									'sesi'    => $sesi,
									'nim'     => ' ' . $row[2],
									'nama'    => $row[1],
									'nilai'   => number_format((float)$row[4], 2, '.', ''),
									'nilai_w' => $nilaiSbj[2],
									'nilai_e' => $nilaiSbj[0],
									'nilai_p' => $nilaiSbj[1]
								];
								$n_gagal++;
							}
							/**==================================*/
							if ($row[4] >= $row[5]) {
								$status = "<b style='color:green;'>Lulus</b>";
								$status2 = "Lulus";
							} else {
								$status = "<b style='color:red;'>Tidak Lulus</b>";
								$status2 = "Tidak Lulus";
							}
							$kesempatan = explode('.', $row[6]);
							if ($kesempatan[1] == 1) {
								$field[$value . '.1'][$no_1] = array(
									0 => $sesi,
									1 => ' ' . $row[2],
									2 => $row[1],
									3 => $nilaiSbj[2],
									4 => $nilaiSbj[0],
									5 => $nilaiSbj[1],
									6 => number_format((float)$row[4], 2, '.', '')
								);
								$isi_1 .= "<tr><td>$no_1</td>";
								foreach ($field[$value . '.1'][$no_1] as $key_nilai => $value_nilai) {
									$isi_1 .= "<td>$value_nilai</td>";
								}
								$isi_1 .= "<td>" . $status . "</td></tr>";
								$field[$value . '.1'][$no_1][7] = $status2;
								$no_1++;
							} else {
								$field[$value . '.2'][$no_2] = array(
									0 => $sesi,
									1 => ' ' . $row[2],
									2 => $row[1],
									3 => $nilaiSbj[2],
									4 => $nilaiSbj[0],
									5 => $nilaiSbj[1],
									6 => number_format((float)$row[4], 2, '.', '')
								);
								$isi_2 .= "<tr><td>$no_2</td>";
								foreach ($field[$value . '.2'][$no_2] as $key_nilai => $value_nilai) {
									$isi_2 .= "<td>$value_nilai</td>";
								}
								$isi_2 .= "<td>" . $status . "</td></tr>";
								$field[$value . '.2'][$no_2][7] = $status2;
								$no_2++;
							}
						}
					}
					$i = 4;
					$header = array(0 => 'No', 1 => 'Sesi', 2 => 'ID Student', 3 => 'Student Name');
					if ($id_program == 'P0006' or $id_program == 'P0007' or $id_program == 'P0008' or $id_program == 'P0009' or $id_program == 'P0010' or $id_program == 'P0011') {
						$header[4] = $namaSbj[2];
						$header[5] = $namaSbj[0];
						$header[6] = $namaSbj[1];
						$i = 7;
					} else {
						foreach ($namaSbj as $key => $value) {
							$header[$i] = $value;
							$i++;
						}
					}
					$header[$i] 	= 'Average';
					$header[$i + 1] = 'Status';
				}
				echo "<div style='text-align:center;'>
				<h3> Nilai Ujian " . $dataCustomer[1] . "</h3>
				<h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5></div>
				<table id=\"tbl\">
				<tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_1;
				echo "</table><br>";
				echo "<div style='text-align:center;'>
				<h3> Nilai Ujian " . $dataCustomer[1] . "</h3>
				<h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5></div>
				<table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_2;
				$param = 'Report Ujian ' . $dataCustomer[1] . ' (' . tanggal_indo($start) . ' Sampai ' . tanggal_indo($end) . ')';
				$reportExam = 1;
				$json_header = json_encode($header);
				$json_lulus = json_encode($lulus);
				$json_gagal = json_encode($gagal);
				$json_ujian_ke1 = json_encode($field[$value . '.1']);
				$json_ujian_ke2 = json_encode($field[$value . '.2']);
				echo "</table><br>";
				if ($dataCustomer[0] == 'C0061') {
					echo "<button onclick=\"getElementById('DownloadGelombang').submit()\" class='btn btn-sm btn-primary'>Download Report</button> &nbsp ";
					echo "<button onclick=\"getElementById('DownloadGoldSilver').submit()\" class='btn btn-sm btn-primary'>Download Gold Silver</button> &nbsp ";
					echo "<button onclick=\"getElementById('DownloadInvoice').submit()\" class='btn btn-sm btn-primary'>Download Tagihan</button> <br>";
				}
				break;
			case 'exam':
				/** Base Setup */
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$exam = $_POST['exam'];
				if (isset($_POST['desc'])) {
					$exam = json_decode($exam, true);
					$id_report = $_POST['id_report'];
				}
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				$field = array();
				$no_1 = 1;
				$no_2 = 1;
				foreach ($exam as $key => $value) {
					$dataVoucher = CoviddataVoucher($start, $end, $value);
					$no = 1;
					while ($rows = mysqli_fetch_array($dataVoucher)) {
						$exIdGroup		= explode('.', $rows[1]);
						$id_program 	= $exIdGroup[1];
						$dataSchedule = CoviddataSchedule($value);
						$tanggal_indo = tanggal_indo($dataSchedule[0]);
						$result 			= admRpt_Exam($start, $end, $rows[0]);
						$dataCustomer = dataCustomer($exIdGroup[0]);
						if (mysqli_num_rows($result) != 0) {
							$sesi++;
						}
						// while ($row = mysqli_fetch_row($result)) {
						// 	if ($row[4]>=$row[5]) {
						// 		$status = "<b style='color:green;'>Lulus</b>";
						// 		$status2 = "Lulus";
						// 	}else{
						// 		$status = "<b style='color:red;'>Tidak Lulus</b>";
						// 		$status2 = "Tidak Lulus";
						// 	}
						// 	$kesempatan = explode('.', $row[6]);
						// 	if ($kesempatan[1] == 1) {
						// 		$field[$value.'.1'][$no_1] = array(0=>$sesi,1=>' '.$row[2],2=>$row[1]);
						// 		$nNilai = setNilai($row[3],$row[6]);
						// 		$iN = 3;
						// 		$t=0;
						// 		while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
						// 			$val = ($rNilai[0] / $rNilai[1]) * 100;
						// 			$nilaiSubject = number_format((float)$val, 2, '.', '') ;
						// 			$field[$value.'.1'][$no_1][$iN] = $nilaiSubject;
						// 			$namaSbj[$t] = $rNilai[2];
						// 			$iN++;
						// 			$t++;
						// 		}
						// 		$field[$value.'.1'][$no_1][$iN] = number_format((float)$row[4], 2, '.', '') ;
						// 		$isi_1 .= "<tr><td>$no_1</td>";
						// 		foreach ($field[$value.'.1'][$no_1] as $key_nilai => $value_nilai) {
						// 			$isi_1 .="<td>$value_nilai</td>";	
						// 		}
						// 		$isi_1 .= "<td>".$status."</td></tr>";
						// 		$field[$value.'.1'][$no_1][$iN+1] = $status2;
						// 		$no_1++;
						// 	}else{
						// 		$field[$value.'.2'][$no_2] = array(0=>$sesi,1=>' '.$row[2],2=>$row[1]);
						// 		$nNilai = setNilai($row[3],$row[6]);
						// 		$iN = 3;
						// 		$t = 0;
						// 		while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
						// 			$val = ($rNilai[0] / $rNilai[1]) * 100;
						// 			$nilaiSubject = number_format((float)$val, 2, '.', '') ;
						// 			$field[$value.'.2'][$no_2][$iN] = $nilaiSubject;
						// 			$namaSbj[$t] = $rNilai[2];
						// 			$t++;
						// 			$iN++;
						// 		}
						// 		$field[$value.'.2'][$no_2][$iN] = number_format((float)$row[4], 2, '.', '') ;
						// 		$isi_2 .= "<tr><td>$no_2</td>";
						// 		foreach ($field[$value.'.2'][$no_2] as $key_nilai => $value_nilai) {
						// 			$isi_2 .="<td>$value_nilai</td>";	
						// 		}
						// 		$isi_2 .= "<td>".$status."</td></tr>";
						// 		$field[$value.'.2'][$no_2][$iN+1] = $status2;
						// 		$no_2++;
						// 	}
						// }
						while ($row = mysqli_fetch_row($result)) {
							$nNilai = setNilai($row[3], $row[6]);
							$t = 0;
							$kesempatan = explode('.', $row[6]);
							/** rebuild */
							if ($id_program == 'P0006' or $id_program == 'P0007' or $id_program == 'P0008' or $id_program == 'P0009' or $id_program == 'P0010' or $id_program == 'P0011') {
								while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
									$val = ($rNilai[0] / $rNilai[1]) * 100;
									$namaSbj[$t] = $rNilai[2];
									$nilaiSbj[$t] = number_format((float)$val, 2, '.', '');
									$t++;
								}
								$kesempatan = explode('.', $row[6]);
								if ($kesempatan[1] == 1) {
									if ($row[4] >= $row[5]) {
										$status = "<b style='color:green;'>Lulus</b>";
										$status2 = "Lulus";
										$examlulus[$n_lulus] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_lulus++;
										$isi_1 .= "<tr><td>$no_1</td>";
										$isi_1 .= "<td>$sesi</td>";
										$isi_1 .= "<td> " . $row[2] . "</td>";
										$isi_1 .= "<td>$row[1]</td>";
										$isi_1 .= "<td>$nilaiSbj[2]</td>";
										$isi_1 .= "<td>$nilaiSbj[0]</td>";
										$isi_1 .= "<td>$nilaiSbj[1]</td>";
										$isi_1 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_1 .= "<td>" . $status . "</td></tr>";
										$noL++;
									} else {
										$status = "<b style='color:red;'>Tidak Lulus</b>";
										$status2 = "Tidak Lulus";
										$examgagal[$n_gagal] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_gagal++;
										$isi_1 .= "<tr><td>$no_1</td>";
										$isi_1 .= "<td>$sesi</td>";
										$isi_1 .= "<td> " . $row[2] . "</td>";
										$isi_1 .= "<td>$row[1]</td>";
										$isi_1 .= "<td>$nilaiSbj[2]</td>";
										$isi_1 .= "<td>$nilaiSbj[0]</td>";
										$isi_1 .= "<td>$nilaiSbj[1]</td>";
										$isi_1 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_1 .= "<td>" . $status . "</td></tr>";
										$noTL++;
									}
									$field[$value . '.1'][$no_1] = array(
										0 => $sesi,
										1 => ' ' . $row[2],
										2 => $row[1],
										3 => $nilaiSbj[2],
										4 => $nilaiSbj[0],
										5 => $nilaiSbj[1],
										6 => number_format((float)$row[4], 2, '.', '')
									);
									$field[$value . '.1'][$no_1][7] = $status2;
									$no_1++;
								} else {
									if ($row[4] >= $row[5]) {
										$status = "<b style='color:green;'>Lulus</b>";
										$status2 = "Lulus";
										$reexamlulus[$n_lulus] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_lulus++;
										$isi_2 .= "<tr><td>$no_2</td>";
										$isi_2 .= "<td>$sesi</td>";
										$isi_2 .= "<td> " . $row[2] . "</td>";
										$isi_2 .= "<td>$row[1]</td>";
										$isi_2 .= "<td>$nilaiSbj[2]</td>";
										$isi_2 .= "<td>$nilaiSbj[0]</td>";
										$isi_2 .= "<td>$nilaiSbj[1]</td>";
										$isi_2 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_2 .= "<td>" . $status . "</td></tr>";
										$noL++;
									} else {
										$status = "<b style='color:red;'>Tidak Lulus</b>";
										$status2 = "Tidak Lulus";
										$reexamgagal[$n_gagal] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_gagal++;
										$isi_2 .= "<tr><td>$no_2</td>";
										$isi_2 .= "<td>$sesi</td>";
										$isi_2 .= "<td> " . $row[2] . "</td>";
										$isi_2 .= "<td>$row[1]</td>";
										$isi_2 .= "<td>$nilaiSbj[2]</td>";
										$isi_2 .= "<td>$nilaiSbj[0]</td>";
										$isi_2 .= "<td>$nilaiSbj[1]</td>";
										$isi_2 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_2 .= "<td>" . $status . "</td></tr>";
										$noTL++;
									}
									$field[$value . '.2'][$no_2] = array(
										0 => $sesi,
										1 => ' ' . $row[2],
										2 => $row[1],
										3 => $nilaiSbj[2],
										4 => $nilaiSbj[0],
										5 => $nilaiSbj[1],
										6 => number_format((float)$row[4], 2, '.', '')
									);
									$field[$value . '.2'][$no_2][7] = $status2;
									$no_2++;
								}
							} else {
								if ($row[4] >= $row[5]) {
									$status = "<b style='color:green;'>Lulus</b>";
									$status2 = "Lulus";
								} else {
									$status = "<b style='color:red;'>Tidak Lulus</b>";
									$status2 = "Tidak Lulus";
								}
								$kesempatan = explode('.', $row[6]);
								if ($kesempatan[1] == 1) {
									$field[$value . '.1'][$no_1] = array(0 => $sesi, 1 => ' ' . $row[2], 2 => $row[1]);
									$nNilai = setNilai($row[3], $row[6]);
									$iN = 3;
									while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
										$val = ($rNilai[0] / $rNilai[1]) * 100;
										$nilaiSbj = number_format((float)$val, 2, '.', '');
										$field[$value . '.1'][$no_1][$iN] = $nilaiSbj;
										$namaSbj[$t] = $rNilai[2];
										$iN++;
									}
									$field[$value . '.1'][$no_1][$iN] = number_format((float)$row[4], 2, '.', '');
									$isi_1 .= "<tr><td>$no_1</td>";
									foreach ($field[$value . '.1'][$no_1] as $key_nilai => $value_nilai) {
										$isi_1 .= "<td>$value_nilai</td>";
									}
									$isi_1 .= "<td>" . $status . "</td></tr>";
									$field[$value . '.1'][$no_1][$iN + 1] = $status2;
									$no_1++;
								} else {
									$field[$value . '.2'][$no_2] = array(0 => $sesi, 1 => ' ' . $row[2], 2 => $row[1]);
									$nNilai = setNilai($row[3], $row[6]);
									$iN = 3;
									while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
										$val = ($rNilai[0] / $rNilai[1]) * 100;
										$nilaiSbj = number_format((float)$val, 2, '.', '');
										$field[$value . '.2'][$no_2][$iN] = $nilaiSbj;
										$namaSbj[$t] = $rNilai[2];
										$iN++;
									}
									$field[$value . '.2'][$no_2][$iN] = number_format((float)$row[4], 2, '.', '');
									$isi_2 .= "<tr><td>$no_2</td>";
									foreach ($field[$value . '.2'][$no_2] as $key_nilai => $value_nilai) {
										$isi_2 .= "<td>$value_nilai</td>";
									}
									$isi_2 .= "<td>" . $status . "</td></tr>";
									$field[$value . '.2'][$no_2][$iN + 1] = $status2;
									$no_2++;
								}
							}
						}
					}
					$i = 4;
					$header = array(0 => 'No', 1 => 'Sesi', 2 => 'ID Student', 3 => 'Student Name');
					if ($id_program == 'P0006' or $id_program == 'P0007' or $id_program == 'P0008' or $id_program == 'P0009' or $id_program == 'P0010' or $id_program == 'P0011') {
						$header[4] = $namaSbj[2];
						$header[5] = $namaSbj[0];
						$header[6] = $namaSbj[1];
						$i = 7;
						$json_header = json_encode($namaSbj);
						$json_examlulus = json_encode($examlulus);
						$json_examgagal = json_encode($examgagal);
						$json_reexamlulus = json_encode($reexamlulus);
						$json_reexamgagal = json_encode($reexamgagal);
						$json_ujian_ke1 = json_encode($field[$value . '.1']);
						$json_ujian_ke2 = json_encode($field[$value . '.2']);
						$reportExam = 2;
					} else {
						foreach ($namaSbj as $key => $value) {
							$header[$i] = $value;
							$i++;
						}
						$json_header = '';
						$json_examlulus = '';
						$json_examgagal = '';
						$json_reexamlulus = '';
						$json_reexamgagal = '';
						$json_ujian_ke1 = '';
						$json_ujian_ke2 = '';
						$reportExam = 1;
					}
					$header[$i] 	= 'Average';
					$header[$i + 1] = 'Status';
				}
				echo "<div style='text-align:center;'><h3> Nilai Ujian " . $dataCustomer[1] . "</h3><h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5>
				<h5>Peserta Exam</h5></div><table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_1;
				echo "</table><br>";
				echo "<div style='text-align:center;'><h3> Nilai Ujian " . $dataCustomer[1] . "</h3><h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5>
				<h5>Peserta Re-Exam</h5></div><table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_2;
				$param = 'Report Ujian ' . $dataCustomer[1] . ' (' . tanggal_indo($start) . ' Sampai ' . tanggal_indo($end) . ')';
				echo "</table><br>";
				break;
		}
	} else {
		/** Exam Standard */
		switch ($_POST['cmd']) {
			case 'customer':
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$by = $_POST['by'];
				$customer = $_POST['customer'];
				$result = admRpt_Cust($start, $end, $by, $customer);
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				/*By Vouc*/
				if ($by == 'Voucher') {
					$header = array('No', 'Customer Name', 'Id Voucher', 'Id Program', 'Latest Top Up', 'Available', 'Use', 'Top Up');
					echo "<table id=\"tbl\" class=\"table table-bordered\">
					<tr><th>No</th>
					<th>Customer Name</th>
					<th>Id Voucher</th>
					<th>Id Program</th>
					<th>Latest Top Up</th>
					<th>Available</th>
					<th>Use</th>
					<th>Top Up</th></tr>";
					$grup = 0;
					$no = 1;
					$param = 'Report Customer By Voucher';
					while ($row = mysqli_fetch_row($result)) {
						$field[0][$no] = array($row[1], $row[2], $row[3], $row[5], $row[4], $row[6], $row[7]);
						echo "<tr><td>$no</td>
						<td>" . $row[1] . "</td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
						<td>" . $row[5] . "</td>
						<td>" . $row[4] . "</td>
						<td>" . $row[6] . "</td>
						<td>" . $row[7] . "</td></tr>";
						$no++;
					}
					echo "</table>";
				} else if ($by == 'Exam') {
					/*By exam*/
					$header = array('No', 'Customer Name', 'Id Exam Group', 'Date', 'Id Classroom', 'Proctor', 'Alocated', 'Participant', 'Voucher Cancel');
					echo "<table id=\"tbl\"><tr>
					<th>No</th>
					<th>Customer Name</th>
					<th>Id Exam Group</th>
					<th>Date</th>
					<th>Id Classroom</th>
					<th>Proctor</th>
					<th>Alocated </th>
					<th>Participant</th>
					<th>Voucher Cancel</th></tr>";
					$grup = 0;
					$no = 1;
					$param = 'Report Customer By Exam';
					while ($row = mysqli_fetch_row($result)) {
						$field[$grup][$no] = array($row[1], $row[2], $row[3], $row[5], $row[4], $row[6], $row[7], $row[8]);
						echo "<tr><td>$no</td>
						<td>" . $row[1] . "</td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
						<td>" . $row[5] . "</td>
						<td>" . $row[4] . "</td>
						<td>" . $row[6] . "</td>
						<td>" . $row[7] . "</td>
						<td>" . $row[8] . "</td></tr>";
						$no++;
					}
					echo "</table>";
				} else if ($by == 'Program') {
					/*By Prog*/
					$header = array('No', 'Customer Name', 'Program Name', 'Exams', 'Pass Rates');
					echo "<table id=\"tbl\"><tr>
					<th>No</th>
					<th>Customer Name</th>
					<th>Program Name</th>
					<th>Exams</th>
					<th>Pass Rates </th></tr>";
					$grup = 0;
					$no = 1;
					$param = 'Report Customer By Program';
					while ($row = mysqli_fetch_row($result)) {
						$sql1 = "SELECT (sum(AA.kelulusan)/count(*)*100)kelulusan from (
							select if(sum(a.percentage_true)/sum(a.percentage_true+a.percentage_false+a.percentage_null)*100>=c.pass_grade,1,0) kelulusan 
							from exam_percentage a inner join exam_group b on a.exam_code=b.exam_code 
							inner join programs c on SUBSTRING_INDEX(SUBSTRING_INDEX(group_name,'.',2),'.',-1) = c.id_program where b.exam_code in ('$row[0]') 
							group by a.id_student,a.exam_code )AA";
						$res = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']));
						while ($row1 = mysqli_fetch_row($res)) {
							$field[$grup][$no] = array($row[2], $row[1], $row[3], number_format($row1[0], 2) . "%");
							echo "<tr>
							<td>$no</td>
							<td>" . $row[2] . "</td>
							<td>" . $row[1] . "</td>
							<td>" . $row[3] . "</td>
							<td>" . number_format($row1[0], 2) . "%</td></tr>";
							$no++;
						}
					}
					echo "</table>";
				}
				break;
			case 'voucher':
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$voucher = $_POST['voucher'];
				$result = admRpt_Voucher($start, $end, $voucher);
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				$header = array('No', 'Id Customer', 'Customer Name', 'Program Name', 'Exam Group', 'Date Time', 'Alocated', 'Use', 'Cancel', 'Pass Rates');
				echo "<table id=\"tbl\" ><tr>
				<th>No</th>
				<th>Id Voucher</th>
				<th>Customer Name</th>
				<th>Program Name</th>
				<th>Exam Group</th>
				<th>Date Time</th>
				<th>Alocated</th>
				<th>Use</th>
				<th>Cancel</th>
				<th>Pass Rates </th></tr>";
				$grup = 0;
				$no = 1;
				$param = 'Report Voucher Customer';
				while ($row = mysqli_fetch_row($result)) {
					$sql1 = "SELECT (sum(AA.kelulusan)/count(*)*100)kelulusan from (
						select if(sum(a.percentage_true)/sum(a.percentage_true+a.percentage_false+a.percentage_null)*100>=c.pass_grade,1,0) kelulusan 
						from exam_percentage a inner join exam_group b on a.exam_code=b.exam_code 
						inner join programs c on SUBSTRING_INDEX(SUBSTRING_INDEX(group_name,'.',2),'.',-1) = c.id_program 
						where b.exam_code = '$row[7]' group by a.id_student,a.exam_code )AA";
					$res = mysqli_query($GLOBALS['link'], $sql1) or die(mysqli_error($GLOBALS['link']));
					while ($row1 = mysqli_fetch_row($res)) {
						$field[$grup][$no] = array($row[0], $row[1], $row[2], $row[3], $row[8], $row[4], $row[5], $row[6], number_format($row1[0], 2) . "%");
						echo "<tr><td>$no</td>
						<td>" . $row[0] . "</td>
						<td>" . $row[1] . "</td>
						<td>" . $row[2] . "</td>
						<td>" . $row[3] . "</td>
						<td>" . $row[8] . " " . $row[9] . "</td>
						<td>" . $row[4] . "</td>
						<td>" . $row[5] . "</td>
						<td>" . $row[6] . "</td>
						<td>" . number_format($row1[0], 2) . "%</td></tr>";
						$no++;
					}
				}
				echo "</table>";
				break;
				/** End */
			case 'exam':
				/** Report Exam */
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$exam = $_POST['exam'];
				if (isset($_POST['desc'])) {
					$exam = json_decode($exam, true);
					$id_report = $_POST['id_report'];
				}
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				$field = array();
				$no_1 = 1;
				$no_2 = 1;
				$noL = 1;
				$noTL = 1;
				foreach ($exam as $key => $value) {
					$kodeVoucher = $value;
					$dataVoucher = dataVoucher($start, $end, $value);
					$no = 1;
					while ($rows = mysqli_fetch_array($dataVoucher)) {
						$exIdGroup		= explode('.', $rows[1]);
						$id_program 	= $exIdGroup[1];
						$dataSchedule = dataSchedule($value);
						$tanggal_indo = tanggal_indo($dataSchedule[0]);
						$result 			= admRpt_Exam($start, $end, $rows[0]);
						$dataCustomer = dataCustomer($exIdGroup[0]);
						if (mysqli_num_rows($result) != 0) {
							$sesi++;
						}
						while ($row = mysqli_fetch_row($result)) {
							$nNilai = setNilai($row[3], $row[6]);
							$t = 0;
							$kesempatan = explode('.', $row[6]);
							/** rebuild */
							if ($id_program == 'P0006' or $id_program == 'P0007' or $id_program == 'P0008' or $id_program == 'P0009' or $id_program == 'P0010' or $id_program == 'P0011') {
								while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
									$val = ($rNilai[0] / $rNilai[1]) * 100;
									$namaSbj[$t] = $rNilai[2];
									$nilaiSbj[$t] = number_format((float)$val, 2, '.', '');
									$t++;
								}
								$kesempatan = explode('.', $row[6]);
								if ($kesempatan[1] == 1) {
									if ($row[4] >= $row[5]) {
										$status = "<b style='color:green;'>Lulus</b>";
										$status2 = "Lulus";
										$examlulus[$n_lulus] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_lulus++;
										$isi_1 .= "<tr><td>$no_1</td>";
										$isi_1 .= "<td>$sesi</td>";
										$isi_1 .= "<td> " . $row[2] . "</td>";
										$isi_1 .= "<td>$row[1]</td>";
										$isi_1 .= "<td>$nilaiSbj[2]</td>";
										$isi_1 .= "<td>$nilaiSbj[0]</td>";
										$isi_1 .= "<td>$nilaiSbj[1]</td>";
										$isi_1 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_1 .= "<td>" . $status . "</td></tr>";
										$noL++;
									} else {
										$status = "<b style='color:red;'>Tidak Lulus</b>";
										$status2 = "Tidak Lulus";
										$examgagal[$n_gagal] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_gagal++;
										$isi_1 .= "<tr><td>$no_1</td>";
										$isi_1 .= "<td>$sesi</td>";
										$isi_1 .= "<td> " . $row[2] . "</td>";
										$isi_1 .= "<td>$row[1]</td>";
										$isi_1 .= "<td>$nilaiSbj[2]</td>";
										$isi_1 .= "<td>$nilaiSbj[0]</td>";
										$isi_1 .= "<td>$nilaiSbj[1]</td>";
										$isi_1 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_1 .= "<td>" . $status . "</td></tr>";
										$noTL++;
									}
									$field[$value . '.1'][$no_1] = array(
										0 => $sesi,
										1 => ' ' . $row[2],
										2 => $row[1],
										3 => $nilaiSbj[2],
										4 => $nilaiSbj[0],
										5 => $nilaiSbj[1],
										6 => number_format((float)$row[4], 2, '.', '')
									);
									$field[$value . '.1'][$no_1][7] = $status2;
									$no_1++;
								} else {
									if ($row[4] >= $row[5]) {
										$status = "<b style='color:green;'>Lulus</b>";
										$status2 = "Lulus";
										$reexamlulus[$n_lulus] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_lulus++;
										$isi_2 .= "<tr><td>$no_2</td>";
										$isi_2 .= "<td>$sesi</td>";
										$isi_2 .= "<td> " . $row[2] . "</td>";
										$isi_2 .= "<td>$row[1]</td>";
										$isi_2 .= "<td>$nilaiSbj[2]</td>";
										$isi_2 .= "<td>$nilaiSbj[0]</td>";
										$isi_2 .= "<td>$nilaiSbj[1]</td>";
										$isi_2 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_2 .= "<td>" . $status . "</td></tr>";
										$noL++;
									} else {
										$status = "<b style='color:red;'>Tidak Lulus</b>";
										$status2 = "Tidak Lulus";
										$reexamgagal[$n_gagal] = [
											'sesi'    => $sesi,
											'nim'     => ' ' . $row[2],
											'nama'    => $row[1],
											'nilai_w' => $nilaiSbj[2],
											'nilai_e' => $nilaiSbj[0],
											'nilai_p' => $nilaiSbj[1],
											'nilai'   => number_format((float)$row[4], 2, '.', ''),
											'status'  => $status2
										];
										$n_gagal++;
										$isi_2 .= "<tr><td>$no_2</td>";
										$isi_2 .= "<td>$sesi</td>";
										$isi_2 .= "<td> " . $row[2] . "</td>";
										$isi_2 .= "<td>$row[1]</td>";
										$isi_2 .= "<td>$nilaiSbj[2]</td>";
										$isi_2 .= "<td>$nilaiSbj[0]</td>";
										$isi_2 .= "<td>$nilaiSbj[1]</td>";
										$isi_2 .= "<td>" . number_format((float)$row[4], 2, '.', '') . "</td>";
										$isi_2 .= "<td>" . $status . "</td></tr>";
										$noTL++;
									}
									$field[$value . '.2'][$no_2] = array(
										0 => $sesi,
										1 => ' ' . $row[2],
										2 => $row[1],
										3 => $nilaiSbj[2],
										4 => $nilaiSbj[0],
										5 => $nilaiSbj[1],
										6 => number_format((float)$row[4], 2, '.', '')
									);
									$field[$value . '.2'][$no_2][7] = $status2;
									$no_2++;
								}
							} else {
								if ($row[4] >= $row[5]) {
									$status = "<b style='color:green;'>Lulus</b>";
									$status2 = "Lulus";
								} else {
									$status = "<b style='color:red;'>Tidak Lulus</b>";
									$status2 = "Tidak Lulus";
								}
								$kesempatan = explode('.', $row[6]);
								if ($kesempatan[1] == 1) {
									$field[$value . '.1'][$no_1] = array(0 => $sesi, 1 => ' ' . $row[2], 2 => $row[1]);
									$nNilai = setNilai($row[3], $row[6]);
									$iN = 3;
									while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
										$val = ($rNilai[0] / $rNilai[1]) * 100;
										$nilaiSbj = number_format((float)$val, 2, '.', '');
										$field[$value . '.1'][$no_1][$iN] = $nilaiSbj;
										$namaSbj[$t] = $rNilai[2];
										$iN++;
									}
									$field[$value . '.1'][$no_1][$iN] = number_format((float)$row[4], 2, '.', '');
									$isi_1 .= "<tr><td>$no_1</td>";
									foreach ($field[$value . '.1'][$no_1] as $key_nilai => $value_nilai) {
										$isi_1 .= "<td>$value_nilai</td>";
									}
									$isi_1 .= "<td>" . $status . "</td></tr>";
									$field[$value . '.1'][$no_1][$iN + 1] = $status2;
									$no_1++;
								} else {
									$field[$value . '.2'][$no_2] = array(0 => $sesi, 1 => ' ' . $row[2], 2 => $row[1]);
									$nNilai = setNilai($row[3], $row[6]);
									$iN = 3;
									while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
										$val = ($rNilai[0] / $rNilai[1]) * 100;
										$nilaiSbj = number_format((float)$val, 2, '.', '');
										$field[$value . '.2'][$no_2][$iN] = $nilaiSbj;
										$namaSbj[$t] = $rNilai[2];
										$iN++;
									}
									$field[$value . '.2'][$no_2][$iN] = number_format((float)$row[4], 2, '.', '');
									$isi_2 .= "<tr><td>$no_2</td>";
									foreach ($field[$value . '.2'][$no_2] as $key_nilai => $value_nilai) {
										$isi_2 .= "<td>$value_nilai</td>";
									}
									$isi_2 .= "<td>" . $status . "</td></tr>";
									$field[$value . '.2'][$no_2][$iN + 1] = $status2;
									$no_2++;
								}
							}
						}
					}
					$i = 4;
					$header = array(0 => 'No', 1 => 'Sesi', 2 => 'ID Student', 3 => 'Student Name');
					if ($id_program == 'P0006' or $id_program == 'P0007' or $id_program == 'P0008' or $id_program == 'P0009' or $id_program == 'P0010' or $id_program == 'P0011') {
						$header[4] = $namaSbj[2];
						$header[5] = $namaSbj[0];
						$header[6] = $namaSbj[1];
						$i = 7;
						$json_header = json_encode($namaSbj);
						$json_examlulus = json_encode($examlulus);
						$json_examgagal = json_encode($examgagal);
						$json_reexamlulus = json_encode($reexamlulus);
						$json_reexamgagal = json_encode($reexamgagal);
						$json_ujian_ke1 = json_encode($field[$value . '.1']);
						$json_ujian_ke2 = json_encode($field[$value . '.2']);
						$reportExam = 2;
					} else {
						foreach ($namaSbj as $key => $value) {
							$header[$i] = $value;
							$i++;
						}
						$json_header = '';
						$json_examlulus = '';
						$json_examgagal = '';
						$json_reexamlulus = '';
						$json_reexamgagal = '';
						$json_ujian_ke1 = '';
						$json_ujian_ke2 = '';
						$reportExam = 1;
					}
					$header[$i] 	= 'Average';
					$header[$i + 1] = 'Status';
				}
				echo "<div style='text-align:center;'><h3> Nilai Ujian " . $dataCustomer[1] . "</h3><h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5>
				<h5>Peserta Exam</h5></div><table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_1;
				echo "</table><br>";
				echo "<div style='text-align:center;'><h3> Nilai Ujian " . $dataCustomer[1] . "</h3><h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5>
				<h5>Peserta Re-Exam</h5></div><table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_2;
				$param = 'Report Ujian ' . $dataCustomer[1] . ' (' . tanggal_indo($start) . ' Sampai ' . tanggal_indo($end) . ')';
				echo "</table><br>";
				break;
			case 'exam_ub':
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$exam = $_POST['exam'];
				if (isset($_POST['desc'])) {
					$exam = json_decode($exam, true);
					$id_report = $_POST['id_report'];
					$gelombang = $_POST['desc'];
				} else {
					$gelombang = $_POST['judul'];
				}
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				$field = array();
				$no_1 = 1;
				$no_2 = 1;
				//echo $value;
				foreach ($exam as $key => $value) {
					$dataVoucher = dataVoucher($start, $end, $value);
					$no = 1;
					$sesi = 0;
					$n_lulus = 1;
					$n_gagal = 1;
					while ($rows = mysqli_fetch_array($dataVoucher)) {
						$exIdGroup		= explode('.', $rows[1]);
						$id_program 	= $exIdGroup[1];
						$dataSchedule = dataSchedule($value);
						$tanggal_indo = tanggal_indo($dataSchedule[0]);
						$result 			= admRpt_Exam($start, $end, $rows[0]);
						$n 						= subjectls($id_program);
						$dataCustomer = dataCustomer($exIdGroup[0]);
						if (mysqli_num_rows($result) != 0) {
							$sesi++;
						}
						while ($row = mysqli_fetch_row($result)) {
							$nNilai = setNilai($row[3], $row[6]);
							$t = 0;
							while ($rNilai = mysqli_fetch_array($nNilai)) { //looping save to array for export
								$val = ($rNilai[0] / $rNilai[1]) * 100;
								$nilaiSbj[$t] = number_format((float)$val, 2, '.', '');

								$t++;
							}
							/** Khusus UB */
							if ($row[4] >= 50) {
								$lulus[$n_lulus] = [
									'sesi'    => $sesi,
									'nim'     => ' ' . $row[2],
									'nama'    => $row[1],
									'nilai'   => number_format((float)$row[4], 2, '.', ''),
									'nilai_w' => $nilaiSbj[2],
									'nilai_e' => $nilaiSbj[0],
									'nilai_p' => $nilaiSbj[1]
								];
								$n_lulus++;
							} elseif ($row[4] < 50) {
								//gagal bisa ikut ujian
								$gagal[$n_gagal] = [
									'sesi'    => $sesi,
									'nim'     => ' ' . $row[2],
									'nama'    => $row[1],
									'nilai'   => number_format((float)$row[4], 2, '.', ''),
									'nilai_w' => $nilaiSbj[2],
									'nilai_e' => $nilaiSbj[0],
									'nilai_p' => $nilaiSbj[1]
								];
								$n_gagal++;
							}
							/** ================================== */
							if ($row[4] >= $row[5]) {
								$status = "<b style='color:green;'>Lulus</b>";
								$status2 = "Lulus";
							} else {
								$status = "<b style='color:red;'>Tidak Lulus</b>";
								$status2 = "Tidak Lulus";
							}
							$kesempatan = explode('.', $row[6]);
							if ($kesempatan[1] == 1) {
								$field[$value . '.1'][$no_1] = array(
									0 => $sesi,
									1 => ' ' . $row[2],
									2 => $row[1],
									3 => $nilaiSbj[0],
									4 => $nilaiSbj[1],
									5 => $nilaiSbj[2],
									6 => number_format((float)$row[4], 2, '.', '')
								);
								$isi_1 .= "<tr><td>$no_1</td>";
								foreach ($field[$value . '.1'][$no_1] as $key_nilai => $value_nilai) {
									$isi_1 .= "<td>$value_nilai</td>";
								}
								$isi_1 .= "<td>" . $status . "</td></tr>";
								$field[$value . '.1'][$no_1][7] = $status2;
								$no_1++;
							} else {
								$field[$value . '.2'][$no_2] = array(
									0 => $sesi,
									1 => ' ' . $row[2],
									2 => $row[1],
									3 => $nilaiSbj[0],
									4 => $nilaiSbj[1],
									5 => $nilaiSbj[2],
									6 => number_format((float)$row[4], 2, '.', '')
								);
								$isi_2 .= "<tr><td>$no_2</td>";
								foreach ($field[$value . '.2'][$no_2] as $key_nilai => $value_nilai) {
									$isi_2 .= "<td>$value_nilai</td>";
								}
								$isi_2 .= "<td>" . $status . "</td></tr>";
								$field[$value . '.2'][$no_2][7] = $status2;
								$no_2++;
							}
						}
					}
					$i = 4;
					$header = array(0 => 'No', 1 => 'Sesi', 2 => 'ID Student', 3 => 'Student Name');
					while ($row = mysqli_fetch_row($n)) {
						$header[$i] = $row[2];
						$i++;
					}
					$header[$i] 	= 'Average';
					$header[$i + 1] = 'Status';
				}
				echo "<div style='text-align:center;'><h3> Nilai Ujian " . $dataCustomer[1] . "</h3><h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5>
				</div><table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_1;
				echo "</table><br>";
				echo "<div style='text-align:center;'><h3> Nilai Ujian " . $dataCustomer[1] . "</h3><h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5>
				</div><table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_2;
				$param = 'Report Ujian ' . $dataCustomer[1] . ' (' . tanggal_indo($start) . ' Sampai ' . tanggal_indo($end) . ')';
				$reportExam = 1;
				$json_lulus = json_encode($lulus);
				$json_gagal = json_encode($gagal);
				$json_ujian_ke1 = json_encode($field[$value . '.1']);
				$json_ujian_ke2 = json_encode($field[$value . '.2']);
				echo "</table><br>";
				if ($dataCustomer[0] == 'C0061') {
					echo "<button onclick=\"getElementById('DownloadGelombang').submit()\" class='btn btn-sm btn-primary'>Download Report</button> &nbsp ";
					echo "<button onclick=\"getElementById('DownloadGoldSilver').submit()\" class='btn btn-sm btn-primary'>Download Gold Silver</button> &nbsp ";
					echo "<button onclick=\"getElementById('DownloadInvoice').submit()\" class='btn btn-sm btn-primary'>Download Tagihan</button> <br>";
				}
				break;
			case 'program':
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$program = $_POST['program'];
				print_r($start . '<br>' . $end . '<br>' . $program);
				break;
			case '10persen':
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$exam = $_POST['exam'];
				if (isset($_POST['desc'])) {
					$exam = json_decode($exam, true);
					$id_report = $_POST['id_report'];
				}
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				$field = array();
				$no_1 = 1;
				$no_2 = 1;
				foreach ($exam as $key => $value) {
					if (isset($_POST['fromhome'])) {
						$dataVoucher = CoviddataVoucher($start, $end, $value);
					} else {
						$dataVoucher = dataVoucher($start, $end, $value);
					}
					$no = 1;
					while ($rows = mysqli_fetch_array($dataVoucher)) {
						$exIdGroup		= explode('.', $rows[1]);
						$id_program 	= $exIdGroup[1];
						if (isset($_POST['fromhome'])) {
							$dataSchedule = CoviddataSchedule($value);
						} else {
							$dataSchedule = dataSchedule($value);
						}
						$tanggal_indo = tanggal_indo($dataSchedule[0]);
						$result 			= admRpt_Exam($start, $end, $rows[0]);
						$n 						= subjectls($id_program);
						$dataCustomer = dataCustomer($exIdGroup[0]);
						if (mysqli_num_rows($result) != 0) {
							$sesi++;
						}
						while ($row = mysqli_fetch_row($result)) {
							if ($row[4] >= $row[5]) {
								$nim[$n_lulus] 	= $row[2];
								$nama[$n_lulus]	= $row[1];
								$nilai[$n_lulus] 	= $row[4];
								$n_lulus++;
							}
						}
					}
					// sorting DESC
					array_multisort($nilai, SORT_DESC, SORT_NUMERIC, $nim, $nama);
					// 10%
					$jumlah_peserta = count($nilai);
					$n_10 = $jumlah_peserta * 0.1;
					// echo 'lulus='.$jumlah_peserta.'<br>';
					// echo '10%='.$n_10;
					$n_fix = ceil($n_10);
					for ($i = 0; $i < $n_fix; $i++) {
						$user_name_10[$i] 	= $nama[$i];
						$nim_10[$i] 		= $nim[$i];
						$nilai_10[$i] 		= number_format((float)$nilai[$i], 2, '.', '') . '%';
					}
					array_multisort($user_name_10, SORT_ASC, SORT_STRING, $nim_10, $nilai_10);
					foreach ($user_name_10 as $key10 => $value10) {
						$field[$value . '.1'][$key10] = array(0 => '', 1 => ' ' . $nim_10[$key10], 2 => $user_name_10[$key10], 3 => number_format((float)$nilai_10[$key10], 2, '.', ''));
						$no = $key10 + 1;
						$isi_1 .= "<tr><td>" . $no . "</td><td></td><td>" . $nim_10[$key10] . "</td><td>" . $user_name_10[$key10] . "</td><td>" . number_format((float)$nilai_10[$key10], 2, '.', '') . "%</td>";
						$isi_1 .= "</tr>";
					}
					$header = array(0 => 'No', 1 => 'No Sertifikat', 2 => 'NIM', 3 => 'Nama', 4 => 'Nilai');
				}
				$per_customer = $dataCustomer[1];
				echo "<div style='text-align:center;'><h3>  10% Nilai Tertinggi " . $dataCustomer[1] . "</h3><h5> Periode  " . tanggal_indo($start) . " sampai " . tanggal_indo($end) . " </h5>
				</div><table id=\"tbl\"><tr>";
				foreach ($header as $key_header => $value_header) {
					echo "<th>$value_header</th>";
				}
				echo "</tr>";
				echo $isi_1;
				echo "</table><br>";
				$user_name_10 = json_encode($user_name_10);
				$nim_10 			= json_encode($nim_10);
				$nilai_10 		= json_encode($nilai_10);
				echo "<button onclick=\"getElementById('Download10persen').submit()\" class='btn btn-sm btn-primary'>Download Report</button> &nbsp ";
				break;
			case 'voucher_history':
				$start = $_POST['date_start'];
				$end = $_POST['date_end'];
				$voucher = $_POST['voucher'];
				echo "<div class=\"row\"><div class=\"col-lg-12\"><h1></h1></div><div class=\"col-lg-12\">";
				foreach ($voucher as $key => $value) {
					$result = historyVoucher($value, $start, $end);
					$header = array('No', 'Tanggal', 'Description', 'Kredit', 'Debit', 'Saldo');
					$no = 1;
					while ($row = mysqli_fetch_array($result)) {
						if ($row[2] == 'Topup') {
							$kredit = $row[5];
							$debit = '';
						} else if ($row[2] == 'Usage') {
							$kredit = '';
							$debit = $row[9];
						} else if ($row[2] == 'Return') {
							$kredit = $row[5];
							$debit = '';
						}
						if ($row[2] == 'Topup') {
							$desc = '<b>(' . $row[11] . ')</b> <br>Invoice Number : ' . $row[7] . ' / Date : ' . tanggal_indo($row[8]);
						} else if ($row[2] == 'Usage') {
							$desc = '<b>Exam Group : </b>' . $row[10] . " ";
						} else if ($row[2] == 'Return') {
							$desc = '<b>(' . $row[11] . ')</b> <br>' . $row[7] . ' / Date : ' . tanggal_indo($row[8]);
						}
						$field[$value][$no] = array(date("d-M-Y H:i", strtotime($row[3])), $desc, $kredit, $debit, $row[12]);
						$no++;
					}
				}
				$param = 'Report History Voucher Customer';
				//tabel
				foreach ($field as $kode_voucher => $field_desc) {
					echo $kode_voucher;
					echo "<br><table id=\"tbl\">";
					//isinya
					foreach ($field_desc as $no_key => $isi) {
						echo "<tr>";
						//membuat header
						if ($no_key == 1) {
							echo "<tr>";
							foreach ($header as $header_key => $header_value) {
								echo "<th>" . $header_value . "</th>";
							}
							echo "</tr>";
						}
						echo "<td>" . $no_key . "</td>";
						//isi komolomya
						foreach ($isi as $key => $value) {
							echo "<td>" . $value . "</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
				}
				break;
			default:
				print_r($_POST['cmd']);
				break;
		}
	}
}
$nama = json_encode($header);
$isi = json_encode($field);
?>
<br>
<form id='Download' method="POST" action="view_admin/help-export.php">
	<input type="hidden" name="param" value="<?= $param ?>">
	<input type="hidden" name="start" value="<?= $start ?>">
	<input type="hidden" name="end" value="<?= $end ?>">
	<input type="hidden" name="report" value="<?= $reportExam ?>">
	<input type="hidden" name="voucher" value="<?= $kodeVoucher ?>">
	<textarea id="examheader" hidden="" name="examheader"><?= $json_header ?></textarea>
	<textarea id="examlulus" hidden="" name="examlulus"><?= $json_examlulus ?></textarea>
	<textarea id="examgagal" hidden="" name="examgagal"><?= $json_examgagal ?></textarea>
	<textarea id="reexamlulus" hidden="" name="reexamlulus"><?= $json_reexamlulus ?></textarea>
	<textarea id="reexamgagal" hidden="" name="reexamgagal"><?= $json_reexamgagal ?></textarea>
	<textarea id="ujian_ke2" hidden="" name="ujian_ke2"><?= $json_ujian_ke2 ?></textarea>
	<textarea hidden="" name="nama"><?= $nama ?></textarea>
	<textarea id="isi" hidden="" name="isi"><?= $isi ?></textarea>
</form>
<form id='DownloadGoldSilver' method="POST" action="view_admin/excel-gold-silver.php">
	<textarea id="isi" hidden="" name="isi"><?= $json_lulus ?></textarea>
	<input type="hidden" name="param" value="<?= $gelombang ?>">
	<input type="hidden" name="start" value="<?= $start ?>">
	<input type="hidden" name="end" value="<?= $end ?>">
</form>
<form id='Download10persen' method="POST" action="view_admin/excel_report_10.php">
	<textarea id="user_name_10" hidden="" name="user_name_10"><?= $user_name_10 ?></textarea>
	<textarea id="nim_10" hidden="" name="nim_10"><?= $nim_10 ?></textarea>
	<textarea id="nilai_10" hidden="" name="nilai_10"><?= $nilai_10 ?></textarea>
	<textarea id="examheader" hidden="" name="examheader"><?= $json_header ?></textarea>
	<input type="hidden" name="param" value="<?= $per_customer ?>">
	<input type="hidden" name="start" value="<?= $start ?>">
	<input type="hidden" name="end" value="<?= $end ?>">
</form>
<form id='DownloadInvoice' method="POST" action="view_admin/excel-invoice.php">
	<textarea id="ujian_ke1" hidden="" name="ujian_ke1"><?= $json_ujian_ke1 ?></textarea>
	<textarea id="ujian_ke2" hidden="" name="ujian_ke2"><?= $json_ujian_ke2 ?></textarea>
	<textarea id="examheader" hidden="" name="examheader"><?= $json_header ?></textarea>
	<input type="hidden" name="param" value="<?= $gelombang ?>">
	<input type="hidden" name="start" value="<?= $start ?>">
	<input type="hidden" name="end" value="<?= $end ?>">
</form>
<form id='DownloadGelombang' method="POST" action="view_admin/excel-gelombang.php">
	<textarea id="lulus" hidden="" name="lulus"><?= $json_lulus ?></textarea>
	<textarea id="gagal" hidden="" name="gagal"><?= $json_gagal ?></textarea>
	<textarea id="ujian_ke2" hidden="" name="ujian_ke2"><?= $json_ujian_ke2 ?></textarea>
	<textarea id="examheader" hidden="" name="examheader"><?= $json_header ?></textarea>
	<input type="hidden" name="param" value="<?= $gelombang ?>">
	<input type="hidden" name="start" value="<?= $start ?>">
	<input type="hidden" name="end" value="<?= $end ?>">
</form>
<button onclick="goBack()" class="btn btn-sm btn-danger"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back </button>
<?php if ($dataCustomer[0] != 'C0061') : ?>
	<button onclick="getElementById('Download').submit()" class="btn btn-sm btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Download</button>
<?php endif ?>
<style>
	#batas {
		margin-bottom: 40px;
	}
</style>
<script>
	function goBack() {
		window.history.go(-1);
	}
</script>
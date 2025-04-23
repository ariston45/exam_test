<?php
/*
file version:20150804 14:00
*/
function randomsoal(){
	$sql="insert into test_jawaban select 1 session_id,'bejo' id_peserta,a.id_soal, @i:=@i+1 no_urut_soal,null from 
	(select session_id,id_soal from test_soal where session_id=1 order
	by rand()) a, (select @i:=0) b";
}

function getKodeUjian(){
	global $id_peserta;
	$kodeUjian="";
	$sql="SELECT * FROM `exam_participants` WHERE `id_student`='".$id_peserta."'";
	$rs=mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error($GLOBALS['link']));
	if ($row=mysqli_fetch_row($rs)){
		$kodeUjian=$row[1];
		//hapus data yang mempunyai kode ujian 02.2345.13.999
	}
	return $kodeUjian;
}

function userStarted(){
	global $id_peserta,$remainingtime,$token;
	$skrg=sqlFormatDate(date("d/m/Y H:i:s"),"%d/%m/%Y %H:%i:%s");
	$sql="select token,end_time,timediff(".$skrg.", start_time) elasped_time from session_ujian where id_peserta='".$id_peserta."'";
	$rs=mysqli_query($sql);
	if ($row=mysqli_fetch_row($rs)){
		if ($row[1] == null){
			$art=explode(":",$row[2]);
			$elapsed=intVal($art[0]) * 60 * 60;
			$elapsed+=intVal($art[1]) * 60;
			$elapsed+=intVal($art[2]);
			$remainingtime-=$elapsed;
			
			$token=generateToken();
			$sql="update session_ujian set token='".$token."' where id_peserta='".$id_peserta."'";
			mysqli_query($sql);
			//echo $remainingtime." - ".$elapsed;
			//echo "not ended";
		}else{
			//echo "ended";
			$remainingtime=0;
		}
		return true;
	}else{
		return false;
	}
}

function getRemainingTime(){
	/*if counter is server based
	global $kodeUjian,$remainingtime;
	$skrg=sqlFormatDate(date("d/m/Y H:i:s"),"%d/%m/%Y %H:%i:%s");
	$sql="select status,durasi,start_time,
		timediff(".$skrg.", start_time) elasped_time
		 from jadwal_ujian where kode_ujian='".$kodeUjian."'";
	$rs=mysqli_query($sql);
	$remainingtime=0;
	if ($row=mysqli_fetch_row($rs)){
		$statusUjian=$row[0];
		$remainingtime = $row[1] * 60;
		if ($statusUjian=="started"){
			$art=explode(":",$row[3]);
			$elapsed=intVal($art[0]) * 60 * 60;
			$elapsed+=intVal($art[1]) * 60;
			$elapsed+=intVal($art[2]);
			$remainingtime = ($row[1]*60) - $elapsed;
			//echo $remainingtime;
		}
	}
	*/
	global $remainingtime,$id_peserta,$kodeUjian;
	$sql="select durasi from jadwal_ujian where kode_ujian='".$kodeUjian."'";
	$rs=mysqli_query($sql);
	$durasi=60;
	//echo $sql;
	if ($row=mysqli_fetch_row($rs)){
		$durasi=$row[0];
	}
	$skrg=sqlFormatDate(date("d/m/Y H:i:s"),"%d/%m/%Y %H:%i:%s");
	$sql="select timediff(".$skrg.", start_time) elasped_time, ".$durasi." 
		 from session_ujian where id_peserta='".$id_peserta."'";
	$rs=mysqli_query($sql);
	$remainingtime=0;
	if ($row=mysqli_fetch_row($rs)){
		$art=explode(":",$row[0]);
		$elapsed=intVal($art[0]) * 60 * 60; //hour
		$elapsed+=intVal($art[1]) * 60; //minute
		$elapsed+=intVal($art[2]); //sec
		$remainingtime = ($row[1]*60) - $elapsed;
	}
	return $remainingtime;
}

function generateSession(){
	global $id_peserta, $kodeUjian;
	$token=generateToken();
	$sql="delete from session_ujian where id_peserta='".$id_peserta."'";
	mysqli_query($sql);
	$sql="insert into session_ujian(token,id_peserta,start_time,end_time) values(
				'".$token."',
				'".$id_peserta."',
				".sqlFormatDate(date("m/d/Y H:i")).",
				null)";
	mysqli_query($sql);
	return $token;
}

function generateSoal(){
	global $id_peserta, $kodeUjian,$easy,$medium,$hard,
		$jumlahSoal,$jumlahSoal_w,$jumlahSoal_e,$jumlahSoal_p,$kode_mapel;
	//komposisi,+mapel sekalian
	$sql="select b.easy,b.medium,b.hard,b.jumlah_soal,b.jumlah_soal_w,b.jumlah_soal_e,b.jumlah_soal_p, a.kode_mapel from jadwal_ujian a,komposisi_soal b where 
			a.kode_ujian = b.kode_ujian and
			a.kode_ujian='".$kodeUjian."'";
	$rs=mysqli_query($sql);
	if ($row=mysqli_fetch_row($rs)){
		$easy=$row[0];
		$medium=$row[1];
		$hard=$row[2];
		$jumlahSoal=$row[3];
		$jumlahSoal_w=$row[4];
		$jumlahSoal_e=$row[5];
		$jumlahSoal_p=$row[6];
		$kode_mapel=$row[7];
		//clean real... in case
		$sql="delete from soal_ujian_run where id_peserta='".$id_peserta."' and kode_ujian='".$kodeUjian."'";
		mysqli_query($sql);
		
		$n=generateSoalbyType('W',0);
		$n=generateSoalbyType('E',$n);
		$n=generateSoalbyType('P',$n);
		
		/*SHUFFLE URUTAN JAWABAN*/
		$sql="select id_soal,jawab_a,jawab_b,jawab_c,jawab_d,jawab_e,kunci from soal_ujian_run
				where kode_ujian='".$kodeUjian."' and id_peserta='".$id_peserta."'";
		$rs=mysqli_query($sql);
		$kunci[1]="A";$kunci[2]="B";$kunci[3]="C";$kunci[4]="D";$kunci[5]="E";
		$field_key[1]="A";$field_key[2]="B";$field_key[3]="C";$field_key[4]="D";$field_key[5]="E";
		while ($row=mysqli_fetch_row($rs)){
			$idxs = range(1, 5);
			shuffle($idxs);
			$i=1;
			foreach ($idxs as $idx) {
  	  	$jawab[$i] = $row[$idx];
  	  	if (strtoupper($row[6])==$field_key[$idx]){
  	  		$kunci_new=$kunci[$i];
  	  	}
  	  	$i++;
			}
			$sql="update soal_ujian_run set 
					jawab_a='".$jawab[1]."',
					jawab_b='".$jawab[2]."',
					jawab_c='".$jawab[3]."',
					jawab_d='".$jawab[4]."',
					jawab_e='".$jawab[5]."',
					kunci='".$kunci_new."'
					where id_soal='".$row[0]."' and kode_ujian='".$kodeUjian."' and id_peserta='".$id_peserta."'";
			//echo $sql."<br><br>";
			mysqli_query($sql);
		}
		/*======*&*&(&*(&*(#$%gfgdf$======*/
		if ($n==0){
			return 2; //error soal blm diupload
		}else{
			return 0;
		}
	}else{
		return 1; //echo "error! komposisi soal belum disiapkan!";
	}
}

function generateSoalbyType($tp,$last_ins_no){
	global $id_peserta, $kodeUjian,$easy,$medium,$hard,
		$jumlahSoal,$jumlahSoal_w,$jumlahSoal_e,$jumlahSoal_p,$kode_mapel;
	switch ($tp) {
		case "W":
			$n_easy = intVal($easy/100 * $jumlahSoal_w);
			$n_med = intVal($medium/100 * $jumlahSoal_w);
			$n_hard = $jumlahSoal_w - $n_easy - $n_med;
			$n_all = $jumlahSoal_w;
		break;
		case "E":
			$n_easy = intVal($easy/100 * $jumlahSoal_e);
			$n_med = intVal($medium/100 * $jumlahSoal_e);
			$n_hard = $jumlahSoal_e - $n_easy - $n_med;
			$n_all = $jumlahSoal_e;
		break;
		case "P":
			$n_easy = intVal($easy/100 * $jumlahSoal_p);
			$n_med = intVal($medium/100 * $jumlahSoal_p);
			$n_hard = $jumlahSoal_p - $n_easy - $n_med;
			$n_all = $jumlahSoal_p;
		break;
	}
	
	//insert random easy
	$sql="insert into soal_ujian_tmp(no_urut,kode_ujian,id_peserta,id_soal,pertanyaan,jawab_a,jawab_b,jawab_c,jawab_d,kunci,bobot,jawab_e,tipe_soal)
				select @i:=@i+1 no_urut,x.kode_ujian,x.id_peserta,x.id_soal, x.pertanyaan,x.jawab_a,x.jawab_b,x.jawab_c,x.jawab_d,x.kunci,x.bobot,x.jawab_e,x.tipe_soal
				from (
				select '".$kodeUjian."' kode_ujian,'".$id_peserta."' id_peserta,a.id id_soal, a.pertanyaan,a.jawab_a,a.jawab_b,a.jawab_c,a.jawab_d,a.kunci,a.bobot,a.jawab_e,a.tipe_soal from bank_soal a where a.kode_mapel='".$kode_mapel."' and upper(a.tipe_soal)='".$tp."' and a.bobot='1' order by rand(now())) x
				, (select @i:=0) y
				where @i+1<=".$n_easy;
	//echo $sql."<br><br>";
	mysqli_query($sql);
	//insert random medium
	$sql="insert into soal_ujian_tmp(no_urut,kode_ujian,id_peserta,id_soal,pertanyaan,jawab_a,jawab_b,jawab_c,jawab_d,kunci,bobot,jawab_e,tipe_soal)
				select @i:=@i+1 no_urut,x.kode_ujian,x.id_peserta,x.id_soal, x.pertanyaan,x.jawab_a,x.jawab_b,x.jawab_c,x.jawab_d,x.kunci,x.bobot,x.jawab_e,x.tipe_soal
				from (
				select '".$kodeUjian."' kode_ujian,'".$id_peserta."' id_peserta,a.id id_soal, a.pertanyaan,a.jawab_a,a.jawab_b,a.jawab_c,a.jawab_d,a.kunci,a.bobot,a.jawab_e,a.tipe_soal from bank_soal a where a.kode_mapel='".$kode_mapel."' and upper(a.tipe_soal)='".$tp."' and a.bobot='2' order by rand(now())) x
				, (select @i:=0) y
				where @i+1<=".$n_med;
	//echo $sql."<br><br>";				
	mysqli_query($sql);
	//insert random hard
	$sql="insert into soal_ujian_tmp(no_urut,kode_ujian,id_peserta,id_soal,pertanyaan,jawab_a,jawab_b,jawab_c,jawab_d,kunci,bobot,jawab_e,tipe_soal)
				select @i:=@i+1 no_urut,x.kode_ujian,x.id_peserta,x.id_soal, x.pertanyaan,x.jawab_a,x.jawab_b,x.jawab_c,x.jawab_d,x.kunci,x.bobot,x.jawab_e,x.tipe_soal
				from (
				select '".$kodeUjian."' kode_ujian,'".$id_peserta."' id_peserta,a.id id_soal, a.pertanyaan,a.jawab_a,a.jawab_b,a.jawab_c,a.jawab_d,a.kunci,a.bobot,a.jawab_e,a.tipe_soal from bank_soal a where a.kode_mapel='".$kode_mapel."' and upper(a.tipe_soal)='".$tp."' and a.bobot='3' order by rand(now())) x
				, (select @i:=0) y
				where @i+1<=".$n_hard;
	//echo $sql."<br><br>";			
	mysqli_query($sql);
	//cek jumlah soal
	$sql="select count(*) from soal_ujian_tmp where id_peserta='".$id_peserta."' and kode_ujian='".$kodeUjian."'";
	$rs=mysqli_query($sql);
	$row=mysqli_fetch_row($rs);
	//echo $sql."<br><br>";
	if ($row[0] < $jumlahSoal){
		$kurang = $n_all - $row[0];
		//insert kurangnya, random any
		$sql="insert into soal_ujian_tmp(no_urut,kode_ujian,id_peserta,id_soal,pertanyaan,jawab_a,jawab_b,jawab_c,jawab_d,kunci,bobot,jawab_e,tipe_soal)
				select @i:=@i+1 no_urut,x.kode_ujian,x.id_peserta,x.id_soal, x.pertanyaan,x.jawab_a,x.jawab_b,x.jawab_c,x.jawab_d,x.kunci,x.bobot,x.jawab_e,x.tipe_soal
				from (
				select '".$kodeUjian."' kode_ujian,'".$id_peserta."' id_peserta,a.id id_soal, a.pertanyaan,a.jawab_a,a.jawab_b,a.jawab_c,a.jawab_d,a.kunci,a.bobot,a.jawab_e,a.tipe_soal from bank_soal a where a.kode_mapel='".$kode_mapel."' and upper(a.tipe_soal)='".$tp."' 
				and a.id not in(
					select id_soal from soal_ujian_tmp where kode_ujian='".$kodeUjian."' and id_peserta='".$id_peserta."'
				)
				order by rand(now())) x
				, (select @i:=0) y
				where @i+1<=".$kurang;
	//echo $sql."<br><br>";
	mysqli_query($sql);
	}
	
	//copy to real table
	$sql="insert into soal_ujian_run(no_urut,kode_ujian,id_peserta,id_soal,pertanyaan,jawab_a,jawab_b,jawab_c,jawab_d,kunci,bobot,jawab_e,tipe_soal)
			select @i:=@i+1,x.kode_ujian,x.id_peserta,x.id_soal,x.pertanyaan,x.jawab_a,x.jawab_b,x.jawab_c,x.jawab_d,x.kunci,x.bobot,x.jawab_e,x.tipe_soal from
			(
			select a.kode_ujian,a.id_peserta,a.id_soal,a.pertanyaan,a.jawab_a,a.jawab_b,a.jawab_c,a.jawab_d,a.kunci,a.bobot,a.jawab_e,a.tipe_soal 
			from soal_ujian_tmp a
			where a.kode_ujian='".$kodeUjian."' and a.id_peserta='".$id_peserta."' order by rand(now())
			) x,(select @i:=".$last_ins_no.") y";
	//echo $sql."<br><br>";		
	mysqli_query($sql);
	
	//clean tmp table
	$sql="delete from soal_ujian_tmp where id_peserta='".$id_peserta."' and kode_ujian='".$kodeUjian."'";
	mysqli_query($sql);
	
	//get last_ins_no
	$sql="select ifnull(max(no_urut),0) from soal_ujian_run where kode_ujian='".$kodeUjian."' and id_peserta='".$id_peserta."'";
	$rs=mysqli_query($sql);
	$row=mysqli_fetch_row($rs);
	$last_ins_no = $row[0];
	return $last_ins_no;
}

function printPleaseWaitPage($startbutton_state){
	global $id_peserta, $user_name,$kodeUjian,$user_id;
	echo "<div align=\"center\">";
	echo "	<div id=\"bgwaitdiv\">";
	echo "		<form name=\"fujian\" method=\"post\" action=\"\">";
	echo "			<input type=\"hidden\" name=\"cmd\" value=\"start\">";
	echo "			<input type=\"hidden\" name=\"id_peserta\" value=\"".$id_peserta."\">";
	echo "			<input type=\"hidden\" name=\"user_name\" value=\"".$user_name."\">";
	echo "			<input type=\"hidden\" name=\"user_id\" value=\"".$user_id."\">";
	echo "			<input type=\"hidden\" name=\"kodeUjian\" value=\"".$kodeUjian."\">";
	echo "			<div id=\"btstartdiv\">
									<input id=\"btstart\" name=\"btstart\" type=\"submit\" value=\"Start Exam\" ".$startbutton_state.">
									<input id=\"btlogout\" name=\"btlogout\" type=\"button\" value=\"Logout\" onclick=\"javascript:logout();\">
							</div>";
	echo "		</form>";
	echo "	</div>";
	echo "</div>";
	$script = "<script>
					$(function(){
						$( \"#btstart\" ).button();
						$( \"#btlogout\" ).button();
					})
					</script>
					<script language=\"javascript\">
					function logout(){
						location.href='logout.php';
					}
					function autorefresh(){
						document.fujian.cmd.value='cekKodeUjian';
						document.fujian.submit();
					}
					setTimeout(autorefresh,10000);
					</script>
	`";
	
	echo $script;
}

function viewSoal(){
	global $id_peserta,$user_name,$token,$kodeUjian,$nomorSoal,$remainingtime,$user_id;
	$sql="select count(*) from soal_ujian_run ";
	$sql.=" where id_peserta='".$id_peserta."' and kode_ujian='".$kodeUjian."'";
	$rs=mysqli_query($sql);
	$jumlahSoal=0;
	if ($row=mysqli_fetch_row($rs)){
		$jumlahSoal=$row[0];
	}else{
		echo "error! soal tidak tersedia!";
		die();
	}
	
	if ($jumlahSoal==0){
		echo "error! soal tidak tersedia!";
		die();
	}
	$sql="select no_urut,pertanyaan,jawab_a,jawab_b,jawab_c,jawab_d,jawab_e,bobot,jawaban from soal_ujian_run ";
	$sql.=" where id_peserta='".$id_peserta."' and kode_ujian='".$kodeUjian."' and no_urut='".$nomorSoal."'";
	$rs=mysqli_query($sql);
	if ($row=mysqli_fetch_row($rs)){
		//wrap jawaban
		$jawab_a=wordwrap($jawab_a, 20, "<br>",true);
		$jawab_b=wordwrap($jawab_b, 20, "<br>",true);
		$jawab_c=wordwrap($jawab_c, 20, "<br>",true);
		$jawab_d=wordwrap($jawab_d, 20, "<br>",true);
		$jawab_e=wordwrap($jawab_e, 20, "<br>",true);
		
		$pertanyaan=$row[1];
		$cari="<img src=\"";
		$rplwith="<img style=\"max-width:550px; border:1px solid green; cursor:pointer;\" 
							onclick=\"javascript:ngepop(this.src,10,10,900,600,1);\"	
							src=\"".$GLOBALS["img-soal-dir"];
		$pertanyaan=str_replace($cari,$rplwith,$pertanyaan);
		$jawab_a=$row[2];
		$jawab_a=str_replace($cari,$rplwith,$jawab_a);
		$jawab_b=$row[3];
		$jawab_b=str_replace($cari,$rplwith,$jawab_b);
		$jawab_c=$row[4];
		$jawab_c=str_replace($cari,$rplwith,$jawab_c);
		$jawab_d=$row[5];
		$jawab_d=str_replace($cari,$rplwith,$jawab_d);
		$jawab_e=$row[6];
		$jawab_e=str_replace($cari,$rplwith,$jawab_e);
		$bobot=$row[7];
		$jawaban=$row[8];
		$time_menit=intVal($remainingtime/60);
		$time_detik=$remainingtime % 60;
		echo "<div id=\"exam_page\">
	<div id=\"exam_h\">
		<img src=\"img/exam_on_H.png\">
	</div>";
		echo "<form name=\"fsoal\" method=\"post\" action=\"\">";
		echo "<input type=\"hidden\" name=\"token\" value=\"".$token."\">";
		echo "<input type=\"hidden\" name=\"cmd\" value=\"jawab\">";
		echo "<input type=\"hidden\" name=\"cmd2\" value=\"next\">";
		echo "<input type=\"hidden\" name=\"nomorSoal\" value=\"".$nomorSoal."\">";
		echo "<input type=\"hidden\" name=\"jumlahSoal\" value=\"".$jumlahSoal."\">";
		echo "<input type=\"hidden\" name=\"kodeUjian\" value=\"".$kodeUjian."\">";
		echo "<input type=\"hidden\" name=\"id_peserta\" value=\"".$id_peserta."\">";
		echo "<input type=\"hidden\" name=\"user_name\" value=\"".$user_name."\">";
		echo "<input type=\"hidden\" name=\"user_id\" value=\"".$user_id."\">";
		echo "<div align=\"center\">";
		
		echo "<div id=\"customsoal\" >";
		echo "<table>";
		echo "<thead>";
		echo "<tr class=\"headinfo\">";
		echo "<th width=\"150\" align=\"left\">ID Peserta</th><th width=\"300\" align=\"left\">: ".$user_id."</th>";
		echo "<th width=\"150\" align=\"left\">Kode Ujian</th><th width=\"200\" align=\"left\">: ".$kodeUjian."</th>";
		echo "</tr>";
		echo "<tr class=\"headinfo\">";
		echo "<th align=\"left\">Nama Peserta</th><th align=\"left\">: ".$user_name."</th>";
		echo "<th align=\"left\">Waktu</th><th align=\"left\">: <input type=\"text\" id=\"menit\" name=\"menit\" value=\"".$time_menit."\"> menit <input type=\"text\" id=\"detik\" name=\"detik\" value=\"".$time_detik."\"> detik</th>";
		echo "</tr>";
		echo "</thead>";
		echo "</table>";
		echo "</div>";
		echo "<br>";
		echo "<div id=\"customsoal\">";
		echo "<table width=\"100%\">";
		echo "<thead>";
		echo "<tr>";
		echo "<th align=\"left\">No Soal:".$nomorSoal."/".$jumlahSoal."</th>";
		echo "<th align=\"right\">";
		if ($nomorSoal > 1){
			echo "<input type=\"button\" id=\"btprev\" name=\"btprev\" value=\"Sebelumnya\" onclick=\"javascript:jawab('prev');\">";
		}
		if ($nomorSoal < $jumlahSoal){
			echo "<input type=\"button\" id=\"btnext\" name=\"btnext\" value=\"Berikutnya\" onclick=\"javascript:jawab('next');\">";
		}
		echo "<input type=\"button\" id=\"btfinish\" name=\"btfinish\" value=\"Periksa Soal\" onclick=\"javascript:jawab('review');\">";
		echo "</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		echo "<tr>";
		echo "<td align=\"left\" valign=\"top\" width=\"70%\" height=\"200\">".$pertanyaan."</td>";
		echo "<td align=\"left\" valign=\"top\" width=\"30%\" style=\"border-left:1px dashed #009B4C\"><input type=\"radio\" name=\"jawaban\" ";
		if (strtoupper($jawaban)=="A"){echo " checked ";}
		echo "value=\"A\">A. ".$jawab_a."<br>";
		echo "<input type=\"radio\" name=\"jawaban\" ";
		if (strtoupper($jawaban)=="B"){echo " checked ";}
		echo "value=\"B\">B. ".$jawab_b."<br>";
		echo "<input type=\"radio\" name=\"jawaban\" ";
		if (strtoupper($jawaban)=="C"){echo " checked ";}
		echo "value=\"C\">C. ".$jawab_c."<br>";
		echo "<input type=\"radio\" name=\"jawaban\" ";
		if (strtoupper($jawaban)=="D"){echo " checked ";}
		echo "value=\"D\">D. ".$jawab_d."<br>";
		echo "<input type=\"radio\" name=\"jawaban\" ";
		if (strtoupper($jawaban)=="E"){echo " checked ";}
		echo "value=\"E\">E. ".$jawab_e."<br>";
		echo "</td>";
		echo "</tr>";
		echo "</tbody>";
		/*
		echo "<tfoot>";
		echo "<td colspan=\"2\" align=\"right\">";
		if ($nomorSoal > 1){
			echo "<input type=\"button\" id=\"btprev\" name=\"btprev\" value=\"Sebelumnya\" onclick=\"javascript:jawab('prev');\">";
		}
		if ($nomorSoal < $jumlahSoal){
			echo "<input type=\"button\" id=\"btnext\" name=\"btnext\" value=\"Berikutnya\" onclick=\"javascript:jawab('next');\">";
		}
		echo "<input type=\"button\" id=\"btfinish\" name=\"btfinish\" value=\"Selesai\" onclick=\"javascript:jawab('review');\">";
		echo "</td>";
		echo "</tfoot>";
		*/
		echo "</table>";
		echo "</div>";
		
		echo "</div>";
		echo "</form>";
		
		echo "<br>";
		echo "	<div id=\"exam_f\">
		<img src=\"img/exam_on_F.png\">
	</div>
</div>";
		
		$JQui="<script>
		$(function(){
			$( \"#btprev\" ).button();
			$( \"#btnext\" ).button();
			$( \"#btfinish\" ).button();
		})
		</script>
		";
		echo $JQui;
		$js="<script language=\"javascript\">
		function jawab(cmd2){
			if (cmd2=='selesai'){
				if (!confirm('are you sure?')){
					return;
				}
			}
			document.fsoal.cmd.value='jawab';
			document.fsoal.cmd2.value=cmd2;
			document.fsoal.submit();
		}
		</script>
		";
		echo $js;
	}
}

function startCounter(){
	global $remainingtime;
	$menit = intVal($remainingtime/60);
	$detik = $remainingtime % 60;
	$js="
		<script language=\"javascript\">
		var menit=".$menit.";
		var detik=".$detik.";
		var habis=false;
		function hitungmundur(){
			document.fsoal.menit.value=menit;
			document.fsoal.detik.value=detik;
			detik--;
			if (detik==-1){
				detik=59;
				menit--;
				if (menit<0){
					habis=true;
					alert(\"Waktu habis!\");
					document.fsoal.cmd.value='jawab';
					document.fsoal.cmd2.value='selesai';
					document.fsoal.submit();
				}
			}
			if (!habis){
				setTimeout(hitungmundur,1000);
			}
		}
		hitungmundur();
		</script>
	";
	echo $js;
}

function validateToken(){
	global $id_peserta,$token,$remainingtime;
	$sql="select * from session_ujian where id_peserta='".$id_peserta."' and token='".$token."'";
	
	$rs=mysqli_query($sql);
	if ($row=mysqli_fetch_row($rs)){
		//update remaining time
		$sql="update session_ujian set remaining_time='".$remainingtime."' where id_peserta='".$id_peserta."' and token='".$token."'";
		mysqli_query($sql);
		return true;
	}else{
		
		return false;
	}
}

function updateJawaban(){
	global $id_peserta,$kodeUjian,$nomorSoal,$jawaban;
	//update jawaban
	$sql="update soal_ujian_run set jawaban='".$jawaban."' where id_peserta='".$id_peserta."' and kode_ujian='".$kodeUjian."' and 
				no_urut='".$nomorSoal."'";
	mysqli_query($sql);
}

function endSession(){
	global $id_peserta,$token,$user_id;
	$sql="update session_ujian set end_time=".sqlFormatDate(date("m/d/Y H:i"),"%m/%d/%Y %H:%i")."
				 where id_peserta='".$id_peserta."' and token='".$token."'";
	//echo $sql;
	mysqli_query($sql);
	//move jawaban from run
	$sql="insert into soal_ujian select * from soal_ujian_run where id_peserta='".$id_peserta."'";
	mysqli_query($sql);
	$sql="delete from soal_ujian_run where id_peserta='".$id_peserta."'";
	mysqli_query($sql);
	
	logoutLog($user_id);
	$_SESSION["user_id"]="";
	$_SESSION["id_peserta"]="";
	$_SESSION["user_name"]="";
	$_SESSION["user_group"]="";
}

function viewResult(){
	global $kodeUjian,$id_peserta,$user_name,$user_id;
	$sql="select persen_lulus from jadwal_ujian where kode_ujian='".$kodeUjian."'";
	$rs=mysqli_query($sql);
	$row=mysqli_fetch_row($rs);
	$persen_lulus=$row[0];
	
	$sql="SELECT tipe_soal,sum( if( upper(jawaban) = upper(kunci), 1, 0 ) ) benar, count( * ) jumlahsoal
			FROM soal_ujian
			WHERE kode_ujian = '".$kodeUjian."'
			AND id_peserta = '".$id_peserta."'
			group by tipe_soal";
	$rs=mysqli_query($sql);
	$benar_e=0;$soal_e=0;
	$benar_w=0;$soal_w=0;
	$benar_p=0;$soal_p=0;
	$benar=0;$soal=0;
	while ($row=mysqli_fetch_row($rs)){
		$benar+=$row[1];
		$soal+=$row[2];
		switch (strtoupper($row[0])){
			case "E":
				$benar_e+=$row[1];
				$soal_e+=$row[2];
				$percent_e=number_format(($row[1]/$row[2]*100),2)."%";
			break;
			case "W":
				$benar_w+=$row[1];
				$soal_w+=$row[2];
				$percent_w=number_format(($row[1]/$row[2]*100),2)."%";
			break;
			case "P":
				$benar_p+=$row[1];
				$soal_p+=$row[2];
				$percent_p=number_format(($row[1]/$row[2]*100),2)."%";
			break;
		}
	}
	$percent=$benar/$soal*100;
	//echo $percent."/".$persen_lulus."<br>";
	if ($percent >= $persen_lulus){
		$lulus=" (LULUS)";
		$berhasil=true;
	}else{
		$lulus=" (<font color=\"red\">TIDAK LULUS!</font>)";
		$berhasil=false;
	}
	
	echo "<div align=\"center\">";
	echo "<div id=\"bgresultdiv\">";
	echo "<div id=\"resultdiv\">";
	echo "<table>";
	echo "<thead>";
	echo "<tr><th>NAMA/ID </th><th>: ".$user_name." / ".$user_id."</th></tr>";
	echo "<tr><th>RESULT </th><th>: ".number_format($percent,2)."%".$lulus."</th></tr>";
	echo "</thead>";
	echo "<tbody><tr><td>EXCEL </td><td>: ".$benar_e."/".$soal_e."(".$percent_e.")</td></tr>";
	echo "<tr><td>POWERPOINT </td><td>: ".$benar_p."/".$soal_p."(".$percent_p.")</td></tr>";
	echo "<tr><td>WORD </td><td>: ".$benar_w."/".$soal_w."(".$percent_w.")</td></tr></tbody></table>";
	echo "</div>";
	echo "</div>";
	echo "<br>";
	echo "<input type=\"button\" id=\"btlogout\" name=\"btlogout\" value=\"LOGOUT\" onclick=\"javascript:logout();\">";
	//echo "<div id=\"logoutctr\">Anda akan otomatis logout dalam 5 Menit</div>";
	echo "</div>";
	$script = "<script>
					$(function(){
						$( \"#btlogout\" ).button();
					})
					</script>
					<script language=\"javascript\">
					function logout(){
						location.href='logout.php';
					}
					</script>
					<style>
					#btlogout {
  					padding:0;
  					width:120;
  					height:30;
  					font-size:16px;
  				}
					</style>";
	echo $script;
	
	$ctrscript="
	<script language=\"javascript\">
		var menit=5;
		var detik=0;
		var habis=false;
		function hitungmundur(){
			//document.getElementById('logoutctr').innerHTML='Anda akan otomatis logout dalam '+menit+' Menit '+detik+' detik';
			detik--;
			if (detik==-1){
				detik=59;
				menit--;
				if (menit<0){
					habis=true;
					location.href='logout.php';
				}
			}
			if (!habis){
				setTimeout(hitungmundur,1000);
			}
		}
		hitungmundur();
		</script>
	";
	echo $ctrscript;
	return $berhasil;
}

function viewJadwal(){
	/*
	$cmd=$_POST["cmd"];
	$id_peserta=$_POST["id_peserta"];
	//echo "peserta".$id_peserta;
	$user_name=$_POST["user_name"];
	*/
	global $id_peserta,$user_name,$user_id;
	$kelas="";
	if (isset($_POST["kelas"])){
		$kelas=$_POST["kelas"];
	}
	$sql="select kelas from kelas order by kelas";
	$rs=mysqli_query($sql);
	echo "<form name=\"fpilihkelas\" method=\"post\" action=\"\">";
	echo "<input type=\"hidden\" name=\"id_peserta\" value=\"".$id_peserta."\">";
	echo "<input type=\"hidden\" name=\"user_name\" value=\"".$user_name."\">";
	echo "<input type=\"hidden\" name=\"user_id\" value=\"".$user_id."\">";
	echo "<input type=\"hidden\" name=\"cmd\" value=\"cekKodeUjian\">";
	echo "<input type=\"hidden\" name=\"cmd2\" value=\"\">";
	echo "<div align=\"center\" id=\"bgpilihjadwal\">";
	echo "<table id=\"tblpilihjadwal\"><tr><td>";
	echo "<div id=\"pilihjadwaldiv\" class=\"datagrid\">";
	echo "<table><tr><td>";
	echo "Kelas : </td><td><select name=\"kelas\" id=\"kelas\">";
	echo "<option value=\"\">-Pilih Kelas-</option>";
	while ($row=mysqli_fetch_row($rs)){
		echo "<option value=\"".$row[0]."\"";
		if ($row[0]==$kelas){
			echo " selected ";
		}
		echo ">".$row[0]."</option>";
	}
	echo "</select></td></tr></table><br><br>";
	$x=listJadwal($kelas);
	echo "<br><hr><div align=\"right\">";
	if ($x!=0){
		echo "<input type=\"button\" id=\"btpilihjadwal\" name=\"btpilihjadwal\" value=\"Pilih Jadwal\" onclick=\"javascript:pilihjadwal();\"> ";
	}
	echo "<input type=\"button\" id=\"btlogout\" name=\"btlogout\" value=\"Batal\" onclick=\"javascript:batal();\"> ";
	echo "</div>";
	echo "</div>";
	echo "</td></tr></table>";
	echo "</div>";
	echo "</form>";
	echo "<style>
	
	#tblpilihjadwal{
		border:0px;
		width:50%;
		height:100%;
		v-align:middle;
		text-align:center;
	}
		
	#pilihjadwaldiv {
		padding:20px;
		position:relative;
  	align:center;
  	background:#fff;
  	border:1px solid #069;
		-webkit-border-radius:3px;
		-moz-border-radius:3px;
		border-radius:3px;
  }
  #pilihjadwaldiv {
	
	</style>
	";
	
	echo "<script>
	$(function(){
		$( \"#btpilihjadwal\" ).button();
		$( \"#btlogout\" ).button();
		$( \"#kelas\" ).selectmenu();
		$( \"#kelas\").on(\"selectmenuchange\",function(){
			selectkelas()
			});
	})
	</script>
	";
	
	echo "<script language=\"javascript\">
		function selectkelas(){
			document.fpilihkelas.cmd2.value='';
			document.fpilihkelas.submit();
		}
		function pilihjadwal(){
			document.fpilihkelas.cmd2.value='pilihJadwal';
			document.fpilihkelas.submit();
		}
		function batal(){
			location.href='logout.php';
		}
	</script>
	";
}

function listJadwal($kelas){
	$sql="select a.kode_ujian,a.tanggal,a.kelas,b.nama_group,a.status 
	from jadwal_ujian a left join group_ujian b on a.kode_ujian = b.kode_ujian 
	where a.kelas='".$kelas."' 
	and a.tanggal>".sqlFormatDate(date("d/m/Y H:i"),"%d/%m/%Y %H:%i")." order by tanggal";
	$rs=mysqli_query($sql);
	$i=0;$checked=false;
	while ($row=mysqli_fetch_row($rs)){
		$i++;
		if ($i==1){
			echo "<table><thead><tr>";
			echo "<th>KODE UJIAN</th>";
			echo "<th>TANGGAL</th>";
			echo "<th>KELAS</th>";
			echo "<th>GROUP</th>";
			echo "<th>STATUS</th>";
			echo "<th>PILIHAN</th>";
			echo "</tr></thead>";
		}
		$class=" class=\"alt\" ";
		if ($i % 2){
			$class="";
		}
		echo "<tr ".$class.">";
		echo "<td>".$row[0]."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td>".$row[2]."</td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "<td><input type=\"radio\" name=\"kode_ujian\" value=\"".$row[0]."\"";
		if ($row[4]=="init") {
			if (!$checked){
				echo " checked ";
				$checked=true;	
			}
		}else{
			echo " disabled ";
		}
		echo "></td>";
		echo "</tr>";
	}
	if ($i>0){
		echo "</table>";
	}
	if ($checked){
		return 1;
	}else{
		return 0;
	}
}
function pilihJadwal(){
	global $id_peserta,$user_name,$user_id;
	$kode_ujian = $_GET['uri'];
	//$kode_ujian=$_POST["kode_ujian"];
	if (($kode_ujian!="")){
		$sql="insert into peserta_ujian(kode_ujian,id_peserta) values ('".$kode_ujian."','".$id_peserta."')";
		mysqli_query($sql);
	}
		//header('location:halaman_ujian.php');
		echo "<form method=\"post\" name=\"fpj\" action=\"\">";
		echo "<input type=\"hidden\" name=\"id_peserta\" value=\"".$id_peserta."\">";
		echo "<input type=\"hidden\" name=\"user_name\" value=\"".$user_name."\">";
		echo "<input type=\"hidden\" name=\"user_id\" value=\"".$user_id."\">";
		echo "<input type=\"hidden\" name=\"cmd\" value=\"cekKodeUjian\">";
		echo "</form>";
		echo "<script language=\"javascript\">
		document.fpj.submit();
		</script>
		";
	
}

function reviewJawaban(){
	global $id_peserta,$user_name,$token,$kodeUjian,$jumlahSoal,$user_id;
	$maxrow=20;
	$sql="select no_urut,jawaban from soal_ujian_run where kode_ujian='".$kodeUjian."' and id_peserta='".$id_peserta."' order by no_urut";
	$rs=mysqli_query($sql);
	$i=0;
	$jwb[0]="";
	while ($row=mysqli_fetch_row($rs)){
		$i++;
		$jwb[$i]=$row[1];
	}
	$kolom = intVal($i/$maxrow);
	if ($i % $maxrow != 0){
		$kolom++;
	}
	
	echo "<div align=\"center\">";
	echo "<div id=\"bgreviewdiv\">";
	echo "<br><br>";
	echo "<div class=\"datagrid\" style=\"width:90%;\">";
	echo "<h1>Review Jawaban anda, klik Selesai jika sudah yakin benar, atau klik nomor soal untuk kembali kehalaman soal.</h1>";
	echo "<table>";
	echo "<thead><tr>";
	for ($x=1; $x <= $kolom; $x++){
		echo "<th>No</th><th>Jawaban</th>";
	}
	echo "</tr></thead>";
	echo "<tbody>";
	for ($y=1; $y<=$maxrow; $y++){
		if ($y % 2){
			echo "<tr>";
		}else{
			echo "<tr class=\"alt\">";
		}
		for ($x=1; $x<=$kolom; $x++){
			$no=(($x-1)*$maxrow)+$y;
			echo "<td>";
			if ($no<=$i){
				echo "<a href=\"javascript:viewsoal(".$no.");\">".$no."</a>";
			}else{
				echo "&nbsp;";
			}
			echo "</td>";
			echo "<td>";
			if ($no<=$i){
				echo $jwb[$no];
			}else{
				echo "&nbsp;";
			}
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table>";
	echo "</div>";
	echo "<br><input type=\"button\" id=\"btselesai\" value=\"selesai\" onclick=\"javascript:selesai();\">";
	echo "</div>";
	echo "</div>";
	
	echo "<form name=\"fsoal\" method=\"post\" action=\"\">";
		echo "<input type=\"hidden\" name=\"token\" value=\"".$token."\">";
		echo "<input type=\"hidden\" name=\"cmd\" value=\"jawab\">";
		echo "<input type=\"hidden\" name=\"cmd2\" value=\"viewsoal\">";
		echo "<input type=\"hidden\" name=\"nomorSoal\" value=\"\">";
		echo "<input type=\"hidden\" name=\"kodeUjian\" value=\"".$kodeUjian."\">";
		echo "<input type=\"hidden\" name=\"id_peserta\" value=\"".$id_peserta."\">";
		echo "<input type=\"hidden\" name=\"user_name\" value=\"".$user_name."\">";
		echo "<input type=\"hidden\" name=\"user_id\" value=\"".$user_id."\">";
		echo "<input type=\"hidden\" name=\"jumlahSoal\" value=\"".$jumlahSoal."\">";
	echo "</form>";
	echo "
	<script language=\"javascript\">
	function viewsoal(x){
		document.fsoal.nomorSoal.value=x;
		document.fsoal.submit();
	}
	function selesai(){
		if (confirm('Apakah Anda benar-benar ingin mengakhiri Ujian?')){
			document.fsoal.cmd2.value='selesai';
			document.fsoal.submit();
		}
	}
	</script>
	";
	
	echo "
		<script>
			$(function(){
				$(\"#btselesai\").button();
			})
		</script>
		<style>
				#btselesai {
  			padding:0;
  			width:120;
  			height:30;
  			font-size:16px;
  		}
		</style>
	";
}

function activateNextId(){
	global $id_peserta,$user_id;
	$sql=" select id_peserta from user_test where user_id ='".$user_id."' and status=0 order by prioritas,id_peserta";
	$rs=mysqli_query($sql);
	if ($row=mysqli_fetch_row($rs)){
		$newid=$row[0];
		$eff_date=sqlFormatDate(date("m/d/y 00:00",strtotime("+1 day")));
		$sql="update user_test set status=1,eff_date=".$eff_date." where id_peserta='".$newid."'";
		mysqli_query($sql);
	}
}
?>
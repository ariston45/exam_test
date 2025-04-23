<link rel="icon" href="icon.ico">
<title>
Jurus
</title>
<body style="background: black;">
<?php
if(isset($_POST['qry_submit'])){
	$host=$_POST['host'];
	$user=$_POST['user'];
	$psw=$_POST['pwd'];
	$db=$_POST['db'];
	$link = mysql_connect($host,$user,$psw) or die('Unable to connect.') or die(mysql_error());
  	mysql_select_db($db) or die('unable to select db') or die(mysql_error());
	
	$user_auth = $_POST['customer'].'.99';
	
	//encrypt
	$newsalt = md5($user_auth);
    $pass = sha1(123 . $newsalt);
	$sqlUpdateAuth="UPDATE auth SET pword = '$pass' ,user_auth='$user_auth' WHERE id_auth = '".$_POST['id_auth']."' ";
	$res=mysql_query($sqlUpdateAuth);
	$sqlUpdateUser="UPDATE users SET id_user='$user_auth',cust_group='".$_POST['customer']."' WHERE id_user='".$_POST['id_user']."'";
	$res=mysql_query($sqlUpdateUser);
	
	
}
if (isset($_GET['host'])){
	if(isset($_GET['qry'])){
		$qry='>'.$_GET['qry'];
	} else{
		$qry='placeholder="masukan query">';
	}
	$pg=$_GET['pg'];
	$host=$_GET['host'];
	$user=$_GET['user'];
	$psw=$_GET['pwd'];
	$db=$_GET['db'];
	$link = mysql_connect($host,$user,$psw) or die('Unable to connect.') or die(mysql_error());
  	mysql_select_db($db) or die('unable to select db') or die(mysql_error());
} 
if(isset($host)){
	echo'
<form action="dashboard.php?pg=jurus" method="GET">
	<input type="hidden" id="asesor" name="pg" value='.$pg.'>
	<input type="hidden" id="asesor" name="host" value='.$host.' >
	<input type="hidden" id="asesor" name="user" value='.$user.' >
	<input type="hidden" id="asesor" name="pwd" value='.$psw.'>
	<input type="hidden" id="asesor" name="db" value='.$db.'>
	<textarea rows="4" cols="90" name = "qry" '.$qry.'</textarea> 
	<input type="submit" id="asesor" name="qry_submit" value="Submit" >
</form>
	 <a href="dashboard.php?pg=jurus"><button>Reset</button></a> 
	 <a href="dashboard.php?pg=jurus&host='.$host.'&user='.$user.'&pwd='.$psw.'&db='.$db.'"><button>New Query</button></a>
	';
	if($db=='db_exam'){
				echo '<a href="dashboard.php?pg=jurus&host='.$host.'&user='.$user.'&pwd='.$psw.'&db='.$db.'&qry=select+*+from+auth+a+inner+join+users+b+on+a.user_auth+%3D+b.id_user+where+a.uname+%3D+%27Tmp%27&qry_submit=Edit_User"><button>Edit User Tmp</button></a>' ;
	}
	if(isset($_GET['qry_submit']) and $_GET['qry_submit'] == 'Submit'){
		$sqlt=$_GET['qry'];
		$res=mysql_query($sqlt);
		$jml = mysql_num_rows ($res);
		if ($jml > 0){
			$var=mysql_fetch_assoc($res);
			$field = array_keys($var);
			$no = 1;
			//print_r($var);
			$n_field=count($field);
				echo'<table border = "1" style="color:white;"> <tr>
					<th> No </th>';

					for($i=0 ; $i<$n_field ; $i++){
						echo'<th>'.$field[$i].'</th>';
					}
					echo'</tr>';
				$res=mysql_query($sqlt);
				while ($var=mysql_fetch_row($res)) {
					//print_r($var);
					echo'<tr>
						<th>'.$no.'</th>';
					for($i=0 ; $i<$n_field ; $i++){
						echo'<td>'.$var[$i].'</td>';
					}
					echo'</tr>';
				$no++;
				}
			echo'</table>';
		} else {echo'<br> <h1> KOSONG </h1> ';}
	}else if(isset($_GET['qry_submit']) and $_GET['qry_submit'] == 'Edit_User'){
		$sqlt=$_GET['qry'];
		$res=mysql_query($sqlt);
		$var=mysql_fetch_assoc($res);
		$qrCustomer='Select * from customer ORDER BY cust_name asc';
		$rCustomer=mysql_query($qrCustomer);
		echo'
		<br>
		<br>
		<div style="height: 1px; background-color: #EAEFF5"></div>
		<br>
			<form method="POST">
			<input type="hidden" id="asesor" name="pg" value='.$pg.' >
			<input type="hidden" id="asesor" name="host" value='.$host.' >
			<input type="hidden" id="asesor" name="user" value='.$user.' >
			<input type="hidden" id="asesor" name="pwd" value='.$psw.'>
			<input type="hidden" id="asesor" name="db" value='.$db.'>
				<input type="text" id="asesor" name="id_auth" value='.$var["id_auth"].' readonly >
				<input type="text" id="asesor" name="id_user" value='.$var["user_auth"].' readonly><br><br>
				<select name="customer">
				';
				while($vCustomer = mysql_fetch_array($rCustomer)){
						echo "<option value='".$vCustomer[0]."'>".$vCustomer[1]."</option>";
					
				}
		echo'	</select>
				<br>
				<br>
				<input type="submit" id="asesor" name="qry_submit" value="Update" >
			</form>
				
				';
	}
} else {
?>
<form action = '' method ='GET'>
	<input type="hidden" id="asesor" name="pg" placeholder='host' value="jurus"><br>
	<input type="text" id="asesor" name="host" placeholder='host' value="127.0.0.1"><br>
	<input type="text" id="asesor" name="user" placeholder='user'><br>
	<input type="text" id="asesor" name="pwd" placeholder='password'><br>
	<input type="text" id="asesor" name="db" placeholder='database'><br>
	<input type="submit" id="asesor" name="submit" value='Connect'>
</form>
<?php
}
?></body>
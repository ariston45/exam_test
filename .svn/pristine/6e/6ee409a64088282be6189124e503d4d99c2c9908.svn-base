<?php
if (isset($_GET['CC'])) {
	$idSubject=$_GET['CC'];
}
if (isset($_POST['cmd'])) {
	switch ($_POST['cmd']) {
		case 'Submit':
			 $_SESSION["import_id"]=date("Ymd-His");
			 $subject = $_POST['subject'];
			 $pertanyaan = $_POST['pertanyaan'];
			 $gambar = $_POST['gambar'];
			 $opsi_a = $_POST['opsi_a'];
			 $opsi_b = $_POST['opsi_b'];
			 $opsi_c = $_POST['opsi_c'];
			 $opsi_d = $_POST['opsi_d'];
			 $opsi_e = $_POST['opsi_e'];
			 $kunci  = $_POST['kunci'];
			//upload gambar
			 $type = explode('.',$_FILES['gambar']['name']);
			 $idx= count($type);
			 $namaFile = $type[0].'-'.$_SESSION["import_id"].'.'.$type[($idx-1)];
			 $namaSementara = $_FILES['gambar']['tmp_name'];
			 $dirUpload = "../assets/img-soal/";
			 $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
			//mulai query 
			 if ($type[1]=='') {
			 	$img_source ='';
			 }else {
			 	$img_source="<img src=\"".$namaFile."\"><br>";
			 }
			 $into_fields="row_reff,kode_mapel,import_id,pertanyaan,	jawab_a,jawab_b,jawab_c,jawab_d,jawab_e,kunci";
			 $data = "1,'$subject','".$_SESSION['import_id']."','".sqlValue($pertanyaan.' '.$img_source)."','".sqlValue($opsi_a)."','".sqlValue($opsi_b)."','".sqlValue($opsi_c)."','".sqlValue($opsi_d)."','".sqlValue($opsi_e)."','$kunci'";
  			 $sql="insert into exam_source_tmp(".$into_fields.") values (".$data.")";
			 mysqli_query($GLOBALS['link'],$sql);
			 preview_soal();
			 print_finish_button();
			 //print_r($sql);
			break;
		case 'finish':
			finish_import();
			break;
	}
}
?>
<div class="row">
	<div class="col-lg-12">
		<h4><?php echo $_POST['cmd'] ;?></h4>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">Add Question</div>
			<div class="panel-body">
				<form role="form" id="add_cust" action="" method="POST" enctype="multipart/form-data">
			        	<div class="row">
			        		<div class="col-lg-12">
			        			<div class="form-group">
									<label>Subject Soal</label>
										<select class="form-control" name="subject">
											<?php	$result=showSubject();
												while($row = mysqli_fetch_array($result)){
													if ($idSubject==$row[0]) {
													 echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
													}else{
													 echo "<option value='".$row[0]."'>".$row[1]."</option>";
													}
												}
											?>
										</select>
								</div>
			        		</div>
			        		<div class="col-lg-9" 	>
					        	<div class="form-group">
									<label>Pertanyaan</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='pertanyaan' ></textarea>
								</div>
			        		</div>
			        		<div class="col-lg-3" 	>
								<div class="form-group">
									<label>Gambar Pertanyaan</label>
									<input type="file" name="gambar">
									<p class="help-block">Example block-level help text here.</p>
								</div>
			        		</div>
			         		<div class="col-lg-6">
			         			<div class="form-group">
									<label>Opsi A</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_a' ></textarea>
								</div>
								<div class="form-group">
									<label>Opsi B</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_b' ></textarea>
								</div>
			         		</div>
			         		<div class="col-lg-6">
			         			<div class="form-group">
									<label>Opsi C</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_c' ></textarea>
								</div>
								<div class="form-group">
									<label>Opsi D</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_d' ></textarea>
								</div>
								<div class="form-group">
									<label>Opsi E</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_e' ></textarea>
								</div>
			         		</div>
			         		<div class="col-lg-12" 	>
					        	<div class="form-group">
									<label>Kunci Jawaban</label>
									<input class="form-control" required="" name="kunci">
								</div>
			        		</div>
			         	</div>
			         	<div class="form-group" style="text-align: center;">
		<button class="btn btn-sm btn-danger" type="button" onclick="javascript:history.back()"><i class="fa fa-arrow-left" ></i> Back</button>
			         		
							<input type="Submit" class="btn btn-sm btn-primary" name="cmd" value="Submit">
							<input type="Reset" class="btn btn-sm btn-warning" name="reset" value="Reset">
						</div>
			    </form>
			</div>
		</div>
	</div>
</div>
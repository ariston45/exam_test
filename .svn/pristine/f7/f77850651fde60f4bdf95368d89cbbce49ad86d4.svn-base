<?php 
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
$id= $_GET['id'];
$rs= editQuestion($id);
$result = mysqli_fetch_array($rs);
$soal=explode("<img src=\"", $result[3]);
if ($soal[1]!=null) {
$img="<img class=\"zoom\" style=\"max-width:190px;\" src=\"../".$GLOBALS["img-soal-dir"].$soal[1];
	
}
?> 
			<div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Edit Question</h4>
			        </div>
			       <form role="form" action="" method="POST" enctype="multipart/form-data">
			    <div class="modal-body ">
			     	
			        	<div class="row">
			        		<div class="col-lg-12" 	>
					        	<div class="form-group">
									
									<div class="col-md-3">
										<div class="form-group">
										<label>Gambar Pertanyaan</label>
										<?=$img?>
										<input type="file" name="gambar">
									</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="hidden" name="gambar_lama" value='<?=$soal[1]?>'>
											<input type="hidden" name="id" value='<?=$result[0]?>'>
										<label>Pertanyaan</label>
										<textarea class="form-control" rows="4" cols="50" name='pertanyaan' ><?=$soal[0]?></textarea>
											<label>Kunci Jawaban</label>
											<input class="form-control"  name="kunci" value="<?=$result[9]?>">
										</div>
									</div>
									
									
								</div>
			        		</div>
			         		<div class="col-lg-6">
			         			<div class="form-group">
									<label>Opsi A</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_a' ><?=$result[4]?></textarea>
								</div>
								<div class="form-group">
									<label>Opsi B</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_b' ><?=$result[5]?></textarea>
								</div>
			         		</div>
			         		<div class="col-lg-6">
			         			<div class="form-group">
									<label>Opsi C</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_c' ><?=$result[6]?></textarea>
								</div>
								<div class="form-group">
									<label>Opsi D</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_d' ><?=$result[7]?></textarea>
								</div>
								<div class="form-group">
									<label>Opsi E</label>
									<textarea class="form-control" rows="3" cols="50" required="" name='opsi_e' ><?=$result[8]?></textarea>
								</div>
			         		</div>
			         	</div>

						
			         
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			            <input type="hidden" name="cmd" value="Update">
			            <input type="submit" class="btn btn-sm btn-success" value="Submit">
			        </div> 
			    </form>



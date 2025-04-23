<?php	
include "header.php"; 
if ($_SESSION["admin_group"]=="test admin"){
	include "startujian.php";
}
?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<!-- container -->
			<?php include $container;?>
	</div>

<?php
include "footer.php";
?>

			<!--======================-->
<div id="edit_akun" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
	  	<div class="fetched-data"></div>
	</div>
</div></div>
<script>
	$(document).ready(function(){
		$('#edit_akun').on('show.bs.modal', function (e) {
		var rowid = $(e.relatedTarget).data('id');
			$.ajax({
				type : 'get',
			  url  : 'edit_akun.php', //Here you will fetch records 
			  data : 'id='+ rowid, //Pass $id
			  success : function(data){
			  	$('.fetched-data').html(data);//Show fetched data from database
			  }
			});
		});
	});
</script>

</body>
</html>
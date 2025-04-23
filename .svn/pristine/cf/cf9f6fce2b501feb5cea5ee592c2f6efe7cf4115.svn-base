<?php
$today = timeVar();
$id_g = $_SESSION['admin_group'];
if (isset($_GET['CC'])) {
  $id=$_GET['CC'];
  $tokenRandom = generatePassword();
  $update = updateExamToken($tokenRandom,$id,$today[1]);
  //$status = updateStatus($id);
  echo "
<script type='text/javascript'>
$(document).ready(function(){
document.getElementById('token').innerHTML = '$tokenRandom';
$('#Show_token').modal('show');
});
</script>";
  //header('location:?pg=pic_exam');
}
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'Search':
      $valin = $_POST['valin'];
      break;
    default:
      # code...
      break;
  }
}?>
<div class="row">
  <div class="col-lg-12">
    <h4></h4>
  </div>
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Exam Create</div>
        <div class="panel-body">
          <div class="row"><?php
            $result=editExamVoucher($id_g);
              while ($row = mysqli_fetch_array($result)) {
                echo "
                  <div class=\"col-md-3\">
                    <div class=\"panel panel-info\" style=\"border: 1px solid #30a5ff;\">
                      <div class=\"panel-heading\">".$row[2]."</div>
                      <div class=\"panel-body\" style=\"text-align:center\">
                        <b>".$row[5]."</b><br>
                        Voucher : <b>".$row[3]."</b><br><br>";
                        if($row[3]==0){
                          if ($row[5]=='Postpaid') {
                          echo "<a href=\"?pg=ExA_create&CC=".$row[0]."\" class=\"btn btn-block btn-sm btn-danger\">Use</a>";
                          } else {
                          echo "<button type=\"button\" class=\"btn btn-block btn-sm btn-default\">Use</button>";
                          }
                        }else {
                          echo "<a href=\"?pg=ExA_create&CC=".$row[0]."\" class=\"btn btn-block btn-sm btn-danger\">Use</a>";
                        }
                        echo "<a href=\"?pg=pic_detail_voucher&id=".$row[0]."\" class=\"btn btn-block btn-sm btn-success\">View</a>";
                      echo"
                      </div>
                    </div>
                  </div>";
                }?>    
            </div>
          </div>
        </div>
      </div>
    </div>

<div id="Show_token" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Token Session</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="text-align: center;text-shadow: 0px -2px 2px #000;" >
          <h1 id='token' style="font-size: 75px;"></h1>
        </div>
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--======================-->
  <script src='../assets/js/jquery-1.12.0.min.js'></script>
  <script>
    $(document).ready(function() {
      $('#tbExam').DataTable({
        "columnDefs":[
          {"width": "2%", "targets":0},
          {"width": "15%", "targets":1},
          {"width": "8%", "targets":2}
        ]
      });
    });
    function show_token($tokenRandom){
      document.getElementById('token').innerHTML = $tokenRandom;
      $('#Show_token').modal('show');
    }
  </script>
      
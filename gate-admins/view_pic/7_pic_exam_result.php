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
      <div class="panel-heading">Exam Result (Exams at home)</div>
      <div class="panel-body">
              <h4>Exam</h4>
              <table class="table table-xs" id="tbExam">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Date</th>
                    <th scope="col">Proctor</th>
                    <th scope="col">Status</th>
                    <th scope="col">Participants</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>
                <tbody><?php
                $no = 1;
                $result=CovidshowExam($id_g,null);
                while($row = mysqli_fetch_array($result)){
                  
                  $dataParticpant = mysqli_num_rows(CovidlistExamParticipants($row[7]));
                  echo '
                  <tr>
                    <td>'.$no.'</td>
                    <td>'.date('d.M.Y', strtotime($row[1])).'</td>
                    <td>'.$row[3].'</td>
                    <td>'.$row[5].'</td>
                    <td>'.$dataParticpant.'</td>
                    <td>';
                    if ($row[5]!='init') {
                      $views = cekViewResult($id_g);
                      $view = mysqli_fetch_array($views);;
                      if ($view[2] != 0) {
                        echo '<a href="?pg=st_home_result_detail&CC='.$row[0].'"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-search-plus"></i>  View</button></a> ';
                      }else{
                        echo "<button class='btn btn-xs btn-default' disabled><i class='fa fa-search-plus'></i>  View</button>";
                      }
                    }
                    echo '</td>
                  </tr>';
                  $no++;
                }?> 
                </tbody>
              </table>
            </div>
          </div>
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
      
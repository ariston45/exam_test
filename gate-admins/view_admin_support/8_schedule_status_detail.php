<?php
$today = timeVar();
$id_g = $_SESSION['admin_group'];
if (isset($_GET['CC'])) {
  switch ($_GET['CC']) {
    case 'pause':
    $id=$_GET['raw'];
    $update = examPause($id);
      break;
    case 'continue':
    $id=$_GET['raw'];
    $update = examContinue($id);
      break;
    default:
    $id=$_GET['CC'];
    $tokenRandom = generatePassword();
    $update = updateExamToken($tokenRandom,$id,$today[1]);
      echo "
      <script type='text/javascript'>
      $(document).ready(function(){
      document.getElementById('token').innerHTML = '$tokenRandom';
      $('#Show_token').modal('show');
      });
      </script>";
      break;
  }

}
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'report':
      $listExam = $_POST['list'];
      $desc = $_POST['note'];
      $max = max(array_keys($listExam));
      foreach ($listExam as $key => $value) {
        if ($key==0) {
          $examCode=$value.',';
        }else if ($key==$max) {
          $examCode=$examCode.$value;
        }else{
          $examCode=$examCode.$value.',';
        }
      }
      reportAdmin($desc,$examCode,$_SESSION['admin_id'],$listExam);
      echo "
        <script>
          window.location.href = '?pg=exam_status';
        </script>
      ";
      break;
    default:
      # code...
      break;
  }
}
$cus = editCustomer($_GET['id_g']);
$dataCustomer = mysqli_fetch_array($cus);
?>
<div class="row">
  <div class="col-lg-12">
    <h4></h4>
  </div>
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">New Exam <?=$dataCustomer[1]?></div>
        <div class="panel-body">
              <form id="formReport" action="" method="POST">
             <table class="table table-xs" id="tbExam">
              <thead>
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Start</th>
                  <th scope="col">Status</th>
                  <th scope="col">Participant</th>
                  <th scope="col">#</th>
                </tr>
              </thead>
              <tbody><?php
              $no = 1;
              $result=showExamAdmin($_GET['id_g'],'AND a.notif = 0 AND SUBSTRING_INDEX(SUBSTRING_INDEX(b.group_name,".",2),".",-1) != "P0005"');
              while($row = mysqli_fetch_array($result)){
                echo '
                <tr>
                  <td>'.date('d.M.Y', strtotime($row[1])).'</td>
                  <td>'.$row[2].'</td>
                  <td> No Activity </td>
                  <td>'.$row[6].'</td>
                  <td><input type="checkbox" name="list[]" value="'.$row[0].'"></td>
                </tr>
                ';
                $no++;
              }?>
            </tbody>
          </table>
              </form>
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
				select: true,
        "columnDefs":[
          {"width": "30%", "targets":0},
          {"width": "25%", "targets":1},
          {"width": "18%", "targets":2}
        ],
        "lengthChange": false,
        "iDisplayLength": 25, 
        "searching": false,
        "ordering": false,
        "info" : false
      });
    });

    function show_token($tokenRandom){
      document.getElementById('token').innerHTML = $tokenRandom;
      $('#Show_token').modal('show');
    }
  </script>

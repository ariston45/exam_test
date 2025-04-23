<?php 
$today = timeVar();
$id_g = $_SESSION['admin_group'];
if (isset($_GET['CC'])) {
  $id=$_GET['CC'];
  $tokenRandom = generatePassword();
  $update = covidupdateExamToken($tokenRandom,$id,$today[1]);
  //$status = updateStatus($id);
  echo "
<script type='text/javascript'>
$(document).ready(function(){
document.getElementById('token').innerHTML = '$update';
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
      <div class="panel-heading">Exam Schedule (Exams at home)</div>
      <div class="panel-body">
              <h4>Exam</h4>
              <table class="table table-xs" id="tbExam">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Date</th>
                    <th scope="col">Proctor</th>
                    <th scope="col">Token</th>
                    <th scope="col">Status</th>
                    <th scope="col">Max. Participant</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>
                <tbody><?php
                $no = 1;
                $result=CovidshowExam($id_g,null);
                while($row = mysqli_fetch_array($result)){
                  if ($row[5]=='pause') {
                    $token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Hold</button>";
                   } else  if ( $row[4]!=null) {
                    $token="<button type=\"button\" class=\"btn btn-xs btn-block btn-warning \" onclick=\"show_token('$row[4]')\" >$row[4]</button>";
                  }else{
                      if ($row[1]==$today[0]) {
                        $token="<a href=\"?pg=st_home_schedule&CC=".$row[0]."\"><button type=\"button\" class=\"btn btn-xs btn-danger btn-block \"><i class=\"fa fa-key\"></i>  Generate</button></a>";
                        //$token="<button type=\"button\" onclick=\"generate_token(".$row[0].")\" class=\"btn btn-xs btn-danger btn-block \"><i class=\"fa fa-key\"></i>  Generate</button>";
                      } else {
                        if ($row[1]==$today[0] and $row[2]>$today[1]) {
                            $token="<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Not Ready</button>";
                        }else if ($row[1]>$today[0]) {
                            // $token="<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Not Ready</button>";
                          $token="<a href=\"?pg=st_home_schedule&CC=".$row[0]."\"><button  type=\"button\" class=\"btn btn-xs btn-danger btn-block \"><i class=\"fa fa-key\"></i>  Generate</button></a>";
                          // $token="<button onclick=\"generate_token('$row[0]')\"  type=\"button\" class=\"btn btn-xs btn-danger btn-block \"><i class=\"fa fa-key\"></i>  Generate</button>";
                        }else{
                            $token="<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Expired</button>";
                        }
                    }
                  }
                  $today = timeVar();
                  echo '
                  <tr>
                    <td>'.$no.'</td>
                    <td>'.date('d.M.Y', strtotime($row[1])).'</td>
                    <td>'.$row[3].'</td>
                    <td>'.$token.'</td>
                    <td>'.$row[5].'</td>
                    <td>'.$row[6].'</td>
                    <td>';
                    $expTime = date('H:i:s', strtotime("+15 minutes", strtotime($row[2])));
                    $expDate = date('Y-m-d');
                    if ($row[5]!='init') {
                      echo '<a href="?pg=st_home_sch_detail&CC='.$row[0].'"><button type="button" class="btn btn-xs btn-primary"><i class="fa fa-info-circle"></i>  Detail</button></a> ';
                    }else if ($row[5]=='init'AND $row[1]>=$today[0]) {
                       echo '<a href="?pg=st_home_exam_edit&CC='.$row[0].'"><button type="button" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>  Edit</button></a> ';
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
<div id="Show_warning_generate" class="modal fade">
  <div class="modal-dialog modal-warning">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Warning</h4>
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
          {"width": "12%", "targets":2}
        ]
      });
    });
    function show_token($tokenRandom){
      document.getElementById('token').innerHTML = $tokenRandom;
      $('#Show_token').modal('show');
    }
    function generate_token($tokenRandom){
      document.getElementById('token').innerHTML = $tokenRandom;
      $('#Show_warning_generate').modal('show');
    }
  </script>
      
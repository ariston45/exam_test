<?php
// die();
$today = timeVar();
$id_g = $_SESSION['admin_group'];
if (isset($_GET['CC'])) {
  switch ($_GET['CC']) {
    case 'pause':
      $id = $_GET['raw'];
      $update = examPause($id);
      break;
    case 'continue':
      $id = $_GET['raw'];
      $update = examContinue($id);
      break;
    default:
      $id = $_GET['CC'];
      $tokenRandom = generatePassword();
      $update = updateExamToken($tokenRandom, $id, $today[1]);
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
    case 'Search':
      $valin = $_POST['valin'];
      break;
    default:
      # code...
      break;
  }
} ?>
<div class="row">
  <div class="col-lg-12">
    <h4></h4>
  </div>
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Exam Schedule Master</div>
      <div class="panel-body">
        <table class="table table-xs" id="tbExam">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Customer</th>
              <th scope="col">Date</th>
              <th scope="col">Start</th>
              <th scope="col">Status</th>
              <th scope="col">Alocated</th>
              <th scope="col">Option</th>
            </tr>
          </thead>
          <tbody><?php
          $no = 1;
          $result = showAllExam($_SESSION["admin_group"]);
          while ($row = mysqli_fetch_array($result)) {
            if ($row[4] != null) {
              $token = "<button type=\"button\" class=\"btn btn-xs btn-block btn-warning \" onclick=\"show_token('$row[4]')\" >$row[4]</button>";
            } else {
              if (cekTimeSchedule($row[0])) {
                $token = "<a href=\"?pg=proc_exam&CC=" . $row[0] . "\"><button type=\"button\" class=\"btn btn-xs btn-danger btn-block \"><i class=\"fa fa-key\"></i>  Generate</button></a>";
              } else {
                if ($row[1] == $today[0] and $row[2] > $today[1]) {
                  $token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Not Ready</button>";
                } else if ($row[1] > $today[0]) {
                  $token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Not Ready</button>";
                } else {
                  $token = "<button type=\"button\" class=\"btn btn-xs btn-default btn-block \">Expired</button>";
                }
              }
            }
            echo '
                <tr>
                  <td>' . $no . '</td>
                  <td>' . $row[7] . '</td>
                  <td>' . date('d.M.Y', strtotime($row[1])) . '</td>
                  <td>' . $row[2] . '</td>
                  <td>';
            if ($row[5] == 'finish') {
              echo '<div style="">Finish</div>';
            } elseif ($row[5] == 'run') {
              echo '<div style="color:green;"><b><i class="fa fa-play"></i> Run</b></div>';
            } else {
              echo '<div style=""><b>Init</b></div>';
            }
            echo '</td>
                  <td>' . $row[6] . '</td>
                  <td><a href="?pg=schedule_detail&CC=' . $row[0] . '" class="btn btn-xs btn-primary"><i class="fa fa-info-circle"></i>  Detail</a> ';
            if ($row[5] != 'init') {
              echo '';
            }
            // if ($row[5]=='run') {
            //   echo ' <a href="?pg=schedule&CC=pause&raw='.$row[0]. '" class="btn btn-xs btn-warning"><i class="fa fa-pause"></i>  Hold</a>';
            // }
            // if ($row[5]=='pause') {
            //   echo '<a href="?pg=schedule&CC=continue&raw='.$row[0]. '" class="btn btn-xs btn-success"><i class="fa fa-play"></i>  Continue</a>';
            // }
            echo '</td></tr>';
            $no++;
          } ?>
          </tbody>
        </table>
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
        <div class="row" style="text-align: center;text-shadow: 0px -2px 2px #000;">
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
  $(document).ready(function () {
    $('#tbExam').DataTable({
      "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
      select: true,
      "columnDefs": [
        { "width": "2%", "targets": 0 },
        { "width": "8%", "targets": 2 },
        { "width": "8%", "targets": 3 },
        { "width": "8%", "targets": 4 },
        { "width": "8%", "targets": 5 },
        { "width": "8%", "targets": 6 }
      ]
    });
  });

  function show_token($tokenRandom) {
    document.getElementById('token').innerHTML = $tokenRandom;
    $('#Show_token').modal('show');
  }
</script>
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
?>
<style type="text/css">
  .notif{
    font-size: 9px;
    background: red;
    padding: 2px;
    border-radius: 4px;
    color: #fff;
    vertical-align: top;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <h4></h4>
  </div>
</div>
    <div class="row">
    <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">In Progress Report</div>
        <div class="panel-body">
          <table class="table table-xs table-bordered" id="tbReportPanding">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Last Update</th>
                  <th scope="col">History</th>
                </tr>
              </thead>
              <tbody><?php
              $no = 1;
              $result=showReportListAdmin('where status !="Sent"');
              while($row = mysqli_fetch_array($result)){
                $paramReport = paramReport($row[0]);
                echo '
                <tr>
                  <td>'.$no.'</td>
                  <td>'.$row[1].'</td>
                  <td>'.$row[2].'</td>
                  <td>'.$row[3].'</td>
                  <td><button class="btn btn-xs btn-primary" onclick="modalHistory('.$row[0].')"><i class="fa fa-info-circle"></i> Detail </button></td>
                </tr>
                ';
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

<div id="panel_update" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Status</h4>
      </div>
      <div class="modal-body">
        <form id="formUpdateReport" action="" method="POST">
          <input type="hidden" class="form-control" id="id_report" name="id_report">
          <input type="hidden" class="form-control" id="id_report" name="cmd" value="UpdateStatus">
          <label>Status</label>
          <select name="status" id="" class="form-control">
            <option value="Not Reported">Not Reported</option>
            <option value="Reporting">Reporting</option>
            <option value="Confirm Name">Confirm Name</option>
            <option value="Print Certificate">Print Certificate</option>
            <option value="Sent">Sent</option>
          </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('formUpdateReport').submit()">Submit</button>
      </div>
    </div>
  </div>
</div>
<div id="panel_history" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">History Report Status</h4>
      </div>
      <div class="modal-body">
        <div id="content_history"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <form id="formReport" action="?pg=admin_showReport" method="POST">
  <input type="hidden" id="date_start" name="date_start">
  <input type="hidden" id="date_end" name="date_end">
  <input type="hidden" id="cmd" name="cmd" value="exam">
  <input type="hidden" id="desc" name="desc">
  <textarea id="exam" name="exam" hidden="">
    
  </textarea>
</form>
   
<!--======================-->
  <script src='../assets/js/jquery-1.12.0.min.js'></script>
  <script>
    $(document).ready(function() {
      $('#tbExam').DataTable({
        select: true,
        "columnDefs":[
          {"width": "2%", "targets":0},
          {"width": "55%", "targets":1},
          {"width": "12%", "targets":2},
          {"width": "12%", "targets":3}
        ],
        "lengthChange": false,
        "iDisplayLength": 25,
        "ordering": false,
        "info" : false
      });
    });  
    $(document).ready(function() {
      $('#tbReportPanding').DataTable({
        select: true,
        "columnDefs":[
          {"width": "2%", "targets":0},
          {"width": "33%", "targets":1},
          {"width": "14%", "targets":2},
          {"width": "14%", "targets":3},
          {"width": "16%", "targets":4}
        ],
        "lengthChange": false,
        "iDisplayLength": 15, 
        "info" : false
      });
    }); 
    $(document).ready(function() {
      $('#tbReportFinish').DataTable({
        select: true,
        "columnDefs":[
         {"width": "2%", "targets":0},
          {"width": "39%", "targets":1},
          {"width": "8%", "targets":2},
          {"width": "14%", "targets":3},
          {"width": "16%", "targets":4}
        ]
      });
    });

    function modalUpdate($id_report){
      document.getElementById('id_report').value = $id_report;
      $('#panel_update').modal('show');
    }
    function modalHistory($id_report){
       $.ajax({
          type : 'get',
          url  : 'view_admin/help-report.php', //Here you will fetch records
          data : {id:$id_report,variable:'report_history'}, //Pass $id
          success :function(data){
              //alert(data);
              document.getElementById('content_history').innerHTML=data;
          }
        });
      $('#panel_history').modal('show');
    }
    function viewReport($date_start,$date_end,$description,$idv){
      var obj = { 0: $idv };
      var examCode = JSON.stringify(obj);
      document.getElementById('date_start').value=$date_start;
      document.getElementById('date_end').value=$date_end;
      document.getElementById('desc').value=$description;
      document.getElementById('exam').value=examCode;
      document.getElementById('formReport').submit();
    }
  </script>

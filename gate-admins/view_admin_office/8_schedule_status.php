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
    case 'UpdateStatus':
      $id = $_POST['id_report'];
      $status = $_POST['status'];
      updateStatusReport($id,$status);
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
      <div class="panel-heading">Exam Schedule</div>
        <div class="panel-body">
             <table class="table table-xs table-bordered" id="tbExam">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Last Exam</th>
                  <th scope="col">Detail</th>
                </tr>
              </thead>
              <tbody><?php
              $no = 1;
              $result=showCustomer();
              while($row = mysqli_fetch_array($result)){
                $flag = '';
                $exam = showExamAdmin($row[0],'AND a.status = "finish" AND a.notif = 0 AND SUBSTRING_INDEX(SUBSTRING_INDEX(b.group_name,".",2),".",-1) != "P0005" ORDER BY a.date asc ');
                while ($row_exam = mysqli_fetch_array($exam)) {
                  $last_Exam = $row_exam[1];
                  if ($row_exam[8]==0 AND $row_exam[8]!=null) {
                   $flag = '<l class="notif"> New ! </l>';
                  }
                }
                  
                  if ($flag!='') {
                  echo '
                <tr>
                  <td>'.$no.'</td>
                  <td>'.$row[1].' '.$flag.'</td>
                  <td>'.tanggal_indo($last_Exam).'</td>
                  <td> <a href="?pg=exam_status_detail&id_g='.$row[0].'" class="btn btn-xs btn-primary"><i class="fa fa-search-plus"></i> View</a></td></tr>';
                $no++;  
                  }
              }?>
            </tbody>
          </table>
          
          </div>
        </div>
      </div>
    </div>
    <div class="row">
    <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Report List</div>
        <div class="panel-body">
          <h4 >Pending Report</h4>
          <hr style=" margin-top: 0px;margin-bottom: 0px;   border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
          <table class="table table-xs table-bordered" id="tbReportPanding">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Last Update</th>
                  <th scope="col">Action</th>
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
                  <td>'.$row[2].' <button class="btn btn-xs btn-primary" onclick="modalHistory('.$row[0].')"><i class="fa fa-bars"></i></button> </td>
                  <td>'.$row[3].'</td>
                  <td> 
                       <button class="btn btn-xs btn-danger" onclick="modalUpdate('.$row[0].')" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Status</button>
                       <button class="btn btn-xs btn-success" onclick="viewReport(\''.$paramReport[0].'\',\''.$paramReport[1].'\',\''.$paramReport[2].'\',\''.$paramReport[3].'\',\''.$paramReport[4].'\')"><i class="fa fa-info-circle" aria-hidden="true"></i> Detaill</button>
                  </td>
                </tr>
                ';
                $no++;
              }?>
            </tbody>
          </table> 

          <br>          
          <hr style=" margin-top: 0px;margin-bottom: 0px;   border: 0;   height: 1px;    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(48, 165, 255), rgba(0, 0, 0, 0));">
          <h4 >Finish Report</h4>
          <table class="table table-xs table-bordered" id="tbReportFinish">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th>
                  <th scope="col">Last Update</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody><?php
              $no = 1;
              $result=showReportListAdmin('where status ="Sent"');
              while($row = mysqli_fetch_array($result)){
                $paramReport = paramReport($row[0]);
                echo '
                <tr>
                  <td>'.$no.'</td>
                  <td>'.$row[1].'</td>
                  <td>'.$row[2].' <button class="btn btn-xs btn-primary" onclick="modalHistory('.$row[0].')"><i class="fa fa-bars"></i></button></td>
                  <td>'.$row[3].'</td>
                  <td> 
                      <button class="btn btn-xs btn-danger" onclick="modalUpdate('.$row[0].')" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Status</button>
                      <button class="btn btn-xs btn-success" onclick="viewReport(\''.$paramReport[0].'\',\''.$paramReport[1].'\',\''.$paramReport[2].'\',\''.$paramReport[3].'\',\''.$paramReport[4].'\')"><i class="fa fa-info-circle" aria-hidden="true"></i> Detaill</button>
                  </td>
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
            <!-- <option value="Not Reported">Not Reported</option> -->
            <option value="Reporting">Reporting</option>
            <!-- <option value="Confirm Name">Confirm Name</option> -->
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
        "iDisplayLength": 15,
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
    function viewReport($date_start,$date_end,$description,$idv,$idcust){
      if ($idcust =='C0061') 
        document.getElementById('cmd').value='exam_ub';
      var obj = { 0: $idv };
      var examCode = JSON.stringify(obj);
      document.getElementById('date_start').value=$date_start;
      document.getElementById('date_end').value=$date_end;
      document.getElementById('desc').value=$description;
      document.getElementById('exam').value=examCode;
      document.getElementById('formReport').submit();
     

    }
  </script>

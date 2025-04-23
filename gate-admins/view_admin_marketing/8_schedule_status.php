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
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Not Yet Reported</div>
        <div class="panel-body">
             <table class="table table-xs table-bordered" id="tbExam">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Last Exam</th>
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
                      </tr>'; 
                    $no++;  
                  }
                 
               
              }?>
            </tbody>
          </table>
          
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
        "iDisplayLength": 25, 
        "ordering": false,
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

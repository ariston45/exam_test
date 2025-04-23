<?php
include "../cfg/general.php";
include "../control/inc_function.php";
include "../control/inc_function2.php";
include "view_exam_cmd.php";
connectdb();
//cek session ujian runing (durasi ujian)
$remainingtime=getRemainingTime();
if ($remainingtime<=0) {
  $time_menit=0;
  $time_detik=0;
} else {
  $time_menit=intVal($remainingtime/60);
  $time_detik=$remainingtime % 60;
}
$sql = "select a.idstudents, a.fname, b.logo from students a inner join customer b on SUBSTRING_INDEX(a.our_id,'.','1') = b.id_customer where a.idstudents = '".$_SESSION['user_id']."' ";
$rs=mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error($GLOBALS['link']));
$result = mysqli_fetch_row($rs);
$logo=$result[2];
//update jawaban ujian
if (isset($_POST['no'])) {
  $act=$_POST['act'];
  switch ($act) {
     case 'SetAnswer':
      $no = $_POST['no'];
      $nomorSoal = $no;
      $id_soal = $_POST['id_soal'];
      updateRunQuest($_POST['answer'],$id_soal);
      break;
    case 'Prev':
      $no = $_POST['no'];
      $nomorSoal = $no-1;
      // $id_soal = $_POST['id_soal'];
      // if ($_POST['answer']!=null) {
      //   updateRunQuest($_POST['answer'],$id_soal,'False');
      // }
      break;
    case 'Next':
      $no = $_POST['no'];
      $nomorSoal = $no+1;
      // $id_soal = $_POST['id_soal'];
      // if ($_POST['answer']!=null) {
      //   updateRunQuest($_POST['answer'],$id_soal,'False');
      // }
      break;
    case 'Mark':
      $no = $_POST['no'];
      $nomorSoal = $no;
      $id_soal = $_POST['id_soal'];
      updateUndecided($id_soal,'True');
      break;
    case 'Unmark':
      $no = $_POST['no'];
      $nomorSoal = $no;
      $id_soal = $_POST['id_soal'];
      if ($_POST['answer']!=null) {
        updateUndecided($id_soal,'False');
      }else{
        updateUndecided($id_soal,(null));
      }
      break;
    
    default:
      $no = $_POST['no'];
      $nomorSoal = $no;
      break;
  } 
} else {
  $nomorSoal=1;
}
//----------------------------------------END EXAM--------------------------------------------------
if (isset($_POST['cmd'])) {
  switch ($_POST['cmd']) {
    case 'end':
      //jika user control memperbolehkan lihat hasil maka eksekusi jika tidak kasih keterangan
      // versi 2
      $data = showResultExam($_POST['student_id'], $_POST['exam_group']);
      $idses = $_SESSION['cust_group'];
      $views = cekViewResult($idses);
      $view = mysqli_fetch_array($views);;
      if ($view[2] == 'true') {
        echo ($data);
      } else {
        $v = viewResultNone();
        echo ($v);
      }
      endSession($_POST['student_id'], $_POST['exam_group']);
      die();
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Exam</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="../assets/css/exam-style.css" rel="stylesheet">
    <link rel="icon" href="../assets/img/icon.png" type="image/gif" sizes="16x16">
   <style type="text/css">
     .col-md-2, .col-md-10{
        padding-right: 5px;
        padding-left: 5px;
      }
      .custom-heading{
        height: 25px;
        color: #fff;
        text-shadow: 1px 1px #000; 
        padding: 1px 10px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        background-image: url(../assets/img/heading-panel.png);
        background-size: cover;
        border-bottom: 3px solid #ffbc00;
      }
      .btn-danger {
        background-color: #d6251f;
        border : 1px solid #fff; 
      }
      .btn-danger:hover {
        background-color: #e4130c;
        border : 1px solid #fff; 
      }
      .btn-warning {
        background-color: #ffbc00;
      }
      .btn-success {
        background-color: #00b842;
      }
   </style>
    <!-- Custom JS -->
  <script src="../assets/js/jquery-1.11.1.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script>
    var intCountDown = <?php echo $remainingtime; ?>;
    function countDown(){
      if(intCountDown < 0){ 
         window.alert('Times Up');
         window.location.href='end_exam.php';
        cntdwn.innerText = 'Done';
        return;
      } seconds_left  = intCountDown;
        
            seconds  = Math.floor(seconds_left / 1) % 60;
            minutes  = Math.floor(seconds_left / 60);
            
        setElement('countdown-minutes', minutes);
            setElement('countdown-seconds', seconds);
      cntdwn.innerText = intCountDown--;
      setTimeout("countDown()",1000);
    }

     function setElement(id, value) {
            if (value.length < 2) {
                value = "0" + value;
            }
          window.document.getElementById(id).innerHTML = value;
        }
</script>
</head>
<body>
  <div id="wrapper">
  <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-image: url(../assets/img/header.png); background-size: cover; position: fixed; width: 100% ">
      <div class="col-lg-2" style="    text-align: center;    padding: 5px;">
          <img style="max-height:70px;" src="../assets/img/logo/<?=$result[2]?>">
        </div>
        <div class="col-lg-5">
          <h4 style="color: #fff;text-shadow: 1px 1px #000;">ID Student : <?=$result[0]?></h4>
          <h4 style="color: #fff;text-shadow: 1px 1px #000;">Name : <?=$result[1]?></h4>

        </div>  
        <div class="col-lg-1">
          <body onload="countDown()">
        <div id="cntdwn" style="visibility: hidden;" ></div>
      </body>
        </div>
        <div class="col-lg-4" style="text-align: right; margin-bottom:10px ">
          <h4 style="color: #fff;text-shadow: 1px 1px #000;">
            Remaining Time : 
            <b <?php if ($time_menit<10) { echo 'style="color:#d9534f"';}?> ><span id="countdown-minutes"></span></b> Minutes 
            <b <?php if ($time_menit<10) { echo 'style="color:#d9534f"';}?> ><span id="countdown-seconds"></span></b> Second
          </h4>
          <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#end_exam">End Exam</button>
        </div>
        <div class="navbar-header">
    </div>
        <!-- /.navbar-header -->
      <div class="nav navbar-top-links navbar-right"></div>
    </nav>
    <div id="page-wrapper">
     <div> 
      <div class="row">
        <div class="col-md-12">
              <div class="panel panel-default">
                <div class="custom-heading" >
                  <i class="fa fa-bell fa-fw"></i> Question Map
                </div>
                <div class="panel-body" style="padding: 5px;">
                 <div class="row">
                  <h2 align="center">Review Answer</h2>
       <?php
//sudah terjawab
      $sql="select undecided,answer,no_quest from exam_run_quest where id_student='".$_SESSION["id_peserta"]."' and group_name='".$_SESSION["exam_group"]."' and answer is not null and undecided = 'False'";
      $rs=mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error($GLOBALS['link']));
        echo '<div class="col-md-4" style="text-align:center;">
            <h4>Answer</h4>';
        while ($row = mysqli_fetch_row($rs)) {
            echo '<button type="button" style="background-color: #00b842;color: white;" class="btn btn-outline btn-primary btn-sm btn-number-review" onclick="formSubmitNumber('.$row[2].')" >'.$row[2].'. '.$row[1].'</button>&nbsp;';
          }
        echo "</div>";      

//ragu ragu
      $sql="select undecided,answer,no_quest from exam_run_quest where id_student='".$_SESSION["id_peserta"]."' and group_name='".$_SESSION["exam_group"]."' and answer is not null and undecided = 'True'"; 
      $rs=mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error($GLOBALS['link']));
        echo '<div class="col-md-4" style="text-align:center;">
            <h4>Marking</h4>';
        while ($row = mysqli_fetch_row($rs)) {
            echo '<button type="button" style="background-color: #ffbc00;color: white;" class="btn btn-outline btn-primary btn-sm btn-number-review" onclick="formSubmitNumber('.$row[2].')" >'.$row[2].'. '.$row[1].'</button>&nbsp;';
            }
        echo "</div>";

//belum dijawab
      $sql="select undecided,answer,no_quest from exam_run_quest where id_student='".$_SESSION["id_peserta"]."' and group_name='".$_SESSION["exam_group"]."' and answer is null";
      $rs=mysqli_query($GLOBALS['link'],$sql) or die(mysqli_error($GLOBALS['link']));
        echo '<div class="col-md-4" style="text-align:center;">
            <h4>Not Answer</h4>';
        while ($row = mysqli_fetch_row($rs)) {
            echo '<button type="button" style="background-color: #ce2b2b;color: white;" class="btn btn-outline btn-primary btn-sm btn-number-review" onclick="formSubmitNumber('.$row[2].')" >'.$row[2].'. '.$row[1].'</button>&nbsp;';
            }
        echo "</div>";
        echo "";
       ?>
      </div>
    </div>
  </div>
</div>
<!-- panel navigasi -->
       <div style="text-align: center;">
           <a href="exam.php"><button class="btn btn-success">Cancel</button></a>
           <button class = "btn btn-danger" data-toggle="modal" data-target="#end_exam">End Exam</button>
       </div>
<!-- form -->
       <form id="navigation" action="exam.php" method="POST">
        <input type='hidden' id="no" name='no'>   
       </form>
     
      </div>
     </div>
    </div>
<!-- Footer -->
    <!-- <div style="background-image: url(../assets/img/heading-panel.png);background-size: cover;border-top: 2px solid #ffbc00; text-align: right;padding: 10px;">
      <img src="../assets/img/trust-150X38.png" style="text-align: right; max-width: 150px">
      
    </div> -->
  </div>

<!-- Modal -->
  <div class="modal fade" id="end_exam" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="
            background-color: #d9534f;
            border-radius: 5px 5px 0px 0px;
            color : #fff;
        ">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Info</h4>
        </div>
        <div class="modal-body">
          <p>Anda Memilih untuk mengakhiri ujian ini <br>
             Setelah anda mengakhiri ujian <br>
             anda tidak dapat kembali ke halaman ujian ini dan jawaban anda akan tersimpan</p>
             <br><br>
            <p>Anda Yakin Mengakhiri Ujian?</p>
          <div style="text-align: center;">
            <form action="exam.php" method="POST">
              <input type="hidden" name="cmd" value="end">
              <input type="hidden" name="student_id" value="<?=$_SESSION['id_peserta']?>">
              <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
              <input type="hidden" name="exam_group" value="<?=$_SESSION['exam_group']?>">
              <button class="btn btn-sm btn-success"> Ya </button>
              <button class="btn btn-sm btn-danger" data-dismiss="modal"> Tidak</button>
            </form>
          </div>
       </div>
      </div>
      
    </div>
  </div>
<script>
  function formSubmitNumber($id) {
      document.getElementById('no').value = $id;
      document.getElementById('navigation').submit();
  }
</script>
</body>
</html>

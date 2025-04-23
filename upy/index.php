<!DOCTYPE html>
<html>
<?php
include '../cfg/general.php';
include '../control/inc_function.php';
include '../control/inc_function2.php';
connectdb();
// if (studentLoginCek()){
//     header('location:halaman_ujian.php');
// }
if (studentLoginCek()) {
    header('location:view_exam.php');
}
$user_id = '';
$password = '';
$loginSukses = 0;
$js = '';
if (isset($_POST['user_id'])) {
    $user_id = trim($_POST['user_id']);
    $passkey = trim($_POST['password']);
    $password = preg_replace('/\s+/','', $passkey);
    $t = CovidexamStudentLogin($user_id, $password);
    if ($t == 1) {
        $sql = "SELECT * FROM `exam_participants` WHERE `id_student` = '".sqlValue($id_participant)."' AND `exam_group`= $exam_group";
        $rs = mysqli_query($GLOBALS['link'], $sql) or die(mysqli_error($GLOBALS['link']));
        if (mysqli_fetch_row($rs) == 0) {
            examParticipants($id_participant, $exam_group); //daftarkan exam participant
        }
        $n = CovidcekLogStu($user_id, $password); //cek alokasi peserta ujian
        if (cekSessionFront($_SESSION['id_peserta'], $_SESSION['exam_group'])) { // cek jika sudah memulai ujian tapi belum selesai
          header('location:view_exam.php');
        } elseif ($n == 1) {
            header('location:view_exam.php');
        } else {
            cancelLogin($_SESSION['id_peserta'], $_SESSION['exam_group']);
            echo "<script LANGUAGE='JavaScript'>
        window.alert('Sorry, you can\'t sign in, because the allocation of exam participants is full.');
              window.location.href='../upy_logout.php';
              </script>";
        }
    } elseif ($t == 2) {
        $loginSukses = 0;
        $js = "alert(\"You still have an active session!\\r\\n Please contact administrator!\");\r\n";
    } else {
        $loginSukses = 0;
        $js = "alert(\"Invalid Identification Id/Exam Token!\");\r\n";
    }
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/datepicker3.css" rel="stylesheet">
  <link href="../assets/css/styles.css" rel="stylesheet">
  <link rel="icon" href="assets/img/icon.png" type="image/gif">
  <script type="text/javascript"> //<![CDATA[
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>
  <style>
  body {
    background-size: 100%;
  }
* {
    box-sizing: border-box;
}


/* Create two equal columns that floats next to each other */
.column-left {
  float: left;
    margin-left: 5%;
    width: 65%;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */

}
.column-right {
  background-color: #f9f9f9;
  float: left;
  width: 28%;
    padding: 10px;
    height: 250px;
    border-radius: 10px; /* Should be removed. Only for demonstration */

}
.btn-primary{
  background-color: #e6aa00;
  border-color: #000;
}
.btn-primary:active:hover
.btn-primary:hover
.btn-block:hover{
  background-color: #e6aa00;
  border-color: #000;
}

  .head{
    display: none;
    background-color: #ffb53e;
  }
  .foot-bot{
    display: none;
  }
@media only screen and (min-width: 1101px) {
  .t-mid {
    font-size: 45px;
  }
  .t-bottom{
    font-size: 62px;
  }
  .t-logo{
    max-width: 420px;
  }
}
@media only screen and (max-width: 1100px) {
  h1 {
    font-size: 28px;
  }
  .t-mid{
    font-size: 38px;
  } 
  .t-bottom{
    font-size: 45px;
  }
  .t-logo{
    max-width: 320px;
  }
}
/*mobile view*/

@media only screen and (max-width: 1023px) {
  body{
    /* background-size: 200%; */
    padding-top: 0px;
    background-repeat: no-repeat;
    background-size: auto;
    background-position-x: center;
  }
  .column-left{
    display: none;
  }
  .column-right{
    background-color: #f9f9f9;
    float: left;
    width: 100%;
    padding: 10px;
    height: 250px;
    border-radius: 10px;
    margin: 0px 0px 15px;
  }
  .foot{
    display: none;
  }
  .head{
    display: block;
    width: 100%;
    text-align: center;
    /*padding: 0px 20px 10px 0px;*/
  }
  .foot-bot{
    bottom: 0;
    width: 100%;
    display: flex;
    background: #0e1110;
    position: fixed;
  }
}
  </style>
</head>
<body style="background-image:url('../assets/img/bg-B.jpg'); ">

<div class="row" style="width: 100%; margin-left: 0px">
<div class="head">
  <img src="../assets/img/logo/logoUPY.png" style="max-height: 70px;padding:5px;">
</div>
<div class="col-sm-12" style="margin-top: 35px; margin-bottom: 95px; padding: 15px;" >
  <div class="column-left" >
    <h1 style="color: #FFF;margin: 25px 0px 0px 0px;text-shadow: -2px -2px 3px #000;"><b>DON'T WAIT FOR</b></h1>
    <h1 class="t-mid" style="color: #FFF;margin: 0px;text-shadow: -2px -2px 3px #000;"><b>OPPORTUNITY.</b></h1>
    <h1 class="t-bottom" style="color: #ffe003;margin:0px;text-shadow: -2px -2px 3px black;"><b>CREATE IT.</b></h1>
    <img class="t-logo" src="../assets/img/logo/logoUPY.png" style="background: #f1f1f1d6;border-radius: 10px;">
  </div>
  <div class="column-right">
    <h2 align=center style="color: #000;text-shadow: 0px 0px 2px #a37900;margin-bottom: 5px;"><b> Student Login</b></h2>

  <br> <form role="form" id="flogin" name="flogin" method="post" action="">
    <fieldset>
    <div class="form-group">
      <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Identification">
              </div>
              <div class="form-group">
                <input type="password" name="password" id="password"  class="form-control" placeholder="Exam Token">
              </div>
              <br>
                <!-- Change this to a button or input when using this as a form -->
              <input type="submit" class="btn btn-warning btn-block" id="btlogin" name="btlogin" value="LOGIN">
            </fieldset>
          </form>
  </div>
</div>
</div>
<div class="foot-bot">
  <div style="width: 50%; text-align: left;">
   <img src="../assets/img/logo_trust.png" style="max-height: 35px;padding:5px 20px;;  margin-top: 5px;">  
  </div>
  <div style="width: 50%; text-align: right;">
    <img src="../assets/img/ms_logo.png" style="padding: 5px;padding-right: 25px;max-height: 45px;  ">
  </div>
</div>

<div class="foot" style="background-color: #000; height: 75px; position: fixed; width: 100%;bottom:0">
  <div class="row">
    <div class="col-sm-2"><img src="../assets/img/logo_trust.png" style="max-height: 50px;padding:5px;margin-top: 10px;margin-left: 25px">
    </div>
    <div class="col-sm-6" style="padding-top:16px">
    <script language="JavaScript" type="text/javascript">
      TrustLogo("https://cbt.trusttrain.com/assets/ssl-img/sectigo_trust_seal_sm_82x32.png", "CL1", "none");
      </script>
      <a  href="https://ssl.comodo.com" id="comodoTL">Comodo SSL</a>
    </div>
    <div class="col-sm-4" style="text-align: right;" ><img src="../assets/img/ms_logo.png" style="padding: 5px;padding-right: 25px;max-height: 78px;"></div>
  </div>
</div>
<script src="../assets/js/jquery-1.11.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script language="javascript">
  <?php echo $js; ?>
</script>
</body>
</html>

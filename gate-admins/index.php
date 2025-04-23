<?php
include "../cfg/general.php";
include "../control/inc_function.php";
connectdb();
if (cekAdminLogin()){
    header('location:dashboard.php');
}
$user_id="";
$password="";
$loginSukses=0;
$js="";
if (isset($_POST["user_id"])){
    $user_id=$_POST["user_id"];
    $password=$_POST["password"];
    if (adminLogin($user_id,$password)){
        autoFinish();
        header('location:dashboard.php');
    }else{
        $loginSukses=0;
        $js="alert(\"Invalid User Id/Password!\");\r\n";
    }
}
?>
<head>
  <link rel="icon" href="../assets/img/icon.png" type="image/gif">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/login-style.css">
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript"> //<![CDATA[
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>

<script>
//membuat objek XMLHttpRequest
  var xmlHttp = new XMLHttpRequest();
//membuat fungsi getData untuk memanggil file php
  function getData(source,id){
    if(xmlHttp != null){
      var o = document.getElementById(id);
      xmlHttp.open("GET", source);
      xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
          o.innerHTML = xmlHttp.responseText;
        }
      }
      xmlHttp.send(null);
    }
  }
//membuat fungsi jam untuk memanggul file jam.php
  function jam(){
    getData("jam.php","txt")
  }
</script>
<style type="text/css">
  time{
    display: flex;
    width: 270px;
    background-color: #000000e0;
    font-size: 20px;
    color: #fff;
    margin: 10px;
    padding: 5px 10px 5px 10px;
    border-radius: 10px;
    border: 1px solid #fff;
  }
</style>
</head>
<!------ Include the above in your HEAD tag ---------->
<body onload="setInterval(jam,1000)">

<div class="container login-container">
  <div class="row">
    <div class="col-md-8 login-form-1" style='padding-bottom:3.1%'>
    <time >Server Time :  <l id="txt" style='padding: 0px 5px'></l> WIB</time>
      <div style='background: #000000cc;height: 110px;margin-top: 26%; border-top:2px solid #fff;border-bottom:2px solid #fff;'>
        <div class='row'>
          <div class='col-md-6' style='padding-top:3%;padding-left:30px'>
            <img src='../assets/img/logo_trust.png' style='max-height:55px'>
          </div>
          <div class='col-md-6' style='text-align:right;padding-top:2%;padding-right:30px'>
            <img src='../assets/img/Logo_ms.png' style='max-height:75px'>
          </div>
        </div>
      </div>

    </div>
    <div class="col-md-4 login-form-2" style='padding-bottom:4%; border-left:2px solid #fff;'>
	  <h3>Login</h3>
        <form id="flogin" name="flogin" method="post" action="">
          <div class="form-group">
			<input type="text" class="form-control" name="user_id" id="user_id" placeholder="Username *" maxlength='25'>
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password"  class="form-control" placeholder="Password *" maxlength='25'>
          </div>
          <div class="form-group">
			<input type="submit" class="btnSubmit" id="btlogin" name="btlogin" value="Login">
          </div>
        </form>
        <div style="text-align: right;margin: 32.4% -30px -10px -24px;">
          <script language="JavaScript" type="text/javascript">
          TrustLogo("https://cbt.trusttrain.com/assets/ssl-img/sectigo_trust_seal_sm_82x32.png", "CL1", "none");
          </script>
        </div>
    </div>
  </div>
</div>

</body>

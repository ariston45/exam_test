<?php
session_cache_limiter('nocache');
$cache_limiter = session_cache_limiter();
date_default_timezone_set('Asia/Jakarta');
session_start();
/*ERROR REPORTING*/
//error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them


/*PATH*/
//$GLOBALS["app-path"]="/myweb/exam/";
$GLOBALS["app-path"]="/project_exam/";
$GLOBALS["xls-reader-dir"]="classes/PHPExcel_1.8.0/Classes/";
$GLOBALS["tmp-dir"]="tmp/";
$GLOBALS["img-soal-dir"]="assets/img-soal/";

/*const*/
$GLOBALS["bobot_soal"][1]="<font color=\"green\">easy</font>";
$GLOBALS["bobot_soal"][2]="<font color=\"brown\">medium</font>";
$GLOBALS["bobot_soal"][3]="<font color=\"red\">hard</font>";
$GLOBALS["status_id_peserta"][0]="<font color=\"grey\">Not Active</font>";
$GLOBALS["status_id_peserta"][1]="Active";

/*EMAIL*/
//$GLOBALS["phpmail-dir"]="classes/mail/";
//$GLOBALS["phpmail-class"]="htmlMimeMail";
$GLOBALS["phpmail-dir"]="classes/PHPMailer/";
$GLOBALS["phpmail-class"]="PHPMailer";
//$GLOBALS["PHPMailer_SMTPDebug"] = 3; //debug mode. set higher (2 or 1)  for more details
$GLOBALS["mail_html_dir"]="mailbuff/";
/*smtp setting read from db*/
/*
gmail setting:
host:smtp.gmail.com
ssl port:465
tls port:587
*/

/*
yahoo setting:
host:smtp.mail.yahoo.com
ssl port:465
tls port:587
*/

/*
$GLOBALS["smtp_host"]="smtp.mail.yahoo.com";
$GLOBALS["smtp_connection_type"]="ssl"; //ssl or tls (leave blank for unsecure connection )
$GLOBALS["smtp_port"]=465;
$GLOBALS["smtp_auth"]=true;
$GLOBALS["smtp_user"]="demo.bejo2015@yahoo.co.id";
$GLOBALS["smtp_pass"]="santai2013";
$GLOBALS["mail_from"]="demo.bejo2015@yahoo.co.id";
$GLOBALS["mail_from_name"]="Trust Learning Demo";
*/
/*
$GLOBALS["smtp_host"]="zmail.smartfren.com";
$GLOBALS["smtp_connection_type"]=""; //ssl or tls (leave blank for unsecure connection )
$GLOBALS["smtp_port"]=25;
$GLOBALS["smtp_auth"]=false;
$GLOBALS["mail_from"]="sistyo.tribowo@smartfren.com";
$GLOBALS["mail_from_name"]="Trust Learning Demo";
*/

/*DB*/
$GLOBALS["db_host"]="127.0.0.1";
$GLOBALS["db_user"]="root";
$GLOBALS["db_password"]="M4rch";
$GLOBALS["db_name"]="db_exam";
?>

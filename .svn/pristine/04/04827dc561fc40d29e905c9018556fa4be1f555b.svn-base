<?php
include "../../cfg/general.php";
include "../../control/inc_function.php";
include "../../control/inc_function2.php";
connectdb();
 if (isset($_GET['cmd'])) {
 	switch ($_GET['cmd']) {
 		case 'release':
 			releaseUser($_GET['id']);
 			break;
 		case 'restart':
 			echo "Restart nim :".$_GET['id'];
 			break;
 		
 		default:
 			# code...
 			break;
 	}
 }

?>
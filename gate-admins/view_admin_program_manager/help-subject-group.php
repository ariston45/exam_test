<?php		
include "../../cfg/general.php";
include "../../control/inc_function.php";
connectdb();
//global $link;
$qry = "SELECT * FROM subject_ls group by subject_group";
$sql = mysqli_query($GLOBALS['link'],$qry)or die($GLOBALS['link']);
while ($row = mysqli_fetch_assoc($sql) ){
  $leads[]=array(
	'subject_group'=>$row['subject_group'],
	'id_subject'=>$row['id_subject']);
}
$term = trim(strip_tags($_GET['term']));
$matches = array();
foreach($leads as $lead){
	if(stripos($lead['subject_group'], $term) !== false){
		$lead['value'] = $lead['subject_group'];
		$lead['label'] = "{$lead['subject_group']}";
		$matches[] = $lead;
	}
}
$matches = array_slice($matches, 0, 6);
print json_encode($matches);
?>


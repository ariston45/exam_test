<?php		
$conn =new mysqli('localhost', 'root', 's3mu@s4m4' , 'db_exam');
$sql = $conn->query ("SELECT * FROM customer ");
while ($row = $sql->fetch_assoc()) {
  $leads[]=array(
	'subject_group'=>$row['cust_name'],
	'id_subject'=>$row['id_customer']);
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


<?php		
	$conn =new mysqli('localhost', 'root', '' , 'db_exam');
	$sql = $conn->query ("SELECT id_customer,cust_name FROM customer where id_customer !='C0000'");
	while ($row = $sql->fetch_assoc()) {
	  $leads[]=array(
		'id'=>$row['id_customer'],
		'cust_name'=>$row['cust_name']);
	}
	$term = trim(strip_tags($_GET['term']));
	$matches = array();
	foreach($leads as $lead){
		if(stripos($lead['cust_name'], $term) !== false){
			$lead['value'] = $lead['cust_name'];
			$lead['label'] = "{$lead['cust_name']}";
			$matches[] = $lead;
		}
	}
	$matches = array_slice($matches, 0, 6);
	print json_encode($matches);
?>


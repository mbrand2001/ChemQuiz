<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	
	$query = "SELECT first_name, last_name, employee_id FROM employees WHERE role='1'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['employee_id'].":".$row['first_name'].":".$row['last_name']."&";
	}

	echo $returnStr;
	$db->close();

?>
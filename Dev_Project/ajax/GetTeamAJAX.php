<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	
	$query = "SELECT first_name, last_name, email, employee_id FROM employees";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['first_name'].":".$row['last_name'].":".$row['email'].":".$row['employee_id']."&";
	}

	echo $returnStr;
	$db->close();

?>
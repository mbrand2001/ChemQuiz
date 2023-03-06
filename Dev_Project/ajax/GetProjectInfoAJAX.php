<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	
	$query = "SELECT client_name, end_date, project_name, project_id FROM projects INNER JOIN clients ON clients.client_id=projects.client_id";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['project_name'].":".$row['end_date'].":".$row['client_name'].":".$row['project_id']."&";
	}

	echo $returnStr;
	$db->close();

?>
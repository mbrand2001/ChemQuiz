<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$tid = $_POST['tid'];
	$query = "SELECT * FROM tasks WHERE task_id='$tid'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['task_name'].":".$row['task_description'].":".$row['due_date'].":".$row['assigned_to'].":".$row['task_status'].":".$row['priority']."&";
	}
	
	echo $returnStr;
	$db->close();

?>
<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$pid = $_POST['pid'];
	$query = "SELECT * FROM tasks JOIN PROJECTS ON tasks.related_project_id=projects.project_id JOIN employees ON tasks.assigned_to=employees.employee_id JOIN status_table ON tasks.task_status=status_table.status_id WHERE tasks.related_project_id=$pid";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['task_name'].":".$row['due_date'].":".$row['first_name'].":".$row['priority'].":".$row['task_status'].":".$row['task_id'].":".$row['project_name'].":".$row['status_name'].":".$row['color_code']."&";
	}

	echo $returnStr;
	$db->close();

?>
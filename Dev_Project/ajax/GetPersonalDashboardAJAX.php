<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }
	$currUserID = $_POST['uid'];
	$query = "SELECT task_name, due_date, project_name, status_name, related_project_id, color_code, assigned_to, tasks.priority FROM tasks INNER JOIN status_table ON status_table.status_id=tasks.task_status INNER JOIN projects ON projects.project_id=tasks.related_project_id WHERE tasks.assigned_to = '$currUserID'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['task_name'].":".$row['due_date'].":".$row['project_name'].":".$row['status_name'].":".$row['related_project_id'].":".$row['color_code'].":".$row['priority']."&";
	}

	echo $returnStr;
	$db->close();

?>
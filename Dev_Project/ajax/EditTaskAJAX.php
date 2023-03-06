<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	

	//Get values from POST
	$tid = $_POST['tid'];
	$task_status = $_POST['task_status'];
	$due_date = $_POST['due_date'];
	$priority = $_POST['priority'];
	$task_name = filter_var($db->real_escape_string($_POST['task_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$task_description = filter_var($db->real_escape_string($_POST['task_description']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);

	//Declare and run query to edit
	$query = "UPDATE tasks SET task_status='$task_status', due_date='$due_date', priority='$priority', task_name='$task_name', task_description='$task_description' WHERE task_id='$tid'";
	$result = $db->query($query);
	$numRow = $result->num_rows;
	
	return $numRow;
	$db->close();

?>
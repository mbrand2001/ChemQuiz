<?php 
	include("../../back/php/consts_db.php");
?>
<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }

	$db->set_charset("utf8");
	
	if ($_POST['pid']) $related_project_id = $_POST['pid'];
	else $related_project_id = "";

	if ($_POST['assigned_to']) $assigned_to = $_POST['assigned_to'];
	else $assigned_to = "";

	if ($_POST['assigned_date']) $assigned_date = $_POST['assigned_date'];
	else $assigned_date = "";

	if ($_POST['due_date']) $due_date = $_POST['due_date']; 
	else $due_date = "";

	if ($_POST['priority']) $priority = $_POST['priority']; 
	else $priority = "";

	if ($_POST['status']) $task_status = $_POST['status']; 
	else $task_status = "";

	if ($_POST['task_name']) $task_name =  filter_var($db->real_escape_string($_POST['task_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	else $task_name = "";

	if ($_POST['task_description']) $task_description =  filter_var($db->real_escape_string($_POST['task_description']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	else $task_description = "";

	$returnStr = 0;		// Assume the task does not exist in the database...
	
	$query = "SELECT * FROM tasks WHERE task_name='$task_name'"; //Tries to find task with equal name
	$result = $db->query($query);	
	$numRows = $result->num_rows;
	if ($numRows == 0)
	{
		$myquery = "INSERT INTO `tasks` (`related_project_id`, `assigned_to`, `task_status`, `assigned_date`, `due_date`, `priority`, `task_name`, `task_description`) VALUES ('$related_project_id', '$assigned_to', '$task_status', '$assigned_date', '$due_date', '$priority', '$task_name', '$task_description');";
		$result = $db->query($myquery);
		$numRow = $result->num_rows;
	}
	else
	{
		$returnStr = 1;	// This indicates tells the client (i.e. browser) that the task already exists in the database.
	}
	
	return $returnStr;
	$db->close();
?>
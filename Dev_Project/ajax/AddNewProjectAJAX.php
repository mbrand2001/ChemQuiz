<?php 
	include("../../back/php/consts_db.php");
?>
<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }

	if ($_POST['project_name']) $project_name = filter_var($db->real_escape_string($_POST['project_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	else $project_name = "";

	if ($_POST['client_id']) $client_id = $_POST['client_id'];
	else $client_id = "";

	if ($_POST['pmid']) $pmid = $_POST['pmid'];
	else $pmid = "";

	if ($_POST['start_date']) $start_date = $_POST['start_date'];
	else $start_date = "";

	if ($_POST['end_date']) $end_date = $_POST['end_date'];
	else $end_date = "";

	$returnStr=0;		// Assume the project does not exist in the database...
	$numRows = 0;
	if ($numRows == 0)
	{
		$myquery = "INSERT INTO `projects` (`project_name`, `client_id`, `project_manager_id`, `start_date`, `end_date`) VALUES	('$project_name', '$client_id', '$pmid', '$start_date', '$end_date')";
		$result = $db->query($myquery);
		$numRows = $result->num_rows;
	}
	else
	{
		$returnStr = 1;	// This indicates tells the client (i.e. browser) that the person already exists in the database.
	}
	echo $returnStr;
	return $returnStr;
	$db->close();
?>
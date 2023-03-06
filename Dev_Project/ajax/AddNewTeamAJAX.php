<?php 
	include("../../back/php/consts_db.php");
?>
<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }

	if ($_POST['first_name']) $first_name = filter_var($db->real_escape_string($_POST['first_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	else $first_name = "";

	if ($_POST['last_name']) $last_name = filter_var($db->real_escape_string($_POST['last_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	else $last_name = "";

	if ($_POST['password']) $password = $db->real_escape_string($_POST['password']);
	else $password = "";
	
	if ($_POST['role']) $role = $db->real_escape_string($_POST['role']);
	else $role = "";

	if ($_POST['email']) $email = filter_var($db->real_escape_string($_POST['email']), FILTER_SANITIZE_STRING);
	else $email = "";

	$returnStr=0;		// Assume the person does not exist in the database...
	$query = "SELECT * FROM employees WHERE employees.email='$email'";
	$result = $db->query($query);	
	$numRows = $result->num_rows;

	if ($numRows == 0)
	{
	$myquery = "INSERT INTO `employees` (`first_name`, `last_name`, `email`, `password`, `role`) VALUES ('$first_name', '$last_name', '$email', '$password', '$role')";
	$result = $db->query($myquery);
	$numRow = $result->num_rows;
	}
	else
	{
		$returnStr = 1;	// This indicates tells the client (i.e. browser) that the person already exists in the database.
	}
	echo $returnStr;
	echo $numRow;
	return $returnStr;
	$db->close();
?>
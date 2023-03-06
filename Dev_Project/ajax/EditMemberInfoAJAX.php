<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; }	

	//Get values from POST
	$eid = $_POST['eid'];
	$first_name = filter_var($db->real_escape_string($_POST['first_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$last_name = filter_var($db->real_escape_string($_POST['last_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$email = filter_var($db->real_escape_string($_POST['email']), FILTER_SANITIZE_STRING);

	//Declare and run query to edit
	$query = "UPDATE employees SET first_name='$first_name', last_name='$last_name', email='$email' WHERE employee_id='$eid'";
	$result = $db->query($query);
	$numRow = $result->num_rows;
	
	return $numRow;
	$db->close();

?>
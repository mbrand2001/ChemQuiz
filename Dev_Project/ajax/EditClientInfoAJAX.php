<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	

	//Get values from POST
	$cid = $_POST['cid'];
	$cname = filter_var($db->real_escape_string($_POST['client_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$cadd = filter_var($db->real_escape_string($_POST['billing_address']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	$cemail = filter_var($db->real_escape_string($_POST['email']), FILTER_SANITIZE_STRING);

	//Declare and run query to edit
	$query = "UPDATE clients SET client_name='$cname', billing_address='$cadd', email='$cemail' WHERE client_id='$cid'";
	$result = $db->query($query);
	$numRow = $result->num_rows;
	
	return $numRow;
	$db->close();

?>
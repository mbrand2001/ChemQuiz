<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$eid = $_POST['eid'];
	$query = "DELETE FROM employees WHERE employee_id='$eid'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	
	return $numRow;
	$db->close();

?>
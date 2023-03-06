<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$cid = $_POST['cid'];
	$query = "DELETE FROM clients WHERE client_id='$cid'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	
	return $numRow;
	$db->close();

?>
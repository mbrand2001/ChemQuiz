<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$tid = $_POST['tid'];
	$query = "DELETE FROM tasks WHERE task_id='$tid'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	
	return $numRow;
	$db->close();

?>
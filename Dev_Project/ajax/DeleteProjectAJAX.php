<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$pid = $_POST['pid'];

	//Delete project
	$query = "DELETE FROM projects WHERE project_id='$pid'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	
	if ($numRow == $numRow2) {
	return $numRow;
	}
	else {
		return 1;
	}
	$db->close();

?>
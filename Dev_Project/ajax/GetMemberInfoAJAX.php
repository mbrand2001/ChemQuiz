<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$eid = $_POST['eid'];
	$query = "SELECT * FROM employees WHERE employee_id='$eid'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['role'].":".$row['first_name'].":".$row['last_name'].":".$row['email']."&";
	}
	
	echo $returnStr;
	$db->close();

?>
<?php 
	include("../../back/php/consts_db.php");
?>

<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }	
	$cid = $_POST['cid'];
	$query = "SELECT client_name, billing_address, email, client_id FROM clients WHERE client_id='$cid'";
	$result = $db->query($query);		
	$numRow = $result->num_rows;
	$returnStr = $numRow."#";
	for ($i=0; $i<$numRow; $i++)
	{
		$row = $result->fetch_assoc();
		$returnStr = $returnStr.$row['client_name'].":".$row['billing_address'].":".$row['email']."&";
	}
	
	echo $returnStr;
	$db->close();

?>
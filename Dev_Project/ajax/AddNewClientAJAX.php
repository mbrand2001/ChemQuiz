<?php 
	include("../../back/php/consts_db.php");
?>
<?php	
	$db = new mysqli($server, $dbusername, $dbpassword, $dbname);
	if (mysqli_connect_errno()) { echo "Could not connect to the database!"; exit; }

	$db->set_charset("utf8");
	
	if ($_POST['client_name']) $client_name = filter_var($db->real_escape_string($_POST['client_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	else $client_name = "";

	if ($_POST['billing_address']) $billing_address = $db->real_escape_string($_POST['billing_address']);
	else $billing_address = "";

	if ($_POST['email']) $email = filter_var($db->real_escape_string($_POST['email']), FILTER_SANITIZE_STRING);
	else $email = "";

	$returnStr=0;		// Assume the person does not exist in the database...

	$query = "SELECT * FROM clients WHERE clients.email='$email'";
	$result = $db->query($query);	
	$numRows = $result->num_rows;
	if ($numRows == 0)
	{
		$result = $db->query("INSERT INTO clients (client_name, email, billing_address) VALUES ('$client_name', '$email', '$billing_address')");
		//$prep = $db->prepare("INSERT INTO clients (client_name, email, billing_address) VALUES (?, ?, ?)");
		//$prep->bind_param($client_name, $email, $billing_address);
		//$prep->execute();
		//Commented prepared statements because I could not make them work
	}
	else
	{
		$returnStr = 1;	// This indicates tells the client (i.e. browser) that the person already exists in the database.
	}
	return $returnStr;
	$db->close();
?>
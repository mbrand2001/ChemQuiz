<?php 
$dbhost="localhost"; 
$dbuser="dbuser"; 
$dbpass="dbuser445$";
$db="student_app";
 
$conn = new mysqli($dbhost,$dbuser,$dbpass,$db) or die("Connection Failed:%s\n".$conn->error); 



?>
<?php
session_start();
if($_SESSION['role'] != 'professor'){ 
    header('Location: index.php');
    exit();
}


?>

<b>for professors</b>
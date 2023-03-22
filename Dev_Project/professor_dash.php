<?php
include("includes/classes.php");
session_start();
if($_SESSION['user']->role != 'professor'){ 
    header('Location: index.php');
    exit();
}


?>

<b>for professors</b>
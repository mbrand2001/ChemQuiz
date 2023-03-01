<?php
session_start();
if($_SESSION['role'] != 'student'){ 
    header('Location: index.php');
    exit();
}


?>


<b>for students</b>
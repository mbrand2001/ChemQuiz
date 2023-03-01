<?php
session_start();
if($_SESSION['role'] != 'admin'){ 
    header('Location: index.php');
    exit();
}


?>




<b>for admins</b>
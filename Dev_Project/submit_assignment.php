<?php
include("includes/classes.php");
session_start();

$assignment=$_SESSION['assignment'];
$grade=$assignment->submitAssignment();
echo "Your grade on this assignment is: $grade";




?>
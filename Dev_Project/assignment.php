<?php
session_start();
include("includes/classes.php");

$test_user = new Student($_SESSION["id"],"test","test","email","student","1","2","3","4","5");

$valid_assignments = $test_user->getAssignmentsDue(); 
$current_assignment_id = $_GET["assignment"];

$valid = 0;

foreach($valid_assignments as $assignment){ 
    
    if($assignment[0] == $current_assignment_id){ 
        $valid = 1;
    }
}



if($valid === 0){ 
    header('Location: assignments.php');
    exit;
}

echo "hi!";






?>
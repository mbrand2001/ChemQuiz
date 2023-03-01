<html>
<head>
<script src="/javascript/Nav.js"></script>
</head>
<?php 
session_start();
include("includes/classes.php");


// use sessions to init student class! 
$test_user = new Student(1,"test","test","email","student","1","2","3","4","5");
$_SESSION["id"] = $test_user->user_id;

$assignments_due = $test_user->getAssignmentsDue(); 



foreach($assignments_due as $assignment){ 

    echo "Assignment Id: ". $assignment[0]."<br>";
    echo "Assignment Name: ". $assignment[1]."<br>";
    echo "Assignment Due: ". $assignment[2]."<br>";
    echo "Assignment Active: ". $assignment[3]."<br>";
    echo "<button type='button' onclick='beginAssignment($assignment[0]);'>Begin</button>";
    echo "<br>";
    echo "<br>";
   

}






?>

</html>
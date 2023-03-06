<html>
<head>
<script src="/javascript/Nav.js"></script>
</head>
<?php 
include("includes/classes.php");
session_start();


// use sessions to init student class! 
$test_user = new Student(1,"test","test","email","student","1","2","3","4","5");
$_SESSION["student"] = $test_user;

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


echo "<a href='student_dash.php'><input type='button' value='Back to dashboard'/></a>";



?>

</html>
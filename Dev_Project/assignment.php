<html>
<head>
<script src="/javascript/Nav.js"></script>
</head>
<?php
function str_contains($haystack,$needle){ 
    if (strpos($haystack, $needle) !== false) {
        return true;
      }
    return false;
}




include("includes/classes.php");
session_start();



$test_user = $_SESSION["student"];

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

$stmt = $conn->prepare("Select * from Assignments where Assignment_id = ?");
$stmt->bind_param("i",$current_assignment_id); 
$stmt->execute();
$stmt->bind_result($ID,$CID,$name,$type,$date,$num_attempts,$is_active); 
$stmt->close();
$assignment = new Assignment($current_assignment_id,$CID,$name,$type,$date,$num_attempts,$is_active);
//$_SESSION['current_assignment']

$questions = $assignment->beginAssignment($test_user->user_id);
$index = 0;
foreach($questions as $question){ 
    echo "Question id : $question[0] <br>";
    echo "Question Text : $question[3] <br>";
    echo "Question Answers $question[4] <br>";
    //echo "Question diagram: $question[6] <br>";
    if((str_contains($question[6],'.png') || str_contains($question[6],'.jpg')|| str_contains($question[6],'.jpeg')||str_contains($question[6],'.gif')) && !str_contains($question[6],'none')){
        echo "<img src='manage_php/diagrams/$question[6]' style='width:200px;height:150px;'/><br>";
    }
    
    echo "Question formula: $question[15] <br>";
    echo "<br>";
    echo "<form id='question_form$index>";
    echo "<label for='answer'>Answer:</label>";
    echo "<input type='text' id='answer' name='answer'>";
    echo "<input type='hidden' name='qid' value=$question[0]>";
    echo "<button type='button' onclick='answerQuestion($index);'>Submit</button>";
    echo "</form>";
    echo "<br>";
    $index++;
}
$_SESSION['questions'] = $questions;
$_SESSION['assignment'] = $assignment;
?>




</html>        











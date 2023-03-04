<?php
include("includes/classes.php");
session_start();

$questions=$_SESSION['questions'];
$assignment=$_SESSION['assignment'];
$answer=$_POST['answer'];
$qid=$_POST['qid'];


$correct=$assignment->answerQuestion($questions,$qid,$answer);
if($correct===true){ 
    echo "correct";
}
if($correct===false){ 
    echo "incorrect";
}

?>
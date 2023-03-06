<?php
include("includes/classes.php");
session_start();

$questions=$_SESSION['questions'];
$assignment=$_SESSION['assignment'];
$qid=$_POST['qid'];
$question = $questions[$qid];
$hid = $_POST['hid'];
$answer = $_POST['answer'];

if($hid == 1){
    
    $ans_arr = preg_split("/\,/",$question[11]);
    foreach($ans_arr as $ans){ 
    if($answer===$ans){
        echo "correct";
        exit();
    }

    }
    echo "incorrect";
    exit();
}
if($hid == 2){
    
    $ans_arr = preg_split("/\,/",$question[12]);
    foreach($ans_arr as $ans){ 
    if($answer===$ans){
        echo "correct";
        exit();
    }

    }
    echo "incorrect";
    exit();
    
}   

if($hid == 3){
    
    $ans_arr = preg_split("/\,/",$question[13]);
    foreach($ans_arr as $ans){ 
    if($answer===$ans){
        echo "correct";
        exit();
    }

    }
    echo "incorrect";
    exit();
    
}
if($hid == 4){
    
    $ans_arr = preg_split("/\,/",$question[14]);
    foreach($ans_arr as $ans){ 
    if($answer===$ans){
        echo "correct";
        exit();
    }

    }
    echo "incorrect";
    exit();
    
}


?>
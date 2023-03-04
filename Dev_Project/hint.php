<?php
include("includes/classes.php");
session_start();

$questions=$_SESSION['questions'];
$assignment=$_SESSION['assignment'];
$qid=$_POST['qid'];
$index=$_POST['index'];
$question = $questions[$qid];

//something is going wrong with the indexing I think I need to look more into this later?
//var_dump($questions);
if(empty($question[7])){
    $question[7] = "n/a";
}
if(empty($question[8])){
    $question[8] = "n/a";
}
if(empty($question[9])){
    $question[9] = "n/a";
}
if(empty($question[10])){
    $question[10] = "n/a";
}


echo "<br>";
echo "<form id='step1_$index'>";
echo "Step 1: $question[7]<br>";
echo "<input type='text' id='step1_answer_$index' name='answer'>";
echo "<input type='hidden' name='hid' value=1 />";
echo "<button id='step1_submit_$index' type='button' onclick='answerHint($index,$qid,1);'>Submit</button>";
echo "</form>";

echo "<form id='step2_$index'>";
echo "Step 2: $question[8]<br>";
echo "<input type='text' id='step2_answer_$index' name='answer'>";
echo "<input type='hidden' name='hid' value=2 />";
echo "<button id='step2_submit_$index' type='button' onclick='answerHint($index,$qid,2);'>Submit</button>";
echo "</form>";

echo "<form id='step3_$index'>";
echo "Step 3: $question[9]<br>";
echo "<input type='text' id='step3_answer_$index' name='answer'>";
echo "<input type='hidden' name='hid' value=3 />";
echo "<button id='step3_submit_$index' type='button' onclick='answerHint($index,$qid,3);'>Submit</button>";
echo "</form>";

echo "<form id='step4_$index'>";
echo "Step 4: $question[10]<br>";
echo "<input type='text' id='step4_answer_$index' name='answer'>";
echo "<input type='hidden' name='hid' value=4 />";
echo "<button id='step4_submit_$index' type='button' onclick='answerHint($index,$qid,4);'>Submit</button>";
echo "</form>";
echo "<br>";


?>
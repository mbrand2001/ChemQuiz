<?php
include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor'){ 
  header('Location: ../index.php');
  exit();
}

//Create Question
if( isset($_POST['click'])){
if(isset($_POST['class_id']) && isset($_POST['type']) &&isset($_POST['text']) && isset($_POST['answers']) && isset($_POST['tag']) && isset($_POST['url']) && isset($_POST['step_1']) && isset($_POST['step_2'])  && isset($_POST['step_3'])  && isset($_POST['step_4'])  && isset($_POST['step_1_a'])  && isset($_POST['step_2_a'])  && isset($_POST['step_3_a'])  && isset($_POST['step_4_a']) && isset($_POST['formula'])){ 
  if( !empty($_POST['class_id']) && !empty($_POST['type']) &&!empty($_POST['text']) && !empty($_POST['answers']) && !empty($_POST['tag']) && !empty($_POST['url']) && !empty($_POST['step_1']) && !empty($_POST['step_2'])  && !empty($_POST['step_3'])  && !empty($_POST['step_4'])  && !empty($_POST['step_1_a'])  && !empty($_POST['step_2_a'])  && !empty($_POST['step_3_a'])  && !empty($_POST['step_4_a']) && !empty($_POST['formula']) ){
    
    $class_id=$_POST['class_id'];
    $type=$_POST['type'];
    $text=$_POST['text'];
    $answers=$_POST['answers'];
    $tag=$_POST['tag'];
    $url=$_POST['url'];
    $step_1=$_POST['step_1'];
    $step_2=$_POST['step_2'];
    $step_3=$_POST['step_3'];
    $step_4=$_POST['step_4'];
    $step_1_a=$_POST['step_1_a'];
    $step_2_a=$_POST['step_2_a'];
    $step_3_a=$_POST['step_3_a'];
    $step_4_a=$_POST['step_4_a'];
    $formula=$_POST['formula'];
    
    
    $stmt = $conn->prepare("INSERT INTO Questions(Class_id,Question_type,Question_text,Question_answers,Question_tag,Question_diagram_url,Step_1,Step_2,Step_3,Step_4,Step_1_answers,Step_2_answers,Step_3_answers,Step_4_answers,formula) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
    $stmt->bind_param("issssssssssssss",$class_id,$type ,$text,$answers,$tag,$url,$step_1,$step_2,$step_3,$step_4,$step_1_a,$step_2_a,$step_3_a,$step_4_a,$formula); 
    if(!$stmt->execute()) echo $stmt->error;
    echo"1";
    exit();

  }
  else{ 
    echo"-1";
    exit();
  }
   
}
else{ 
  echo "-2";
  exit();
}
}


if( isset($_POST['edit'])){
  if(isset($_POST['id'])&& isset($_POST['class_id']) && isset($_POST['type']) &&isset($_POST['text']) && isset($_POST['answers']) && isset($_POST['tag']) && isset($_POST['url']) && isset($_POST['step_1']) && isset($_POST['step_2']) && isset($_POST['step_3']) && isset($_POST['step_4']) && isset($_POST['step_1_a']) && isset($_POST['step_2_a']) && isset($_POST['step_3_a']) && isset($_POST['step_4_a']) && isset($_POST['formula'])){
if( !empty($_POST['id']) && !empty($_POST['class_id']) && !empty($_POST['type']) &&!empty($_POST['text']) && !empty($_POST['answers']) && !empty($_POST['tag']) && !empty($_POST['url']) && !empty($_POST['step_1']) && !empty($_POST['step_2']) && !empty($_POST['step_3']) && !empty($_POST['step_4']) && !empty($_POST['step_1_a']) && !empty($_POST['step_2_a']) && !empty($_POST['step_3_a']) && !empty($_POST['step_4_a']) && !empty($_POST['formula']) ){

$id = $_POST['id'];
$class_id = $_POST['class_id'];
$type = $_POST['type'];
$text = $_POST['text'];
$answers = $_POST['answers'];
$tag = $_POST['tag'];
$url = $_POST['url'];
$step_1 = $_POST['step_1'];
$step_2 = $_POST['step_2'];
$step_3 = $_POST['step_3'];
$step_4 = $_POST['step_4'];
$step_1_a = $_POST['step_1_a'];
$step_2_a = $_POST['step_2_a'];
$step_3_a = $_POST['step_3_a'];
$step_4_a = $_POST['step_4_a'];
$formula = $_POST['formula'];

$stmt = $conn->prepare("UPDATE Questions SET Class_id=?, Question_type=?, Question_text=?, Question_answers=?, Question_tag=?, Question_diagram_url=?, Step_1=?, Step_2=?, Step_3=?, Step_4=?, Step_1_answers=?, Step_2_answers=?, Step_3_answers=?, Step_4_answers=?, formula=? WHERE id=?"); 
$stmt->bind_param("issssssssssssssi", $class_id, $type, $text, $answers, $tag, $url, $step_1, $step_2, $step_3, $step_4, $step_1_a, $step_2_a, $step_3_a, $step_4_a, $formula, $id); 
if(!$stmt->execute()) echo $stmt->error;
echo "1";
exit();
}
else{
echo "-1";
exit();
}

}
else{
echo "-2";
exit();
}
}

?>
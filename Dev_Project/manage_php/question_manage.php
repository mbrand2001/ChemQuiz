<?php
include("../includes/db_connect.php");

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
  if(isset($_POST['id'])&& isset($_POST['class_id']) && isset($_POST['type']) &&isset($_POST['text']) && isset($_POST['answers']) && isset($_POST['tag']) && isset($_POST['url']) && isset($_POST['step_1']) && isset($_POST['step_2'])  && isset($_POST['step_3'])  && isset($_POST['step_4'])  && isset($_POST['step_1_a'])  && isset($_POST['step_2_a'])  && isset($_POST['step_3_a'])  && isset($_POST['step_4_a']) && isset($_POST['formula'])){ 
    if( !empty($_POST['id']) && !empty($_POST['class_id']) && !empty($_POST['type']) &&!empty($_POST['text']) && !empty($_POST['answers']) && !empty($_POST['tag']) && !empty($_POST['url']) && !empty($_POST['step_1']) && !empty($_POST['step_2'])  && !empty($_POST['step_3'])  && !empty($_POST['step_4'])  && !empty($_POST['step_1_a'])  && !empty($_POST['step_2_a'])  && !empty($_POST['step_3_a'])  && !empty($_POST['step_4_a']) && !empty($_POST['formula']) ){
      $id = $_POST['id'];
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
      
      
      $stmt = $conn->prepare("Update Questions SET Class_id=?,Question_type=?,Question_text=?,Question_answers=?,Question_tag=?,Question_diagram_url=?,Step_1=?,Step_2=?,Step_3=?,Step_4=?,Step_1_answers=?,Step_2_answers=?,Step_3_answers=?,Step_4_answers=?,formula=? WHERE Question_id = ?"); 
      $stmt->bind_param("issssssssssssssi",$class_id,$type ,$text,$answers,$tag,$url,$step_1,$step_2,$step_3,$step_4,$step_1_a,$step_2_a,$step_3_a,$step_4_a,$formula,$id); 
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




if( isset($_POST['delete'])){
  if(isset($_POST['id'])){ 
    if(!empty($_POST['id'])){ 
      $id = $_POST['id'];
      $stmt = $conn->prepare("DELETE FROM Questions where Question_id = ?");
      $stmt->bind_param("i",$id);
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


?>

<html> 
<head> 
<title>Manage Question Entries</title>
<script src="../javascript/Async.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#imageSelect").change(function(){
                var selectedImage = $(this).val();
                
                $("#preview").attr("src", "diagrams/" + selectedImage);
            });
        });
    </script>
</head> 
<body> 
<h1 id=warning></h1>
<h1> Welcome admin!</h1>
<div id="table area"> 
<?php
if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

$sql ="SELECT * FROM Questions"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table id='table'>";
    echo"<th>";
    echo"<tr>"; 
    echo"<td>Question Id</td>";
    echo"<td>Class Id</td>"; 
    echo"<td>Type</td>"; 
    echo"<td>Text</td>"; 
    echo"<td>Answers</td>";
    echo"<td>Tags</td>";
    echo"<td>Diagram URL</td>";
    echo"<td>Step 1</td>";
    echo"<td>Step 2</td>";
    echo"<td>Step 3</td>";
    echo"<td>Step 4</td>";
    echo"<td>Answer 1</td>";
    echo"<td>Answer 2</td>";
    echo"<td>Answer 3</td>";
    echo"<td>Answer 4</td>";
    echo"<td>Formula</td>";
    echo"</tr>";
    echo"</th>";
  while($row = $result->fetch_assoc()){ 
    //echo $row['First_Name'] . $row['Last_Name'] . $row['Email'] . $row['Role'];
    echo"<tr>";
    echo"<td>".$row['Question_id']."</td>";
    echo"<td>".$row['Class_id']."</td>";
    echo"<td>".$row['Question_type']."</td>";
    echo"<td>".$row['Question_text']."</td>";
    echo"<td>".$row['Question_answers']."</td>";
    echo"<td>".$row['Question_tag']."</td>";
    echo"<td>".$row['Question_diagram_url']."</td>";
    echo"<td>".$row['Step_1']."</td>";
    echo"<td>".$row['Step_2']."</td>";
    echo"<td>".$row['Step_3']."</td>";
    echo"<td>".$row['Step_4']."</td>";
    echo"<td>".$row['Step_1_answers']."</td>";
    echo"<td>".$row['Step_2_answers']."</td>";
    echo"<td>".$row['Step_3_answers']."</td>";
    echo"<td>".$row['Step_4_answers']."</td>";
    echo"<td>".$row['formula']."</td>";

    echo"</tr>";
    
    
    

  }

  echo "</table>";
}
if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){
exit();
}
}
?>
</div>  
<br/>
<p>Upload Diagram</p>

    <form method="post" enctype="multipart/form-data" id="upload">
        Select diagram to upload:
        <input type="file" name="image" id="image">
        <button type="button" onclick="uploadFile();">Upload</button>
    </form>
    <b id="upload_response"></b>








<p>Create Question</p>
<form id="question_create">
  
  <label for="class_id">Class Id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <label for="type">Question Type:</label><br>
  <input type="text" id="type" name="type"><br>
  <label for="text"> Question Text:</label><br>
  <textarea id="text" name="text" rows="4" cols="50">Enter Question Text Here!</textarea><br>
  <label for="answers">Answers:</label><br>
  <textarea id="answers" name="answers" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="tag">Question Tags:</label><br>
  <textarea id="tag" name="tag" rows="4" cols="50">Enter Tags Here In Comma Seperated Format ex: introductory,isotopes,elements</textarea><br>
  <label for="imageSelect">Diagram:</label>
 <!-- <input type="text" id="url" name="url"><br> -->
 <?php
        $imageDir = "diagrams/";
        $images = glob($imageDir . "*.{jpg,png,gif}", GLOB_BRACE);
        // Create a dropdown menu of the image files
        
        echo "<select name='url' id='imageSelect'>";
        echo "<option value='none'>none</option>";
        foreach ($images as $image) {
            $imageName = basename($image);
            echo "<option value='$imageName'>$imageName</option>";
        }
        echo "</select>";
        echo "<br>";
        // Display a preview of the first image in the directory
        if (count($images) > 0) {
            $firstImage = basename($images[0]);
            echo "<img id='preview' src='diagrams/$firstImage' width='200'>";
        } else {
            echo "No images found in $imageDir";
        }
    ?>
    <br>
  <label for="step_1"> Question Wrong Step 1</label><br>
  <textarea id="step_1" name="step_1" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_1_a">Step 1 Answers:</label><br>
  <textarea id="step_1_a" name="step_1_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="step_2"> Question Wrong Step 2</label><br>
  <textarea id="step_2" name="step_2" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_2_a">Step 2 Answers:</label><br>
  <textarea id="step_2_a" name="step_2_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="step_3"> Question Wrong Step 3</label><br>
  <textarea id="step_3" name="step_3" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_3_a">Step 3 Answers:</label><br>
  <textarea id="step_3_a" name="step_3_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="step_4"> Question Wrong Step 4</label><br>
  <textarea id="step_4" name="step_4" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_4_a">Step 4 Answers:</label><br>
  <textarea id="step_4_a" name="step_4_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="formula">Formula:</label><br>
  <textarea id="formula" name="formula" rows="4" cols="50">Enter Formula To Use Here</textarea><br>
  <input type="hidden" value="1" name="click"/>
</br>
  <button type="button" onclick="createQuestion();">Submit</button>
</form>
</br> 
</br>
<p>Edit Question</p>
<form id="question_edit">
  <label for="id">Question Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <label for="class_id">Class Id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <label for="type">Question Type:</label><br>
  <input type="text" id="type" name="type"><br>
  <lable for="text"> Question Text:</label><br>
  <textarea id="text" name="text" rows="4" cols="50">Enter Question Text Here!</textarea><br>
  <label for="answers">Answers:</label><br>
  <textarea id="answers" name="answers" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="tag">Question Tags:</label><br>
  <textarea id="tag" name="tag" rows="4" cols="50">Enter Tags Here In Comma Seperated Format ex: introductory,isotopes,elements</textarea><br>
  <label for="imageSelect">Diagram:</label>
 <!-- <input type="text" id="url" name="url"><br> -->
 <?php
        $imageDir = "diagrams/";
        $images = glob($imageDir . "*.{jpg,png,gif}", GLOB_BRACE);
        // Create a dropdown menu of the image files
        
        echo "<select name='url' id='imageSelect'>";
        foreach ($images as $image) {
            $imageName = basename($image);
            echo "<option value='$imageName'>$imageName</option>";
        }
        echo "</select>";
        echo "<br>";
        // Display a preview of the first image in the directory
        if (count($images) > 0) {
            $firstImage = basename($images[0]);
            echo "<img id='preview' src='diagrams/$firstImage' width='200'>";
        } else {
            echo "No images found in $imageDir";
        }
    ?>
    <br>
  <label for="step_1"> Question Wrong Step 1</label><br>
  <textarea id="step_1" name="step_1" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_1_a">Step 1 Answers:</label><br>
  <textarea id="step_1_a" name="step_1_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="step_2"> Question Wrong Step 2</label><br>
  <textarea id="step_2" name="step_2" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_2_a">Step 2 Answers:</label><br>
  <textarea id="step_2_a" name="step_2_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="step_3"> Question Wrong Step 3</label><br>
  <textarea id="step_3" name="step_3" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_3_a">Step 3 Answers:</label><br>
  <textarea id="step_3_a" name="step_3_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="step_4"> Question Wrong Step 4</label><br>
  <textarea id="step_4" name="step_4" rows="4" cols="50">Enter Question Step Text Here!</textarea><br>
  <label for="step_4_a">Step 4 Answers:</label><br>
  <textarea id="step_4_a" name="step_4_a" rows="4" cols="50">Enter Answers Here In Comma Seperated Format ex: 25,25.0,25.00</textarea><br>
  <label for="formula">Formula:</label><br>
  <textarea id="formula" name="formula" rows="4" cols="50">Enter Formula To Use Here</textarea><br>
  <input type="hidden" value="1" name="edit"/>
</br>
  <button type="button" onclick="editQuestion();">Submit</button>
</form>
</br> 
</br>

<p>Delete Question</p>
<form id="question_delete">
  <label for="id">Question Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <input type="hidden" value="1" name="delete"/>
</br>
  <button type="button" onclick="deleteQuestion();">Submit</button>
</form>



</body>
</html>
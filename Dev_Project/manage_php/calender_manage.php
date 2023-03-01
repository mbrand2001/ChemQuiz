<?php
include("../includes/db_connect.php");
session_start();
if($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'professor'){ 
  header('Location: ../index.php');
  exit();
}

if( isset($_POST['click'])){
if(isset($_POST['class_id']) && isset($_POST['date']) &&isset($_POST['text_entry'])){ 
  if( !empty($_POST['class_id']) && !empty($_POST['date']) &&!empty($_POST['text_entry']) ){
    $date = date("Y-m-d",strtotime($_POST['date']));
    $class_id=$_POST['class_id'];
    $text_entry= $_POST['text_entry'];
    
    $stmt = $conn->prepare("INSERT INTO Calender_Entry(Class_id,Calender_date,Text_entry) VALUES (?,?,?)"); 
    $stmt->bind_param("iss",$class_id,$date ,$text_entry); 
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
  if( isset($_POST['id']) && isset($_POST['class_id']) && isset($_POST['date']) &&isset($_POST['text_entry'])){ 
    if( !empty($_POST['id']) &&  !empty($_POST['class_id']) && !empty($_POST['date']) &&!empty($_POST['text_entry']) ){
      $id = $_POST['id'];
      $date = date("Y-m-d",strtotime($_POST['date']));
      $class_id=$_POST['class_id'];
      $text_entry= $_POST['text_entry'];
      
      $stmt = $conn->prepare("UPDATE Calender_Entry SET Class_id=?,Calender_date=?,Text_entry=? where Entry_id =?"); 
      $stmt->bind_param("issi",$class_id,$date ,$text_entry,$id); 
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
      $stmt = $conn->prepare("DELETE FROM Calender_Entry where Entry_id = ?");
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
<title>Manage Calender Entries</title>
<script src="../javascript/Async.js"></script>
</head> 
<body> 
<h1 id=warning></h1>
<h1> Welcome admin!</h1>
<div id="table area"> 
<?php
if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

$sql ="SELECT * FROM Calender_Entry"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table id='table'>";
    echo"<th>";
    echo"<tr>"; 
    echo"<td>Entry Id</td>";
    echo"<td>Class Id</td>";
    echo"<td>Calender Date</td>"; 
    echo"<td>Text Entry</td>"; 
    
    echo"</tr>";
    echo"</th>";
  while($row = $result->fetch_assoc()){ 
    
    echo"<tr>";
    echo"<td>".$row['Entry_id']."</td>";
    echo"<td>".$row['Class_id']."</td>";
    echo"<td>".$row['Calender_date']."</td>";
    echo"<td>".$row['Text_entry']."</td>";
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
<p>Create Entry</p>
<form id="calender_create">
  
  <label for="class_id">Class_id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <lable for="date"> Pick Date</label><br>
  <input type="date" id="date" name="date">
  <label for="text_entry">text_entry:</label><br>
  <textarea id="text_entry" name="text_entry" rows="4" cols="50">Enter Calender Text Here!</textarea>
  <input type="hidden" value="1" name="click"/>
</br>
  <button type="button" onclick="createCalender();">Submit</button>
</form>

</br> 
</br>

<p>Edit Entry</p>
<form id="calender_edit">
  <label for="id">Calender Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <label for="class_id">Class_id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <lable for="date"> Pick Date</label><br>
  <input type="date" id="date" name="date">
  <label for="text_entry">text_entry:</label><br>
  <textarea id="text_entry" name="text_entry" rows="4" cols="50">Enter Calender Text Here!</textarea>
  <input type="hidden" value="1" name="edit"/>
</br>
  <button type="button" onclick="editCalender();">Submit</button>
</form>

</br> 
</br>


<p>Delete Calender</p>
<form id="calender_delete">
  <label for="id">Calender Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <input type="hidden" value="1" name="delete"/>
</br>
  <button type="button" onclick="deleteCalender();">Submit</button>
</form>



</body>
</html>
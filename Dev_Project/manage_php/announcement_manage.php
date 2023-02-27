<?php
include("../includes/db_connect.php");
if( isset($_POST['click'])){
if(isset($_POST['class_id']) && isset($_POST['text_entry'])){ 
  if( !empty($_POST['class_id']) && !empty($_POST['text_entry']) ){
   
    $class_id=$_POST['class_id'];
    $text_entry= $_POST['text_entry'];

    $stmt = $conn->prepare("INSERT INTO Announcement_Entry(Class_id,Calender_date,Text_entry) VALUES (?,NOW(),?)"); 
    $stmt->bind_param("is",$class_id,$text_entry); 
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
  if(isset($_POST['id']) && isset($_POST['class_id']) && isset($_POST['text_entry'])){ 
    if( !empty($_POST['id']) && !empty($_POST['class_id']) && !empty($_POST['text_entry']) ){
      $id = $_POST['id'];
      $class_id=$_POST['class_id'];
      $text_entry= $_POST['text_entry'];
  
      $stmt = $conn->prepare("UPDATE Announcement_Entry SET  Class_id=?,Calender_date=NOW(),Text_entry=? where Entry_id=?"); 
      $stmt->bind_param("isi",$class_id,$text_entry,$id); 
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
      $stmt = $conn->prepare("DELETE FROM Announcement_Entry where Entry_id = ?");
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
<title>Manage Announcements</title>
<script src="../javascript/Async.js"></script>
</head> 
<body> 
<h1 id=warning></h1>
<h1> Welcome admin!</h1>
<div id="table area"> 
<?php
if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

$sql ="SELECT * FROM Announcement_Entry"; 
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
<p>Create Announcement</p>
<form id="announcement_create">
  
  <label for="class_id">Class_id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <label for="text_entry">text_entry:</label><br>
  <textarea id="text_entry" name="text_entry" rows="4" cols="50">Enter Announcement Here!</textarea>
  <input type="hidden" value="1" name="click"/>
</br>
  <button type="button" onclick="createAnnouncement();">Submit</button>
</form>

</br> 
</br>

<p>Edit Announcement</p>
<form id="announcement_edit">
  <label for="id">Announcement Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <label for="class_id">Class_id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <label for="text_entry">text_entry:</label><br>
  <textarea id="text_entry" name="text_entry" rows="4" cols="50">Enter Announcement Here!</textarea>
  <input type="hidden" value="1" name="edit"/>
</br>
  <button type="button" onclick="editAnnouncement();">Submit</button>
</form>

</br> 
</br>
<p>Delete Announcement</p>
<form id="announcement_delete">
  <label for="id">Announcement Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <input type="hidden" value="1" name="delete"/>
</br>
  <button type="button" onclick="deleteAnnouncement();">Submit</button>
</form>



</body>
</html>
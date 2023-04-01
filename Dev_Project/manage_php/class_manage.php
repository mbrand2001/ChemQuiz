<?php
include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor'){ 
  header('Location: ../index.php');
  exit();
}


//Create Class


if( isset($_POST['click'])){
if(isset($_POST['c_name']) && isset($_POST['p_id'])){ 
  if(!empty($_POST['c_name']) && !empty($_POST['p_id'] && !empty($_POST['click']))){
    $c_name=$_POST['c_name'];
    $p_id=$_POST['p_id'];
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < 10; $i++) {
      $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    $stmt = $conn->prepare("INSERT INTO Class(Class_name,Professor_id,Code) VALUES (?,?,?)"); 
    $stmt->bind_param("sss",$c_name,$p_id,$code); 
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
    echo"-2";
    exit();
}

}



if( isset($_POST['edit'])){
  if( isset($_POST['id']) && isset($_POST['c_name']) && isset($_POST['p_id'])){ 
    if( !empty($_POST['id']) &&!empty($_POST['c_name']) && !empty($_POST['p_id'])){
      $id = $_POST['id'];
      $c_name=$_POST['c_name'];
      $p_id=$_POST['p_id'];
      
      $stmt = $conn->prepare("UPDATE Class SET Class_name=?,Professor_id=?  where Class_id =?"); 
      $stmt->bind_param("ssi",$c_name,$p_id,$id); 
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
      echo"-2";
      exit();
  }
  
  }


if( isset($_POST['delete'])){
  if(isset($_POST['id'])){ 
    if(!empty($_POST['id'])){ 
      $id = $_POST['id'];
      $stmt = $conn->prepare("DELETE FROM Class where Class_id = ?");
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
<title>Manage Classes</title>
<script src="../javascript/Async.js"></script>
</head> 
<body> 
<h1 id=warning></h1>
<h1> Welcome admin!</h1>
<div id="table area"> 
<?php
if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

$sql ="SELECT * FROM Class"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table id='table'>";
    echo"<th>";
    echo"<tr>"; 
    echo"<td>Class Id</td>";
    echo"<td>Class Name</td>";
    echo"<td>Professor Id</td>"; 
    echo"<td>Code</td>"; 
    echo"</tr>";
    echo"</th>";
  while($row = $result->fetch_assoc()){ 
    
    echo"<tr>";
    echo"<td>".$row['Class_id']."</td>";
    echo"<td>".$row['Class_name']."</td>";
    echo"<td>".$row['Professor_id']."</td>";
    echo"<td>".$row['Code']."</td>";
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
<p>Create Class</p>
<form id="class_create">
  <label for="c_name">Class Name:</label><br>
  <input type="text" id="c_name" name="c_name"><br>
  <label for="p_id">Professor_Id:</label><br>
  <input type="text" id="p_id" name="p_id"><br>
  <input type="hidden" value="1" name="click"/>

</br>
  <button type="button" onclick="createClass();">Submit</button>
</form>

</br> 
</br>

<p>Edit Class</p>
<form id="class_edit">
  <label for="id">Class Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <label for="c_name">Class Name:</label><br>
  <input type="text" id="c_name" name="c_name"><br>
  <label for="p_id">Professor_Id:</label><br>
  <input type="text" id="p_id" name="p_id"><br>
  <input type="hidden" value="1" name="edit"/>

</br>
  <button type="button" onclick="editClass();">Submit</button>
</form>

</br> 
</br>

<p>Delete Class</p>
<form id="class_delete">
  <label for="id">Class Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <input type="hidden" value="1" name="delete"/>
</br>
  <button type="button" onclick="deleteClass();">Submit</button>
</form>







</body>
</html>
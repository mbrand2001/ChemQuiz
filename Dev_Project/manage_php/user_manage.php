<?php
include("../includes/db_connect.php");

//Create User
if( isset($_POST['click'])){
if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])){ 
  if( !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']) ){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role=$_POST['role'];

    $stmt = $conn->prepare("INSERT INTO Users(First_Name,Last_Name,Email,Password,Role) VALUES (?,?,?,?,?)"); 
    $stmt->bind_param("sssss",$fname,$lname,$email,$password,$role); 
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
  if( isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])){ 
    if( !empty($_POST['id']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']) ){
      $id = $_POST['id'];
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $email=$_POST['email'];
      $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
      $role=$_POST['role'];
  
      $stmt = $conn->prepare("UPDATE Users SET First_Name=?,Last_Name=?,Email=?,Password=?,Role=? where User_ID = ?"); 
      $stmt->bind_param("sssssi",$fname,$lname,$email,$password,$role,$id); 
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
      $stmt = $conn->prepare("DELETE FROM Users where User_ID = ?");
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


if(isset($_POST['user_class_list'])){
  if(isset($_POST['student_id']) && isset($_POST['class_id_1']) && isset($_POST['class_id_2']) && isset($_POST['class_id_3']) && isset($_POST['class_id_4']) && isset($_POST['class_id_5'])){
    if( !empty($_POST['student_id'])){
    
    $sid = $_POST['student_id'];
    $c1  = $_POST['class_id_1'];
    $c2  = $_POST['class_id_2'];
    $c3  = $_POST['class_id_3'];
    $c4  = $_POST['class_id_4'];
    $c5  = $_POST['class_id_5'];

    if(empty($c1)){ 
      $c1=-1;

    }
    if(empty($c2)){ 
      $c2=-1;
      
    }
    if(empty($c3)){ 
      $c3=-1;
      
    }
    if(empty($c4)){ 
      $c4=-1;
      
    }
    if(empty($c5)){ 
      $c5=-1;
      
    }
    
    $stmt = $conn->prepare("Update Users set Class_1=? ,Class_2=?,Class_3=?,Class_4=?,Class_5=? where Users.User_ID =? ");
    $stmt->bind_param("iiiiii",$c1,$c2,$c3,$c4,$c5,$sid);
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
<title>Manage Users</title>
<script src="../javascript/Async.js"></script>
</head> 
<body> 
<h1 id=warning></h1>
<h1>Welcome admin!</h1>
<div id="table area"> 
<?php
if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

$sql ="SELECT User_ID,First_Name,Last_Name,Email,Role,Class_1,Class_2,Class_3,Class_4,Class_5 FROM Users"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table id='table'>";
    echo"<th>";
    echo"<tr>"; 
    echo"<td>User Id</td>";
    echo"<td>First Name</td>";
    echo"<td>Last Name</td>"; 
    echo"<td>Email</td>"; 
    echo"<td>Role</td>"; 
    echo"<td>Class 1</td>"; 
    echo"<td>Class 2</td>"; 
    echo"<td>Class 3</td>"; 
    echo"<td>Class 4</td>"; 
    echo"<td>Class 5</td>"; 
    echo"</tr>";
    echo"</th>";
  while($row = $result->fetch_assoc()){ 
    //echo $row['First_Name'] . $row['Last_Name'] . $row['Email'] . $row['Role'];
    echo"<tr>";
    echo"<td>".$row['User_ID']."</td>";
    echo"<td>".$row['First_Name']."</td>";
    echo"<td>".$row['Last_Name']."</td>";
    echo"<td>".$row['Email']."</td>";
    echo"<td>".$row['Role']."</td>";
    echo"<td>".$row['Class_1']."</td>";
    echo"<td>".$row['Class_2']."</td>";
    echo"<td>".$row['Class_3']."</td>";
    echo"<td>".$row['Class_4']."</td>";
    echo"<td>".$row['Class_5']."</td>"; 
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
<p>Create User</p>
<form id="user_create">
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname"><br>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="password">Password:</label><br>
  <input type="text" id="password" name="password"><br>
  <label for="role">Role:</label><br>
  <input type="text" id="role" name="role">
  <input type="hidden" value="1" name="click"/>
</br>
  <button type="button" onclick="createUser();">Submit</button>
</form>
</br> 
</br>
<p>Edit User</p>
<form id="user_edit">
  <label for="id">User Id:</label><br> 
  <input type="text" id="id" name="id"><br>
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname"><br>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="password">Password:</label><br>
  <input type="text" id="password" name="password"><br>
  <label for="role">Role:</label><br>
  <input type="text" id="role" name="role">
  <input type="hidden" value="1" name="edit"/>
</br>
  <button type="button" onclick="editUser();">Submit</button>
</form>
</br> 
</br>
<p>Delete User</p>
<form id="user_delete">
  <label for="id">User Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <input type="hidden" value="1" name="delete"/>
</br>
  <button type="button" onclick="deleteUser();">Submit</button>
</form>




<div id="table area"> 
<?php
//if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

$sql ="SELECT Class.Class_id,Class.Class_name,Users.First_Name,Users.Last_Name FROM Class Inner JOIN Users on Users.User_ID=Class.Professor_id"; //and Users.Role='professor'"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table id='table'>";
    echo"<th>";
    echo"<tr>"; 
    echo"<td>Class Id</td>";
    echo"<td>Class Name</td>";
    echo"<td>Professor First Name</td>"; 
    echo"<td>Professor Last Name</td>"; 
    echo"</tr>";
    echo"</th>";
  while($row = $result->fetch_assoc()){ 
    
    echo"<tr>";
    echo"<td>".$row['Class_id']."</td>";
    echo"<td>".$row['Class_name']."</td>";
    echo"<td>".$row['First_Name']."</td>";
    echo"<td>".$row['Last_Name']."</td>";
    echo"</tr>";
    
    
    

  }

  echo "</table>";
}
/*
if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){
exit();
}
*/
//}
?>
</div>  


<p>Set User Class List</p>
<form id="user_class_list">
  <label for="student_id">Student Id:</label><br>
  <input type="text" id="student_id" name="student_id"><br>
  <label for="class_id_1">Class Id 1:</label><br>
  <input type="text" id="class_id_1" name="class_id_1"><br>
  <label for="class_id_2">Class Id 2:</label><br>
  <input type="text" id="class_id_2" name="class_id_2"><br>
  <label for="class_id_3">Class Id 3:</label><br>
  <input type="text" id="class_id_3" name="class_id_3"><br>
  <label for="class_id_4">Class Id 4:</label><br>
  <input type="text" id="class_id_4" name="class_id_4"><br>
  <label for="class_id_5">Class Id 5:</label><br>
  <input type="text" id="class_id_5" name="class_id_5"><br>
  <input type="hidden" value="1" name="user_class_list"/>
</br>
  <button type="button" onclick="setUserClassList();">Submit</button>
</form>

</body>
</html>
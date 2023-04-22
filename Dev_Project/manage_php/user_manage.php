<?php
include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin'){ 
  header('Location: ../index.php');
  exit();
}







//Create User
if( isset($_POST['click'])){
if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])){ 
  if( !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']) ){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo -3;
      exit(0);
    }
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
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo -3;
        exit(0);
      }
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

if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){

  $sql ="SELECT User_ID,First_Name,Last_Name,Email,Role,Class_1,Class_2,Class_3,Class_4,Class_5 FROM Users"; 
  $result = $conn->query($sql);
  if($result->num_rows > 0){ 
    
    echo "<table class='table table-striped'>";
      echo"<thead>";
      echo"<tr>"; 
      echo"<th>User Id</th>";
      echo"<th>First Name</th>";
      echo"<th>Last Name</th>"; 
      echo"<th>Email</th>"; 
      echo"<th>Role</th>"; 
      echo"<th>Class 1</th>"; 
      echo"<th>Class 2</th>"; 
      echo"<th>Class 3</th>"; 
      echo"<th>Class 4</th>"; 
      echo"<th>Class 5</th>"; 
      echo"</tr>";
      echo"</thead>";
      echo"<tbody>";
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
    echo"</tbody>";
    echo "</table>";
  }
  if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){
  exit();
  }
  }



?>
<html> 
<head> 
<title>Manage Users</title>
<script src="../javascript/Async.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head> 
<body> 
<div class="container-fluid">
<h1 id="warning"></h1>
<h1>Welcome admin!</h1>
<a href="announcement_manage.php">Manage Announcements</a>
              <a href="assignment_manage.php">Manage Assignments</a>
              <a href="class_manage.php">Manage Classes </a>
              <a href="question_manage.php">Manage Questions</a>
              <?php 
              if($_SESSION['user']->role == 'admin'){
               echo '<a href="user_manage.php">Manage Users</a>';
              }
              ?>
<div id="table area" class="table-responsive"> 
<?php


$sql ="SELECT User_ID,First_Name,Last_Name,Email,Role,Class_1,Class_2,Class_3,Class_4,Class_5 FROM Users"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table class='table table-striped'>";
    echo"<thead>";
    echo"<tr>"; 
    echo"<th>User Id</th>";
    echo"<th>First Name</th>";
    echo"<th>Last Name</th>"; 
    echo"<th>Email</th>"; 
    echo"<th>Role</th>"; 
    echo"<th>Class 1</th>"; 
    echo"<th>Class 2</th>"; 
    echo"<th>Class 3</th>"; 
    echo"<th>Class 4</th>"; 
    echo"<th>Class 5</th>"; 
    echo"</tr>";
    echo"</thead>";
    echo"<tbody>";
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
  echo"</tbody>";
  echo "</table>";
}
if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){
exit();
}

?>
</div>  
<br/>
<p>Create User</p>
<form id="user_create">
  <div class="form-group">
    <label for="fname">First name:</label>
    <input type="text" class="form-control" id="fname" name="fname">
  </div>
  <div class="form-group">
    <label for="lname">Last name:</label>
    <input type="text" class="form-control" id="lname" name="lname">
  </div>
  <div class="form-group">
    <label for="email">Email
:</label>
<input type="text" class="form-control" id="email" name="email">

  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="text" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <label for="role">Role:</label>
    <input type="text" class="form-control" id="role" name="role">
  </div>
  <input type="hidden" value="1" name="click"/>
  <button type="button" class="btn btn-primary" onclick="createUser();">Submit</button>
</form>
</br> 
</br>
<p>Edit User</p>
<form id="user_edit">
  <div class="form-group">
    <label for="id">User Id:</label>
    <input type="text" class="form-control" id="id" name="id">
  </div>
  <div class="form-group">
    <label for="fname">First name:</label>
    <input type="text" class="form-control" id="fname" name="fname">
  </div>
  <div class="form-group">
    <label for="lname">Last name:</label>
    <input type="text" class="form-control" id="lname" name="lname">
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="text" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <label for="role">Role:</label>
    <input type="text" class="form-control" id="role" name="role">
  </div>
  <input type="hidden" value="1" name="edit"/>
  <button type="button" class="btn btn-primary" onclick="editUser();">Submit</button>
</form>
</br> 
</br>
<p>Delete User</p>
<form id="user_delete">
  <div class="form-group">
    <label for="id">User Id:</label>
    <input type="text" class="form-control" id="id" name="id">
  </div>
  <input type="hidden" value="1" name="delete"/>
  <button type="button" class="btn btn-danger" onclick="deleteUser();">Submit</button>
</form>
<div id="class_table_area" class="table-responsive"> 

</div>  
</div> 
</body> 
</html>
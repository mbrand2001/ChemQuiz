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
    
    echo "<table class='table table-bordered table-responsive'>";
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
</head> 
<body> 
<h1 id=warning></h1>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEMQuiz - Manage Users</title>
        <meta name="description" content="CHEMQuiz">
        <meta name="keywords" content="Chem practice problems">
        <meta name="author" content="Michael Brand, Juan Cadile">
        <meta http-equiv="Pragma" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="expires" content="-1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <!-- Project CSS -->
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
        <!-- Local JS -->
        <script src="../javascript/logout_script.js"></script>
        <script src="../javascript/logout_script_manage.js"></script>
        <script src="../js/layout.js"></script>
        <script src="../js/dashboard.js"></script>
        <script src="../js/internal-project.js"></script>
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">    
        <!-- Head ends -->
    </head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styles */
        .container-rounded {
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .btn-view {
            background-color: #007bff;
            color: #fff;
        }
        .btn-submit {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head> 
<body> 
<nav>
    <div id="left-side">
       <div id="logo-div">
        <img src="../imgs/logo.png"  id="ionalogo" class="logo"  style="max-width:40px; max-height:40px;" />
      </div>
        
        </a>
        </div>
        </div>
        <div id="right-side">
        <div class="link-nav"><a href="announcement_manage.php">Manage Announcements</a></div>
        <div class="link-nav"><a href="assignment_manage.php">Manage Assignments</a></div>
        <div class="link-nav"><a href="class_manage.php">Manage Classes </a></div>
        <div class="link-nav"><a href="question_manage.php">Manage Questions</a></div>
              <?php 
              if($_SESSION['user']->role == 'admin'){
               echo '<div class="link-nav"><a href="user_manage.php">Manage Users</a></div>';
              }
              ?>
        <div class="link-nav"><a onclick="logoutcallmanage()" id="logoutbtn">Log-out</a></div> <!-- logout button not working -->
    </div>
    </nav>
<div class="container-fluid">
<h1 id="warning"></h1>
<div class="container mt-4">
            <h4>Manage Users</h4></br>
            <div class="card" style="height:auto;">
              <div class="card-header">
                  <h5 class="mb-0">All Users</h5>
              </div>
              <div class="card-body" id="table area">
<div id="table area" class="table-responsive table table-bordered"> 
<?php


$sql ="SELECT User_ID,First_Name,Last_Name,Email,Role,Class_1,Class_2,Class_3,Class_4,Class_5 FROM Users"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table class='table table-bordered'>";
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

?></div></div>
</div>  
<br/></br>
<div class="card" style="height:auto;">
              <div class="card-header">
                  <h5 class="mb-0">Create User</h5>
              </div>
              <div class="card-body" id="table area">
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
  </div></br>
  <input type="hidden" value="1" name="click"/>
  <button type="button" class="btn btn-primary" onclick="createUser();">Submit</button>
</form>

</div></div></br></br>
<div class="card" style="height:auto;">
              <div class="card-header">
                  <h5 class="mb-0">Edit User</h5>
              </div>
              <div class="card-body" id="table area">
<form id="user_edit">
  <div class="form-group">
    <label for="id">User ID:</label>
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
  </div><br/>
  <input type="hidden" value="1" name="edit"/>
  <button type="button" class="btn btn-primary" onclick="editUser();">Submit</button>
</form>

</div></div></br></br>
<div class="card" style="height:auto;">
              <div class="card-header">
                  <h5 class="mb-0">Delete User</h5>
              </div>
              <div class="card-body" id="table area">

<form id="user_delete">
  <div class="form-group">
    <label for="id">User ID:</label>
    <input type="text" class="form-control" id="id" name="id">
  </div>
  <input type="hidden" value="1" name="delete"/></br>
  <button type="button" class="btn btn-danger" onclick="deleteUser();">Submit</button>
</form>
<div id="class_table_area" class="table-responsive"> 

</div>  
</div> 
</body> 
</html>
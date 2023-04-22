<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();

if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor'){ 
  header('Location: ../index.php');
  exit();
}
$user = $_SESSION['user'];

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

  }}
  else{ 
    echo"-1";
    exit();
  }
   
}

// Edit Class
if (isset($_POST['edit'])) {
    if (isset($_POST['id']) && isset($_POST['c_name']) && isset($_POST['p_id'])) {
        if (!empty($_POST['id']) && !empty($_POST['c_name']) && !empty($_POST['p_id'])) {
            $id = $_POST['id'];
            $c_name = $_POST['c_name'];
            $p_id = $_POST['p_id'];

            $stmt = $conn->prepare("UPDATE Class SET Class_name=?,Professor_id=?  where Class_id =?");
            $stmt->bind_param("ssi", $c_name, $p_id, $id);
            if (!$stmt->execute()) echo $stmt->error;
            echo "1";
            exit();
        } else {
            echo "-1";
            exit();
        }
    } else {
        echo "-2";
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




if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){

$sql ="SELECT * FROM Class"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table id='table' class='table table-bordered'>";
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
exit(0);
}








?>






<html> 
<head> 
<title>Manage Classes</title>
<script src="../javascript/Async.js"></script>
</head> 
<body> 
<h1 id=warning></h1>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="../javascript/Async.js"></script>
  <title>Manage Classes</title>
  
</head>
<body>
  <div class="container">
    <h1 class="text-center my-4">Welcome admin!</h1>
    <a href="announcement_manage.php">Manage Announcements</a>
              <a href="assignment_manage.php">Manage Assignments</a>
              <a href="class_manage.php">Manage Classes </a>
              <a href="question_manage.php">Manage Questions</a>
              <?php 
              if($_SESSION['user']->role == 'admin'){
               echo '<a href="user_manage.php">Manage Users</a>';
              }
              ?>

    <h2 id="warning" class="text-danger"></h2>

    <div id="table area">
      <?php
        if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

          $sql ="SELECT * FROM Class";
          $result = $conn->query($sql);
          if($result->num_rows > 0){

            echo "<table class='table table-bordered'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th scope='col'>Class Id</th>";
                  echo "<th scope='col'>Class Name</th>";
                  echo "<th scope='col'>Professor Id</th>";
                  echo "<th scope='col'>Class Code</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
            while($row = $result->fetch_assoc()){

              echo "<tr>";
                echo "<td>".$row['Class_id']."</td>";
                echo "<td>".$row['Class_name']."</td>";
                echo "<td>".$row['Professor_id']."</td>";
                echo "<td>".$row["Code"]."</td>";
              echo "</tr>";

            }
            echo "</tbody>";
            echo "</table>";
          }
        
        }
      ?>
    </div>

    <div class="row">
      <div class="col-md-4">
        <h3>Create Class</h3>
        <form id="class_create">
          <div class="mb-3">
            <label for="c_name" class="form-label">Class Name:</label>
            <input type="text" class="form-control" id="c_name" name="c_name">
          </div>
          <div class="mb-3">
            <label for="p_id" class="form-label">Professor_Id:</label>
            <input type="text" class="form-control" id="p_id" name="p_id">
          </div>
          <input type="hidden" value="1" name="click"/>
          <button type="button" class="btn btn-primary" onclick="createClass();">Submit</button>
        </form>
      </div>
      <div class="col-md-4">
        <h3>Edit Class</h3>
        <form id="class_edit">
          <div class="mb-3">
            <label for="id" class="form-label">Class Id:</label>
            <input type="text" class="form-control" id="id" name="id">
          </div>
          <div class="mb-3">
            <label for="c_name" class="form-label">Class Name:</label>
            <input type="text" class="form-control" id="c_name" name="c_name">
          </div>
          <div class="mb-3">
            <label for="p_id" class="form-label">Professor_Id:</label>
            <input type="text" class="form-control" id="p_id" name="p_id">
</div>
<input type="hidden" value="1" name="edit"/>
<button type="button" class="btn btn-primary" onclick="editClass();">Submit</button>
</form>
</div>
<div class="col-md-4">
<h3>Delete Class</h3>
<form id="class_delete">
<div class="mb-3">
<label for="id" class="form-label">Class Id:</label>
<input type="text" class="form-control" id="id" name="id">
</div>
<input type="hidden" value="1" name="delete"/>
<button type="button" class="btn btn-danger" onclick="deleteClass();">Submit</button>
</form>
</div>
</div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
      ```
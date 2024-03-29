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
    echo"<td>Class ID</td>";
    echo"<td>Class Name</td>";
    echo"<td>Professor ID</td>"; 
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
    <title>CHEMQuiz - Announcments</title>
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
        <a>
        <img src="../imgs/logo.png" style="max-width:40px; max-height:40px;" />
        </a>
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
              if($_SESSION['user']->role == 'professor'){
                echo '<div class="link-nav"><a href="../professor_dash.php">Back to dashboard</a></div>';
               }
              ?>
        <div class="link-nav"><a onclick="logoutcallmanage();" id="logoutbtn">Log-out</a></div> <!-- logout button not working -->
    </div>
    </nav>
    <div class="container mt-4">
  </br>
      <h4 class="">Manage Classes</h4>
      <br />


    <h2 id="warning" class="text-danger"></h2>
    <div class="card" style="height:auto;">
              <div class="card-header">
                  <h5 class="mb-0">All Classes</h5>
              </div>
              <div class="card-body" id="table area">
    <div id="table area">
      <?php
        if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

          $sql ="SELECT * FROM Class";
          $result = $conn->query($sql);
          if($result->num_rows > 0){

            echo "<table class='table table-bordered'>";
              echo "<thead>";
                // echo "<tr>";
                  echo "<th scope='col'>Class ID</th>";
                  echo "<th scope='col'>Class Name</th>";
                  echo "<th scope='col'>Professor ID</th>";
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
      </div></div></br></br>
    <div class="row">
      <div class="col-md-4">
      <div class="card" style="height:100%;">
              <div class="card-header">
                  <h5 class="mb-0">Create Class</h5>
              </div>
              <div class="card-body" id="table area">
        <form id="class_create">
          <div class="mb-3">
            <label for="c_name" class="form-label">Class Name:</label>
            <input type="text" class="form-control" id="c_name" name="c_name">
          </div>
          <div class="mb-3">
            <label for="p_id" class="form-label">Professor ID:</label>
            <input type="text" class="form-control" id="p_id" name="p_id">
          </div>
          <input type="hidden" value="1" name="click"/>
          <button type="button" class="btn btn-primary" onclick="createClass();">Submit</button>
        </form>
      </div></div></div>
      
      <div class="col-md-4">
      <div class="card" style="height:100%;">
              <div class="card-header">
                  <h5 class="mb-0">Edit Class</h5>
              </div>
              <div class="card-body" id="table area">
        <form id="class_edit">
          <div class="mb-3">
            <label for="id" class="form-label">Class ID:</label>
            <input type="text" class="form-control" id="id" name="id">
          </div>
          <div class="mb-3">
            <label for="c_name" class="form-label">Class Name:</label>
            <input type="text" class="form-control" id="c_name" name="c_name">
          </div>
          <div class="mb-3">
            <label for="p_id" class="form-label">Professor ID:</label>
            <input type="text" class="form-control" id="p_id" name="p_id">
</div>
<input type="hidden" value="1" name="edit"/>
<button type="button" class="btn btn-primary" onclick="editClass();">Submit</button>
</form>
</div></div></div>
<div class="col-md-4">
<div class="card" style="height:100%;">
              <div class="card-header">
                  <h5 class="mb-0">Delete Class</h5>
              </div>
              <div class="card-body" id="table area">
<form id="class_delete">
<div class="mb-3">
<label for="id" class="form-label">Class ID:</label>
<input type="text" class="form-control" id="id" name="id">
</div>
<input type="hidden" value="1" name="delete"/>
<button type="button" class="btn btn-danger" onclick="deleteClass();">Submit</button>
</form>
</div></div>
</div>
  </div>
      </br></br>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

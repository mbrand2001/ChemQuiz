
<?php
include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor'){ 
  header('Location: ../index.php');
  exit();
}
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



if ((isset($_GET['refresh']) && $_GET['refresh'] == 1)) {
  $sql = "SELECT * FROM Announcement_Entry";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Entry Id</th>";
    echo "<th>Class Id</th>";
    echo "<th>Calender Date</th>";
    echo "<th>Text Entry</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['Entry_id'] . "</td>";
      echo "<td>" . $row['Class_id'] . "</td>";
      echo "<td>" . $row['Calender_date'] . "</td>";
      echo "<td>" . $row['Text_entry'] . "</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  }
  if ((isset($_GET['refresh']) && $_GET['refresh'] == 1)) {
    exit();
  }
}







?>

<html>
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Project CSS -->
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
        <!-- Local JS -->
        <script src="../javascript/logout_script.js"></script>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-TWIBnPHgiT67kzlGxv1np49SnW6GczHARhPXnXgzo3rjE3kB+eU6oMkxQrxnx8vvR22K+Vy0T1j47v39zyxwWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<script src="../javascript/Async.js"></script>
    <!-- Start of nav bar -->
    <nav>
    <div id="left-side">
       <div id="logo-div">
        <a>
        <img src="../imgs/logo.png" style="max-width:40px max-height:40px" />
        <a href="announcement_manage.php">Manage Announcements</a>
              <a href="assignment_manage.php">Manage Assignments</a>
              <a href="class_manage.php">Manage Classes </a>
              <a href="question_manage.php">Manage Questions</a>
              <?php 
              if($_SESSION['user']->role == 'admin'){
               echo '<a href="user_manage.php">Manage Users</a>';
              }
              ?>
        </a>
        </div>
        </div>
        <div id="right-side">
        <div class="link-nav"><a style="color:black; text-decoration:none;" href="student_dash.php">Back To Dashboard</a></div>
        <div class="link-nav"><a onclick="logoutcall()" id="logoutbtn">Log-out</a></div>
    </div>
    </nav>
    <!-- Nav bar ends -->
    <div class="container-fluid">
        <div class="row">
  <div class="container">
    <h1 class="mt-5 mb-4">Welcome admin!</h1>
    <h1 id=warning></h1>
    <div class="table-responsive" id="table area">
      <?php
     
        $sql = "SELECT * FROM Announcement_Entry";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Entry Id</th>";
          echo "<th>Class Id</th>";
          echo "<th>Calender Date</th>";
          echo "<th>Text Entry</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Entry_id'] . "</td>";
            echo "<td>" . $row['Class_id'] . "</td>";
            echo "<td>" . $row['Calender_date'] . "</td>";
            echo "<td>" . $row['Text_entry'] . "</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
        }
        if ((isset($_GET['refresh']) && $_GET['refresh'] == 1)) {
          exit();
        }
      
      ?>
    </div>
    <h1 class="mt-5 mb-4">Create Announcement</h1>
    <form id="announcement_create" class="mb-5">
      <div class="form-group">
        <label for="class_id">Class ID:</label>
        <input type="text" class="form-control" id="class_id" name="class_id">
      </div>
      <div class="form-group">
        <label for="text_entry">Text Entry:</label>
        <textarea class="form-control" id="text_entry" name="text_entry" rows="4" cols="50">Enter Announcement Here!</textarea>
      </div>
      <input type="hidden" value="1" name="click"/>
      <button type="button" class="btn btn-primary" onclick="createAnnouncement();">Submit</button>
    </form>

    <h1 class="mt-5 mb-4">Edit Announcement</h1>
    <form id="announcement_edit" class="mb-5">
      <div class="form-group">
        <label for="id">Announcement ID:</label>
        <input type="text" class="form-control" id="id" name="id">
      </div>
      <div class="form-group">
        <label for="class_id">Class ID:</label>
        <input type="text" class="form-control" id="class_id" name="class_id">
      </div>
      <div class="form-group">
        <label for="text_entry">Text Entry:</label>
        <textarea class="form-control" id="text_entry" name="text_entry" rows="4" cols="50">Enter Announcement Here!</textarea>
      </div>
      <input type="hidden" value="1" name="edit"/>
      <button type="button" id="editBtn" class="btn btn-primary" onclick="editAnnouncement()">Submit</button> <!-- Cant get this one to work -->
      </form>

      <script>/*
      const editBtn = document.getElementById('editBtn');
      const titleInput = document.getElementById('title-input');
      const contentInput = document.getElementById('content-input');
     // const editForm = document.getElementById('edit-form');
      
      editBtn.addEventListener('click', () => {
        // show the form
       // editForm.style.display = 'block';
        
        // populate the form with current values
        titleInput.value = document.getElementById('title').textContent;
        contentInput.value = document.getElementById('content').textContent;
      });
      /*
      editForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // update the post with new values
        const updatedTitle = titleInput.value;
        const updatedContent = contentInput.value;
        document.getElementById('title').textContent = updatedTitle;
        document.getElementById('content').textContent = updatedContent;
        
        // hide the forma
        //editForm.style.display = 'none';
      })
      */;
      </script>
      
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

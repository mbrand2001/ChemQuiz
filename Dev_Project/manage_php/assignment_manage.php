<?php
include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor'){ 
  header('Location: ../index.php');
  exit();
}
if( isset($_POST['click'])){
    if(isset($_POST['class_id']) && isset($_POST['assignment_name']) && isset($_POST['assignment_type']) && isset($_POST['due_date']) && isset($_POST['num_attempts'])){ 
      if( !empty($_POST['class_id']) && !empty($_POST['assignment_name']) && !empty($_POST['assignment_type']) && !empty($_POST['due_date']) && !empty($_POST['num_attempts']) ){
        $class_id=$_POST['class_id'];
        $assignment_name=$_POST['assignment_name'];
        $assignment_type=$_POST['assignment_type'];
        $due_date=date('Y-m-d H:i:s',strtotime($_POST['due_date']));
        $num_attempts=$_POST['num_attempts'];
    
        $stmt = $conn->prepare("INSERT INTO Assignments(Class_id,Assignment_name,Assignment_type,due_date,No_of_attempts,Is_active) VALUES (?,?,?,?,?,1)"); 
        $stmt->bind_param("isssi",$class_id,$assignment_name,$assignment_type,$due_date,$num_attempts); 
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
      if(isset($_POST['id']) && isset($_POST['class_id']) && isset($_POST['assignment_name']) && isset($_POST['assignment_type']) && isset($_POST['due_date']) && isset($_POST['num_attempts'])){ 
        if( !empty($_POST['id']) && !empty($_POST['class_id']) && !empty($_POST['assignment_name']) && !empty($_POST['assignment_type']) && !empty($_POST['due_date']) && !empty($_POST['num_attempts']) ){
          $id = $_POST['id'];
          $class_id=$_POST['class_id'];
          $assignment_name=$_POST['assignment_name'];
          $assignment_type=$_POST['assignment_type'];
          $due_date=date('Y-m-d H:i:s',strtotime($_POST['due_date']));
          $num_attempts=$_POST['num_attempts'];
      
          $stmt = $conn->prepare("UPDATE Assignments SET Class_id=?,Assignment_name=?,Assignment_type=?,due_date=?,No_of_attempts=?,Is_active=1 where Assignment_id=? "); 
          $stmt->bind_param("isssii",$class_id,$assignment_name,$assignment_type,$due_date,$num_attempts,$id); 
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
          $stmt = $conn->prepare("DELETE FROM Assignments where Assignment_id = ?");
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
    if( isset($_POST['question_add'])){
      if(isset($_POST['assignment_id']) && isset($_POST['question_id']) ){ 
        if( !empty($_POST['assignment_id']) && !empty($_POST['question_id'])  ){
          $assignment_id=$_POST['assignment_id'];
          $question_id=$_POST['question_id'];
          $stmt = $conn->prepare("INSERT INTO Assignment_Question_List(Assignment_id,Question_id) VALUES (?,?)"); 
          $stmt->bind_param("ii",$assignment_id,$question_id); 
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
      if( isset($_POST['question_remove'])){
        if(isset($_POST['id'])){ 
          if(!empty($_POST['id'])){ 
            $id = $_POST['id'];
            $stmt = $conn->prepare("DELETE FROM Assignment_Question_List where Entry_id = ?");
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
      if((isset($_GET['refresh']) && $_GET['refresh'] == 1) ){
        $sql ="SELECT * FROM Assignments"; 
        $result = $conn->query($sql);
        if($result->num_rows > 0){ 
          echo "<table class='table table-bordered table-responsive' id='table'>";
            echo"<th>";
            echo"<tr>"; 
            echo"<td>Assignment ID</td>";
            echo"<td>Class ID</td>";
            echo"<td>Assignment Name</td>";
            echo"<td>Assignment Type</td>"; 
            echo"<td>Due Date</td>"; 
            echo"<td># attempts</td>"; 
            echo"<td>Active</td>"; 
            echo"</tr>";
            echo"</th>";
          while($row = $result->fetch_assoc()){ 
            echo"<tr>";
            echo"<td>".$row['Assignment_id']."</td>";
            echo"<td>".$row['Class_id']."</td>";
            echo"<td>".$row['Assignment_name']."</td>";
            echo"<td>".$row['Assignment_type']."</td>";
            echo"<td>".$row['Due_date']."</td>";
            echo"<td>".$row['No_of_attempts']."</td>";
            echo"<td>".$row['Is_active']."</td>";
            echo"</tr>";
          }
          echo "</table>";
        }
        if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){
        exit();
        }
      }


if((isset($_GET['refresh2']) && $_GET['refresh2'] == 1)){

$sql ="SELECT * FROM Assignment_Question_List"; 
$result = $conn->query($sql);
if($result->num_rows > 0){ 
  
  echo "<table class='table table-bordered table-responsive' style='width:100%'id='table 2'>";

    echo"<tr>"; 
    echo"<td>Entry ID</td>";
    echo"<td>Assignment ID</td>";
    echo"<td>Question ID</td>";
    
    echo"</tr>";
    echo"</th>";
  while($row = $result->fetch_assoc()){ 
    
    echo"<tr>";
    echo"<td>".$row['Entry_id']."</td>";
    echo"<td>".$row['Assignment_id']."</td>";
    echo"<td>".$row['Question_id']."</td>";
    echo"</tr>";
    
    
    

  }

  echo "</table>";
}
if((isset($_GET['refresh2']) && $_GET['refresh2'] == 1)){
exit();
}
}
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CHEMQuiz - Manage Assignments</title>
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
          <script src="../javascript/Async.js"></script>
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
        <img src="../imgs/logo.png" style="max-width:40px; max-height:40px;" />
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
      <div class="link-nav"><a onclick="logoutcallmanage()" id="logoutbtn">Log-out</a></div>
    </div> 
</nav>
  <div class="container mt-4">
    </br>
      <h4 class="">Manage Assignments</h4>
      <br />
      <h1 id=warning></h1>
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Create Assignment</h5>
            </div>
            <div class="card-body">
              <form id="assignment_create">
                <div class="form-group">
                  <label for="class_id">Class ID:</label><br>
                  <input type="text" class="form-control" id="class_id" name="class_id"><br>
                </div>
                <div class="form-group">
                  <label for="assignment_name">Assignment Name:</label><br>
                  <input type="text" class="form-control" id="assignment_name" name="assignment_name"><br>
                </div>
                <div class="form-group">
                  <label for="assignment_type">Assignment Type:</label><br>
                  <input type="text" class="form-control" id="assignment_type" name="assignment_type"><br>
                </div>  
                <div class="form-group">
                  <label for="due_date">Due Date:</label><br>
                  <input type="datetime-local" class="form-control" id="due_date" name="due_date"><br>
                </div>
                <div class="form-group">
                  <label for="num_attempts">Max. attempts</label><br>
                  <input type="text" class="form-control" id="num_attempts" name="num_attempts">
                </div>
                <div class="form-group">
                  <input type="hidden" value="1" name="click"/>
                  <button class="btn btn-primary" type="button" onclick="createAssignment();">Submit</button>
                </div>
              </form>
        </div>
      </div>
    </div>
      <div class="col-md-6">
          <div class="card" style="height:100%;">
              <div class="card-header">
                  <h5 class="mb-0">All Assignments Table</h5>
              </div>
              <div class="card-body" id="table area">
                  <table class="table table-bordered">
                    <?php
                  $sql ="SELECT * FROM Assignments"; 
          $result = $conn->query($sql);
          if($result->num_rows > 0){ 
            echo "<table id='table' class='table table-bordered table-responsive'>";
              echo"<tr>"; 
              echo"<td>Assignment ID</td>";
              echo"<td>Class ID</td>";
              echo"<td>Assignment Name</td>";
              echo"<td>Assignment Type</td>"; 
              echo"<td>Due Date</td>"; 
              echo"<td># attempts</td>"; 
              echo"<td>Active</td>"; 
              echo"</tr>";
              echo"</th>";
            while($row = $result->fetch_assoc()){ 
              
              echo"<tr>";
              echo"<td>".$row['Assignment_id']."</td>";
              echo"<td>".$row['Class_id']."</td>";
              echo"<td>".$row['Assignment_name']."</td>";
              echo"<td>".$row['Assignment_type']."</td>";
              echo"<td>".$row['Due_date']."</td>";
              echo"<td>".$row['No_of_attempts']."</td>";
              echo"<td>".$row['Is_active']."</td>";
              echo"</tr>";
            }
            echo "</table>";
          }
          ?>
                          <!-- Assignments will be added dynamically here -->
                      </tbody>
                  </table>
              </div>
          </div>
      </div>


  <div class="container mt-4">
      <br />
      <h1 id=warning></h1>
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Edit Assignment</h5>
            </div>
            <div class="card-body">
              <form id="assignment_edit">
                <label for="id">Assignment ID:</label><br>
                <input class="form-control" type="text" id="id" name="id"><br>
                <label for="class_id">Class ID:</label><br>
                <input class="form-control" type="text" id="class_id" name="class_id"><br>
                <label for="assignment_name">Assignment Name:</label><br>
                <input class="form-control" type="text" id="assignment_name" name="assignment_name"><br>
                <label for="assignment_type">Assignment Type:</label><br>
                <input class="form-control" type="text" id="assignment_type" name="assignment_type"><br>
                <label for="due_date">Due Date:</label><br>
                <input class="form-control" type="datetime-local" id="due_date" name="due_date"><br>
                <label for="num_attempts">Max. attempts:</label><br>
                <input class="form-control" type="text" id="num_attempts" name="num_attempts">
                <input type="hidden" value="1" name="edit"/>
              </br>
                <button type="button" class="btn btn-primary"  onclick="editAssignment();">Submit</button>
              </form>
        </div>
      </div>
    </div>
      <div class="col-md-6">
          <div class="card" style="height:auto !important;">
              <div class="card-header">
                  <h5 class="mb-0">Delete Assignments</h5>
              </div>
              <div class="card-body" id="table area" style="height:100%">
              
  <form id="assignment_delete">
    <label for="id">Assignment ID:</label><br>
    <input  class="form-control" type="text" id="id" name="id"><br>
    <input type="hidden" value="1" name="delete"/>
  </br>
    <button type="button" class="btn btn-primary btn-danger" onclick="deleteAssignment();">Submit</button>
  </form>
              </div>
          </div>
        </br>
        </br>
          <div class="card" style="height:auto !important;">
              <div class="card-header">
                  <h5 class="mb-0">Remove Questions</h5>
              </div>
              <div class="card-body" id="table area" style="height:100%">
              <form id="question_remove">
    <label for="entry_id">Question ID:</label><br>
    <input type="text" class="form-control" id="id" name="id"><br>
    <input type="hidden" value="1" name="question_remove"/>
    <button type="button" class="btn btn-primary btn-danger" onclick="removeQuestion();">Submit</button>
  </form>
      </div>
      
      </div>
        </br></br>
      
  </div>

  
        </div></div></div>
  <div id="table area a"> 
        </br>
        <div class="card" style="height:auto !important;">
              <div class="card-header">
                  <h5 class="mb-0">All Questions Table</h5>
              </div>
              <div class="card-body" id="table area" style="height:100%">
  <?php
  //if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

  $sql ="SELECT * FROM Questions"; 
  $result = $conn->query($sql);
  if($result->num_rows > 0){ 
    
    echo "<table class='table-responsive table table-bordered' style='max-width:90vw;' id='table'>";
      
      echo"<tr>"; 
      echo"<td>Question ID</td>";
      echo"<td>Class ID</td>"; 
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
  /*
  if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){
  exit();
  }
  */
  //}
  ?>
  </div>       </div>


  <br>
  <div id="table area 2"> 
</br>
<div class="card" style="height:auto !important;">
              <div class="card-header">
                  <h5 class="mb-0">Question-Assignment Links</h5>
              </div>
              <div class="card-body" id="table area" style="height:100%">

  <?php
  

  $sql ="SELECT * FROM Assignment_Question_List"; 
  $result = $conn->query($sql);
  if($result->num_rows > 0){ 
    
    echo "<table class='table table-bordered' id='table 2'>";

      echo"<tr>"; 
      echo"<td>Entry ID</td>";
      echo"<td>Assignment ID</td>";
      echo"<td>Question ID</td>";
      
      echo"</tr>";
      echo"</th>";
    while($row = $result->fetch_assoc()){ 
      
      echo"<tr>";
      echo"<td>".$row['Entry_id']."</td>";
      echo"<td>".$row['Assignment_id']."</td>";
      echo"<td>".$row['Question_id']."</td>";
      echo"</tr>";
      
      
      

    }

    echo "</table>";
  }
  
  
  ?>
  </div>  
</div>

</div>

  
  </br> 
  </br>
  <div class="card" style="height:auto !important;">
              <div class="card-header">
                  <h5 class="mb-0">Link Question</h5>
              </div>
              <div class="card-body" id="table area" style="height:100%">
              
  <form id="question_add">
    <label for="assignment_id">Assignment ID:</label><br>
    <input type="text" class="form-control" id="assignment_id" name="assignment_id"><br>
    <label for="question_id">Question ID:</label><br>
    <input type="text" class="form-control" id="question_id" name="question_id"><br>
    <input type="hidden" value="1" name="question_add"/>
    <button type="button" class="btn btn-primary" onclick="addQuestion();">Submit</button>
  </form>
      </div></div>

  </br> 
  </br>

</div>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
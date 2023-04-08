<?php
include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor'){ 
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEMQuiz - Manage Calendar</title>
    <meta name="description" content="CHEMQuiz.">
    <meta name="keywords" content="Chem practice problems">
    <meta name="author" content="Michael Brand, Juan Cadile">
    <meta http-equiv="Pragma" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="expires" content="-1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Project CSS -->
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <!-- Local JS -->
    <script src="javascript/logout_script.js"></script>
    <script src="../js/layout.js"></script>
    <script src="../js/dashboard.js"></script>
    <script src="../js/internal-project.js"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">    
</head>
<body>
    <script src="../javascript/Async.js"></script>
    <!-- Start of nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <b>CHEMQuiz</b>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./dashboard.php">Back To Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" onclick="logoutcall()" id="logoutbtn">Log-out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 id="warning"></h1>
        <h1> Welcome admin!</h1>
        <div id="table_area" class="container-rounded"> 
        <?php
        if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

        $sql ="SELECT * FROM Calender_Entry"; 
        $result = $conn->query($sql);
        if($result->num_rows > 0){ 
          
          echo "<table id='table' class='table table-striped'>";
            echo"<thead>";
            echo"<tr>"; 
            echo"<th scope='col'>Entry Id</th>";
            echo"<th scope='col'>Class Id</th>";
            echo"<th scope='col'>Calender Date</th>"; 
            echo"<th scope='col'>Text Entry</th>"; 
            echo"</tr>";
            echo"</thead>";
            echo"<tbody>";
          while($row = $result->fetch_assoc()){ 
            
            echo"<tr>";
            echo"<td>".$row['Entry_id']."</td>";
            echo"<td>".$row['Class_id']."</td>";
            echo"<td>".$row['Calender_date']."</td>";
            echo"<td>".$row['Text_entry']."</td>";
            echo"</tr>";
          }

          echo "</tbody>";
          echo "</table>";
        }
        if((isset($_GET['refresh']) && $_GET['refresh'] == 1)){
        exit();
        }
        }
        ?>
        </div>
        <div class="container-rounded">
            <h3>Create Entry</h3>
            <form id="calender_create">
                <div class="form-group">
                    <label for="class_id">Class_id:</label>
                    <input type="text" id="class_id" name="class_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date">Pick Date</label>
                    <input type="date" id="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="text_entry">Text_entry:</label>
                    <textarea id="text_entry" name="text_entry" rows="4" cols="50" class="form-control">Enter Calender Text Here!</textarea>
                </div>
                <input type="hidden" value="1" name="click"/>
                <button type="button" onclick="createCalender();" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="container-rounded">
            <h3>Edit Entry</h3>
            <form id="calender_edit">
                <div class="form-group">
                    <label for="id">Calender Id:</label>
                    <input type="text" id="id" name="id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="class_id">Class_id:</label>
                    <input type="text" id="class_id" name="class_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date">Pick Date</label>
                    <input type="date" id="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="text_entry">Text_entry:</label>
                    <textarea id="text_entry" name="text_entry" rows="4" cols="50" class="form-control">Enter Calender Text Here!</textarea>
                </div>
                <input type="hidden" value="1" name="edit"/>
                <button type="button" onclick="editCalender();" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="container-rounded">
            <h3>Delete Calender</h3>
            <form id="calender_delete">
                <div class="form-group">
                    <label for="id">Calender Id:</label>
                    <input type="text" id="id" name="id" class="form-control">
                </div>
                <input type="hidden" value="1" name="delete"/>
                <button type="button" onclick="deleteCalender();" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
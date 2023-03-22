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

<html> 

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
            <b>CHEMQuiz</b>
            </a>
            </div>
            </div>
            <div id="right-side">
            <div class="link-nav"><a style="color:black; text-decoration:none;" href="./dashboard.php">Back To Dashboard</a></div>
            <div class="link-nav"><a onclick="logoutcall()" id="logoutbtn">Log-out</a></div>
        </div>
    </nav>


<h1 id=warning></h1>
<h1> Welcome admin!</h1>
<div id="table area"> 
<?php
if((isset($_GET['refresh']) && $_GET['refresh'] == 1) || empty($_REQUEST)){

$sql ="SELECT * FROM Calender_Entry"; 
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
<p>Create Entry</p>
<form id="calender_create">
  
  <label for="class_id">Class_id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <lable for="date"> Pick Date</label><br>
  <input type="date" id="date" name="date">
  <label for="text_entry">text_entry:</label><br>
  <textarea id="text_entry" name="text_entry" rows="4" cols="50">Enter Calender Text Here!</textarea>
  <input type="hidden" value="1" name="click"/>
</br>
  <button type="button" onclick="createCalender();">Submit</button>
</form>

</br> 
</br>

<p>Edit Entry</p>
<form id="calender_edit">
  <label for="id">Calender Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <label for="class_id">Class_id:</label><br>
  <input type="text" id="class_id" name="class_id"><br>
  <lable for="date"> Pick Date</label><br>
  <input type="date" id="date" name="date">
  <label for="text_entry">text_entry:</label><br>
  <textarea id="text_entry" name="text_entry" rows="4" cols="50">Enter Calender Text Here!</textarea>
  <input type="hidden" value="1" name="edit"/>
</br>
  <button type="button" onclick="editCalender();">Submit</button>
</form>

</br> 
</br>


<p>Delete Calender</p>
<form id="calender_delete">
  <label for="id">Calender Id:</label><br>
  <input type="text" id="id" name="id"><br>
  <input type="hidden" value="1" name="delete"/>
</br>
  <button type="button" onclick="deleteCalender();">Submit</button>
</form>



</body>
</html>
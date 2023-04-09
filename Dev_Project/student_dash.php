
<?php
include("includes/classes.php");
session_start();
$user = $_SESSION["user"];

if($_SESSION['user']->role != 'student'){ 
    header('Location: index.php');
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEMQuiz - Student Dashboard</title>
        <meta name="description" content="CHEMQuiz.">
        <meta name="keywords" content="Chem practice problems">
        <meta name="author" content="Michael Brand, Juan Cadile">
        <meta http-equiv="Pragma" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="expires" content="-1">
        <!-- Bootstrap CSS 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">-->
        <!-- Project CSS -->
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <!-- Local JS -->
        <script src="javascript/logout_script.js"></script>
        <script src="javascript/Register.js"></script>
        <script src="js/layout.js"></script>
        <script src="js/dashboard.js"></script>
        <script src="js/internal-project.js"></script>
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">   
        <script src="/javascript/Nav.js"></script> 
        <!-- Head ends -->
    </head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="border: 0px solid black;">
    <!-- Start of nav bar -->
    <nav>
        <div id="left-side">
        <div id="logo-div">
            <a>
            <img src="./imgs/logo.png" style="width:40px; height:40px;" />
            </a>
            </div>
            </div>
            <div id="right-side">
            <div class="link-nav"><a style="color:black; text-decoration:none;" href="./student_dash.php">Back To Dashboard</a></div>
            <div class="link-nav"><a onclick="logoutcall()" id="logoutbtn">Log-out</a></div>
        </div>
    </nav>
    <!-- Nav bar ends -->
    <div class="container-fluid">
        <div class="row">
    <!-- Left column -->
    <div class="col-md-3">
        <div class="container-rounded">
        <table class='table'>
        <thead>
        <tr>
        <th scope='col'>Assignments</th>
        <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php 
       
        
        /*
        $_SESSION["user"] = new Student(1,'a','a','a','a',1,2,3,4,5);
        $user = $_SESSION["user"];
        */
        $assignments_due = $user->getAssignmentsDue(); 
        

            foreach($assignments_due as $assignment){ 
                echo " <tr>";
                echo " <td>Assignment: ".$assignment[1]."<br />";
                echo " Due: ".$assignment[1]."<br></td>";
                echo " <td><button onclick='beginAssignment($assignment[0]);' type='button' class='btn btn-view btn-primary'><i class='fas fa-eye'></i> View</button></td>";
                //echo "Assignment Id: ". $assignment[0]."<br>";
                //echo "Assignment Name: ". $assignment[1]."<br>";
                //echo "Assignment Due: ". $assignment[2]."<br>";
                //echo "Assignment Active: ". $assignment[3]."<br>";
                //echo "<br>";
                //echo "<br>";
            }
            echo ' </tbody>';
            echo "</table>";
            echo "</div>";
            ?>

<div class="container-rounded">
        <table class='table'>
        <thead>
        <tr>
        <th scope='col'>Classes</th>
        <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php 
       
        
        /*
        $_SESSION["user"] = new Student(1,'a','a','a','a',1,2,3,4,5);
        $user = $_SESSION["user"];
        */
        $assignments_due = $user->getAssignmentsDue(); 
        $classes = $user->getClasses();
        //echo $classes;
        var_dump($classes);

            foreach($assignments_due as $assignment){ 
                echo " <tr>";
                echo " <td>Class: ".$assignment[1]."<br />";
                echo " Professor: ".$assignment[1]."<br></td>";
                echo " <td><button onclick='beginAssignment($assignment[0]);' type='button' class='btn btn-view btn-primary'><i class='fas fa-eye'></i> View</button></td>";
                //echo "Assignment Id: ". $assignment[0]."<br>";
                //echo "Assignment Name: ". $assignment[1]."<br>";
                //echo "Assignment Due: ". $assignment[2]."<br>";
                //echo "Assignment Active: ". $assignment[3]."<br>";
                //echo "<br>";
                //echo "<br>";
            }
            echo ' </tbody>';
            echo "</table>";
            echo "</div>";
            ?>


        <?php
        
            $sql ="SELECT Class.Class_id,Class.Class_name,Users.First_Name,Users.Last_Name FROM Class Inner JOIN Users on Users.User_ID=Class.Professor_id"; //and Users.Role='professor'"; 
            $result = $conn->query($sql);
            if($result->num_rows > 0){ 
            echo "<table class='table table-striped'>";
            echo"<thead>";
            echo"<tr>";
            echo"<th>Class Id</th>";
            echo"<th>Class Name</th>";
            echo"<th>Professor First Name</th>";
            echo"<th>Professor Last Name</th>";
            echo"</tr>";
            echo"</thead>";
            echo"<tbody>";
            while($row = $result->fetch_assoc()){

            echo"<tr>";
            echo"<td>".$row['Class_id']."</td>";
            echo"<td>".$row['Class_name']."</td>";
            echo"<td>".$row['First_Name']."</td>";
            echo"<td>".$row['Last_Name']."</td>";
            echo"</tr>";

            }
            echo"</tbody>";
            echo "</table>";
            }

        ?>


        </div>
        <!-- Right column -->
        <div class="col-md-9">
            <div class="container-rounded">
                <h4>Announcements</h4>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <?php 
                              $Announcement_Class =  new Announcements();
                              $array = $Announcement_Class->getEntries(1); 
                              // var_dump($array);
                            echo "<h5 class='card-title'>".$array[0]->Class_id."</h5>";
                            echo "<h5 class='card-title'>".$array[0]->Class_Name."</h5>";
                            echo "<p class='card-text'>".$array[0]->Text."</p>";
                            echo "<p class='card-text'><small class='text-muted'>".$array[0]->Date."</small></p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="register_class">
    <b id="response"></b>
    <label for="class_code">Class_Code</label>
    <input type="text" name="class_code" id="class_code"/>
    <button type="button" onclick="registerClass();">Submit</button>
        </form>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Fontawesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-qqg+l5/+CUy7P5yJcluOzK0oYYNFl9z1ZpNkSujwVfMg1/AL3h4FQ4d4KjSBz+tw9KGcZp55NYevhRuo7Meag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>

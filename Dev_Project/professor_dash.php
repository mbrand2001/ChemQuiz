<?php
include("includes/classes.php");
session_start();
$user = $_SESSION["user"];


if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor' ){ 
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
        <img src="../imgs/logo.png" style="max-width:40px; max-height:40px;" />
        </a>
      </div>
        
        </a>
        </div>
        </div>
        <div id="right-side">
        <div class="link-nav"><a href="manage_php/announcement_manage.php">Manage Announcements</a></div>
        <div class="link-nav"><a href="manage_php/assignment_manage.php">Manage Assignments</a></div>
        <div class="link-nav"><a href="manage_php/class_manage.php">Manage Classes </a></div>
        <div class="link-nav"><a href="manage_php/question_manage.php">Manage Questions</a></div>
              <?php 
              if($_SESSION['user']->role == 'admin'){
               echo '<div class="link-nav"><a href="user_manage.php">Manage Users</a></div>';
              }
              ?>
        <div class="link-nav"><a onclick="logoutcall()" id="logoutbtn">Log-out</a></div> <!-- logout button not working -->
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
            $classes = array();
            $sql = "select * from Class where Professor_id = ".$user->user_id."";
            $result = $conn->query($sql);
           
            if($result->num_rows > 0){
             while($row = $result->fetch_assoc()){
                $class = new Class_Container($row["Class_id"],$row["Class_name"],"","","");


                array_push($classes,$class);
             }   
            }
            
           
            foreach($classes as $class){ 
                $assignments_due = $class->getAssignments();
            

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
        }
            echo ' </tbody>';
            echo "</table>";
            echo "</div>";
            
            ?>
            

        </div>
        <!-- Right column -->
        <div class="col-md-9">
            <div class="container-rounded">
                <h4>Announcments</h4>
                <hr>
                <div class="card">


        


                    <div class="card-body">
                        <?php 
                        $Announcement_Class =  new Announcements();
                             foreach($classes as $class){ 
                                $array = $Announcement_Class->getEntries($class->class_id); 
                                foreach($array as $announcement){ 
                                    echo "<h5 class='card-title'>".$announcement->Class_id."</h5>";
                                    echo "<h5 class='card-title'>".$announcement->Class_Name."</h5>";
                                    echo "<p class='card-text'>".$announcement->Text."</p>";
                                    echo "<p class='card-text'><small class='text-muted'>".$announcement->Date."</small></p>";

                                }
                             }
                            



                              
                             
                              // var_dump($array);
                           
                        ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Fontawesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-qqg+l5/+CUy7P5yJcluOzK0oYYNFl9z1ZpNkSujwVfMg1/AL3h4FQ4d4KjSBz+tw9KGcZp55NYevhRuo7Meag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>

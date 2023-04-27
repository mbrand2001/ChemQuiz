<?php
include("includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin'){ 
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <!-- Start of head -->
    <head>
        <title>CHEMQuiz</title>
    
        <meta charset="UTF-8">
        <meta name="description" content="CHEMQuiz.">
        <meta name="keywords" content="Chem practice problems">
        <meta name="author" content="Michael Brand, Juan Cadile">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Pragma" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="expires" content="-1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <!-- Head ends -->
    </head>
    <!-- Start of body -->
    <body>
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
        <div class="link-nav"><a href="/manage_php/announcement_manage.php">Manage Announcements</a></div>
        <div class="link-nav"><a href="/manage_php/assignment_manage.php">Manage Assignments</a></div>
        <div class="link-nav"><a href="/manage_php/class_manage.php">Manage Classes </a></div>
        <div class="link-nav"><a href="/manage_php/question_manage.php">Manage Questions</a></div>
              <?php 
              if($_SESSION['user']->role == 'admin'){
               echo '<div class="link-nav"><a href="./manage_php/user_manage.php">Manage Users</a></div>';
              }
              ?>
        <div class="link-nav"><a onclick="logoutcall()" href="#" id="logoutbtn">Log-out</a></div> <!-- logout button not working -->
    </div>
    </nav>
    <!-- Nav bar ends -->
                <!-- Project main body -->
                <!-- Project identification -->
                <br />
                <br />
                <br />
                <div class="row">
                    <div style="padding-left:40px;"class="col-sm-12"><h1 id="project-name" class="main-claim">Hi admin, use menu to navigate webapp</h1></div>
                </div>
                <br />
               
    </div>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Body ends -->
    </body>
    <!-- Start of footer -->
    <footer>
        <!-- Footer ends -- empty -->
    </footer>
</html>

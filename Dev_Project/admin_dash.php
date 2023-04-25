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
               echo '<div class="link-nav"><a href="user_manage.php">Manage Users</a></div>';
              }
              ?>
        <div class="link-nav"><a onclick="logoutcall()" href="#" id="logoutbtn">Log-out</a></div> <!-- logout button not working -->
    </div>
    </nav>
    <!-- Nav bar ends -->
    <!-- Start of dynamic elements -->
    <div class="column info">
        <!-- Start Project Internal Page -->
        <div id="project-internal">
            <div class="container-fluid, top-extra-pad">
                <!-- Modal Edit Task -->
                <div class="modal fade" id="EditTaskModal" tabindex="-1" aria-labelledby="EditTaskModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new task</h5>
                                <button type="button" id="close-edit-task-modal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div  method="POST" id="contactForm" name="contact" role="form">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="task_name">Task Name</label>
                                            <input type="text" name="task_name" class="form-control" id="edit-task-name">
                                        </div>		
                                        <div class="form-group">
                                            <label for="task_description">Task Description</label>
                                            <input type="text" name="task_description" class="form-control" id="edit-task-description">
                                        </div>	
                                        <div class="form-group">
                                            <label for="due_date">Due Date</label>
                                            <input type="date" name="due_date" class="form-control" id="edit-task-due-date">
                                        </div>
                                        <select id="edit-task-status-selector" style="margin-bottom: 10px !important;" class="form-select" aria-label="Project Manager">
                                            <option selected id="selected-status">Select status</option>
                                            <option value="1">To Be Done</option>
                                            <option value="2">In Progress</option>
                                            <option value="3">QA</option>
                                            <option value="4">Approved</option>
                                        </select>
                                        <select id="edit-task-priority-selector" style="margin-bottom: 10px !important;" class="form-select" aria-label="Select priority">
                                            <option selected id="selected-priority">Select priority</option>
                                            <option value="1">🔥</option>
                                            <option value="2">🔥🔥</option>
                                            <option value="3">🔥🔥🔥</option>
                                        </select>				
                                    </div>
                                    <div class="modal-footer">					
                                        <button type="button" id="delete-task-modal" class="btn btn-danger" data-bs-dismiss="modal">Delete task</button>
                                        <button type="button" onclick="EditTask()" class="btn btn-primary" id="submitedittask">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Create New Task -->
                <div class="modal fade" id="createNewTaskModal" tabindex="-1" aria-labelledby="createNewTaskModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div  method="POST" id="contactForm" name="contact" role="form">
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="task_name">Task Name</label>
                                            <input type="text" name="task_name" class="form-control" id="task-name">
                                        </div>		
                                        <div class="form-group">
                                            <label for="task_description">Task Description</label>
                                            <input type="text" name="task_description" class="form-control" id="task-description">
                                        </div>	
                                        <div class="form-group">
                                            <label for="due_date">Due Date</label>
                                            <input type="date" name="due_date" class="form-control" id="task-due-date">
                                        </div>
                                        <select id="task-status-selector" style="margin-bottom: 10px !important;" class="form-select" aria-label="Project Manager">
                                            <option selected id="selected-status">Select status</option>
                                            <option value="1">To Be Done</option>
                                            <option value="2">In Progress</option>
                                            <option value="3">QA</option>
                                            <option value="4">Approved</option>
                                        </select>
                                        <select id="task-priority-selector" style="margin-bottom: 10px !important;" class="form-select" aria-label="Select priority">
                                            <option selected id="selected-priority">Select priority</option>
                                            <option value="1">🔥</option>
                                            <option value="2">🔥🔥</option>
                                            <option value="3">🔥🔥🔥</option>
                                        </select>			
                                        <select id="task-assigned-to" style="margin-bottom: 10px !important;" class="form-select" aria-label="Choose client">
                                            <option selected>Select developer</option>
                                        </select>				
                                    </div>
                                    <div class="modal-footer">					
                                        <button type="button" id="close-newtask-modal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" onclick="CreateNewTask()" class="btn btn-primary" id="submitnewtask">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project main body -->
                <!-- Project identification -->
                <div class="row">
                    <div class="col-sm-12"><h1 id="project-name" class="main-claim">CHEMQuiz</h1></div>
                </div>
                <br />
                <!-- Tasks table -->
                <div class="row">
                    <div class="col-sm-9"><h5>User table</h5></div>
                    <div class="col-sm-3">
                        <button type="button" style="margin-right:5px;margin-left:5px;" class="btn btn-primary right-align" data-bs-toggle="modal" data-bs-target="#createNewTaskModal" onclick="GetDevelopers()">New User</button>
                        <!-- <button type="button" style="margin-right:5px;margin-left:5px;" class="btn btn-primary right-align" onclick="createProjectReport()">Print report</button> -->
                    </div>
                </div>
            <div class="transparent-wrapper">
                <table class="table table-hover transparent-background">
                    <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Class</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id="internal-project-table">
                        <!-- Gets dinamically filled -->
                    </tbody>
                </table>
            </div>
            <br /><br /><br />
        </div>
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

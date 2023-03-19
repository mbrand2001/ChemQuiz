<?php
session_start();
if($_SESSION['role'] != 'student'){ 
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-TWIBnPHgiT67kzlGxv1np49SnW6GczHARhPXnXgzo3rjE3kB+eU6oMkxQrxnx8vvR22K+Vy0T1j47v39zyxwWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
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
    <!-- Nav bar ends -->
    <div class="container-fluid">
        <div class="row">
            <!-- Left column -->
            <div class="col-md-3">
                <div class="container-rounded">
                    <h5>Classes</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Class</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>English</td>
                                <td><button class="btn btn-view"><i class="fas fa-eye"></i> View</button></td>
                            </tr>
                            <tr>
                                <td>Math</td>
                                <td><button class="btn btn-view"><i class="fas fa-eye"></i> View</button></td>
                            </tr>
                            <tr>
                                <td>Science</td>
                                <td><button class="btn btn-view"><i class="fas fa-eye"></i> View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container-rounded">
                    <h5>Assignments Due Soon</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Assignment</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>English Essay</td>
                                <td><button class="btn btn-submit"><i class="fas fa-upload"></i> Submit</button></td>
                            </tr>
                            <tr>
                                <td>Math Homework</td>
                                <td><button class="btn btn-submit"><i class="fas fa-upload"></i> Submit
                                </tr>
                        <tr>
                            <td>Science Lab Report</td>
                            <td><button class="btn btn-submit"><i class="fas fa-upload"></i> Submit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Right column -->
        <div class="col-md-9">
            <div class="container">
                <h4>Announcements</h4>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome to the Spring Semester!</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra, velit in fringilla ultrices, elit eros suscipit elit, non ullamcorper justo tellus vel sapien. Morbi laoreet enim in ligula dictum, a ullamcorper enim finibus. Sed at aliquet mi, a commodo ex.</p>
                        <p class="card-text"><small class="text-muted">Posted on Jan 15, 2023</small></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Schedule for Mondays</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra, velit in fringilla ultrices, elit eros suscipit elit, non ullamcorper justo tellus vel sapien. Morbi laoreet enim in ligula dictum, a ullamcorper enim finibus. Sed at aliquet mi, a commodo ex.</p>
                        <p class="card-text"><small class="text-muted">Posted on Feb 10, 2023</small></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Science Fair Announcement</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra, velit in fringilla ultrices, elit eros suscipit elit, non ullamcorper justo tellus vel sapien. Morbi laoreet enim in ligula dictum, a ullamcorper enim finibus. Sed at aliquet mi, a commodo ex.</p>
                        <p class="card-text"><small class="text-muted">Posted on Mar 1, 2023</small></p>
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
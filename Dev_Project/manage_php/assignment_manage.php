<?php
include("../includes/db_connect.php");
include("../includes/classes.php");
session_start();
if($_SESSION['user']->role != 'admin' && $_SESSION['user']->role != 'professor'){ 
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEMQuiz - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-TWIBnPHgiT67kzlGxv1np49SnW6GczHARhPXnXgzo3rjE3kB+eU6oMkxQrxnx8vvR22K+Vy0T1j47v39zyxwWw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">CHEMQuiz - Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">

    <h1 class="mb-4">Welcome Admin!</h1>

    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Create Assignment</h5>
                </div>
                <div class="card-body">
                    <form id="assignment_create">
                        <div class="form-group">
                            <label for="class_id">Class ID:</label>
                            <input type="text" class="form-control" id="class_id" name="class_id" required>
                        </div>
                        <div class="form-group">
                            <label for="assignment_name">Assignment Name:</label>
                            <input type="text" class="form-control" id="assignment_name" name="assignment_name" required>
                        </div>
                        <div class="form-group">
                            <label for="assignment_type">Assignment
Type:</label>
<select class="form-control" id="assignment_type" name="assignment_type" required>
<option value="" disabled selected>Select Assignment Type</option>
<option value="quiz">Quiz</option>
<option value="homework">Homework</option>
<option value="exam">Exam</option>
</select>
</div>
<div class="form-group">
<label for="due_date">Due Date:</label>
<input type="date" class="form-control" id="due_date" name="due_date" required>
</div>
<div class="form-group">
<label for="points">Points:</label>
<input type="number" class="form-control" id="points" name="points" required>
</div>
<button type="submit" class="btn btn-primary">Create</button>
</form>
</div>
</div>

php
Copy code
    </div>

    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">View Assignments</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Class ID</th>
                            <th scope="col">Assignment Name</th>
                            <th scope="col">Assignment Type</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Points</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="assignments_table">
                        <!-- Assignments will be added dynamically here -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Custom JS -->
<script src="../scripts/admin.js"></script>
</body>
</html>
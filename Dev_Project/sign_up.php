<?php
include("includes/db_connect.php");
#!GOING TO HAVE TO CHANGE EMAIL TO UNIQUE IN DB!#
if( isset($_POST['click'])){
    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password'])){ 
      if( !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo -3;
          exit(0);
        }
        $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role=$_POST['role'];
    
        $stmt = $conn->prepare("INSERT INTO Users(First_Name,Last_Name,Email,Password,Role) VALUES (?,?,?,?,?)"); 
        $role = "student";
        $stmt->bind_param("sssss",$fname,$lname,$email,$password,$role); 
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
  <title>Student Sign Up</title> 
  <h1 id=warning></h1>
  <script src="javascript/Async.js"></script>
  <script src="javascript/Register.js"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link
    rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous"
  />
  
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Student Sign Up</h5>

            <form onkeydown="return event.key != 'Enter';" class="form-signin" id="sign_up">
              <div class="form-label-group">
              <label for="fname">First name</label>
              <input
                  type="fname"
                  id="fname"
                  for="fname"
                  name="fname"
                  class="form-control"
                  placeholder="First name"
                  required
                  autofocus
                />
                <label for="lname">Last name</label>
                <input
                  type="lname"
                  id="lname"
                  for="lname"
                  name="lname"
                  class="form-control"
                  placeholder="Last name"
                  required
                  autofocus
                />

              
                
                <label for="email">Email address</label>
                <input
                  type="email"
                  id="email"
                  for="email"
                  name="email"
                  class="form-control"
                  placeholder="Email address"
                  required
                  autofocus
                />
              </div>

              <label for="password">Password</label>
              <div class="form-label-group">
                <input
                  type="password"
                  id="password"
                  for="password"
                  name="password"
                  class="form-control"
                  placeholder="Password"
                  required
                />
              </div>
              <hr class="my-4" /> 
              <input type="hidden" value="1" name="click"/>
              <button
                class="btn btn-lg btn-primary btn-block text-uppercase"
                type="button"
                onclick="signUp();"
              >
                Sign Up
              </button>
              
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

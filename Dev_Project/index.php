<?php

session_start();
include("includes/db_connect.php");
if( isset($_POST['click'])){
if(isset($_POST["email"]) && isset($_POST["password"])){ 
  if(!empty($_POST['email']) && !empty($_POST['password'])){
   
    $sql ="Select * from Users"; 
    $result = $conn->query($sql);
    echo $conn->error;
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
           
            if($_POST['email'] == $row['Email']){ 
                if(password_verify($_POST['password'],$row['Password'])){
                    $_SESSION['id']   = $row["User_ID"];
                    $_SESSION['role'] =  $row['Role'];
                    $_SESSION['fname'] = $row['First_Name']; 
                    $_SESSION['lname'] = $row['Last_Name'];
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['class_1'] = $row['Class_1'];
                    $_SESSION['class_2'] = $row['Class_2'];
                    $_SESSION['class_3'] = $row['Class_3'];
                    $_SESSION['class_4'] = $row['Class_4'];
                    $_SESSION['class_5'] = $row['Class_5'];
                    
                    if($_SESSION['role'] === 'admin'){
                      echo "1";
                      exit();

                    }
                    if($_SESSION['role'] === 'student'){ 
                      echo "2";
                      exit();
                    }
                    if($_SESSION['role'] === 'professor'){ 
                      echo "3";
                      exit();
                    }

                    
                }
                else{ 
                    echo "-5";
                    exit();
                }

            }
          
        }
        echo "-6";
        exit();
        
    }
  }
  else{ 
    echo "-2";
    exit();
  }

}
else{ 
    echo "-3";
    exit();
  }
}
  
  ?>


<!DOCTYPE html>
<html lang="en">
<head> 
  <title>Login</title> 
  <h1 id=warning></h1>
  <script src="javascript/Async.js"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link
    rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous"
  />
  <title>Log-in Page</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>

            <form class="form-signin" id="login">
              <div class="form-label-group">
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
                <label for="email">Email address</label>
              </div>

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
                <label for="password">Password</label>
              </div>
              <input type="hidden" value="1" name="click"/>
              <button
                class="btn btn-lg btn-primary btn-block text-uppercase"
                type="submit"
                onclick="Login();"
              >
                Log In
              </button>
              <hr class="my-4" />
              <button
                class="btn btn-lg btn-secondary btn-block text-uppercase"
                type="submit"
              >
                Register
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>





<!--
<form id=loggin>
<label for="email">Email:</label><br>
<input type="text" id="eemail" name="email"><br>
<label for="password">Password:</label><br>
<input type="text" id="ppassword" name="password"><br>
<input type="hidden" value="1" name="click"/>
<button type="button" onclick="Login();">Submit</button>

</form>
<br>
-->
</body>
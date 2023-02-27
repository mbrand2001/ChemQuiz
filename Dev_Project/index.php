<?php
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
                    echo "1"; 
                    exit();
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


<html> 
<head> 
<title>Login</title>
<h1 id=warning></h1>
<script src="javascript/Async.js"></script>
</head> 
<body> 
<h1> Welcome! Please Login</h1>
<form id=login>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="password">Password:</label><br>
  <input type="text" id="password" name="password"><br>
  <input type="hidden" value="1" name="click"/>
  <button type="button" onclick="Login();">Submit</button>
  
</form>
<br>
</body>
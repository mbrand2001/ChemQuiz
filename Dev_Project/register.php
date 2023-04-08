<?php
include("includes/db_connect.php");
include("includes/classes.php");
session_start();

$array = array();





$user = $_SESSION["user"];

array_push($array,$user->class_1);
array_push($array,$user->class_2);
array_push($array,$user->class_3);
array_push($array,$user->class_4);
array_push($array,$user->class_5);




$id = $user->user_id;
if(isset($_POST["class_code"])){
    if(!empty($_POST["class_code"])){
        $sql ="SELECT Class_id,Code FROM Class"; 
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                if($_POST["class_code"] === $row["Code"] ){
                    

                    $class_id = $row['Class_id'];

                    if(in_array($class_id,$array)){
                        echo "Already in class";
                        exit();
                    }

                    
                    if($user->class_1 == NULL){ 
                        $stmt = $conn->prepare("UPDATE Users SET Class_1=?  where User_ID=?"); 
                        $stmt->bind_param("ii",$class_id,$id); 
                        if(!$stmt->execute()) echo $stmt->error;
                        $user->class_1 = $class_id;
                    
        
                        $_SESSION["user"]=$user;
                        echo"Class Added!";
                        exit();
  
                    }
                    else if($user->class_2 == NULL){ 
                        $stmt = $conn->prepare("UPDATE Users SET Class_2=?  where User_ID=?"); 
                        $stmt->bind_param("ii",$class_id,$id); 
                        if(!$stmt->execute()) echo $stmt->error;
                        $user->class_2 = $class_id;
                        $_SESSION["user"]=$user;
                        echo"Class Added!";
                        exit();
                        
                    }
                    else if($user->class_3 == NULL){ 
                        $stmt = $conn->prepare("UPDATE Users SET Class_3=?  where User_ID=?"); 
                        $stmt->bind_param("ii",$class_id,$id); 
                        if(!$stmt->execute()) echo $stmt->error;
                        $user->class_3 = $class_id;
                        $_SESSION["user"]=$user;
                        echo"Class Added!";
                        exit();
                        
                    }
                    else if($user->class_4 == NULL){ 
                        $stmt = $conn->prepare("UPDATE Users SET Class_4=?  where User_ID=?"); 
                        $stmt->bind_param("ii",$class_id,$id); 
                        if(!$stmt->execute()) echo $stmt->error;
                        $user->class_4 = $class_id;
                        $_SESSION["user"]=$user;
                        echo"Class Added!";
                        exit();
                        
                    }
                    else if($user->class_5 == NULL){ 
                        $stmt = $conn->prepare("UPDATE Users SET Class_5=?  where User_ID=?"); 
                        $stmt->bind_param("ii",$class_id,$id); 
                        if(!$stmt->execute()) echo $stmt->error;
                        $user->class_5 = $class_id;
                        $_SESSION["user"]=$user;
                        echo"Class Added!";
                        exit();
                        
                    }


                    
                }
                
            }
        }

    }
}

?>
<html>
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
        <script src="/javascript/Assignment.js"></script>
        <script type="text/javascript">
        window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
        </script>
    </head>
    
    <?php
    function str_contains($haystack,$needle){ 
        if (strpos($haystack, $needle) !== false) {
            return true;
        }
        return false;
    }

    include("includes/classes.php");
    session_start();

    $user = $_SESSION["user"];
    $current_assignment_id = $_GET["assignment"];
    if($user->role == "student" ){
    $valid_assignments = $user->getAssignmentsDue(); 
   
    }
    if($user->role == "professor" || $user->role =="admin"){
        $classes = array();
        $sql = "select * from Class where Professor_id = ".$user->user_id."";
        $result = $conn->query($sql);
        
        if($result->num_rows > 0){
         while($row = $result->fetch_assoc()){
            $class = new Class_Container($row["Class_id"],$row["Class_name"],"","","");


            array_push($classes,$class);
         }   
        }
        
        
        $valid_assignments = array();
        foreach($classes as $class){ 
            $assignments_due = $class->getAssignments();
        

        foreach($assignments_due as $assignment){ 
            array_push($valid_assignments,$assignment);


        }}

      
    
    }

    $valid = 0;

    foreach($valid_assignments as $assignment){ 
      
        if($assignment[0] == $current_assignment_id){ 
            $valid = 1;
        }
    }
/*
    if($valid === 0){ 
        header('Location: assignments.php');
        exit;
    }
    */

    $stmt = $conn->prepare("Select * from Assignments where Assignment_id = ?");
    $stmt->bind_param("i",$current_assignment_id); 
    $stmt->execute();
    $stmt->bind_result($ID,$CID,$name,$type,$date,$num_attempts,$is_active); 
    $stmt->close();
    $assignment = new Assignment($current_assignment_id,$CID,$name,$type,$date,$num_attempts,$is_active);
    $_SESSION['assignment'] = $assignment;

    $questions = $assignment->beginAssignment($user->user_id);
    $_SESSION['questions'] = $questions;
    $index = 0;
    $questionnumber = 1;

    echo '
    <nav>
        <div id="left-side">
        <div id="logo-div">
            <a>
            <img src="./imgs/logo.png" style="height:40px; width:40px" />
            </a>
            </div>
            </div>
            <div id="right-side">
            <div class="link-nav"><a style="color:black; text-decoration:none;" href="./student_dash.php">Back To Dashboard</a></div>
            <div class="link-nav"><a onclick="logoutcall()" id="logoutbtn">Log-out</a></div>
        </div>
    </nav>
    ';

    echo "<br/ > <br /><div class='container d-flex justify-content-center align-items-center'>";
    echo  "<div class='row'>";
        foreach($questions as $question){ 
            echo "
                <div class='card' style='padding-left: 0px !important; padding-right: 0px !important; margin-bottom:2em;'>
                <h5 class='card-header'>Question #$questionnumber</h5>
                <div class='card-body'>
                <h5 class='card-title'>$question[3]</h5>
                
                
                ";
            echo "<div class='question'>";
            // echo "<p><strong>Question id:</strong> $question[0]</p>";
            // echo "<p><strong>Question Text:</strong> $question[3]</p>";
            // echo "<p><strong>Question Answers:</strong> $question[4]</p>";
            if((str_contains($question[6],'.png') || str_contains($question[6],'.jpg')|| str_contains($question[6],'.jpeg')||str_contains($question[6],'.gif')) && !str_contains($question[6],'none')){
                echo "<img class='img-fluid' src='manage_php/diagrams/$question[6]' alt='Question diagram' />";
            }

            //echo "<p><strong>Question formula:</strong> $question[15]</p>";
            echo "<div class='response' id='response$index'></div>";
            echo "<button class='btn btn-primary' id='hintbutton$index' type='button' onclick='showHint($index,$question[0]);' style='visibility: hidden;'>Get Hint</button>";
            echo "<div class='hint' id='hintdiv$index'></div>";
            echo "<form class='question-form' id='question_form$index'>";
            echo "<div class='form-group'>";
            echo "<label for='answer'>Answer:</label>";
            echo "<input class='form-control' type='text' id='answer' name='answer'>";
            echo "</div>";
            echo "<input type='hidden' name='qid' value=$question[0]>";
            echo "<button class='btn btn-primary' id='submit$index' type='button' onclick='answerQuestion($index);'>Submit</button>";
            echo "</form>";
            echo "</div>";
            echo "<br class='mb-4'></div></div>";
            $index++;
            $questionnumber++;
        }
        ?>
        <div class="col-12 text-center">
        <button class="btn btn-primary" id="submit_assignment" type="button" onclick="submitAssignment();">Finish Assignment</button>
        <b id="grade"></b>
        <br><br>
        <a href='student_dash.php'><input class='btn btn-primary gray' type='button' value='Home'/></a>
        <br>
        <br>
        </div>
    </div>
    </div>
</html>        











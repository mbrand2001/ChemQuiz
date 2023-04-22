<?php 
include("db_connect.php");
 
class User{ 
    public $user_id;
    public $first_name; 
    public $last_name; 
    public $email; 
    public $role; 
    public $class_1; 
    public $class_2; 
    public $class_3; 
    public $class_4;
    public $class_5; 

    function __construct($user_id,$first_name,$last_name,$email,$role,$class_1,$class_2,$class_3,$class_4,$class_5){ 
        $this->user_id = $user_id;
        $this->first_name = $first_name; 
        $this->last_name =$last_name; 
        $this->email = $email; 
        $this->role = $role; 
        $this->class_1 =$class_1;
        $this->class_2 =$class_2;
        $this->class_3 =$class_3;
        $this->class_4 =$class_4;
        $this->class_5 =$class_5;
    }

    public function sendEmail($subject,$msg){ 
        // this is going to be a minor pain in the ass leaving this vid here for later: https://www.youtube.com/watch?v=fIYyemqKR58
        }

    // need to intializae this 


}


class Student extends User{ 




    public function getClasses(){ 
        global $conn;
        
        $stmt = $conn->prepare("SELECT Class_1,Class_2,Class_3,Class_4,Class_5 From Users where User_ID=?"); 
        $stmt->bind_param("i",$this->user_id); 
        $stmt->execute();

        $stmt->bind_result($c1,$c2,$c3,$c4,$c5);
        $stmt->fetch();
        $array = array($c1,$c2,$c3,$c4,$c5);
        return $array;
            
        
        
    }

    public function getAttempts($assignment_id){
        global $conn;
        
        $stmt = $conn->prepare("Select Attempts.Attempt_id,Users.First_Name,Users.Last_Name,Assignments.Assignment_name,Attempts.Grade,Attempts.Feedback,Attempts.Date from Attempts Inner join Users On Attempts.User_id=Users.User_ID INNER JOIN Assignments on Attempts.Assignment_id=Assignments.Assignment_id where Attempts.User_id=? and Attempts.Assignment_id=?");
        $stmt->bind_param("ii",$this->user_id,$assignment_id);
        $stmt->execute();
        $stmt->bind_result($id,$f_name,$l_name,$a_name,$grade,$feedback,$date);
        $array = array();
        while($stmt->fetch()){ 
            array_push($array, array($id,$f_name,$l_name,$a_name,$grade,$feedback,$date));

        }
        return $array;
    }

    public function getResponses($attempt_id){
        global $conn;
        
        $stmt = $conn->prepare("Select Questions.Question_text,Questions.Question_answers, Responses.Entry_id,Responses.Response,Responses.Correct from Responses Inner JOIN Questions on Questions.Question_id = Responses.Question_list_id where Attempt_id=?");
        $stmt->bind_param("i",$attempt_id);
        $stmt->execute();
        $stmt->bind_result($q_text,$q_answer,$id,$response,$correct);
        $array = array();
        while($stmt->fetch()){ 
            array_push($array, array($q_text,$q_answer,$id,$response,$correct));
            }
        return $array;

    }



    public function getAssignmentsDue(){ 
        global $conn;
        
        $stmt = $conn->prepare("Select Assignment_id,Assignment_name,Due_date,Is_active from Assignments where Class_id = (select Class_1 from Users where User_ID=?) OR Class_id = (select Class_2 from Users where User_ID=?) OR Class_id = (select Class_3 from Users where User_ID=?) OR Class_id = (select Class_4 from Users where User_ID=?) OR Class_id = (select Class_5 from Users where User_ID=?)");
        $stmt->bind_param("iiiii",$this->user_id,$this->user_id,$this->user_id,$this->user_id,$this->user_id); 
        $stmt->execute();
        $stmt->bind_result($id,$name,$due_date,$is_active); 
        $array = array();
        while($stmt->fetch()){
            array_push($array, array($id,$name,$due_date,$is_active));
        }



        return $array;

    }

    
    

}

class Professor extends User{
    public function getClasses($user_id = null){ 
        global $conn;
        
        $stmt = $conn->prepare("SELECT Class_1,Class_2,Class_3,Class_4,Class_5 From Users where User_ID=?"); 
        if(!empty($user_id)){
            $stmt->bind_param("i",$user_id); 
        }
        else{
        $stmt->bind_param("i",$this->user_id); 
        }
        $stmt->execute();

        $stmt->bind_result($c1,$c2,$c3,$c4,$c5);
        $stmt->fetch();
        $array = array($c1,$c2,$c3,$c4,$c5);
        return $array;
            
        
        
    }


    public function getAssignmentsDue(){ 
        global $conn;
        
        $stmt = $conn->prepare("Select Assignment_name,Due_date,Is_active from Assignments where Class_id = (select Class_1 from Users where User_ID=?) OR Class_id = (select Class_2 from Users where User_ID=?) OR Class_id = (select Class_3 from Users where User_ID=?) OR Class_id = (select Class_4 from Users where User_ID=?) OR Class_id = (select Class_5 from Users where User_ID=?)");
        $stmt->bind_param("iiiii",$this->user_id,$this->user_id,$this->user_id,$this->user_id,$this->user_id); 
        $stmt->execute();
        $stmt->bind_result($name,$due_date,$is_active); 
        $array = array();
        while($stmt->fetch()){
            array_push($array, array($name,$due_date,$is_active));
        }



        return $array;

    }



    public function getStudentAttempts($assignment_id, $student_id){
        global $conn;
        
        $stmt = $conn->prepare("Select Attempts.Attempt_id,Users.First_Name,Users.Last_Name,Assignments.Assignment_name,Attempts.Grade,Attempts.Feedback,Attempts.Date from Attempts Inner join Users On Attempts.User_id=Users.User_ID INNER JOIN Assignments on Attempts.Assignment_id=Assignments.Assignment_id where Attempts.User_id=? and Attempts.Assignment_id=?");
        $stmt->bind_param("ii",$student_id,$assignment_id);
        $stmt->execute();
        $stmt->bind_result($id,$f_name,$l_name,$a_name,$grade,$feedback,$date);
        $array = array();
        while($stmt->fetch()){ 
            array_push($array, array($id,$f_name,$l_name,$a_name,$grade,$feedback,$date));

        }
        return $array;
    }


    public function getStudentResponses($attempt_id){
        global $conn;
        
        $stmt = $conn->prepare("Select Questions.Question_text,Questions.Question_answers, Responses.Entry_id,Responses.Response,Responses.Correct from Responses Inner JOIN Questions on Questions.Question_id = Responses.Question_list_id where Attempt_id=?");
        $stmt->bind_param("i",$attempt_id);
        $stmt->execute();
        $stmt->bind_result($q_text,$q_answer,$id,$response,$correct);
        $array = array();
        while($stmt->fetch()){ 
            array_push($array, array($q_text,$q_answer,$id,$response,$correct));
            }
        return $array;

    }


    public function getStudents(){
        global $conn;
        $stmt = $conn->prepare("select User_ID,First_Name,Last_Name,Email,Class_1,Class_2,Class_3,Class_4,Class_5 from Users where Role = 'student' and Class_1 = ? or Class_1 = ? or Class_1 = ? or Class_1 = ? or Class_1 = ? or Class_2 = ? or Class_2 = ? or Class_2 = ? or Class_2 = ? or Class_2 = ? or Class_3 = ? or Class_3 = ? or Class_3 = ? or Class_3 = ? or Class_3 = ? or Class_4 = ? or Class_4 = ? or Class_4 = ? or Class_4 = ? or Class_4 = ? or Class_5 = ? or Class_5 = ? or Class_5 = ? or Class_5 = ? or Class_5 = ?;");
        $stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiii",$this->class_1,$this->class_2,$this->class_3,$this->class_4,$this->class_5,$this->class_1,$this->class_2,$this->class_3,$this->class_4,$this->class_5,$this->class_1,$this->class_2,$this->class_3,$this->class_4,$this->class_5,$this->class_1,$this->class_2,$this->class_3,$this->class_4,$this->class_5,$this->class_1,$this->class_2,$this->class_3,$this->class_4,$this->class_5);
        $stmt->execute();
        $stmt->bind_result($id,$fname,$lname,$email,$c1,$c2,$c3,$c4,$c5);
        $array = array();
        while($stmt->fetch()){ 
            array_push($array, array($id,$fname,$lname,$email,$c1,$c2,$c3,$c4,$c5));
            }
        return $array;

    }

    public function getStudent($user_id){
        global $conn;
        $stmt = $conn->prepare("select User_ID,First_Name,Last_Name,Email,Class_1,Class_2,Class_3,Class_4,Class_5 from Users where User_ID = ?"); 
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $stmt->bind_result($id,$fname,$lname,$email,$c1,$c2,$c3,$c4,$c5);
        $array = array();
        while($stmt->fetch()){ 
            array_push($array, array($id,$fname,$lname,$email,$c1,$c2,$c3,$c4,$c5));
            }
        return $array;
    }
} 

class Admin extends User{ 

}




class Class_Container { 
    public $class_id;
    public $class_name;
    public $professor_id;
    public $professor_first_name;
    public $professor_last_name;



    function __construct($class_id,$class_name,$professor_id,$professor_first_name,$professor_last_name){
        $this->class_id=$class_id;
        $this->class_name=$class_name;
        $this->professor_id=$professor_id;
        $this->professor_first_name=$professor_first_name;
        $this->professor_last_name=$professor_last_name;
    }



    public function getStudents(){ 
        global $conn;
        $stmt = $conn->prepare("select User_ID,First_Name,Last_Name,Email from Users where Role = 'student' and Class_1 = ? or Class_2 = ? or Class_3 = ? or Class_4 = ? or Class_5 = ?");
        $stmt->bind_param("iiiii",$this->class_id,$this->class_id,$this->class_id,$this->class_id,$this->class_id);
        $stmt->execute();
        $stmt->bind_result($id,$fname,$lname,$email);
        $array = array();
        while($stmt->fetch()){ 
            array_push($array, array($id,$fname,$lname,$email));
            }
        
            return $array;


    }


    public function getAssignments(){ 
        global $conn;
        
        $stmt = $conn->prepare("Select Assignment_id,Assignment_name,Due_date,Is_active from Assignments where Class_id = ?");
        $stmt->bind_param("i",$this->class_id); 
        $stmt->execute();
        $stmt->bind_result($id,$name,$due_date,$is_active); 
        $array = array();
        while($stmt->fetch()){
            array_push($array, array($id,$name,$due_date,$is_active));
        }

        



        return $array;

    }
    /*
    public function makeAnnouncement(){ 
        global $conn;
        
        $stmt = $conn->prepare("Insert into Announcment_Entry");

    }
    */

}

class Assignment{ 
    public $assignment_id;
    public $class_id;
    public $assignment_name;
    public $assignment_type; 
    public $due_date;
    public $num_attempts;
    public $is_active;
    public $attempt_id;

    function __construct($assignment_id,$class_id,$assignment_name,$assignment_type,$due_date,$num_attempts,$is_active){
    $this->assignment_id = $assignment_id;
    $this->class_id = $class_id;
    $this->assignment_name = $assignment_name;
    $this->assignment_type = $assignment_type;
    $this->due_date = $due_date;
    $this->num_attempts = $num_attempts;
    $this->is_active = $is_active;
    }


    function beginAssignment($user_id){ 
        global $conn;


        $sql = "SELECT MAX(Attempt_id) from Attempts";
        $result = $conn->query($sql);
        if($result->num_rows > 0){ 
            $row = $result->fetch_array();
            $this->attempt_id =  1+$row[0];
            
        
        };




        
        
        $stmt = $conn->prepare("Select * from Questions where Question_id in (Select Question_id From Assignment_Question_List where Assignment_id =?)");
        if($stmt == false){ 
            var_dump($conn->error_list);
        }
        $stmt->bind_param("i",$this->assignment_id); 
        $stmt->execute();
        $stmt->bind_result($qid,$cid,$qty,$qte,$qa,$qta,$qdu,$s1,$s2,$s3,$s4,$s1a,$s2a,$s3a,$s4a,$formula); 
        $array = array();
        while($stmt->fetch()){
            array_push($array, array($qid,$cid,$qty,$qte,$qa,$qta,$qdu,$s1,$s2,$s3,$s4,$s1a,$s2a,$s3a,$s4a,$formula));
        }

        
        $stmt = $conn->prepare("Insert into Attempts(Assignment_id,User_id,Date) Values(?,?,NOW())");
        $stmt->bind_param("ii",$this->assignment_id,$user_id); 
        $stmt->execute();
        
       /*
        $stmt = $conn->prepare("Select * from Attempts where Attempt_id = ?");
        
        $stmt->bind_param("i",$this->attempt_id); 
        $stmt->execute();
        
        $stmt->bind_result($atid,$asid,$uid,$g,$f,$d);
        $array2 = array();
        while($stmt->fetch()){
            array_push($array2, array($atid,$asid,$uid,$g,$f,$d));
        }
        var_dump($array2);
            */





        

        return $array;
        
    }

    function answerQuestion($questions,$question_id,$answer){
        global $conn;
        $answer = "".$answer."";
        $stmt = $conn->prepare("Insert into Responses(Question_list_id,Attempt_id,Response,Correct) Values(?,?,?,?)");
        foreach ($questions as $question){ 
            if($question[0] == $question_id){
                $ans_arr = preg_split("/\,/",$question[4]);
                foreach($ans_arr as $ans){ 
                    if($ans === $answer){
                    //echo "blah1";
                    $t = 1;
                    $stmt->bind_param("iisi",$question_id,$this->attempt_id,$answer,$t); 
                    $stmt->execute();
                    $stmt->close();
                    return true;
                    }
                }
                   // echo "blah2";
                    $t = 0;
                    $stmt->bind_param("iisi",$question_id,$this->attempt_id,$answer,$t); 
                    $stmt->execute();
                    $stmt->close();
                    return false;
            }
        }
        




    }

    function submitAssignment(){ 
        global $conn;
        $stmt = $conn->prepare("Select Correct from Responses where Attempt_id = ?");
        $stmt->bind_param("i",$this->attempt_id); 
        $stmt->execute();
        $stmt->bind_result($grade); 
        $array = array();
        while($stmt->fetch()){
            array_push($array, $grade);
            
        }
        $size = count($array);
        $correct = 0;
        foreach($array as $ans){ 
            if($ans === 1){
                $correct++;


            }
        }

        $final_grade = $correct/$size;

        $final_grade = round($final_grade,2) * 100;

        $stmt = $conn->prepare("Update Attempts set Grade = ? WHERE attempt_id = ?");
        $stmt->bind_param("ii",$final_grade,$this->attempt_id); 
        $stmt->execute();
        return $final_grade;

    }

}


class Calender_Entry{ 
    public $Entry_id;
    public $Class_id; 
    public $Class_Name;
    public $Date; 
    public $Text;

   function __construct($Entry_id, $Class_id, $Class_Name ,$Date, $Text){ 
    $this->Entry_id = $Entry_id;
    $this->Class_id = $Class_id;
    $this->Class_Name = $Class_Name;
    $this->Date   = $Date;
    $this->Text = $Text;

    }
}


class Annoucement_Entry{ 
    public $Entry_id;
    public $Class_id; 
    public $Class_Name;
    public $Date; 
    public $Text;

   function __construct($Entry_id, $Class_id,$Class_Name ,$Date, $Text){ 
    $this->Entry_id = $Entry_id;
    $this->Class_id = $Class_id;
    $this->Class_Name = $Class_Name;
    $this->Date   = $Date;
    $this->Text = $Text;

    }
}




class Calender{ 
    public $Entry_array;
    function getEntries($class_id){ 
        global $conn;
        $stmt = $conn->prepare("Select Entry_id, Calender_Entry.Class_id,  Class_Name, Calender_Date,Text_Entry from Calender_Entry inner join Class on Calender_Entry.Class_id = Class.Class_id where Calender_Entry.Class_id=?");
        $stmt->bind_param("i",$class_id); 
        $stmt->execute();
        $stmt->bind_result($eid,$cid,$Class_Name,$cdate,$text); 
        $this->Entry_array = array();
        while($stmt->fetch()){
            array_push($this->Entry_array, new Calender_Entry($eid,$cid,$Class_Name,$cdate,$text));
            
        }
        
        return $this->Entry_array;
        

    }

}







class Announcements{ 
    public $Entry_array;
    function getEntries($class_id){ 
        global $conn;
        $stmt = $conn->prepare("Select Entry_id, Announcement_Entry.Class_id, Class_Name,Calender_Date,Text_Entry from Announcement_Entry inner join Class on Announcement_Entry.Class_id = Class.Class_id where Announcement_Entry.Class_id=? ");
        $stmt->bind_param("i",$class_id); 
        $stmt->execute();
        $stmt->bind_result($eid,$cid,$Class_Name,$cdate,$text); 
        $this->Entry_array = array();
        while($stmt->fetch()){
            array_push($this->Entry_array, new Annoucement_Entry($eid,$cid,$Class_Name,$cdate,$text));
            
        }
        
        return $this->Entry_array;
        

    }

}


Class Element{ 
    public $element_id; 
    public $group; 
    public $period;
    public $atomic_number; 
    public $atomic_mass; 
    public $symbol;
    public $name;
    function __construct($element_id,$group,$period,$atomic_number,$atomic_mass,$symbol,$name){
    $this->element_id = $element_id;
    $this->group = $group;
    $this->period = $period;
    $this->atomic_number = $atomic_number;
    $this->atomic_mass = $atomic_mass;
    $this->symbol = $symbol;
    $this->name =  $name;

    }
}


Class Elements{ 
    public $Element_array; 
    function getElements(){ 
        global $conn;


        $sql = "select element_id,'group',period,atomic_number,atomic_mass,symbol,name from Elements";
        $result = $conn->query($sql);
        $this->Element_array = array();
        while($row = $result->fetch_assoc()){ 

            array_push($this->Element_array, new Annoucement_Entry($row['element_id'],$row['group'],$row['period'],$row['atomic_number'],$row['atomic_mass'],$row['symbol'],$row['name']));
            
        
        };



    

        return $this->Element_array;
    }

}









/*
//$user = new Professor(1,"lmao","lmao","mbrand1@gaels.iona.edu","admin",1,2,3,4,5);
//$classes =$user->getStudent(33);

$class = new Assignment(1,"a","lmao","lmao","lmao","a","a");
$students = $class->beginAssignment(1);
/*
if($class->answerQuestion($students,8,'2')){ 
    echo "true";
}
if(!$class->answerQuestion($students,8,'2')){ 
    echo "false";
}


$class->answerQuestion($students,8,'2');
$class->answerQuestion($students,8,'1');
$class->answerQuestion($students,8,'1');
$class->answerQuestion($students,8,'2');
$class->answerQuestion($students,8,'1');
$class->answerQuestion($students,8,'1');


echo $class->submitAssignment();
*/

?>


function Login(){ 
    req = new XMLHttpRequest(); 
    req.open('POST',"index.php",true)
    var formData = new FormData( document.getElementById("login")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Incorrect Credentials"
        }
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == -3){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="logged in"
            window.location.replace("admin_dash.php");
        }
        if(req.responseText == 2){ 
            document.getElementById('warning').innerText="logged in"
            window.location.replace("student_dash.php");
        }
        if(req.responseText == 3){ 
            document.getElementById('warning').innerText="logged in"
            window.location.replace("professor_dash.php");
        }
        if(req.responseText == -5){
            document.getElementById('warning').innerText="Incorrect Credentials"
       
        }
       
        }
    };
   
    req.send(formData)
    

}


function refreshTable(script_name, refresh_number=1){ 
    req = new XMLHttpRequest();
    if(refresh_number==1){
    req.open('GET',script_name+"?refresh=1",true);
    }
    if(refresh_number!=1){
        req.open('GET',script_name+"?refresh"+refresh_number+"=1",true);
        }
    req.onreadystatechange=function(){ 
        if(this.readyState == 4 && this.status == 200){
            tabletext=req.responseText
            if(refresh_number==1){
            index = tabletext.indexOf("<table id='table'>")
            }
            if(refresh_number !=1){
                index = tabletext.indexOf("<table id='table "+refresh_number+"'>")
                console.log(index);
            }
            tabletext = tabletext.substring(index)
            //console.log(tabletext)
            if(refresh_number ==1){
            document.getElementById("table area").innerHTML = tabletext;
            }
            if(refresh_number != 1){ 
                console.log(tabletext);
                document.getElementById("table area "+refresh_number+"").innerHTML = tabletext;
            }

        }
    }
    req.send()
}




function createUser(){ 
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("user_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="User Created!"
            refreshTable(script)
        }
        if(req.responseText == -3){ 
            document.getElementById('warning').innerText="Invalid Email!"

        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        
        }
    };
   
    req.send(formData)
  
    

}






function createClass(){ 
    req = new XMLHttpRequest(); 
    script ="class_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("class_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Class Created!"
            refreshTable(script)
        }
        if(req.responseText == -10){ 
            document.getElementById('warning').innerText="Professor Already Teaching Class!"
        }
       
        }
    };
   
    req.send(formData)
    

}


function createAnnouncement(){ 
    req = new XMLHttpRequest(); 
    script = "announcement_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("announcement_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Announcement Created!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}

function createCalender(){ 
    req = new XMLHttpRequest(); 
    script ="calender_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("calender_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Calender Entry Created!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}

function createQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "question_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("question_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question Created!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}

function createAssignment(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("assignment_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Assignment Created!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}


function deleteUser(){ 
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("user_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="User Deleted!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        
        }
    };
   
    req.send(formData)
  
    

}

function deleteQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "question_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("question_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question Deleted!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        
        }
    };
   
    req.send(formData)
  
    

}

function deleteClass(){ 
    req = new XMLHttpRequest(); 
    script ="class_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("class_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Class Deleted!"
            refreshTable(script)
        }
   
        }
    };
   
    req.send(formData)
    

}


function deleteCalender(){ 
    req = new XMLHttpRequest(); 
    script ="calender_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("calender_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Calender Entry Deleted!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}

function deleteAssignment(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("assignment_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Assignment Deleted!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}


function deleteAnnouncement(){ 
    req = new XMLHttpRequest(); 
    script = "announcement_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("announcement_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Announcement Deleted!"
            refreshTable(script)
        }
      
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)
}



function editUser(){ 
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("user_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="User Changed!"
            refreshTable(script)
        }
        if(req.responseText == -3){ 
            document.getElementById('warning').innerText="Invalid Email!"

        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        
        }
    };
   
    req.send(formData)
  
    
    

}


function editQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "question_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("question_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question Changed!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        
        }
    };
   
    req.send(formData)
  
    

}


function editClass(){ 
    req = new XMLHttpRequest(); 
    script ="class_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("class_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Class Changed!"
            refreshTable(script)
        }
       
        }
    };
   
    req.send(formData)
    

}


function editCalender(){ 
    req = new XMLHttpRequest(); 
    script ="calender_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("calender_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Calender Entry Changed!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}


function editAssignment(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("assignment_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Assignment Changed!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}





function editAnnouncement(){ 
    req = new XMLHttpRequest(); 
    script = "announcement_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("announcement_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText.trim())
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Announcement Changed!"
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)
}




function addQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("question_add")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question Added!"
            refreshTable(script, 2)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}


function removeQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("question_remove")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters!"
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty!"
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question removed!"
            refreshTable(script, 2)
        }
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        }
    };
   
    req.send(formData)

}


function setUserClassList(){ 
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("user_class_list")); 
    req.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
            if(req.responseText == -2){ 
                document.getElementById('warning').innerText="Missing Parameters!"
            }
            if(req.responseText == -1){ 
                document.getElementById('warning').innerText="Fields cannot be empty!"
            }
            if(req.responseText == 1){ 
                document.getElementById('warning').innerText="User Class List Set!"
                refreshTable(script)
            }
            else{ 
                document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
            }
            }

    }
    req.send(formData)
}


function uploadFile(){
    req = new XMLHttpRequest(); 
    script = "upload.php"; 
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("upload")); 
    req.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById('upload_response').innerText=this.responseText
    }
}
req.send(formData)
}


function checkFormula(num){ 
    req = new XMLHttpRequest(); 
    script = "formula.php"; 
    req.open('POST', script,true);
  
    formula = document.getElementById("formula" + num).value;
    console.log(formula);
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    req.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('response' + num).innerText=this.responseText;
            
        }
    }
    formula="formula="+formula;
    req.send(formula)
    

}
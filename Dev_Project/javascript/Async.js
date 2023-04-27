

/**
 * Sends a POST request to the server to log in the user.
 * @returns None
 */
function Login(){ 
    req = new XMLHttpRequest(); 
    req.open('POST',"index.php",true)
    var formData = new FormData( document.getElementById("login")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Incorrect Credentials."
        }
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == -3){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Logged in."
            window.location.replace("admin_dash.php");
        }
        if(req.responseText == 2){ 
            document.getElementById('warning').innerText="Logged in."
            window.location.replace("student_dash.php");
        }
        if(req.responseText == 3){ 
            document.getElementById('warning').innerText="Logged in."
            window.location.replace("professor_dash.php");
        }
        if(req.responseText == -5){
            document.getElementById('warning').innerText="Incorrect Credentials."
        }
        }
    };
    req.send(formData)
}


/**
 * Refreshes a table by making an XMLHttpRequest to the server and updating the table with the response.
 * @param {string} script_name - The name of the script to call for the table refresh.
 * @param {number} [refresh_number=1] - The number of the table to refresh.
 * @returns None
 */
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




/**
 * Sends a POST request to create a new user using the data from the form with the ID "user_create".
 * Displays a message based on the response from the server.
 * @returns None
 */
function createUser(){ 
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("user_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            //document.getElementById('warning').innerText="Missing Parameters."
            alert("Missing Parameters.")
        }
        if(req.responseText == -1){ 
            //document.getElementById('warning').innerText="Fields cannot be empty."
            alert("Fields cannot be empty.")
        }
        if(req.responseText == 1){ 
            //document.getElementById('warning').innerText="User Created."
            alert("User Created.")
            refreshTable(script)
        }
        if(req.responseText == -3){ 
            //document.getElementById('warning').innerText="Invalid Email."
            alert("Invalid Email.")
        }
        else{ 
            //document.getElementById('warning').innerText=""
        }
        
        }
    };
    req.send(formData)
}






/**
 * Sends a POST request to the server to create a new class using the data from the form.
 * @returns None
 */
function createClass(){ 
    req = new XMLHttpRequest(); 
    script ="class_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("class_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            //document.getElementById('warning').innerText="Missing Parameters."
            alert("Missing Parameters.")
        }
        if(req.responseText == -1){ 
            //document.getElementById('warning').innerText="Fields cannot be empty."
            alert("Fields cannot be empty.")
        }
        if(req.responseText == 1){ 
            //document.getElementById('warning').innerText="Class Created."
            alert("Class Created.")
            refreshTable(script)
        }
        if(req.responseText == -10){ 
            //document.getElementById('warning').innerText="Professor Already Teaching Class."
            alert("Class Created.")
        }
       
        }
    };
    req.send(formData)
}


/**
 * Sends a POST request to the server to create a new announcement.
 * @returns None
 */
function createAnnouncement(){ 
    req = new XMLHttpRequest(); 
    script = "announcement_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("announcement_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            //document.getElementById('warning').innerText="Missing Parameters."
            alert("Missing Parameters.")
        }
        if(req.responseText == -1){ 
            //document.getElementById('warning').innerText="Fields cannot be empty."
            alert("Fields cannot be empty.")
        }
        if(req.responseText == 1){ 
            //document.getElementById('warning').innerText="Announcement Created."
            alert("Announcement Created.")
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}

/**
 * Sends a POST request to the server to create a new calendar entry.
 * @returns None
 */
function createCalender(){ 
    req = new XMLHttpRequest(); 
    script ="calender_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("calender_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            //document.getElementById('warning').innerText="Missing Parameters."
            alert("Missing Parameters.")
        }
        if(req.responseText == -1){ 
            //document.getElementById('warning').innerText="Fields cannot be empty."
            alert("Fields cannot be empty.")
        }
        if(req.responseText == 1){ 
            //document.getElementById('warning').innerText="Calender Entry Created."
            alert("Calender Entry Created.")
            refreshTable(script)
        }
        else{ 
            //document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}

/**
 * Sends a POST request to the server to create a new question.
 * @returns None
 */
function createQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "question_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("question_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            //document.getElementById('warning').innerText="Missing Parameters."
            alert("Missing Parameters.")
        }
        if(req.responseText == -1){ 
            //document.getElementById('warning').innerText="Fields cannot be empty."
            alert("Fields cannot be empty.")
        }
        if(req.responseText == 1){ 
            //document.getElementById('warning').innerText="Question Created."
            alert("Question Created.")
            refreshTable(script)
        }
        else{ 
            //document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}
/**
 * Sends a POST request to create a new assignment using the data from the form with the ID "assignment_create".
 * Displays a warning message based on the response from the server.
 * @returns None
 */
function createAssignment(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("assignment_create")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Assignment Created."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}


/**
 * Sends a request to delete a user from the server.
 * @returns None
 */
function deleteUser(){ 
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("user_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="User Deleted."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}

/**
 * Sends a request to delete a question from the database and updates the page accordingly.
 * @returns None
 */
function deleteQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "question_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("question_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question Deleted."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}

/**
 * Sends a request to delete a class from the server.
 * @returns None
 */
function deleteClass(){ 
    req = new XMLHttpRequest(); 
    script ="class_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("class_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Class Deleted."
            refreshTable(script)
        }
        }
    };
    req.send(formData)
}

/**
 * Sends a request to the server to delete a calendar entry.
 * @returns None
 */
function deleteCalender(){ 
    req = new XMLHttpRequest(); 
    script ="calender_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("calender_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Calender Entry Deleted."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
   
    req.send(formData)

}

/**
 * Sends a request to delete an assignment using AJAX and updates the page accordingly.
 * @returns None
 */
function deleteAssignment(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("assignment_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Assignment Deleted."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}


/**
 * Sends a request to the server to delete an announcement.
 * @returns None
 */
function deleteAnnouncement(){ 
    req = new XMLHttpRequest(); 
    script = "announcement_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("announcement_delete")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Announcement Deleted."
            refreshTable(script)
        }
      
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
   
    req.send(formData)
}



/**
 * Sends a POST request to the server to edit a user's information.
 * @returns None
 */
function editUser(){ 
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("user_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="User Changed."
            refreshTable(script)
        }
        if(req.responseText == -3){ 
            document.getElementById('warning').innerText="Invalid Email."

        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}


/**
 * Sends a POST request to the server to edit a question.
 * @returns None
 */
function editQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "question_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("question_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question Changed."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}


/**
 * Sends a POST request to the server to edit a class.
 * @returns None
 */
function editClass(){ 
    req = new XMLHttpRequest(); 
    script ="class_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("class_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Class Changed."
            refreshTable(script)
        }
        }
    };
    req.send(formData)
}


/**
 * Sends a POST request to the server to edit a calendar entry.
 * @returns None
 */
function editCalender(){ 
    req = new XMLHttpRequest(); 
    script ="calender_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("calender_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Calender Entry Changed."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}


/**
 * Sends a POST request to the server to edit an assignment.
 * @returns None
 */
function editAssignment(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("assignment_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Assignment Changed."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}





/**
 * Sends a POST request to the server to edit an announcement.
 * @returns None
 */
function editAnnouncement(){ 
    req = new XMLHttpRequest(); 
    script = "announcement_manage.php"
    req.open('POST',script,true)
    var formData = new FormData( document.getElementById("announcement_edit")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText.trim())
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Announcement Changed."
            refreshTable(script)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}




/**
 * Sends a POST request to the server to add a new question to the database.
 * @returns None
 */
function addQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("question_add")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question Added."
            refreshTable(script, 2)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)
}


/**
 * Sends a request to remove a question from the database and updates the page accordingly.
 * @returns None
 */
function removeQuestion(){ 
    req = new XMLHttpRequest(); 
    script = "assignment_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("question_remove")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        if(req.responseText == -2){ 
            document.getElementById('warning').innerText="Missing Parameters."
        }
        if(req.responseText == -1){ 
            document.getElementById('warning').innerText="Fields cannot be empty."
        }
        if(req.responseText == 1){ 
            document.getElementById('warning').innerText="Question removed."
            refreshTable(script, 2)
        }
        else{ 
            document.getElementById('warning').innerText=""
        }
        }
    };
    req.send(formData)

}


function setUserClassList(){ 
/**
 * Sends a POST request to the server to set the user class list based on the form data
 * provided by the user.
 * @returns None
 */
    req = new XMLHttpRequest(); 
    script = "user_manage.php"
    req.open('POST', script,true)
    var formData = new FormData( document.getElementById("user_class_list")); 
    req.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200) {
            if(req.responseText == -2){ 
                document.getElementById('warning').innerText="Missing Parameters."
            }
            if(req.responseText == -1){ 
                document.getElementById('warning').innerText="Fields cannot be empty."
            }
            if(req.responseText == 1){ 
                document.getElementById('warning').innerText="User Class List Set."
                refreshTable(script)
            }
            else{ 
                document.getElementById('warning').innerText=""
            }
            }

    }
    req.send(formData)
}


/**
 * Sends a file to the server using AJAX.
 * @returns None
 */
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


/**
 * Sends a POST request to the server to check the formula entered by the user.
 * @param {number} num - the number of the formula to check
 * @returns None
 */
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
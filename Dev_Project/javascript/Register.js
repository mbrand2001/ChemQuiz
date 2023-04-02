function registerClass(){
    req = new XMLHttpRequest(); 
    req.open('POST',"register.php",true)
    var formData = new FormData( document.getElementById("register_class")); 
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("response").innerText =req.responseText
        }


    }
    req.send(formData)
}

function signUp(){
    req = new XMLHttpRequest(); 
    script = "sign_up.php"
    req.open('POST',script,true)
    var formData = new FormData(document.getElementById("sign_up")); 
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
        else{ 
            document.getElementById('warning').innerText="Possible SQL Error, try request and again check the reponse."
        }
        
        }
    };
   
    req.send(formData)
}
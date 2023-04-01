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
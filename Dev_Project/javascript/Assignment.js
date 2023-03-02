function answerQuestion(index){
    req = new XMLHttpRequest(); 
    req.open('POST',"answer.php",true)
    console.log(document.getElementById("question_form"+index))
    
    var formData = new FormData(document.getElementById("question_form"+index))
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
        console.log(req.responseText)
        }
    }
    req.send(formData)
    
}
function answerQuestion(index){
    req = new XMLHttpRequest(); 
    req.open('POST',"answer.php",true)
    
    
    var formData = new FormData(document.getElementById("question_form"+index))
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            if(req.responseText == "correct"){ 
                document.getElementById("response"+index).innerText= req.responseText
                document.getElementById("submit"+index).style.visibility ='hidden'
            }
            if(req.responseText == "incorrect"){ 
                document.getElementById("response"+index).innerText=req.responseText +". \nWould you like a hint?"
                document.getElementById("hintbutton"+index).style.visibility='visible'

            }

        }
    }
    req.send(formData)
    
}


function showHint(index,qid){ 
    req = new XMLHttpRequest(); 
    req.open('POST',"hint.php",true)
    
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("hintdiv" + index).innerHTML = req.responseText
        }
    }
    

    req.send("qid="+index+"&index="+index)



}

function answerHint(index,qid,num){
    req = new XMLHttpRequest(); 
    req.open('POST',"answer_hint.php",true)

    var formData = new FormData(document.getElementById("step"+num+"_"+index))
    formData.append('qid',qid);
    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('step'+num+'_response_'+index).innerHTML = req.responseText +"<br>"
            if(req.responseText=='correct'){ 
                document.getElementById('step'+num+"_submit_"+index).style.visibility='hidden'
            }
        }
    }

    req.send(formData);

}


function submitAssignment(){ 
    req = new XMLHttpRequest();
    req.open('POST','submit_assignment.php',true)

    req.onreadystatechange=function(){ 
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('grade').innerText=req.responseText;
        }

    }
    req.send();
}
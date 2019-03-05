var httpRequest;
var button=document.getElementById('submit');

  if(button)
  {
          button.addEventListener('click', checkAnswer);

          function checkAnswer() 
          {    
                var divno=document.getElementById("no");
                var str=divno.innerHTML;
                var array = str.split(" ");
                var probno=array[1];

                var answer = document.getElementById("answer").value;
                httpRequest = new XMLHttpRequest();

                if (!httpRequest) 
                {
                  alert('Giving up :( Cannot create an XMLHTTP instance');
                  return false;
                }
               
                httpRequest.onreadystatechange = alertContents;
                httpRequest.open('POST', '/problem/'+probno);
                httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                httpRequest.send('answer=' + encodeURIComponent(answer));
          }

          function alertContents() 
          {
            
              if (httpRequest.readyState === XMLHttpRequest.DONE) 
              {
                  if (httpRequest.status === 200)
                    {    var response = JSON.parse(httpRequest.responseText);
                       
                       
                        if(response.answer=="login"){
                          document.getElementById("response").innerHTML="Please Log in to Answer";
                        }
                         
                        else if(response.answer==true){

                          document.getElementById("response").style.color="green";
                          document.getElementById("response").innerHTML="Correct Answer!!";
                        }

                        else{
                          document.getElementById("response").style.color="red";
                          document.getElementById("response").innerHTML="Incorrect Answer!!";
                        }

                    }
              } 
              
          }
  }
  else{
      console.log('about not found');
  }
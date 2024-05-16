var button = document.getElementById('getceleb');



button.addEventListener('click', function() {
        let bdate = document.getElementById("birth");
        let date = new Date(bdate.value);
        let month = ("0" + (date.getMonth() + 1)).slice(-2); // Adding leading zero if necessary
        let day = ("0" + date.getDate()).slice(-2); // Adding leading zero if necessary
        console.log(day + "-" + month); // Output the date in "dd-mm" format

        console.log(day+"/"+month);
        console.log('Button clicked!');
        
        var xhttp= new XMLHttpRequest();
        xhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                        document.getElementById("answer").innerHTML=this.responseText;
                        document.getElementById("answer").style.visibility="visible";
                }else{
                        console.log("error");

                }
        };
       xhttp.open("GET","API_Ops.php?month="+month+"&day="+day,true);
       xhttp.send();
 
});

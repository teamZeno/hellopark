window.onload = function(){
   document.forms["cus_signIn"].reset();
   document.forms["pro_signIn"].reset();

}

function signInCus(){

   var frm = document.forms["cus_signIn"];

   var cusId =  frm["cus_id"].value;
   var cuspsw = frm["cus_psw"].value;
   var who = "cus";

   var sc = {"Id":cusId,"Psw":cuspsw,"who":who};
   var j = JSON.stringify(sc);

   var http = new XMLHttpRequest();
   http.onreadystatechange = function(){

    console.log(this.responseText);

       if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                var st = JSON.parse(this.responseText);
                if(st.st == "OK"){
                   window.location.href = "mainPageCus.html";
                }else{
                  alert("Incorrect User Id or Password");
                }
                console.log(st.st);     
        }else if(this.readyState == 4 && this.status == 404){
            console.log(this.responseText);
        }
   };

   http.open("POST","./php/sign_in.php",true);
   http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   http.send("j="+j);

}


function onSignInPro(){

   var frm = document.forms["pro_signIn"];

   var cusId =  frm["pr_id"].value;
   var cuspsw = frm["pr_psw"].value;
   var who = "pro";

   var sc = {"Id":cusId,"Psw":cuspsw,"who":who};
   var j = JSON.stringify(sc);

   var http = new XMLHttpRequest();
   http.onreadystatechange = function(){

    console.log(this.responseText);

       if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                var st = JSON.parse(this.responseText);
                if(st.st == "OK"){
                   window.location.href = "mainPagePro.html";
                }else{
                   alert("Incorrect User Id or Password");
                }
                console.log(st.st);     
        }else if(this.readyState == 4 && this.status == 404){
            console.log(this.responseText);
        }else{
           
        }
   };

   http.open("POST","./php/sign_in.php",true);
   http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   http.send("j="+j);

}


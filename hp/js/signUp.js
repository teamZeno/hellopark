window.onload() = function(){
    document.getElementById("su_cus_frm").style.display = "none";
    document.getElementById("su_pro_frm").style.display = "none";

}

function onSignUp(){

    var frm = document.forms["cus_signup"];

    var cus_fname =  frm["suCu_fname"].value;
    var cus_lanme = frm["suCu_lname"].value;
    var cus_nic = frm["suCu_nic"].value;
    var cus_email = frm["suCu_email"].value;
    var cus_psw = frm["suCu_psw"].value;
    var cus_user = frm["suCu_usern"].value;
    var cus_cont = frm["suCu_con"].value;

    var who = "cus";
 
    var sc = {"fname":cus_fname,"lname":cus_lanme,"nic":cus_nic,"email":cus_email,"psw":cus_psw,"who":who,"uid":cus_user,"con":cus_cont};
    var j = JSON.stringify(sc);
    console.log(j);
 
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
 
     console.log(this.responseText);
 
        if(this.readyState == 4 && this.status == 200){

                 console.log(this.responseText);
                 var st = JSON.parse(this.responseText);
                 console.log(st.st);
                 if(st.st == "OK"){
                    window.location.href = "mainPageCus.html";
                 }
                 
                 
         }else if(this.readyState == 4 && this.status == 404){
             console.log(this.responseText);
         }
    };
 
    http.open("POST","./php/sign_up.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("j="+j);


}

function onSignUpPro(){

    var frm = document.forms["pro_signup"];

    var pro_fname =  frm["suPr_fname"].value;
    var pro_lanme = frm["suPr_lname"].value;
    var pro_nic = frm["suPr_nic"].value;
    var pro_email = frm["suPr_email"].value;
    var pro_psw = frm["suPr_psw"].value;
    var pro_user = frm["suPr_usern"].value;
    var pro_cont = frm["suPr_con"].value;
    
    var who = "pro";
 
    var sc = {"fname":pro_fname,"lname":pro_lanme,"nic":pro_nic,"email":pro_email,"psw":pro_psw,"who":who,"uid":pro_user,"con":pro_cont};
    var j = JSON.stringify(sc);
    console.log(j);
 
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
 
     console.log(this.responseText);
 
        if(this.readyState == 4 && this.status == 200){
                 console.log(this.responseText);
                 console.log(this.responseText);
                 var st = JSON.parse(this.responseText);
                 console.log(st.st);
                 if(st.st == "OK"){
                    window.location.href = "pReg.html";
                 }

         }else if(this.readyState == 4 && this.status == 404){
             console.log(this.responseText);
         }

    };
 
    http.open("POST","./php/sign_up.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("j="+j);


}

function mycus(){
    // document.getElementById("su_pro_frm").style.display = "none";
    // document.getElementById("su_cus_frm").style.display = "block";
    window.location.href= "#su_cus_frm_div";
}

function mypro(){
    // document.getElementById("su_cus_frm").style.display = "none";
    // document.getElementById("su_pro_frm").style.display = "block";
    window.location.href= "#su_pro_frm_div";
}
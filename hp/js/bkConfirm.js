
var t;
var ref;
var charges;

window.onload = function(){

   var r = localStorage.getItem("j");
     t = JSON.parse(r);

    ref = new this.Date().getTime();

    document.getElementById("ref_no").innerHTML = ref;

    document.getElementById("bk_parkName").innerHTML = t.park;

    document.getElementById("bk_stN").innerHTML = t.slotN;

    // -- 
    document.getElementById("bk_tTime").innerHTML = t.tTime;
    document.getElementById("bk_fTime").innerHTML = t.fTime;

    // --- User Info ---
    document.getElementById("u_name").innerHTML = t.uname;
    document.getElementById("u_id").innerHTML = t.uid;

    // -- Cal Duration ---
    var dur =  this.calDuration(t.tTime,t.fTime);

    document.getElementById("bk_dur").innerHTML = dur+"hr";

    charges =  this.calCharges(t.tTime,t.fTime,t.char);
    document.getElementById("bk_char").innerHTML = charges;

    console.log(r);
    console.log(t.tTime);
    console.log(t.fTime);
    console.log(t.pId);
    console.log(t.sId);

}

function calDuration(to,from){

    var t1 = to.split(":");
    var t2 = from.split(":");

    var tHr = Number(t1[0]);
    var fHr = Number(t2[0]);

    var hr = Math.abs(fHr - tHr);
    return hr;

}

// function calculate charges
function calCharges(to,from,char){
    var dur = calDuration(to,from);
    char = Number(char);
    return char*dur;
}

// event - booking confirmed btn -- 
function confirmBook(){

    console.log(ref);
    console.log(t.tTime);
    console.log(t.fTime);
    console.log(t.pId);
    console.log(t.sId);
    console.log(t.slotN);
    console.log(t.park);
    console.log(t.char);
    console.log(t.uid);
    console.log(t.uname);
    console.log(t.pay);
    console.log(charges);

    var bk = {"ref":ref,"tTime":t.tTime,"fTime":t.fTime,"slot":t.slotN,"parkId":t.pId,"char":charges,"uid":t.uid,"pay":t.pay,};
    var bk_j = JSON.stringify(bk);

    console.log(bk_j);

    var ht = new XMLHttpRequest();
    ht.onreadystatechange = function(){

        console.log("Loading ... ");
        
        // console.log(this.responseText);

        if(this.readyState == 4 && this.status == 200){
            console.log("----- Response -----");
            console.log(this.responseText);
            var t = JSON.parse(this.responseText);
            console.log(t.state);
            if(t.state === "OK") 
            document.getElementById("suc_").style.display = "block";
            sendEmail();
            
        }

    };

    ht.open("POST","./php/bk_confirm.php",true);
    ht.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ht.send("j="+bk_j);
}

function doneBtn(){
    window.location.href = "parkViewCus.html";
}

function sendEmail(){
    var subject = "Booking Confirmation";
    var body = "this booking is confirmed";
    window.open("mailto:uniscj@gmail.com?subject="+subject+"&body="+body);
    console.log("send Email");
}

// // function sendEmail(){
// //     Email.send({
// //         Host : "smtp.yourisp.com",
// //         Username : "username",
// //         Password : "password",
// //         To : 'them@website.com',
// //         From : "you@isp.com",
// //         Subject : "This is the subject",
// //         Body : "And this is the body"
// //     }).then(
// //     message => alert(message)
// //     );
// }

var slot;

window.onload = function(){

    var frm = document.forms["bk_form"];

    var proId = 5;
    var pId = 1;
    var cusId = "cus123";

    // -- send park id --
    frm["park_id"].value = pId;

    // ------------  AJAX ---------------
    var http = new XMLHttpRequest();

    http.onreadystatechange = function(){
        console.log(this.status);

        if(this.readyState == 4 && this.status == 200){
           
            console.log(this.responseText);

            var j = JSON.parse(this.responseText);

            console.log(this.responseText);

            // --- Get Customer details ---
            var cu = JSON.parse(j.cus);
            var cus = JSON.parse(cu[0]);

            document.getElementById("u_name").innerHTML = cus.fname +" "+ cus.lname;
            document.getElementById("u_id").innerHTML = cus.uId;
            frm["uid"].value = cus.uId;
            frm["uname"].value = cus.fname +" "+ cus.lname;

            // -- Get Park Details --- 
            var r = JSON.parse(j.park);
            var park = JSON.parse(r[0]);

            // view park name
            document.getElementById("pr_v_name").innerHTML = park.name;
            frm["park_name"].value = park.name;
            
            // view park address
            document.getElementById("pr_v_ad").innerHTML = park.adno + ","+ park.street + "," + park.city;

            // view park contact number
            document.getElementById("pr_v_cont").innerHTML = "+94"+park.cont;

            // Charges
            console.log(park.char);
            frm["charge"].value = park.char;


            // -- Get Slot details ---
            slot = JSON.parse(j.slot);
            for(var a = 0; a< slot.length;a++){
                var e = JSON.parse(slot[a]);
                console.log(e.name);
                
                // --- parking state ---
                mapState(e.hid,e.state);
            }

            // --- Get Available Slot ---
            document.getElementById("av_slot_v").innerHTML = j.avaSlot;

             // --- Get Park Slot ---
            document.getElementById("pr_slot_v").innerHTML = j.parkSlot;

             // --- Get Book Slot ---
            document.getElementById("bk_slot_v").innerHTML = j.bookSlot;
    }

    };

    // ------------ PHP - pkview_onload.php ----------------------
    http.open("POST","./php/pkview_onload.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("pr_id="+proId+"&pId="+pId+"&cusId="+cusId);
}

function myf(a,c){

//alert("t - "+a);
//    document.getElementById(a).style.fill = "green";
//    document.getElementById(a+"t").style.fill = "white";

    var frm = document.forms["bk_form"];

    var sl_ = JSON.parse(slot[c-1]);
    frm["slot_id"].value = sl_.no ;
    frm["slot_name"].value = sl_.name;

    if(sl_.state === "B"){
        alert("Booked");
    }else if(sl_.state === "P"){
        alert("Parked");
    }else{
        document.getElementById("st_bk").style.display="block";
        document.getElementById("st_bk_h2").innerHTML = "Slot - "+c;
        frm.reset();
    }

}

function clickBook(){

    var frm = document.forms["bk_form"];

    var tTime = frm["to_time"].value;
    var fTime = frm["from_time"].value;
    var pay = frm["pay_mod"].value;

    var parkId = frm["park_id"].value;
  
    var park =  frm["park_name"].value;
    var charge = frm["charge"].value;

    var uid = frm["uid"].value;
    var uname = frm["uname"].value;

    var slotId = frm["slot_id"].value;
    var slotName = frm["slot_name"].value;

    var d = {"tTime":tTime,"fTime":fTime,"pay":pay,"pId":parkId,"sId":slotId,"slotN":slotName,"park":park,"char":charge,"uid":uid,"uname":uname}
    var j = JSON.stringify(d);
    
    var qry = "bkConfirm.html";
    window.location.href = qry;
    localStorage.setItem("j",j);

}

function cancelBook(){
    document.getElementById("st_bk").style.display = "none"; 
}

// --- Map State function
function mapState(id,st){
    switch(st){
        case "A":
            document.getElementById(id).style.fill = "green";
            break;

        case "B":
            document.getElementById(id).style.fill = "yellow";
            break;

        case "P":
            document.getElementById(id).style.fill = "red";
            break;
    }
}


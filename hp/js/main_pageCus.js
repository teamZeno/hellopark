window.onload = function(){

        
}

function searchPlace(){

       var park =  document.forms["search_park_pl"];

       var distric = park["distric"].value;
       var city = park["city"].value;

       var t = {"distric":distric,"city":city};
       var j = JSON.stringify(t);
       console.log(j);

       var http = new XMLHttpRequest();

       http.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200 ){
                console.log(this.responseText);

                var re_val = JSON.parse(this.responseText);
                var tb = "<tr><th>Place</th> <th>Address</th> <th>Available Slots</th> </tr>"
                for(var a =0; a < re_val.length;a++){
                    var val = JSON.parse(re_val[a]);
                    console.log(val.park_name);

                    var park_name = val.park_name;
                    var address_no = val.address_no;
                    var address_street = val.street;
                    var address_city = val.city;
                    var avaliable_slot = val.a_count;
                    var p_id = val.pid;

                    console.log(p_id);

                    var address = address_no+","+address_street+","+address_city;
                    console.log(address);

                     tb += "<tr class='tr_r' >";
                     tb += "<td>"+park_name+"</td>";
                     tb += "<td>"+address+"</td>";
                     tb += "<td>"+avaliable_slot+"</td>";
                     tb += "<td> <form action='javascript:viewPark("+p_id+")' method='POST'> <input class='btn btn-primary p-3 view_btn rounded-pill' type='submit' name='_view' value='View'></form> </td>";
                     tb += "</tr>";
                }
                console.log(tb);
                document.getElementById("_t_tb").innerHTML = tb;
            }
       }
       
    http.open("POST","./php/main_pageCus.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("dt="+j);

}

function viewPark(a){
        switch(a){
            case 1:
            window.location.href= "parkViewPro.html";
            break;

            default:
            alert("This parking place is pending");

        } 
}
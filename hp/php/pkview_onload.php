<?php

$proId = $_POST["pr_id"];
$parkId = $_POST["pId"];
$cusId = $_POST["cusId"];

$park;
$slot;
$avaSlot;
$parkSlot;
$bookSlot;
$customer;

// echo $proId." ".$parkId."\n";

$server = "localhost";
$user = "root";
$psw = "";
$db = "hp";

$con = mysqli_connect($server,$user,$psw,$db);

if($con){
    //echo "Connection Successfully";

    // --- Get Customer Details ---
    $sqc = "SELECT cus_fname,cus_lname,cus_nic,cus_conNum,cus_email,cus_userId FROM `customer`WHERE cus_userId = '".$cusId."'";
    $resCus = mysqli_query($con,$sqc);

    $z = 0;
    $cu = array();
    while($rc = mysqli_fetch_assoc($resCus)){
        $s = array('fname'=>$rc["cus_fname"],'lname'=>$rc["cus_lname"],'email'=>$rc["cus_email"],'con'=>$rc["cus_conNum"],'uId'=>$rc["cus_userId"]);
        $cu[$z] = json_encode($s);
        $z++;
    }

    $customer = json_encode($cu);


    // --- Get Park Details ---
    $sq1 = "SELECT address.ad_no,address.ad_city,address.ad_street,address.ad_distric,park.p_name,park.p_state,park.p_slot,park.p_conNum,park.p_char FROM address,park WHERE address.ad_pId = (SELECT park.p_id FROM park WHERE p_prId = $proId AND p_id = $parkId) AND park.p_prId = $proId AND park.p_id = $parkId";
    $result1 = mysqli_query($con,$sq1);
    
    if(mysqli_num_rows($result1) > 0){

        $x = 0;
        $b = array(); // array for collect data of park

        while($row = mysqli_fetch_assoc($result1)){

            // echo "result - ".$row["ad_no"]."\n";
            // echo "result - ".$row["ad_street"]."\n";
            // echo "result - ".$row["ad_city"]."\n";
            // echo "result - ".$row["ad_distric"]."\n";
            // echo "result - ".$row["p_name"]."\n";
            // echo "result - ".$row["p_state"]."\n";
            // echo "result - ".$row["p_slot"]."\n";

            $t = array('name'=>$row["p_name"],'state'=>$row["p_state"],'slot'=>$row["p_slot"],'adno'=>$row["ad_no"],'street'=>$row["ad_street"],'city'=>$row["ad_city"],'distric'=>$row["ad_distric"],'cont'=>$row["p_conNum"],'char'=>$row["p_char"]);
            $b[$x] =  json_encode($t);
            $x++;
        }

        $park =  json_encode($b);
    }

    // --- Get Slot Details ---
    $sq2 = "SELECT * FROM slot WHERE s_parkId = $parkId";
    $result2 = mysqli_query($con,$sq2);
    
    // array for collect data of slots details
    $a = array();
    $c = 0;

    while($row = mysqli_fetch_assoc($result2)){
        // echo "\n Slot \n";
        // echo "result - ".$row["s_no"]."\n";
        // echo "result - ".$row["s_name"]."\n";
        // echo "result - ".$row["s_state"]."\n";
        // echo "result - ".$row["s_type"]."\n";
        // echo "result - ".$row["s_hid"]."\n";

        $t = array('no'=>$row["s_no"],'name'=>$row["s_name"],'state'=>$row["s_state"],'type'=>$row["s_type"],'hid'=>$row["s_hid"]);
        $a[$c] = json_encode($t);
        $c++;
         
    }

        $slot = json_encode($a);


    // ---  Get Available Count -- 
    $sq3 = "SELECT COUNT(s_no) as 'ava' FROM slot WHERE s_parkId = $parkId AND s_state = 'A' ";
    $r3 = mysqli_query($con,$sq3);
    $ra = mysqli_fetch_assoc($r3);
        // echo "\n Available Slot \n";
        // echo "result - ".$ra["ava"]."\n";
        $avaSlot = $ra["ava"];

    // --- Get Parked Count --
    $sq4 = "SELECT COUNT(s_no) as 'par' FROM slot WHERE s_parkId = $parkId AND s_state = 'P'" ;
    $r4 = mysqli_query($con,$sq4);
    $rp = mysqli_fetch_assoc($r4);
        // echo "\n Parked Slot \n";
        // echo "result - ".$rp["ava"]."\n";
        $parkSlot = $rp["par"];

     // --- Get booking Count --
     $sq5 = "SELECT COUNT(s_no) as 'bk' FROM slot WHERE s_parkId = $parkId AND s_state = 'B'" ;
     $r5 = mysqli_query($con,$sq5);
     $rb = mysqli_fetch_assoc($r5);
        //  echo "\n Booked Slot \n";
        //  echo "result - ".$rb["ava"]."\n";
        $bookSlot = $rb["bk"];

        // echo $park;
        // echo "\n";
        // echo $slot;
        // echo "\n";
        // echo $parkSlot;
        // echo "\n";
        // echo $avaSlot;
        // echo "\n";
        // echo $bookSlot;
        // echo "\n";

        $t = array('cus'=>$customer,'park'=>$park,'slot'=>$slot,'avaSlot'=>$avaSlot,'parkSlot'=>$parkSlot,'bookSlot'=>$bookSlot);
        echo json_encode($t);
        

}else{
    echo "Connection Failed";
}

mysqli_close($con);

?>
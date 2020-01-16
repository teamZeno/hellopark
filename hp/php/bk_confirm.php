<?php 

    $bk = $_POST["j"];
    $bkd = json_decode($bk);

    $ref = $bkd->ref;
    $ftime = $bkd->fTime;
    $ttime = $bkd->tTime;
    $ttime = $bkd->tTime;
    $slot =  $bkd->slot;
    $parkId = $bkd->parkId;
    $char = $bkd->char;
    $uid = $bkd->uid;
    $pay =  $bkd->pay;


    //echo $bkd->fTime;

    // echo $ref."\n";
    // echo $ftime."\n";
    // echo $ttime."\n";
    // echo $slot."\n";
    // echo $parkId."\n";
    // echo $char."\n";
    // echo $uid."\n";
    // echo $pay."\n";

$server = "localhost";
$user = "root";
$psw = "";
$db = "hp";

$con = mysqli_connect($server,$user,$psw,$db);
if($con){
    //echo "Connected Successfully \n";
    $sq = "INSERT INTO booking(bk_refNo,bk_to,bk_from,bk_slotId,bk_cusId,bk_pay,bk_ch,bk_pid)VALUES('".$ref."','".$ttime."','".$ftime."','".$slot."',(SELECT cus_id FROM customer WHERE cus_userId = '".$uid."'),'".$pay."',$char,'".$parkId."')";

    $res = mysqli_query($con,$sq);
    if($res){

        //echo "Insert Success";

        $squ = "UPDATE slot SET s_state = 'B' WHERE s_name='".$slot."' AND s_parkId = '".$parkId."'";
        $re = mysqli_query($con,$squ);
        
        if($re){
            $s = array("state"=>"OK");
            echo json_encode($s);
        }
    }

}else{
    http_response_code(300);
}

mysqli_close($con);

?>
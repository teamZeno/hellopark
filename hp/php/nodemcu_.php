<?php 

    $parkId = 1;
    $parkName = "ABC-Slot1";

    $server = "localhost";
    $user = "root";
    $psw = "";
    $db = "hp";

    $con = mysqli_connect($server,$user,$psw,$db);

    if(!empty($_POST['status']) && !empty($_POST['station']))
    {
    	$status = $_POST['status'];
        $station = $_POST['station'];
        
    if($con){
        $sq = "UPDATE slot SET slot.s_state = 'A' WHERE s_parkId = '".$parkId."' AND s_name = '".$parkName."'";
        $s = mysqli_query($con,$sq);

        if($s){
            echo "Updated...";
        }

    }
}


?>
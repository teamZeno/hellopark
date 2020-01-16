<?php

    $server = "localhost";
    $user = "root";
    $psw = "";
    $db = "hp";

    $dt = $_POST["dt"];
    $r = json_decode($dt);
    
    $distric = $r->distric;
    $city = $r->city;

    // echo $distric;
    // echo $city;

    $con = mysqli_connect($server,$user,$psw,$db);

    if($con){
           // echo "connected";

            $park = array();
            $park_count = 0;

            $sq = "SELECT park.p_name,address.ad_no,address.ad_street,address.ad_city,park.p_id FROM park INNER JOIN address ON park.p_id = address.ad_pId WHERE address.ad_city = '".$city."' AND address.ad_distric = '".$distric."'";
            $r =  mysqli_query($con,$sq);

            if(mysqli_num_rows($r) > 0){

                while($rw = mysqli_fetch_assoc($r)){

                    $park_name = $rw["p_name"];
                    $addres_no =  $rw["ad_no"];
                    $street = $rw["ad_street"];
                    $city = $rw["ad_city"];

                    $q =  $rw["p_id"];
                    
                    // get Available slot amount 
                    $sq = "SELECT COUNT(s_no) as 'aCount' FROM slot WHERE s_parkId = $q AND s_state = 'A' ";

                    $rt =  mysqli_query($con,$sq);

                    if($rt){

                        $fetch = mysqli_fetch_assoc($rt);
                        $ava_count = $fetch["aCount"];
                    
                    }else{
                        $ava_count = 0;
                    }
                   

                    $array_ = array('park_name'=>$park_name,'address_no'=>$addres_no,'street'=>$street,'city'=>$city,"a_count"=>$ava_count,"pid"=>$q);
                    
                    $park[$park_count] = json_encode($array_);
                    $park_count++;

                }

                    echo json_encode($park);

            }
            

    }

    


?>
<?php 

    //echo "DONE";

    $server = "localhost";
    $user = "root";
    $psw = "";
    $db = "hp";

    $con = mysqli_connect($server,$user,$psw,$db);


    $j = $_POST["j"];
    $en = json_decode($j);

    $cus_fname = $en->fname;
    $cus_lname = $en->lname;
    $cus_nic = $en->nic;
    $cus_email = $en->email;
    $cus_psw = $en->psw;
    $cus_who = $en->who;
    $cus_psw = $en->psw;
    $cus_who = $en->who;
    $cus_userid = $en->uid;
    $cus_cont = $en->con;
   

    //fname":cus_fname,"lname":cus_lanme,"nic":cus_nic,"email":cus_email,"psw":cus_psw

    // echo $cus_fname."\n";
    // echo $cus_lname."\n";
    // echo $cus_nic."\n";
    // echo $cus_lname."\n";
    // echo $cus_psw."\n";
    // echo $cus_email."\n";
    // echo $cus_who."\n";



    if($cus_who == "cus"){
        
        $sq = "INSERT INTO customer(cus_fname,cus_lname,cus_nic,cus_email,cus_conNum,cus_userId,cus_psw)VALUES('".$cus_fname."','".$cus_lname."','".$cus_nic."','".$cus_email."','".$cus_cont."','".$cus_userid."','".$cus_psw."')";
        $re = mysqli_query($con,$sq);

        if($re){
            $msg = "Updated Successfull";
            $ar = array('st'=>"OK",'msg'=>$msg);
            echo json_encode($ar);
        }else{
            $msg = "Query Error";
            $ar = array('st'=>"OK",'msg'=>$msg);
            echo json_encode(array($ar));
        }


    }else if($cus_who == "pro"){

        $sq = "INSERT INTO provider(pr_fname,pr_lname,pr_nic,pr_email,pr_conNum,pr_userId,pr_psw)VALUES('".$cus_fname."','".$cus_lname."','".$cus_nic."','".$cus_email."','".$cus_cont."','".$cus_userid."','".$cus_psw."')";
        $re = mysqli_query($con,$sq);

        if($re){
            $msg = "Updated Successfull";
            $w = "cus";
            $ar = array('st'=>"OK",'msg'=>$msg,'who'=>$w);
            echo json_encode($ar);
        }else{
            $msg = "Query Error";
            $w = "pro";
            $ar = array('st'=>"OK",'msg'=>$msg,'who'=>$w);
            echo json_encode(array($ar));
        }

    }

    

?>
<?php 

    $server = "localhost";
    $user = "root";
    $psw = "";
    $db = "hp";

    $con = mysqli_connect($server,$user,$psw,$db);


    $j = $_POST["j"];
    $en = json_decode($j);

    $cusId = $en->Id;
    $cuspsw = $en->Psw;
    $who = $en->who;

    // echo $cusId."\n";
    // echo $cuspsw."\n";
    // echo $who."\n";

    $crpt_psw =  crypt($cuspsw,'$2a$09$anexamplestringforsalt$');

    if($con){

            if($who == "cus"){
                $sq = "SELECT cus_psw FROM customer WHERE cus_userId = '".$cusId."' ";
                $re = mysqli_query($con,$sq);

                if($re){
                    
                    if(mysqli_num_rows($re) > 0){
                            while($rw = mysqli_fetch_assoc($re)){
                                $t = $rw["cus_psw"];
                                $en_t = crypt($t,'$2a$09$anexamplestringforsalt$');

                                if($en_t == $crpt_psw){
                                        $st = "OK";
                                        $ar = array('st'=> $st);
                                        echo json_encode($ar);
                                }else{
                                    $st = "ER";
                                    $ar = array('st'=>$st);
                                    echo json_encode($ar);
                                }
                            }
                    }
                }else{
                    http_response_code(404);
                }
             }else if($who == "pro"){
                $sq = "SELECT pr_psw FROM provider WHERE pr_userId = '".$cusId."' ";
                $re = mysqli_query($con,$sq);

                if($re){
                    
                    if(mysqli_num_rows($re) > 0){
                            while($rw = mysqli_fetch_assoc($re)){
                                $t = $rw["pr_psw"];
                                $en_t = crypt($t,'$2a$09$anexamplestringforsalt$');

                                if($en_t == $crpt_psw){
                                        $st = "OK";
                                        $ar = array('st'=> $st);
                                        echo json_encode($ar);
                                }else{
                                    $st = "ER";
                                    $ar = array('st'=>$st);
                                    echo json_encode($ar);
                                }
                            }
                    }
                }else{
                    http_response_code(404);
                }
             }
    }

    

?>
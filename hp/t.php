<?php 

    // $a = $_POST['fn'];
    // $b = $_POST['fm'];
   
    // $a = "Sanka";
    // $b = "Derana";

    

    // $m = array('fn'=>$a,'fm'=>$b);

    // $mj = json_encode($m);
    // echo $mj;


    $a = $_POST['f'];
    $b = json_decode($a);

    echo $b->fn.'<br>';

    echo $b->fm;

    http_response_code(300);
    

?>
<?php

    $server = "localhost";
    $user = "root";
    $psw = "";
    $db = "hp";

    $con = mysqli_connect($server,$user,$psw,$db);

    if($con) echo "DB Connect Successfully";

?>
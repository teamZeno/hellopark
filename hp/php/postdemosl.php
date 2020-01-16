<?php
//Creates new record as per request
    //Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hp";
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
 

 
    if(!empty($_POST['status']) && !empty($_POST['station']))
    {
    	$status = $_POST['status'];
    	$station = $_POST['station'];
 
	    $sql ="UPDATE slot SET s_state='$station' WHERE  s_parkId= 1 AND s_name ='ABC-Slot1'  ";
		
		
 
		if ($conn->query($sql) == TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
 
 
	$conn->close();
?>
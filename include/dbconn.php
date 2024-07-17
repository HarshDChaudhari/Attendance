<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "attendance";
	
	$conn = mysqli_connect($host, $user, $pass, $db);
	if(!$conn){
		echo "Failed To Connect to database:" . $conn->connect_error;
        die("Sorry we failed to connect");
	}
?>
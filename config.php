<?php
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $database = "attendance";

    $conn = mysqli_connect($servername, $username, $pass);

    if(!$conn){
        die("Sorry we failed to connect");
    }
    echo "We Connected Successfully";

    echo "<br>";
    
    $sql = "CREATE DATABASE $database";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "DB created";  
    }
    else{
        echo "Error occurred" . mysqli_error($conn);
    }

    echo "<br>";

    $conn = mysqli_connect($servername, $username, $pass, $database);

    if(!$conn){
        die("Sorry we failed to connect");
    }
    echo "We Connected Successfully";
    
    echo `<br>`;

    $sql = "CREATE TABLE `teacher` (`name` VARCHAR(50) NOT NULL, `email` VARCHAR(255) NOT NULL UNIQUE, `school` VARCHAR(100) NOT NULL, `class` VARCHAR(100), `phone_no` VARCHAR(12) NOT NULL, `password` VARCHAR(50) NOT NULL, PRIMARY KEY (`email`))";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Table has been successfully created";
    }else{
        echo "Error Occurred --->";
        echo mysqli_error($conn);
    }

    echo `<br>`;

    $sql = "CREATE TABLE `student` (`name` VARCHAR(100) NOT NULL, `enrollment_number` VARCHAR(50) NOT NULL PRIMARY KEY, `school` VARCHAR(100) NOT NULL, `class` VARCHAR(50) NOT NULL, `gender` CHAR(1), `email` VARCHAR(255) NOT NULL, `password` VARCHAR(50) NOT NULL, `phone_no` VARCHAR(12) NOT NULL)";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Table has been successfully created";
    }else{
        echo "Error Occurred --->";
        echo mysqli_error($conn);
    }

    echo `<br>`;

    $sql = "CREATE TABLE `class` (`name` VARCHAR(50) NOT NULL PRIMARY KEY, `teacher_name` VARCHAR(100), `school` VARCHAR(100) NOT NULL)";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Table has been successfully created";
    }else{
        echo "Error Occurred --->";
        echo mysqli_error($conn);
    }

    echo `<br>`;

    $sql = "CREATE TABLE `admin` (`name` VARCHAR(50) NOT NULL, `email` VARCHAR(255) NOT NULL PRIMARY KEY, `password` VARCHAR(100) NOT NULL, `school` VARCHAR(100) NOT NULL UNIQUE, `phone_no` VARCHAR(12) NOT NULL)";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Table has been successfully created";
    }else{
        echo "Error Occurred --->";
        echo mysqli_error($conn);
    }

    echo `<br>`;
?>

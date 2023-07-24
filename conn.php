<?php
    $servername = "localhost";
    $username="root";
    $password="";
    $dbname = "";

    // Checking Connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);
    if(!$conn){
        die("Connection Failed:" .mysqli_connect_error());
    }

    // else SQL Code to create database & create table
    $dbsql = "CREATE DATABASE php_task";
    mysqli_select_db ( $conn , "php_task" );
    $sql = "CREATE TABLE student_table(id INT(11) PRIMARY KEY  AUTO_INCREMENT, name varchar(20) NOT NULL, email VARCHAR(50) NOT NULL UNIQUE, phone VARCHAR(15) NOT NULL, course ENUM('PHP Laravel','UI/UX Design','Web Design')DEFAULT 'PHP Laravel')";
    if(mysqli_query($conn, $dbsql)){
        echo "Database PHP Task created successfully";
    }
    elseif(mysqli_query($conn, $sql)){
        echo "Table Created Successfully";
    }
    // else {
    //     echo "Error creating Database & table: " . mysqli_error($conn);
    // }
    mysqli_close($conn);
?>
<?php
    include('conn.php');

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $course = $_POST['course'];

        if($name == NULL || $email == NULL || $phone == NULL || $course == NULL){
            echo "All field are Necessary";
        }
        $query = "INSERT INTO student_table(name,email,	phone,course) VALUES('".$name."','".$email."','".$phone."','".$course."')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            echo "Data is inserted successfully";
        }
        else{
            die(mysqli_error($conn));
        }
    
    
    
    }   

?>
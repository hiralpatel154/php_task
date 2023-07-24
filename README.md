# php_task
Simple CRUD
Command to find IP address of your PC - ipconfig
install xampp or mysql installer
Extensions in VScode - Prettier, Format HTML in PHP, PHP Debug, PHP Intelephense


1. install xampp server, vscode
2. xampp>htdocs>php_task
3. student.php
	starter template of bootstrap
	copy Live demo modal & paste it at the start of body tag
	wrap modal-body & modal-footer with form tag
	
4. Creating database & table using MySQLi Procedure-oriented Procedure
	conn.php
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
			$sql = "CREATE TABLE student_table(id INT(11) PRIMARY KEY AUTO_INCREMENT, name varchar(20) NOT NULL, email VARCHAR(50) NOT NULL UNIQUE, phone VARCHAR(15) NOT NULL, course ENUM('PHP Laravel','UI/UX Design','Web Design')DEFAULT 'PHP Laravel')";
			if(mysqli_query($conn, $dbsql)){
				echo "Database PHP Task created successfully";
			}
			elseif(mysqli_query($conn, $sql)){
				echo "Table Created Successfully";
			}
			else {
				echo "Error creating Database & table: " . mysqli_error($conn);
			}
			mysqli_close($conn);
		     ?>
	
5. student.php
	<?php
		include('conn.php');
	?>
	
6. in browser,
	http://localhost/php_task/student.php
	
	http://localhost/phpmyadmin
	
7. Comment mysqli_error($conn) echo statement in else part 
   Comment mysqli_close($conn) in conn.php;
	
8. jQuery CDN link - minified version
	add at the end of body tag

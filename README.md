# php_task
Simple CRUD

1. xampp server
2. c:xampp/htdocs/php_task
3. index.php
   starter template of bootstrap
4. copy Live demo modal & paste it at the start of body tag
5. wrap modal-body & modal-footer with form tag
6. conn.php
	<?php
		$servername = "localhost";
		$username = "root";
		$password="";
		$databasename="";
	?>
	
	// Connect web app with database/mysql server
    $conn = mysqli_connect($servername, $username, $password, $databasename);
	
	// Check database connection that it is established or not
    // if connection is not established
    if(!$conn){
        die("Connection Failed!" .mysqli_connect_error());
    }
	
	
	// if connection is established, create database & create table
    $dbsql = "CREATE DATABASE user_database";
	
	// create connection with the database
    mysqli_select_db ( $conn , "user_database" );
	
	// create table
     $tbsql = "CREATE TABLE user_table(id INT(11) PRIMARY KEY AUTO_INCREMENT,  
	 name varchar(255) not null, email VARCHAR(50) NOT NULL unique, phone varchar(15) not null, 
	 course enum('PHP Laravel','UI/UX Design','Web Design')default 'PHP Laravel' )";
			  
	// check that database is connected with mysql server
    if(mysqli_query($conn,$dbsql)){
        echo "Database user_database is created successfully.";
    }
	// check that table is connected with mysql server
	elseif(mysqli_query($conn, $tbsql)){
		echo "Table user_table is created successfully";
	}
	else {
 		echo "Error creating Database & table: " . mysqli_error($conn);
 	}
	mysqli_close($conn);
	
7. Comment mysqli_error($conn) echo statement in else part Comment mysqli_close($conn) in conn.php;

8. inside modal-body,
<form action="insert.php" method="post">
	<div class="mb-3">
		<label for="name">User Name</label>
		<input type="text" name="name" class="form-control">
	</div>
	<div class="mb-3">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control">
	</div>
	<div class="mb-3">
		<label for="course">Course Name</label>
		<select class="form-select" name="course" aria-label="Default select example">
			<option selected value="1">PHP Laravel</option>
			<option value="2">UI/UX Design</option>
			<option value="3">Web Design</option>
		</select>
	</div>
	
	inside modal-footer,
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" name="submit" class="btn btn-primary">Save User</button>
	</div>
</form>

9. insert.php
	<?php
		include('conn.php');

		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$course = $_POST['course'];
		};

	?>
	
10. check validation
	if($name == NULL || $email == NULL || $phone == NULL || $course == NULL){
		echo "All field are Necessary";
	}
	
	// insert query
	$query = "INSERT INTO user_table(name,email,	phone,course) VALUES('".$name."','".$email."','".$phone."','".$course."')";
	
	// check that inserted data is connected with mysql server
	$query_run = mysqli_query($conn, $query);
	
	if($query_run){
		echo "Data is inserted successfully";
	}
	else{
		die(mysqli_error($conn));
	}
			  
11. display/view.php
	<?php

		include('conn.php');
		$dpsql = "SELECT * FROM user_table";
		$result=mysqli_query($conn, $dpsql);
		if($result){
			while($row = mysqli_fetch_assoc($result);){
				$id = $row['id'];
				$name = $row['name'];
				$email = $row['email'];
				$phone = $row['phone'];
				$course = $row['course'];
				echo 
				'<div>
					<table class="table  m-5 text-center">
						<tr>
							<th>'.$id.'</th>
							<td>'.$name.'</td>
							<td>'.$email.'</td>
							<td>'.$phone.'</td>
							<td>'.$course.'</td>
							<td>
								<button class="btn btn-primary"><a href="" class="text-light text-decoration-none">Update</a></button>
								<button class="btn btn-danger"><a href="" class="text-light text-decoration-none">Delete</a></button>
							</td>
						</tr>
					</table>
				</div>';
			}

		}
	?>
	
13. insert.php
	if($query_run){
		// echo "Data is inserted successfully";
		header('location:display.php');
	}
	
14. display.php --  url for delete user
	<button class="btn btn-danger">
		<a href="delete.php?deleteid='.$id.'" class="text-light text-decoration-none">Delete</a>
	</button>

15. delete.php - DELETE Query
	<?php
		include('conn.php');
		if(isset($_GET['deleteid'])){
			echo$id=$_GET['deleteid'];exit;
		}
		
		$deletesql = "DELETE FROM user_table where id=$id";
        $result=mysqli_query($conn,$deletesql);
        if($result){
            header('location: display.php');
        }
        else{
            die(mysqli_error($conn));
        }
	?>
	
16. UPDATE User
	display.php - url for update user
	<button class="btn btn-primary">
		<a href="update.php?updateid='.$id.'" class="text-light text-decoration-none">Update</a>
	</button>
	

17. update.php - Get update user details
	<?php
		include('conn.php');
		$id = $_GET['updateid'];
		$sql = "SELECT * FROM user_table where id=$id";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$name = $row['name'];
		$email = $row['email'];
		$phone = $row['phone'];
		$course = $row['course'];
	?>
	
18. update.php - give value
	<form method="post">
		<label for="name">User Name</label>
		<input type="text" name="name" value=<?php echo $name ?> class="form-control">
		
		<label for="course">Course Name</label>
		<select class="form-select" name="course"> aria-label="Default select example">
			<option <?php if($row['course']=='PHP Laravel') echo 'selected="selected"';?>value="1">PHP Laravel</option>
			<option value="2" <?php if($row['course']=='UI/UX Design') echo 'selected="selected"';?>>UI/UX Design</option>
			<option value="3" <?php if($row['course']=='Web Design') echo 'selected="selected"';?>>Web Design</option>
		</select>
	</form>
	
19. update.php - UPDATE Query
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$course = $_POST['course'];

		$updatesql = "UPDATE user_table SET id=$id, name='$name', email='$email', phone='$phone', 
			course='$course' where id=$id";
		$result = mysqli_query($conn, $updatesql);
		if ($result) {
			header('location: display.php');
		} else {
			die(mysqli_error($conn));
		}
	}

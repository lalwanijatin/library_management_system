<?php
include 'connection.php';
if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['address']) && isset($_GET['phone_no'])
	&& isset($_GET['account_no']) &&isset($_GET['class']) && isset($_GET['year'])){
	 if(!empty($_GET['name']) && !empty($_GET['email']) && !empty($_GET['password']) && !empty($_GET['address']) && !empty($_GET['phone_no']) && 
	 !empty($_GET['account_no']) && !empty($_GET['class']) && !empty($_GET['year'])){
		 $name = strtolower($_GET['name']);
		 $email = strtolower($_GET['email']);
		 $password = strtolower($_GET['password']);
		 $address = strtolower($_GET['address']);
		 $phone_no = strtolower($_GET['phone_no']);
		 $account_no = strtolower($_GET['account_no']);
		 $class = strtolower($_GET['class']);
		 $year = strtolower($_GET['year']);
		 
		 $query = "insert into users(account_no,name,email,password,address,phone_no,class,year) values($account_no,'$name','$email','$password','$address',$phone_no,
		 '$class',$year)";
		 if($query_run = mysqli_query($link,$query)){
			 echo "User added successfully!";
		 } else{
			 echo mysqli_error($link);
		 }
	 } else{
		 echo "Please fill in all the fields";
	 }
 } else{
	 echo "Not set";
 }


?>
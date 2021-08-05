<?php 
session_start();
 
if(isset($_GET['password']) && !empty($_GET['password'])){
   $password = $_GET['password'];
	
	if($password == "vesitlibrary"){
        
	    $_SESSION['sid']=session_id();
		echo "a";
	} else {
		echo "Incorrect password";
	}
} else{
	echo "Enter the password";
}
?>
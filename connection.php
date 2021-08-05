<?php
$host="localhost";
$user="root";
$password="jatin";

$link=mysqli_connect($host,$user,$password);
if(@mysqli_select_db($link,'library')){
	// echo "Database connected..<br>";
}
else
	echo mysqli_connect_error();
?>
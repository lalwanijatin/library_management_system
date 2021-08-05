<?php
include 'connection.php';
	
	if(isset($_POST['title']) && isset($_POST['edition']) && isset($_POST['author']) && isset($_POST['isbn_code']) && isset($_POST['shelf_no'])){
			
		 $title=strtolower($_POST['title']); 
		$edition=strtolower($_POST['edition']);
		$author=strtolower($_POST['author']);
		$isbn_code=strtolower($_POST['isbn_code']);
		$shelf_no=strtolower($_POST['shelf_no']);
		
		
		
	if(!empty($_POST['title']) && !empty($_POST['edition']) && !empty($_POST['author']) && !empty($_POST['isbn_code']) && !empty($_POST['shelf_no'])){
		
		$query = "insert into books(title,edition,author,isbn_code,shelf_no) values
		('$title','$edition','$author','$isbn_code','$shelf_no')";
		 if( $query_run = mysqli_query($link,$query)){
			 echo "<div class='insert'>Book added successfully!</div>";
		 } else{
			 echo mysqli_error($link);
		 }
		} else{
			
			echo "<div class='insert'>Please fill in all the fields!</div>";
		}
		}
?>
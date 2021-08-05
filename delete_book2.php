<?php
include 'connection.php';
/*if(isset($_GET['name']) && isset($_GET['edition']) && isset($_GET['quantity'])){
	if(!empty($_GET['name'])){
		if(!empty($_GET['edition'])){
			$name = $_GET['name'];
			$edition = $_GET['edition'];
			$query = "select * from books where name = '$name' AND edition = '$edition'"; // checkin whether book is actually exists.
			if(@$query_run = mysqli_query($link,$query)){
				$row_numb = mysqli_num_rows($query_run);
				$row = mysqli_fetch_assoc($query_run);
				$quantity1 = $row['quantity'];
				if($row_numb != 0){
					
					if(!empty($_GET['quantity'])){
						$quantity2 = $_GET['quantity'];
						if($quantity1 < $quantity2){ // checkin whether the quantity provided(by user) is more than available in the library.
							echo "Please fill in the correct quantity";
							exit;
						}
						$query = "update books set quantity = ($quantity1 - $quantity2) where name = '$name' AND edition = '$edition'"; 
						if(@$query_run = mysqli_query($link,$query)){
							echo $quantity2." ".$name." books has been removed from the database.";
						} else{
							echo mysqli_error($link);
						}
					} else{
			
			
			
			$query = "DELETE FROM books WHERE name = '$name' AND edition = '$edition'";
			if(@$query_run = mysqli_query($link,$query)){
				echo "Book deleted successfully!";
			} else{
				mysqli_error($link);
			}
		
		
		
		
			}
					
		 } else {
			 echo "Please fill in the correct Book and/or Edition.";
		 }
			} else{
				echo mysqli_error($link);
			}
			
			
		} else{
			echo "Please fill in the Edition";
		}
	} else{
		echo "Please fill in the book name";
	}
} else{
	 echo "Fields are not set";
} */
if(isset($_GET['title']) && !empty($_GET['title'])){
	$title = $_GET['title'];
	
	$query = "select * from books where title = '$title'";
	if($query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
		if($row_num == 0){
			echo "No such book found!";
			exit;
		}
		
		$query = "delete from books where title = '$title'";
		if($query_run = mysqli_query($link,$query)){
			echo "Book(s) deleted successfully!";
		} else{
			echo mysqli_error($link);
		}
	} else{
		echo mysqli_error($link);
	}
}

if(isset($_GET['book_id']) && !empty($_GET['book_id'])){
	$book_id = $_GET['book_id'];
	
	$query = "select * from books where book_id = '$book_id'";
	if($query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
		if($row_num == 0){
			echo "No such book_id found!";
			exit;
		}
	     
		 
		$query = "delete from books where book_id = '$book_id'";
		if($query_run = mysqli_query($link,$query)){
			echo "Book deleted successfully!";
		} else{
			echo mysqli_error($link);
		}
	
	    } else{
		echo mysqli_error($link);
	}
}


if(isset($_GET['card_number']) && !empty($_GET['card_number'])){
	$card_number = $_GET['card_number'];
	
	$query = "select * from users where account_no = '$card_number'";
	if($query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
		if($row_num == 0){
			echo "No such Account Number found!";
			exit;
		}
	     
		 
		$query = "delete from users where account_no = '$card_number'";
		if($query_run = mysqli_query($link,$query)){
			echo "User deleted successfully!";
		} else{
			echo mysqli_error($link);
		}
	
	    } else{
		echo mysqli_error($link);
	}
}


?>
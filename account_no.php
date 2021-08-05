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

$card_number;
$borrowed_book_id =  array();
$fine = array();
$title = array();

// here()

if(isset($_GET['card_number']) && !empty($_GET['card_number']) && empty($_GET['book_return']) && empty($_GET['issue_book'])){
	 $card_number = $_GET['card_number'];
	 
	 
	 // Printing the user name beforehand.
	 $query = "select name from users where account_no = '$card_number'";
		 if(@$query_run = mysqli_query($link,$query)){
			 $row = mysqli_fetch_assoc($query_run);
			 $row_num = mysqli_num_rows($query_run);
			 if($row_num == 0){
				 echo "No such number exists";
				 exit;
			 }
			 $user_name = $row['name'];
			 echo "User-Name: ".$user_name."<br><br>";
			 } else{
			 echo mysqli_error($link);
		 }
	 
	 
	 // Checking if the card_number is available in records table.
	 $query = "Select * from records where borrower_id = '".$card_number."' AND date_returned is NULL";
	 $query_run = mysqli_query($link,$query);
	 $row_numb =@mysqli_num_rows($query_run);
	 if($row_numb == 0){
		 echo "<div class='bdiv1'>No book issued!</div>";
		 
		 
		 
		// if  the card_number is present in records. 
	 } else{
		 $i=0;
		 
		 while($row = mysqli_fetch_assoc($query_run)){ // for each row selected find the book_id and fine-amount.
			 
			 $borrowed_book_id[$i] = $row['borrowed_book_id'];
			 
			 
			 if( ( strtotime($row['due_date']) < time() ) && $row['date_returned'] == NULL){
			 $time = (time() - strtotime($row['due_date']));
			 $fine[$i] = intval($time/86400) * 2;
			 
		 } else{
			 $fine[$i] = 0;	
		 }
		 	 $i++;
		 }
		 
		 
		 
		 // finding the title of the book.
		 $title = array();
		 $i = 0;
		 foreach($borrowed_book_id as $book_id){  // finding the title of the book.
		 $query = "select title from books where book_id = '$book_id'";
		 if(@$query_run = mysqli_query($link,$query)){
			 $row = mysqli_fetch_assoc($query_run);
			 $title[$i] = $row['title'];
		 } else{
			 echo mysqli_error($link);
		 }
		 $i++;
		 }
		 
		 
		 // Printing all the values.
		 for($x=0;$x<$i;$x++){ 
			 echo "Book_name: ".$title[$x]."<br>";
			 echo "Fine_amount: ₹".$fine[$x]."<br>";
			 echo "Book_id: ".$borrowed_book_id[$x]."<br><br>";
			 
		 }
		 
	}
		
		 
} 


	
	
	// here1()

if(isset($_GET['book_return']) && !empty($_GET['book_return']) && isset($_GET['card_number'])){
	//echo "hola";
	$card_number = $_GET['card_number'];
	$book_r = $_GET['book_return'];
	
	$query = "Select * from books where title = '$book_r'";
	//echo "mom";
	 if($query_run = mysqli_query($link,$query)){
		  $row_numb = mysqli_num_rows($query_run);
	 if($row_numb == 0){
		 echo "<div class='bdiv1'>No such book found!</div>";
		 exit;
	 }
	 } else{
		 echo mysqli_error($link);
	 }
	 
/* ===================================================================================================================*/	
	 $query = "Select * from records where borrower_id = '".$card_number."' AND date_returned is NULL";
	 $query_run = mysqli_query($link,$query);
	 $row_numb =@mysqli_num_rows($query_run);
	 if($row_numb == 0){
		 echo "<div class='bdiv1'>No book issued!</div>";
		 
	 } else{
	 $i=0;
		 
		 while($row = mysqli_fetch_assoc($query_run)){ // for each row selected find the book_id and fine-amount.
			 
			 $borrowed_book_id[$i] = $row['borrowed_book_id'];
			 
			 
			 if( ( strtotime($row['due_date']) < time() ) && $row['date_returned'] == NULL){
			 $time = (time() - strtotime($row['due_date']));
			 $fine[$i] = intval($time/86400) * 2;
			 
		 } else{
			 $fine[$i] = 0;	
		 }
		 	 $i++;
		 }
		 
		 
		 
		 // finding the title of the book.
		 
		 $i = 0;
		 foreach($borrowed_book_id as $book_id){  // finding the title of the book.
		 $query = "select title from books where book_id = '$book_id'";
		 if(@$query_run = mysqli_query($link,$query)){
			 $row = mysqli_fetch_assoc($query_run);
			 $title[$i] = $row['title'];
		 } else{
			 echo mysqli_error($link);
		 }
		 $i++;
		 }
	 }
	
/*==================================================================================================================================*/	
	
	// echo $book_r = $_GET['book_return'];
	$i=0;
	$flag = 0;
	//echo $borrowed_book_id[0];
	
	
	foreach($title as $book){
		//echo "hey";
		if ($book == $book_r){
		//	echo "hi";
			$flag = 1;
			break;
		}
		//echo "hello";
		$i++;
	}
	
	if($flag != 1){
		echo "This book has not been issued by the user!";
	} else{
		$modified_time = strtotime('+4hours 30minutes');
		$today = Date('Y-m-d H:i:s',$modified_time);
		$book_id = $borrowed_book_id[$i];
		$fine1 = $fine[$i];
		
		//$query = "update records set date_returned = '$today' AND fine_amount = '$fine1' where borrowed_book_id = '$book_id'";
		$query = "update records set fine_amount = '$fine1' where borrowed_book_id = '$book_id'";
		$query_run = mysqli_query($link,$query);
		$query = "update records set date_returned = '$today' where borrowed_book_id = '$book_id'";
		if(@$query_run = mysqli_query($link,$query)){
			echo "Book:  ".$book_r."<br>";
			echo "Returned successfully!";
		} else{
			echo mysqli_error($link);
		}
		
	}
} else{
	//echo "not set";
}

	

//here2()

if(isset($_GET['issue_book']) && !empty($_GET['issue_book']) && isset($_GET['card_number'])){
	$card_number = $_GET['card_number'];
	$book_i = $_GET['issue_book'];
	$book_id_arr = array();
	$i=0;
	$count=0;
	$available = array();
	$x=0;
	$issue;
	$flag=0;
	
	$query = "select * from records where borrower_id = '$card_number' AND date_returned is NULL";
	if($query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
		if($row_num == 2){
			echo "Cannot issue<br>";
			echo "more than two books";
			exit;
		}
	} else{
		echo mysqli_error($query_run);
	}
	
	$query ="select book_id from books where title = '$book_i'";
	if(@$query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
		if($row_num == 0){
			echo "No such book found!";
			exit;
		} 
		while($row = mysqli_fetch_assoc($query_run)){
			$book_id_arr[$i] = $row['book_id'];
			$i++;
		}
		
		foreach($book_id_arr as $b_id){
			$query = "select * from records where borrowed_book_id = $b_id AND borrower_id = $card_number AND 
			date_returned is NULL";
			if($query_run = mysqli_query($link,$query)){
				$row_num = mysqli_num_rows($query_run);
				if($row_num == 1){
					echo "User has already issued<br>";
					echo "the book.";
					exit;
				}
			}else{
				echo mysqli_error($link);
			}
		}
		
		
		
		foreach($book_id_arr as $book_id){
		$query = "select * from records where borrowed_book_id = '$book_id' AND date_returned is NULL";
		if(@$query_run = mysqli_query($link,$query)){
			$row_num = mysqli_num_rows($query_run);
			
			if($row_num == 1){
				$count++;	
			} else{
				$available[$x] = $book_id;
				$x++;
			}
		} else{
			echo mysqli_error($link);
		}
		}
		
		
		if($count == $i){
			echo "Book not available in the library!";
			exit;
		} else{
			
				$query = "select book_id from books where title = '$book_i'";
				if(@$query_run = mysqli_query($link,$query)){
					while ($row = mysqli_fetch_assoc($query_run)){
					for($y=0;$y<$x;$y++){
						if(($row['book_id'] == $available[$y]) && $flag == 0){
							$issue = $row['book_id'];
							$flag = 1;
						}
					}
					}
					
					
					
					$today = Date('Y-m-d H:i:s',time());
					$modified_time = strtotime('+1 week');
		            $next_week = Date('Y-m-d H:i:s',$modified_time);
					
					$query = "insert INTO records(borrowed_book_id,date_issued,due_date,borrower_id) VALUES ('$issue','$today','$next_week',$card_number)";
					if($query_run = mysqli_query($link,$query)){
						echo "Book issued successfully!";
					} else {
						echo mysqli_error($link);
					}
				} else{
					echo mysqli_error($link);
				}
			}
		
		
		
	} else{
		echo mysqli_error($link);
	}
	
	
	
	
}	
	
	



 
?>
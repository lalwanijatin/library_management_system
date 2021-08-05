<?php
include 'connection.php';

if(isset($_POST['card_number']) && !empty($_POST['card_number'])){
	$account_no = $_POST['card_number'];
	$flag1;
	$query = "select * from records where borrower_id = $account_no";
	if($query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
		if($row_num == 0){
			$flag1 = 0;
		} else{
			$flag1 = 1;
		}
	} else{
		echo mysqli_error($link);
	}
	
	$query = "select * from users where account_no = '$account_no'";
	if($query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
		if($row_num == 0){
			echo "Account Number: <br>";
			echo $account_no."<br>";
			echo "does not exists.";
			exit;
		}
		$row = mysqli_fetch_assoc($query_run);
	    $name = $row['name'];
		$email = $row['email'];
		$password = $row['password'];
		$address = $row['address'];
		$phone_no = $row['phone_no'];
		$class = $row['class'];
        $year = $row['year'];		
		
		$query = "select * from records where borrower_id = '$account_no'";
		if($query_run = mysqli_query($link,$query)){
			$row_num = mysqli_num_rows($query_run);
			$no_of_books_issued_till_date = $row_num;
			$issued_books = array();
			$fine = array();
			$i=0;
			$total_fine=0;
			$count = array();
			$fine = 0;
			
			while($row = mysqli_fetch_assoc($query_run)){
				$issued_books[$i] = $row['borrowed_book_id'];
				$fine += $row['fine_amount'];
				$i++;
			}
			
			
			
			for($x=0;$x<$i;$x++){
				$count[$x] = 0;
				//$total_fine += $fine[$x];
				for($y=0;$y<$i;$y++){
					if(($issued_books[$x] == $issued_books[$y]) && ($x != $y)){
						$count[$x] = ($count[$x] + 1);
					}
				}
			}
			$flag = 0;
			$max_offset = 0;
			$m=0;
			$same = array();
			$same_books = array();
			
			for($z=0;$z<($i-1);$z++){
				if($count[$z] == $count[$z+1]){
					//echo "oye<br>";
					if($issued_books[$z] != $issued_books[$z+1]){
					$flag = 1;
					$same[$m] = $issued_books[$z];
					
					$same[$m+1] = $issued_books[$z+1];
					} else{
						$max_offset = ($z + 1);
					    $flag = 0;
					}
					
				}
				if($count[$z] < $count[$z+1]){
						//echo "hoye<br>";
					$max_offset = ($z + 1);
					$flag = 0;
				}
			}
			$a = 0;
			if($flag == 1){
				
				if($flag1 == 1){
				
				foreach($same as $id){
					$query = "select * from books where book_id = '$id'";
					if($query_run = mysqli_query($link,$query)){
						$row = mysqli_fetch_assoc($query_run);
						$same_books[$a] = $row['title'];
						$a++;
					} else{
						echo mysqli_error($link);
					}
				}
				}
				
			} else{
				if($flag1 == 1){
				if($flag == 0){
			
			$most_frequently_issued_book = $issued_books[$max_offset];
			$query = "select title from books where book_id = $most_frequently_issued_book";
			if($query_run = mysqli_query($link,$query)){
				$row = mysqli_fetch_assoc($query_run);
				$book1 = $row['title'];
			}else{
				 echo mysqli_error($link);
			 }	
				}
				}
			}
			//echo $flag."<br>";
			//echo $same[0]."<br>";
			////echo $same[1]."<br>";
			//echo $same_books[0]."<br>";
			//echo $same_books[1]."<br>";
			echo "Name: ".$name."<br>";
			echo "Email: ".$email."<br>";
			echo "Password: ".$password."<br>";
			echo "Address: ".$address."<br>";
			echo "Phone Number: ".$phone_no."<br>";
			echo "Class: ".$class."<br>";
			echo "Year: ".$year."<br>";
			echo "No of books issued till date: ".$no_of_books_issued_till_date."<br>";
			echo "Fine paid till date: ".$fine."<br>";
			if($flag1 == 1){
			if($flag == 0){
				echo "Most frequently issued book: ".$book1."<br>";
			} else{
				echo "Most frequently issued books: ";
				for($b=0;$b<$a;$b++){
					if($b == ($a-1)){
						echo $same_books[$b].".";
					} else{
						echo $same_books[$b].", ";
					}
				}
			}
			} else{
				echo "Most frequently issued book: None";
			}
			
			
		} else{
			echo mysqli_error($link);
		}
	} else{
		echo mysqli_error($link);
	}
}
?>
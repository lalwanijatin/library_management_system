<?php
include 'connection.php';
if(isset($_POST['name']) && !empty($_POST['name'])){
	$name = $_POST['name'];
	
	$query = "select * from books where title = '$name'";
	if(@$query_run = mysqli_query($link,$query)){
		$row_num = mysqli_num_rows($query_run);
        if($row_num == 0){
			echo "No such book found!";
			exit;
		} else{
		
		// echo "Book: ".$name."<br><br><br>";
	
		
		/*while($row = mysqli_fetch_assoc($query_run)){
			echo "Edition: ".$row['edition']."<br>";
		    echo "Author: ".$row['Author']."<br>";
			echo "Quantity: ".$row['quantity']."<br>";
			echo "Category: ".$row['category']."<br><br>";
		}*/
		
		$edition  = array();
		$shelf_no = array();
		$average_rating = array();
		$book_id = array();
		$c_edition = 0;
		$c_shelf_no = 0;
		$c_average_rating = 0;
		$x = 0;
		$no_of_books_issued = 0;
		$quantity = $row_num;
		
		
		while($row = mysqli_fetch_assoc($query_run)){
			
			if($x == 0){
		        $author = $row['author'];
		        $name = $row['title']; 
			}
			
			$book_id[$x] = $row['book_id'];
			$x++;
			
			
			if($x == 1){
				$edition[$c_edition] = $row['edition'];
			} else {
				for($i=$c_edition;$i>=0;$i--){
					if($row['edition'] != $edition[$i]){
						$c_edition++;
						$edition[$c_edition] = $row['edition'];
					}
				}
				}
				
				if($x == 1){
				$shelf_no[$c_shelf_no] = $row['shelf_no'];
			} else {
				for($i=$c_shelf_no;$i>=0;$i--){
					if($row['shelf_no'] != $shelf_no[$i]){
						$c_shelf_no++;
						$shelf_no[$c_shelf_no] = $row['shelf_no'];
					}
				}
				}
				
				if($x == 1){
				$average_rating[$c_average_rating] = $row['average_rating'];
			} else {
				for($i=$c_average_rating;$i>=0;$i--){
					if($row['average_rating'] != $average_rating[$i]){
						$c_average_rating++;
						$average_rating[$c_average_rating] = $row['average_rating'];
					}
				}
				}
				
				
			}
			
			
			foreach($book_id as $id){
				$query = "select * from records where borrowed_book_id = '$id' and date_returned is NULL";
				if($query_run = mysqli_query($link,$query)){
					$row_num = mysqli_num_rows($query_run);
					if($row_num != 0){
						$no_of_books_issued++;
					}
				} else{
					echo mysqli_error();
				}
			}
			
			
			echo "Name: ".$name."<br>";
			echo "Author: ".$author."<br>";
			echo "Quantity: ".$quantity."<br>";
			echo "No. of '".$name."' books present in the library: ".($quantity-$no_of_books_issued)."<br>";
			echo "Edition(s): ";
			for($y=$c_edition;$y>=0;$y--){
				if($y != 0){
				echo $edition[$y]." ,";
				} else {
					echo $edition[$y].".";
				}
			}
			echo "<br>";
			echo "Shelf Number(s): ";
			for($y=$c_shelf_no;$y>=0;$y--){
				
				if($y != 0){
				echo $shelf_no[$y]." ,";
				} else{
					echo $shelf_no[$y].".";
				}
			}
			echo "<br>";
			echo "Average Rating: ";
			$sum = 0;
			for($y=$c_average_rating;$y>=0;$y--){
				$sum += $average_rating[$y];
				
			}
			
			$c_average_rating++;
				$avg = $sum/$c_average_rating;
			echo $avg."<br>";
			
		}
		
		
		} else{
		echo mysqli_error($link);
	}
}
?>
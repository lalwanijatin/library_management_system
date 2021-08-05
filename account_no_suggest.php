
 <?php
 
include 'connection.php';
if(isset($_POST['name'])) {
	if(!empty($_POST['name'])){
    $name = mysqli_real_escape_string($link,trim($_POST['name']));
    $sql = "SELECT DISTINCT(`title`) FROM `books` WHERE `title` LIKE '{$name}%'";
    $myquery = mysqli_query($link,$sql) or die(mysql_error());
    if(mysqli_num_rows($myquery) !=0) {
        while(($row = mysqli_fetch_array($myquery)) !== NULL) {
            echo '<li>'.$row['title'].'</li>';
        }
    } else {
       // echo '<li>Not Found</li>';
    }
	}
} else {
    echo "not set!";
}


?>
<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
		//echo "Welcome to you<br>";
		// echo "<a href='logout.php'>Logout</a>";
	}
	else
	{   $_SESSION['message'] = "Please login first";
		header("location:login_page.php");
	}
?>

<!doctype html>
<html>
<head>

<!--------------------------------------------------------------------------------------------------------------------->
<title>
	 
Student & Book Details     
		</title>
 
		<link rel="stylesheet" href="delete_book.css" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		
		<script>
	
		     function here(book){
				// alert ("hello!");
				var xhttp;
				
				if(window.XMLHttpRequest){
					xhttp = new XMLHttpRequest();
				} else{
					xhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}
				
				xhttp.onreadystatechange = function(){
					if(xhttp.readyState == 4 && xhttp.status == 200){
						document.getElementById('adiv1').innerHTML = xhttp.responseText;
						// alert('ok!');
						
						 var field1 = document.getElementById('book');
					 
                         field1.value= '';
					 }
				}
				
				xhttp.open('GET','delete_book2.php?title='+document.getElementById('book').value,true);
				xhttp.send();
			} 
			
			
			
			function here1(id){
				 //alert ("hello!");
				var xhttp;
				
				if(window.XMLHttpRequest){
					xhttp = new XMLHttpRequest();
				} else{
					xhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}
				
				xhttp.onreadystatechange = function(){
					if(xhttp.readyState == 4 && xhttp.status == 200){
						document.getElementById('adiv2').innerHTML = xhttp.responseText;
						 //alert('ok!');
						
						 var field1 = document.getElementById('id');
					 
                         field1.value= '';
					 }
				}
				
				xhttp.open('GET','delete_book2.php?book_id='+id,true);
				xhttp.send();
			} 
			
			
			
			function here2(card_number){
				// alert ("hello!");
				var xhttp;
				
				if(window.XMLHttpRequest){
					xhttp = new XMLHttpRequest();
				} else{
					xhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}
				
				xhttp.onreadystatechange = function(){
					if(xhttp.readyState == 4 && xhttp.status == 200){
						document.getElementById('adiv3').innerHTML = xhttp.responseText;
						// alert('ok!');
						
						 var field1 = document.getElementById('card_number');
					 
                         field1.value= '';
					 }
				}
				
				xhttp.open('GET','delete_book2.php?card_number='+document.getElementById('card_number').value,true);
				xhttp.send();
			} 
		</script>
		
	<!---------------------------------------------------------------------------------------------------------------------------------------->	
		


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pretty Off-canvas Sidebar Navigation Demo</title>
<link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.css" rel="stylesheet" type="text/css">
<style>
a {
  color: #35403c;
}
a:hover {
  color: #29322f;
  text-decoration: none;
}



.content {
  background: #dd604c;
  position: relative;
  transition: all .3s ease-in-out;
}

.navigation {
  background: #35403c;
  height: 100%;
  position: absolute;
  transition: all .3s ease-in-out;
  z-index: 5;
}
.navigation, .navigation a {
  color: white;
}
.navigation.expanded {
  background: #1e2422;
  box-shadow: 100px 0 300px 300px rgba(0, 0, 0, 0.5);
}
.navigation.expanded + .content {
  transform: translate3d(50px, 0, 0) rotateY(-10deg);
  transform-origin: 90% 50%;
  transform-style: preserve-3d;
}

.nav-toggler {
  display: inline-block;
  font-size: 26px;
  left: 100%;
  padding: .5em;
  position: absolute;
  text-decoration: none;
}
.nav-toggler span {
  position: relative;
  z-index: 5;
}
.nav-toggler .hide-nav {
  display: none;
}
.expanded .nav-toggler .show-nav {
  display: none;
}
.expanded .nav-toggler .hide-nav {
  display: inline-block;
}
.expanded .nav-toggler:after {
  border-color: #1e2422 transparent transparent transparent;
}
.nav-toggler:after {
  border-style: solid;
  border-width: 100px 100px 0 0;
  border-color: #35403c transparent transparent transparent;
  content: "";
  height: 0;
  left: 0px;
  position: absolute;
  top: 0px;
  transition: border-color .3s ease-in-out;
  width: 0;
}

.navigation__inner {
  font-size: 22px;
  overflow: hidden;
  transition: all .3s ease-in-out;
  width: 0;
}
.expanded .navigation__inner {
  display: block;
  width: 250px;
}
.navigation__inner h2 {
  font-size: 1.2em;
  font-weight: 400;
  margin: 0.5em 1.5em 1.2em;
}
.navigation__inner ul {
  list-style: none;
  margin: 0;
  padding: 1em 0;
}
.navigation__inner li.separator {
  border-bottom: 1px solid white;
  margin: 1.5em 0 .5em;
}
.navigation__inner a {
  border-left: 0 solid #cf3e27;
  display: block;
  padding: .5em 2em;
  text-decoration: none;
  transition: all .2s ease-in-out;
}
.navigation__inner a.current {
  background: #191f1d;
  border-left-width: 10px;
}
.navigation__inner a:hover {
  background: #101312;
  border-left-width: 10px;
}


</style>
</head>

<body class="body" id="search"> <!-- <div class='viewport'> -->
  <!-- <div class='page'> -->
    <div class="navigation" id="navigation">
  <a class="nav-toggler" href="#" id="navToggler">
    <span class="show-nav">&#9776;</span>
    <span class="hide-nav">&times;</span>
  </a>
  <div class="navigation__inner">
    <ul>
      <li>
        <h2>MyLibrary</h2>
      </li>
      <li><a class="current" href="logout.php">Logout</a></li>
      <li><a href="account_no_page.php">Card_Number</a></li>
      <li><a href="add_book_page.php">Add_Books</a></li>
	  <li><a href="add_user_page.php">Add_User</a></li>
      <li><a href="delete_book_page.php">Delete</a></li>
	   <li><a href="search_book_page.php">Search_Books</a></li>
	   <li><a href="user_info_page.php">User_Info</a></li>
    </ul>
  </div>
</div>





<!-- -----------------------------------------      BODY   ------------------------------------------------------------------------- -->



		<center>
			<!-- <div class="body" id="search"> -->
			      
				 <!--  <i class="fa fa-bars fa-4x"></i> -->

				   <!-- <img src="menu-button.jpg" class="menu"> -->
				   
				   
				   
			       <h2 class="h1" style="font-family:arial;"> Delete Books!</h2>
				   <h2 class="h2" style="font-family:arial;"> Delete a Book!</h2>
				   <h2 class="h3" style="font-family:arial;"> Delete Users!</h2>
				  
				    <!-- <form id="form1"> -->
				    
				
					
					<input type="text" id="card_number" name="card_number"  placeholder="CARD_NUMBER" maxlength="5"
	                class="input3"><br><br>
					
					
					<!--<div class="serch-wrap">
					<div class="form-wrapper cf"> -->
					<input type="text" id="book" name="book"  placeholder="BOOK" 
	                class="input1"  autocomplete="off"><br><br>
					<!--</div>	-->
	<div class="autodropdown">
	<ul class="suggestresult"></ul>
	<!--</div>-->
</div>	

                    <input type="text" id="id" name="id"  placeholder="BOOK_ID"
	                class="input2" maxlength="6">
 
				
					
					<!-- <input type="submit" class="submit1" onclick="here();"> -->
					<!-- <button type="submit" class="submit1" onclick="here();">
                    <img src="mybutton.jpg" width="50px" height="50px"/>
                    </button>   -->
					 
					
					 
                     <script>
					 
					 	document.getElementById('book').onkeydown = function(event) {
                        if (event.keyCode == 13) {
							 var book = document.getElementById("book").value;
					// alert(card_numb);
                        here(book);
                       }
                       }
					   
					   document.getElementById('id').onkeydown = function(event) {
                        if (event.keyCode == 13) {
							 var id = document.getElementById("id").value;
					// alert(id);
                        here1(id);
                       }
                       }
					   
					   document.getElementById('card_number').onkeydown = function(event) {
                        if (event.keyCode == 13) {
							 var card_number = document.getElementById("card_number").value;
					// alert(card_numb);
                        here2(card_number);
                       }
                       }
					 </script>
                     
					 
					<!-- </form> -->
					
					
					 <br><br>
					 
					<div id="adiv1" class="adiv"></div>
					<div id="adiv2" class="adiv"></div>
					<div id="adiv3" class="adiv"></div>
	   
	               
					
						
					<script type="text/javascript"  src="js/jquery.js"></script>
					<script type="text/javascript"  src="delete_book.js"></script> 
					
			

<!-- </div> -->
</center>









<!----------------------------------------------------------------------------------------------------------------------------------------------->


   
   <!-- </div> -->
  <!-- </div> -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
  <script>
(function ($, window, document, undefined) {
    $(function () {
        var $navigation = $('#navigation'), $navToggler = $('#navToggler');
        $('#navToggler').on('click', function (e) {
            e.preventDefault();
            $navigation.toggleClass('expanded');
        });
    });
}(jQuery, this, this.document));
</script> 

<!--
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>  -->
</body>
</html>
<?php
	session_start();
	if(@$_SESSION['message'] != "")
	{
		echo "<div id='adiv'>".$_SESSION['message']."</div>";
		// echo "<a href='logout.php'>Logout</a>";
		session_unset(); 
		session_destroy();
		
	} else{
	session_unset(); 
	session_destroy();
	}
?>
<html>
	<head>
		<title>
	   		Student & Book Details     
		</title>

		<link rel="stylesheet" href="login.css" type="text/css">	

		<script>
	
		     function here(password){
				var xhttp;
				//alert('ok!');
				if(window.XMLHttpRequest){
					xhttp = new XMLHttpRequest();
				} else{
					xhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}
				
				xhttp.onreadystatechange = function(){
					if(xhttp.readyState == 4 && xhttp.status == 200){
						// document.getElementById('adiv').innerHTML = xhttp.responseText;
						if(xhttp.responseText == "a"){
						//alert(xhttp.responseText);	
							//window.location="library1.html";
							  window.location="account_no_page.php";
							  } else {
							      document.getElementById('adiv').innerHTML = xhttp.responseText;
							  }
					}
				}
				
				xhttp.open('GET','login.php?password='+password,true);
				xhttp.send();
			} 
		</script>
		
		
		</head>

		<center>
			<body class="body" id="search">
			
			        <h2>About the Portal</h2>
					<hr>
					  
					  <p>This portal provides a variety of functions to the users like adding and/or deleting a user or a book,
					  getting all the detailed information about the book and/or the user, issuing and returning books. 
					  This portal has been developed such a way that user will find it easy to use. 
					  It is quite a secure system. It will keep the data safe from all kind of malpractices. </p>
							
					<input type="password" id="password" name="password"  placeholder="Password" 
	                class="input"><br><br>
					
					<div id="adiv" style="display:none">Welcome</div>

					
					
					 <script>
					 
					 	document.getElementById('password').onkeydown = function(event) {
                        if (event.keyCode == 13) {
							 var password = document.getElementById("password").value;
							 //alert(password);
                        here(password);
                       }
                       }
					 </script>
							
					<script type="text/javascript"  src="js/jquery.js"></script>
					<script type="text/javascript"  src="login.js"></script>

</body>
</center>

</html>
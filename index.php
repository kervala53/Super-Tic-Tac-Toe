<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>Login</title>
		<meta name="description" content="" />
		<meta name="author" content="zchak" />


		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
	</head>
	<body>
		<div>
			<header>
				<h1>Welcome To Super Tic Tac Toe</h1>
			</header>



<?php
    session_start();

	if(isset($_SESSION["username"])){ 
		echo "You Are Loged In as ";
		echo $_SESSION["username"];
		echo "<form id='logout' action='logout.php' method='post' accept-charset='UTF-8'>";
		echo "<input type='hidden' name='username' id='username' maxlength=\"50\" />";
		echo "<input type='submit' name='logout' value='Log Out' />";
		echo "</form>";
	}
	
	else{
		echo "<form id='login' action='login.php' method='post' accept-charset='UTF-8'>";
		echo "<label for='username' >UserName: </label>";
		echo "<input type='text' name='username' id='username' maxlength=\"50\" />";
		echo "<br>";
		echo "<label for='password' >Password: </label>";
		echo "<input type='password' name='password' id='password' maxlength=\"50\" />";
		echo "<br>";
		echo "<input type='submit' name='login' value='Log In' />";
		echo "</form>";
		echo "<form id='registration' action='registration.php' method='post' accept-charset='UTF-8'>";
		echo "<input type='submit' name='login' value='Register' />";
		echo "<a href=\"forgot.html\">forgot password</a>
";
		echo "</form>";
	}
?>		



		
			
		</div>
	</body>
</html>

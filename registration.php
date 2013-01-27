<?php
	session_start();

	if(isset($_SESSION["username"])){ 
		header("Location:index.php");
	}



if(isset($_POST["button"])){
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
		die("Could not connect: ". mysql_error());
	}
	
	if (!mysql_select_db('tictactoe', $conection)) {
	    die ("Can not use test base : " . mysql_error());
	}

	$result = mysql_query("select * from user where username = '".$_POST["username"]."';", $conection);

	if (!$result) {
			die(mysql_error());
		}

	if (mysql_num_rows($result)>0) {
	echo "
		There exists such username . Please , register with another one !
	";
	}
	else{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$firstname = $_POST["firstName"];
		$lastname = $_POST["lastName"];
		$email = $_POST["e-mail"];
		$query = mysql_query("INSERT INTO user VALUES('','$username','$firstname', '$lastname', '$password', '0','0','$email')");
		if (!$query) {
			die("Could not insert: " . mysql_error());
		}
		echo "You Have Registered Successfully ! ! ! <br>";
		echo "You will be redirected to login page in 5 seconds";
		header("refresh:5; url=index.php");
	}
	
}

	
	echo "<!DOCTYPE html>
		<html>
			<head>
				<title> register </title>
			</head>
			<body >
				<h1> Register </h1> 
				<form action = \"registration.php\" method = \"post\">
					username :
					<input type=\"text\"  name=\"username\"/>
					<br>
					password :
					<input type=\"password\"  name=\"password\"/>
					<br>
					first name : 
					<input type=\"text\" name=\"firstName\"/>
					<br>
					last name :
					<input type=\"text\"  name=\"lastName\"/>
					<br>
					e-mail : 
					<input type=\"text\"  name=\"e-mail\"/>
					<br>
					<input type=\"submit\" value=\"register\"/ name=\"button\">
				</form>
				
			</body>

		</html>
	";
	
?>
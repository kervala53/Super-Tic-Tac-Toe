<?php
	session_start();
	if(isset($_SESSION["user_id"])){ 
		$user_id = $_SESSION['user_id'];
	}
	
	else{
		header("Location:index.php");
	}
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
		die("Could not connect: ". mysql_error());
	}
	
	if (!mysql_select_db('tictactoe', $conection)) {
	    die ("Can not use tictactoe base : " . mysql_error());
	}

	$result = mysql_query("select * from user where user_id = '".$user_id."';", $conection);

	if (!$result) {
			die(mysql_error());
	}
	$row = mysql_fetch_array($result);
	$username = $row["username"];
	$old_password = $row["password"];
	$old_email = $row["email"];
	if(isset($_POST['email'])){
		if(isset($_POST["emailFill"])){
			echo "string";
		}
		else{
			echo"
		<!DOCTYPE html>
		<html>
			<head>
				<title>".$username ." settings</title>
			</head>
			<body >
				<h1> Change email ! </h1> 
				<br />
				<form action='userSettings.php' method='post'>
					Enter new e-mail : <input type=\"text\"  name=\"emailFill\"/>
					<input type='submit' name='email' value='Change email' />
				</form>
			</body>
		";
		}
	}elseif(isset($_POST['password'])){
		echo "<!DOCTYPE html>
		<html>
			<head>
				<title>".$username ." settings</title>
			</head>
			<body>
				<h1> Change password ! </h1> 
				<br />
				<form action='userSettings.php' method='post'>
					Enter new password here : <input type=\"text\"  name=\"enterPassword\"/>
					<input type='submit' name='password' value='Change password' />
				</form>
			</body>
			"
			;
		 
	}else {
		echo "<!DOCTYPE html>
		<html>
			<head>
				<title>".$username ." settings  </title>
			</head>
			<body >
				<h1> User settings ! </h1> 
				<br />
				<h3>Your email is ".$old_email." games.</h3>
				<form action='userSettings.php' method='post'>
				<input type='submit' name='email' value='Change email' />
				<input type='submit' name='password' value='Change password' />
				</form>
				<a href=\"mainPage.php\"> Back </a>
				<br />
				<a href= \"logout.php\"> Logout </a>
			</body>
		</html>
		";
	}				
	
?>
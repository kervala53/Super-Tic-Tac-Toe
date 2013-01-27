<?php
	 session_start();

	if(isset($_SESSION["username"])){ 
		header("Location:mainPage.php");	
	}
	
	
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
		die("Could not connect: ". mysql_error());
	}
	
	if (!mysql_select_db('tictactoe', $conection)) {
	    die ("Can not use test base : " . mysql_error());
	}
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	

	$arr = mysql_query("select * from user where username = '".$_POST["username"]."' and password = '".$_POST["password"]. "';", $conection);

	if (!$arr) {
			die(mysql_error());
	}

	if (mysql_num_rows($arr)>0) {
		$row = mysql_fetch_array($arr);
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['username'] = $username; 
		header("Location:mainPage.php");
	}
	else{
		echo "<h1>You entered ilegal username or password  <a href=\"index.php\">try again!</a></h1>";
	}
?>
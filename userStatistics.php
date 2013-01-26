<?php
	// session_start();
	// $user_id = $_SESSION['user_id'];
	$user_id = 1;
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
		die("Could not connect: ". mysql_error());
	}
	
	if (!mysql_select_db('tic-tac-toe', $conection)) {
	    die ("Can not use tic-tac-toe base : " . mysql_error());
	}

	$result = mysql_query("select * from user where user_id = '".$user_id."';", $conection);

	if (!$result) {
			die(mysql_error());
	}
	$row = mysql_fetch_array($result);
	$username = $row["username"];
	$played_game = $row["played_game"];
	$won_game = $row["won_game"];
	//$winning_percentage = $won_game/$played_game;
	
	echo "<!DOCTYPE html>
		<html>
			<head>
				<title>".$username ." statistics  </title>
			</head>
			<body >
				<h1> Your played games statistics!</h1> 
				<br />
				<h3>You have played ".$played_game." games.</h3>
				<br />
				<h3>You have won ".$won_game." .</h3>
				<br />
				<h3>Your winning percentage </h3>
				<a href=\"mainPage.php\"> Back </a>
				<br />
				<a href= \"logout.php\"> Logout </a>
			</body>
		</html>
	";
	
?>
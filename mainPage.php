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
	echo "<a href= \"userStatistics.php\"> User statistics </a>";
	echo "<a href= \"userSettings.php\"> User settings </a>";

?>


<?php
session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location:index.php");
}

if (isset($_SESSION["table_id"])) {
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
		die("Could not connect: " . mysql_error());
	}
	if (!mysql_select_db('tictactoe', $conection)) {
		die("Can not use test base : " . mysql_error());
	}

	$arr = mysql_query("select * from game where table_id = ".$_SESSION["table_id"]." and player1_id = ".$_SESSION["user_id"]." and player2_id != 0;", $conection);

	if (!$arr) {
		die(mysql_error());
	}
	if (mysql_num_rows($arr) > 0) {
		return 1;
	} else {
		return 0;
	}
}
?>
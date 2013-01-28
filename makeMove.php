<?php
session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location:index.php");
}
if (isset($_SESSION["game_id"])) {
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
		die("Could not connect: " . mysql_error());
	}
	if (!mysql_select_db('tictactoe', $conection)) {
		die("Can not use test base : " . mysql_error());
	}
	
	$querry = mysql_query("update game set last_turn=".$_POST["move"]." where game_id =".$_SESSION["game_id"]."");
	if (!$querry) {
		die("Could not update querry: " . mysql_error());
	}
	
	echo $querry;
}
?>
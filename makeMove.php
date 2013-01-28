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
	
	$move = $_POST["move"];
	
	$querry = mysql_query("select * from game where game_id =".$_SESSION["game_id"]."");
	if (!$querry) {
		die("Could not update querry: " . mysql_error());
	}
	$board = NULL;
	if (mysql_num_rows($querry) > 0) {
		$row = mysql_fetch_array($querry);
		$board = $row["board"];
		
		$xoro = $move[0];
		$x = $move[1];
		$y = $move[2];
		$index = $y * 9 + $x;
		$board[$index] = $xoro;
	}
	
	
	
	
	
	$querry = mysql_query("update game set last_turn=".$move.", board = ".$board." where game_id =".$_SESSION["game_id"]."");
	if (!$querry) {
		die("Could not update querry: " . mysql_error());
	}
	
	
	
	echo $querry;
}
?>
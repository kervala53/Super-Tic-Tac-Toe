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
	$arr = mysql_query("select * from game where game_id = " . $_SESSION["game_id"] . " and turn = " . $_SESSION["user_id"] . ";", $conection);
	if (!$arr) {
		die(mysql_error());
	}
	
	if (mysql_num_rows($arr) > 0) {
		$row = mysql_fetch_array($arr);
		$player1_id = $row["player1_id"];
		$player2_id = $row["player2_id"];
		$playerid = NULL;
		if($_SESSION["user_id"] == $player1_id){
			$playerid = $player2_id;
		}
		else {
			$playerid = $player1_id;
		}
		$querry = mysql_query("update game set turn = ".$playerid." where game_id = ".$_SESSION["game_id"]."");
		if (!$querry) {
			die("Could not update querry: " . mysql_error());
		}
		if ($querry > 0) {
			echo 1;
		} 
	} 
	else {
		echo 0;
	}

}
?>
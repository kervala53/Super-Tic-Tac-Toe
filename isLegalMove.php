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
		$mini_board = $row['mini_board'];
		$x = $_POST['x'];
		$y = $_POST['y'];
		$board = $row['board'];
		$index = $y * 9 + $x;
		$playerid = NULL;
		$nashti = $index%9;
		$ganakopi = (int)($index/9);
		$dapa;
		if($ganakopi<3){ // daxurul magidas rom ar gadaaceros 
			if($nashti<3){
				$dapa =0;
			}
			if($nashti>2 && $nashti<6){
				$dapa =1;
			}
			if($nashti>5 && $nashti<9){
				$dapa =2;	
			}
		}
		if($ganakopi>2 && $ganakopi<6){
			if($nashti<3){
				$dapa =3;
			}
			if($nashti>2 && $nashti<6){
				$dapa =1+3;
			}
			if($nashti>5 && $nashti<9){
				$dapa =2+3;	
			}
		}
		if($ganakopi>5 && $ganakopi<9){
			if($nashti<3){
				$dapa =6;
			}
			if($nashti>2 && $nashti<6){
				$dapa =1+6;
			}
			if($nashti>5 && $nashti<9){
				$dapa =2+6;	
			}
		}
		if ($board[$index] != 0) { // natamashebs roma r gadaaceros 
			echo 0;
		}
		else if($mini_board[$dapa]!=0 ){
			echo 0;
		}
		else {
			if ($_SESSION["user_id"] == $player1_id) {
				$playerid = $player2_id;
			} else {
				$playerid = $player1_id;
			}
			$querry = mysql_query("update game set turn = " . $playerid . " where game_id = " . $_SESSION["game_id"] . "");
			if (!$querry) {
				die("Could not update querry: " . mysql_error());
			}
			if ($querry > 0) {
			}
			echo 1;
		}

	} else {
		echo 0;
	}

}
?>
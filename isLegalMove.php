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
		$last_turn = $row['last_turn'];
		$lastX = $last_turn[1];
		$lastY = $last_turn[2];
		$lastIndex = $lastY*9 +$lastX;
		$x = $_POST['x'];
		$y = $_POST['y'];
		$board = $row['board'];
		$index = $y * 9 + $x;
		$playerid = NULL;
		$dzveli_nashti = $lastIndex%3;
		$dzveli_ganakopi = (int)($lastIndex/9);
		$nashti = $index%9;
		$ganakopi = (int)($index/9);
		$dzveli_dapa ;
		$dapa;
		if($dzveli_nashti==0){
			if($dzveli_ganakopi==0){
				$dzveli_dapa =0;
			}
			if($dzveli_ganakopi==1){
				$dzveli_dapa =3;
			}
			if($dzveli_ganakopi==2){
				$dzveli_dapa =6;
			}
		}
		if($dzveli_nashti==1){
			if($dzveli_ganakopi==0){
				$dzveli_dapa =1;
			}
			if($dzveli_ganakopi==1){
				$dzveli_dapa =4;
			}
			if($dzveli_ganakopi==2){
				$dzveli_dapa =7;
			}
		}
		if($dzveli_nashti==2){
			if($dzveli_ganakopi==0){
				$dzveli_dapa =2;	
			}
			if($dzveli_ganakopi==1){
				$dzveli_dapa =5;
			}
			if($dzveli_ganakopi==2){
				$dzveli_dapa =8;
			}
		}
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
		else if($dapa != $dzveli_dapa && $mini_board[$dzveli_dapa]==0){
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
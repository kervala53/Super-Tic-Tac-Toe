<?php
session_start();
if (!isset($_SESSION["user_id"])) {
	header("Location:index.php");
}
if (!isset($_SESSION["game_id"])) {
	header("Location:mainPage.php");
}

$conection = mysql_connect('localhost', 'root', '');
if (!$conection) {
	die("Could not connect: " . mysql_error());
}
if (!mysql_select_db('tictactoe', $conection)) {
	die("Can not use tictactoe base : " . mysql_error());
}
$user_id = $_SESSION["user_id"];
$game_id = $_SESSION["game_id"];
$querry = mysql_query("select * from game where game_id = ".$game_id."");

if (!$querry) {
	die(mysql_error());
}

function checkBoard($patara) {
	$x = 1;
	$o = 2;
	$won = false;
	$whowon = 0;
	for ($i = 0; $i < 3; $i++) {
		for ($j = 0; $j < 3; $j++) {
			if ($j == 0) {
				if ($patara[$i * 3 + $j] == $o) {
					if ($patara[$i * 3 + $j + 1] == $o && $patara[$i * 3 + $j + 2] == $o) {
						$won = true;
						$whowon = $o;
						//win o
					}
				} else {
					if ($patara[$i * 3 + $j + 1] == $x && $patara[$i * 3 + $j + 2] == $x) {
						$won = true;
						$whowon = $x;
						//win x
					}
				}
				if ($i == 0) {
					if ($patara[0] == $o) {
						if ($patara[4] == $o && $patara[8] == $o) {
							$won = true;
							$whowon = $o;
						}
					} else {
						if ($patara[4] == $x && $patara[8] == $x) {
							$won = true;
							$whowon = $x;
						}
					}
				}
			}
			if ($i == 0) {
				if ($patara[$j] == $o) {
					if ($patara[$j + 3] == $o && $patara[$j + 6] == $o) {
						$won = true;
						$whowon = $o;
					}
				} else {
					if ($patara[$j + 3] == $x && $patara[$j + 6] == $x) {
						$won = true;
						$whowon = $x;
					}
				}
				if ($j == 2) {
					if ($patara[2] == $o) {
						if ($patara[4] == $o && $patara[6] == $o) {
							$won = true;
							$whowon = $o;
						}

					} else {
						if ($patara[4] == $x && $patara[6] == $x) {
							$won = true;
							$whowon = $x;
						}

					}
				}
			}
		}
	}
	return $whowon;
}
if (mysql_num_rows($querry) > 0) {
	$row = mysql_fetch_array($querry);
	$board = $row["board"];
	$mini_board = $row["mini_board"];
	$newMiniBoard = "";
	for ($i = 0; $i < 9; $i++) {
		if ($mini_board[$i] == 0) {
			if($i>=0 && $i<3){
				$l = 0;
			}
			if($i>2 && $i<6){
				$l = 6;
			}
			if($i>5 && $i<9){
				$l=12;
			}
			$temp = $temp . $board[($i+$l) * 3];
			$temp = $temp . $board[($i+$l) * 3 + 1];
			$temp = $temp . $board[($i+$l) * 3 + 2];
			$temp = $temp . $board[($i+$l) * 3 + 9];
			$temp = $temp . $board[($i+$l)* 3 + 10];
			$temp = $temp . $board[($i+$l)* 3 + 11];
			$temp = $temp . $board[($i+$l)* 3 + 18];
			$temp = $temp . $board[($i+$l)* 3 + 19];
			$temp = $temp . $board[($i+$l)* 3 + 20];
			$newMiniBoard = $newMiniBoard . checkBoard($temp);
			$temp = NULL;
			$l =null;
		}
		else{
			$newMiniBoard = $newMiniBoard.$mini_board[$i];
		}
	}

	if ($newMiniBoard != $mini_board) {
		$winningPlayer =0;
		$querry = mysql_query("update game set mini_board=" . $newMiniBoard . " where game_id =" . $game_id . "");
		if (!$querry) {
			die("Could not update querry: " . mysql_error());
		}
		if ($querry > 0) {
			$winningPlayer = checkBoard($newMiniBoard);
			echo $winningPlayer;
		} else {
			echo "could not update ";
		}
		
	} else {
		echo 0;
	}

} else {
	echo 0;
	//error
}
?>
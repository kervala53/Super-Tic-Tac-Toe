<?php
session_start();
if(isset($_POST["newgame"])){ // tamashs qmnis
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
	die("Could not connect: ". mysql_error());
	}
	if (!mysql_select_db('tictactoe', $conection)) {
		die ("Can not use tictactoe base : " . mysql_error());
	}
	$user_id =  $_SESSION["user_id"];
	$board = "000000000000000000000000000000000000000000000000000000000000000000000000000000000";
	$querry = mysql_query("Insert into game values('','".$board."','".$user_id."','','0','0','0','0');");
	if (!$querry) {
		die("Could not insert: " . mysql_error());
	}
	else{
		header("Location:play.php");
	}
}
if(isset($_POST["game"])){ // jdeba sxvastan satamashod
	$game_id = $_POST["hidden"];
	$conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
	die("Could not connect: ". mysql_error());
	}
	if (!mysql_select_db('tictactoe', $conection)) {
		die ("Can not use tictactoe base : " . mysql_error());
	}
	$user_id =  $_SESSION["user_id"];
	
	$querry = mysql_query("select * from game where game_id =".$game_id.";", $conection);

	if (!$querry) {
		die(mysql_error());
	}
	$row = mysql_fetch_array($querry);
	$player1_id = $row["player1_id"]; 
	 
	$querry = mysql_query("update game set player2_id=".$user_id." ,isStarted=1 ,turn=".$player1_id." where player2_id ='0' and game_id =".$game_id."");
	if (!$querry) {
		die("Could not update querry: " . mysql_error());
	}
	if($querry>0){
		header("Location:play.php");
	//	header("refresh:5; url=mainPage.php");
	}
	else{
		echo "Some one has sat on this table ! ";
		
	}
		
}

?>
<?php
	session_start();
	if(isset($_SESSION["user_id"])){ 
		$user_id = $_SESSION['user_id'];
	}
	//redirect to play.php if created game or already playing
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

	$result = mysql_query("select * from game where isStarted = '".FALSE."';", $conection);

	if (!$result) {
			die(mysql_error());
	}
	
	
	echo "<table border=\"1\">
		<tr>
			<th>Player name</th>
			<th>Games played</th>
			<th>Games won</th>
		</tr>
	";
	while ($row = mysql_fetch_array($result)) {
		$game_id = $row["game_id"];
		$player_id = $row["player1_id"];
		
		
		$result1 = mysql_query("select * from user where user_id = '".$player_id."';", $conection);
		if (!$result1) {
				die(mysql_error());
		}
		$row1 = mysql_fetch_array($result1);
		$username = $row1["username"];
		$played_game = $row1["played_game"];
		$won_game = $row1["won_game"];
		echo "<tr>
					<td>
						".$username."
					</td>
					<td>
						".$played_game."
					</td>
					<td>
						".$won_game."
					</td>
					<td>
						<form action='sitCreate.php' method='post'>
							<input type=\"submit\"  name=\"game\" value = \" Join game \"/>
							<input type='hidden' name='hidden' value='".$game_id."'/>
						</form>
					</td>
				</tr>";
	}
	echo "<a href= \"userStatistics.php\"> User statistics </a>";
	echo "<a href= \"userSettings.php\"> User settings </a>";
	
	echo "
			<form action='sitCreate.php' method='post'>
				<input type=\"submit\"  name=\"newgame\" value = \" Create New Game\"/>
			</form>"
	;
	
?>


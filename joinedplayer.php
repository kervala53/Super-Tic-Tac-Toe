<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>Play</title>
		<meta name="description" content="" />
		<meta name="author" content="zchak" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />

		<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="drawingcanvas.js"></script>
	</head>
	<body>
		<canvas height="500" width="500" id="board"></canvas>
<div id = "whosturn">Wait for another player to make move </div>
		<?php
		session_start();
		if (!isset($_SESSION["user_id"])) {
			header("Location:index.php");
		}
		?>

		<script>
			$(document).ready(function() {
function changeLabel(newString){
					$('#whosturn').html(newString);
				}
				var myTurn = false;

				paintBoard('');

				function getLastMove() {
					$.ajax({
						url : "getLastMove.php",
						type : 'POST',
						async : false,
						cache : false,
						timeout : 10000,
						complete : function(result) {
							if (result.responseText.charAt(0) == x) {
								paintX(parseInt(result.responseText.charAt(1)), parseInt(result.responseText.charAt(2)));
								function getLastMove() {
									$.ajax({
										url : "getwhowon.php",
										type : 'POST',
										async : false,
										cache : false,
										timeout : 10000,
										complete : function(result) {
											if (result.responseText == 1) {
												window.alert("You Lose");
											}
											if (result.responseText == 2) {
												window.alert("You Won");
											}
										}
									});
								}

							}
						}
					});
				}

				function isMyTurn() {
					$.ajax({
						url : "getTurn.php",
						type : 'POST',
						async : false,
						cache : false,
						timeout : 10000,
						complete : function(result) {
							if (result.responseText == true) {
								console.log("chemi jeria");
								myTurn = true;
								getLastMove();
								changeLabel("Your Turn");
							} else {
								console.log("araa chemi jeri");
								changeLabel("Wait for another player to make move");
								setTimeout(isMyTurn, 3000);
							}
						}
					});
				};
				isMyTurn();
				function clickHandler(e, player) {
					var tempY = Math.floor((e.clientY - 10) / (height / size));
					var tempX = Math.floor((e.clientX - 10) / (width / size));

					$.when($.ajax({
						url : "isLegalMove.php",
						type : 'POST',
						data : {
							'player' : player,
							'x' : tempX,
							'y' : tempY
						},
						async : false,
						cache : false,
						timeout : 10000,
						complete : function(result) {
							return result.responseText;
						}
					})).then(function(isLegal, a, b) {
						if (isLegal != 0) {
							paintO(tempX, tempY);
							$.ajax({
								url : "makeMove.php",
								type : 'POST',
								data : {
									'move' : player + "" + tempX + "" + tempY,
								},
								async : false,
								cache : false,
								timeout : 10000,
								complete : function(result) {
									return result.responseText;
								}
							});
							$.ajax({
								url : "getwhowon.php",
								type : 'POST',
								async : false,
								cache : false,
								timeout : 10000,
								complete : function(result) {
									if (result.responseText == x) {
										window.alert("You Lose");
									}
									if (result.responseText == o) {
										window.alert("You Won");
									}
								}
							});
							myTurn = false;
							isMyTurn();
						}
					});
				}


				$('#board').click(function(e) {
					if (myTurn) {
						//x agebulia drawingcanvas.js-dan
						if (clickHandler(e, o)) {
							isMyTurn();
						}
					}
				});

			});
		</script>
	</body>
</html>

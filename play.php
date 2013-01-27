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

	<?php
		session_start();
		if(!isset($_SESSION["user_id"])){
			header("Location:index.php");
		}
	?>

		<script>
			$(document).ready(function() {
				var isStarted = false; 

				function isGameStarted() {
					$.ajax({
						url: "checkStarted.php",
						type: 'POST',
						async: false,
						cache: false,
						timeout: 10000,
						complete: function(result) {
							if(result.responseText == true){
								console.log("shemogviertda");
								isStarted = true;	
							}
							else{
								console.log("ar shemogviertda");
								setTimeout(isGameStarted, 1000);	
							}
						}
					})
				};
				isGameStarted();
				console.log("aq movida");
				paintBoard('');
				$('#board').click(function(e) {
					clickHandler(e);
				});
			});
		</script>
	</body>
</html>
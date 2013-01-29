<?php
 require_once "Mail.php";
 
 $conection = mysql_connect('localhost', 'root', '');
	if (!$conection) {
		die("Could not connect: " . mysql_error());
	}
	if (!mysql_select_db('tictactoe', $conection)) {
		die("Can not use test base : " . mysql_error());
	}
	$arr = mysql_query("select * from user where username = " . $_POST["username"] .";", $conection);
	if (!$arr) {
		die(mysql_error());
	}
	$userEmail = NULL;
	if (mysql_num_rows($arr) > 0) {
		$row = mysql_fetch_array($arr);
		$userEmail = $row["email"];
	}
 
 
 $from = "Super Tic Tac Toe <gkerv10@freeuni.edu.ge>";
 $to = $userEmail;
 $subject = "Forgot Password!";
 $body = "Your password is";
 
 $host = "smtp.gmail.com";
 $username = "gkerv10@freeuni.edu.ge";
 $password = "aq sheni paroli chawere";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
   echo "You will be redirected to login page in 5 seconds";
	header("refresh:5; url=index.php");
  }
  

 ?>
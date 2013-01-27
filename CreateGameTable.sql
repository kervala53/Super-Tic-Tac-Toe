Create table game (game_id int AUTO_INCREMENT,board varchar(81),player1_id int,player2_id int,turn int,isStarted boolean default 0,isFinished boolean default 0,whoWon int,primary key(game_id ));

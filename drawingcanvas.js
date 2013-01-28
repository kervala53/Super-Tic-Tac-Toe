var xBoard = 0;
var oBoard = 0;
var begin = true;
var context;
var width, height;
var size = 9;
var x = 1;
var o = 2;

function paintBoard(boardString) {
	var board = document.getElementById('board');

	width = board.width;
	height = board.height;
	context = board.getContext('2d');

	context.beginPath();
	context.strokeStyle = '#000';
	context.lineWidth = 4;

	context.clearRect(0, 0, width, height);

	var size = 9;
	for (var i = 0; i <= size; i++) {
		context.moveTo((width / size) * i, 0);
		context.lineTo((width / size) * i, height);

		context.moveTo(0, (height / size) * i);
		context.lineTo(width, (height / size) * i);
	}

	context.stroke();
	context.closePath();

	for (var i = 0; i < boardString.length; i++) {
		var tempX = i % 9;
		var tempY = Math.floor(i / 9);
		if (boardString.charAt(i) == x) {
			paintX(tempX, tempY);
		} else {
			if (boardString.charAt(i) == o) {
				paintO(tempX, tempY);
			}
		}

	}

	// if (begin) {
	// var ini = Math.abs(Math.floor(Math.random() * 9 - 0.1));
	// markBit(1 << ini, 'O');
	// begin = false;
	// } else {
	// begin = true;
	// }
}

function clearCanvas() {
	context.clearRect(0, 0, width, height);
}

function paintX(x, y) {

	context.beginPath();

	context.strokeStyle = '#ff0000';
	context.lineWidth = 4;

	var offsetX = (width / size) * 0.1;
	var offsetY = (height / size) * 0.1;

	var beginX = x * (width / size) + offsetX;
	var beginY = y * (height / size) + offsetY;

	var endX = (x + 1) * (width / size) - offsetX;
	var endY = (y + 1) * (height / size) - offsetY;

	context.moveTo(beginX, beginY);
	context.lineTo(endX, endY);

	context.moveTo(beginX, endY);
	context.lineTo(endX, beginY);

	context.stroke();
	context.closePath();
}

function paintO(x, y) {

	context.beginPath();

	context.strokeStyle = '#0000ff';
	context.lineWidth = 4;

	var offsetX = (width / size) * 0.1;
	var offsetY = (height / size) * 0.1;

	var beginX = x * (width / size) + offsetX;
	var beginY = y * (height / size) + offsetY;

	var endX = (x + 1) * (width / size) - offsetX;
	var endY = (y + 1) * (height / size) - offsetY;

	context.arc(beginX + ((endX - beginX) / 2), beginY + ((endY - beginY) / 2), (endX - beginX) / 2, 0, Math.PI * 2, true);

	context.stroke();
	context.closePath();
}

function paintBigX(x, y) {

	context.beginPath();

	context.strokeStyle = '#ff0000';
	context.lineWidth = 4;

	var offsetX = (width / 3) * 0.1;
	var offsetY = (height / 3) * 0.1;

	var beginX = x * (width / 3) + offsetX;
	var beginY = y * (height / 3) + offsetY;

	var endX = (x + 1) * (width / 3) - offsetX;
	var endY = (y + 1) * (height / 3) - offsetY;

	context.moveTo(beginX, beginY);
	context.lineTo(endX, endY);

	context.moveTo(beginX, endY);
	context.lineTo(endX, beginY);

	context.stroke();
	context.closePath();
}

function paintBigO(x, y) {

	context.beginPath();

	context.strokeStyle = '#0000ff';
	context.lineWidth = 4;

	var offsetX = (width / 3) * 0.1;
	var offsetY = (height / 3) * 0.1;

	var beginX = x * (width / 3) + offsetX;
	var beginY = y * (height / 3) + offsetY;

	var endX = (x + 1) * (width / 3) - offsetX;
	var endY = (y + 1) * (height / 3) - offsetY;

	context.arc(beginX + ((endX - beginX) / 2), beginY + ((endY - beginY) / 2), (endX - beginX) / 2, 0, Math.PI * 2, true);

	context.stroke();
	context.closePath();
}



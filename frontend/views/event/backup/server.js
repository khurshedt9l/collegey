var http = require('http'),
    fs = require('fs');
var app = http.createServer().listen(1337);
var io = require('socket.io').listen(app);
var liveuser=0;
var usernames = {};
var rooms = ['room1','room2','room3'];
var users = [];
var messages = [];
var usersActivity = [];
var onlineClient = {};
//current date and time of any country!
function currentDateTime(city, offset) {
    // create Date object for current location
    d = new Date();
   
    // convert to msec
    // add local time zone offset
    // get UTC time in msec
    utc = d.getTime() + (d.getTimezoneOffset() * 60000);
   
    // create new Date object for different city
    // using supplied offset
    currentdate = new Date(utc + (3600000*offset));
   
    // return time as a string
    
    var datetime =  currentdate.getDate() + "/"
                    + (currentdate.getMonth()+1)  + "/" 
                    + currentdate.getFullYear() + " "  
                    + currentdate.getHours() + ":"  
                    + currentdate.getMinutes() + ":" 
                    + currentdate.getSeconds(); 
                    return datetime;
}
io.sockets.on('connection', function(socket) {
	liveuser++;
		socket.on('adduser', function(username){
		// store the username in the socket session for this client
		socket.username = username;
		// store the room name in the socket session for this client
		socket.room = 'room1';
		// add the client's username to the global list
		usernames[username] = username;
		// send client to room 1
		socket.join('room1');
		// get current time of india
		var curdatetime = currentDateTime('India','5.5');
		// add user in users array
		//users.push(username);
		// echo to client they've connected
		io.sockets.in(socket.room).emit('updatechat', usernames, 'connect successfully',curdatetime);
		// echo to room 1 that a person has connected to their room
		//socket.broadcast.to('room1').emit('updatechat', 'SERVER', username + ' has connected to this room');
		socket.emit('updaterooms', rooms, 'room1');
	});
    socket.on('message_to_server', function(data) {
		var curdatetime = currentDateTime('India','5.5');
        io.sockets.in(socket.room).emit("message_to_client",{ message: data["message"],count: liveuser,liveusername:socket.username,currentdatetime:curdatetime });
    });
io.sockets.emit('message', { count: liveuser });
// when the user disconnects
socket.on('disconnect', function(){
		// remove the username from global usernames list
		delete usernames[socket.username];
		// ***************update list of users in chat, client-side*********
		//io.sockets.in(socket.room).emit('updateusers', usernames);
		// echo globally that this client has left
		io.sockets.in(socket.room).emit('leftchat', socket.username, socket.username + ' has disconnected');
		socket.leave(socket.room);
	});
// END when the user disconnects
});
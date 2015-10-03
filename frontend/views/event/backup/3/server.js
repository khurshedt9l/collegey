var http = require('http'),
    fs = require('fs');
var mysql = require("mysql");

// First you need to create a connection to the db
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "nodejs"
});

con.connect(function(err){
  if(err){
    console.log('Error connecting to Db');
    return;
  }
  console.log('Connection established');
});	
var app = http.createServer().listen(1337);
var io = require('socket.io').listen(app);
var liveuser=0;
var usernames = {};
var userspic={};
var userstype={};
var rooms = ['room1','room2','room3'];
var users = [];
var messages = [];
var usersdetail=[];
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
		socket.on('adduser', function(userinfo){
		// store the username in the socket session for this client
		socket.username = userinfo.username;
		//socket.userpic=userinfo.userprofilepic;
		// store the room name in the socket session for this client
		socket.room = 'room1';
		// add the client's username to the global list
		usernames[userinfo.username] = userinfo.username;
		userspic[userinfo.username]=userinfo.userprofilepic;
		userstype[userinfo.username]=userinfo.usertype;
		usersdetail.push(usernames);
		usersdetail.push(userspic);
		//console.log(userspic);
		console.log(usernames);
		// send client to room 1
		socket.join('room1');
		// get current time of india
		var curdatetime = currentDateTime('India','5.5');
		// add user in users array
		//users.push(username);
		// echo to client they've connected
		io.sockets.in(socket.room).emit('updatechat', usernames, userspic, userstype, curdatetime);
		// echo to room 1 that a person has connected to their room
		//socket.broadcast.to('room1').emit('updatechat', 'SERVER', username + ' has connected to this room');
		socket.emit('updaterooms', rooms, 'room1');
	});
    socket.on('message_to_server', function(data) {
		var curdatetime = currentDateTime('India','5.5');
		var chatlog = { send_user_id: data["userid"], receive_user_id: '2',message: data["message"] };
		con.query('INSERT INTO chatlog SET ?', chatlog, function(err,res){
  if(err) throw err;

  console.log('Last insert ID:', res.insertId);
});
        io.sockets.in(socket.room).emit("message_to_client",{ message: data["message"],count: liveuser,liveusername:socket.username,currentdatetime:curdatetime,liveuserpic: data["userprofilepic"] });
    });
io.sockets.emit('message', { count: liveuser });
// =========user is typing
socket.broadcast.to(socket.room).on("typing", function(data) {
     io.sockets.emit("isTyping",{isTyping:data,user:socket.username});
  });
// =========END user is typing
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
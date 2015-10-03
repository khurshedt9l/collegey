var http = require('http');
var fs = require('fs');
var mysql = require("mysql");
var app = http.createServer().listen(1337);
var io = require('socket.io').listen(app);
var liveuser=0;
var usernames = {};
var userspic={};
var userstype={};
// db connection
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "collegey"
});
con.connect(function(err){
  if(err){
    console.log('Error connecting to Db');
    return;
  }
  console.log('Connection established');
});

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
function currentTimestamp(city, offset) {
    d = new Date();
    utc = d.getTime() + (d.getTimezoneOffset() * 60000);
    currentdate = new Date(utc + (3600000*offset));   
    var datetime =  currentdate.getFullYear() + "-"
                    + (currentdate.getMonth()+1)  + "-" 
                    + currentdate.getDate() + " "  
                    + currentdate.getHours() + ":"  
                    + currentdate.getMinutes() + ":" 
                    + currentdate.getSeconds(); 
                    return datetime;
}
io.sockets.on('connection', function(socket) {
	liveuser++;
		socket.on('adduser', function(userinfo){
		socket.username = userinfo.username;
		socket.room = userinfo.chatroom;
		usernames[userinfo.username] = userinfo.username;
		userspic[userinfo.username]=userinfo.userprofilepic;
		userstype[userinfo.username]=userinfo.usertype;
		console.log(userinfo.chatroom);
		socket.join(socket.room);
		var curdatetime = currentDateTime('India','5.5');
		console.log(userinfo.userid);
		var userActivityLog = { users_id: userinfo.userid, chat_join:currentTimestamp('India','5.5'),chatroom: userinfo.chatroom, islive:1 };
		var LiveChatUsers = { users_id: userinfo.userid, chat_join:currentTimestamp('India','5.5'),chatroom: userinfo.chatroom };
		
		var query = con.query("select count(*) as total from tbl_users_chat_activitylog where users_id='"+userinfo.userid+"' and chatroom='"+userinfo.chatroom+"' and islive=1");
		query.on('error', function(err) {
		throw err;
		});
		query.on('result', function(row) {
		if(!row.total)
		con.query('INSERT INTO tbl_users_chat_activitylog SET ?', userActivityLog);
		});
		var query1 = con.query("select count(*) as total from tbl_live_chat_users where users_id='"+userinfo.userid+"' and chatroom='"+userinfo.chatroom+"'");
		query1.on('error', function(err) {
		throw err;
		});
		query1.on('result', function(row) {
		if(!row.total)
		con.query('INSERT INTO tbl_live_chat_users SET ?', LiveChatUsers);
		});
		var query2 = con.query("select T1.username,T2.image,T3.chat_join from tbl_user T1 join tlb_user_profile T2 on T1.id=T2.user_id join tbl_live_chat_users T3  on T2.user_id=T3.users_id where T3.chatroom="+userinfo.chatroom);
 
query2.on('error', function(err) {
    throw err;
});
 var chatusersname={};
 var chatuserspic={};
 var chatuserstype={};
 var chatusersjointime={};
query2.on('result', function(row) {
	
	chatusersname[row.username] = row.username;
	chatuserspic[row.username] = row.image;
	chatusersjointime[row.username] = row.chat_join;
	console.log(chatusersjointime);
	io.sockets.in(socket.room).emit('updatechat', chatusersname, chatuserspic, userstype, chatusersjointime);
});
		
	});
    socket.on('message_to_server', function(data) {
		var curdatetime = currentDateTime('India','5.5');
		var chatlog = { send_user_id: data["userid"],message: data["message"] };
		con.query('INSERT INTO tbl_chatlog SET ?', chatlog, function(err,res){
  if(err) throw err;

  console.log('Last insert ID:', res.insertId);
});
        io.sockets.in(socket.room).emit("message_to_client",{ message: data["message"],count: liveuser,liveusername:socket.username,currentdatetime:curdatetime,liveuserpic: data["userprofilepic"] });
    });
io.sockets.emit('message', { count: liveuser });
// =========user is typing
socket.broadcast.to(socket.room).on("typing", function(data) {
     io.sockets.in(socket.room).emit("isTyping",{isTyping:data,user:socket.username});
  });
// =========END user is typing
socket.broadcast.to(socket.room).on('disconnect', function(){
		// remove the username from global usernames list
		delete usernames[socket.username];
		io.sockets.in(socket.room).emit('leftchat', socket.username, socket.username + ' has disconnected');
		socket.leave(socket.room);
	});
// END when the user disconnects
});
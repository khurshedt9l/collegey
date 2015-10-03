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
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
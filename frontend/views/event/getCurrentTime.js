
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
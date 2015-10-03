function countrychange(url){
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var val = $('#address-country_id').select2('val');
        $.ajax({
            type: 'POST',
            url: url,
            data: {country_id: val, _csrf: csrfToken},
            dataType: 'json',
            success: function (data) {
                //var res=$.parseJSON(data);
                $('#address-state_id').select2('destroy');
                $('#address-state_id').empty();
                $("#address-state_id").append(data.list);
                $('#address-state_id').select2();
                $('#address-city_id').select2('destroy');
                $('#address-city_id').empty();
                $("#address-city_id").append(data.citylist);
                $('#address-city_id').select2();


            }
        })
    }
    
    function statechange(url) {
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var val = $('#address-state_id').select2('val');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {state_id: val, _csrf: csrfToken},
                    dataType: 'json',
                    success: function (data) {
                        $('#address-city_id').select2('destroy');
                        $('#address-city_id').empty();
                        $("#address-city_id").append(data.citylist);
                        $('#address-city_id').select2();


                    }
                });
            }
//number validation for pincode
$(document).ready(function() {
	$(".numberonly").keydown(function(event) {
		if ( event.keyCode == 46 || event.keyCode == 8 ) {
		}
		else {
			if (event.keyCode < 48 || event.keyCode > 57 ) {
				event.preventDefault();	
			}	
		}
	});
});
// add important link name and url text box Dynamicaly by jquery
    var counter =1;
    $("#addlinkbtn").click(function() {
addlinks(counter);
counter++;
    });
    function removebtn(val) {
        if (counter == 1) {
            return false;
        }
        counter--;
        $("#TextBoxDiv" + val).remove();
    }
 // end add important attribute text box Dynamicaly by jquery end
function addlinks(attrID)
{
    var counter=attrID ;
    	if(counter>7){
            alert("Only 8 allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter)
             .attr("class", 'col-3 addmarginB30 clearfix')
                
	newTextBoxDiv.after().html('<div class="col col1" style="width: 45%; float: left">'+
                '<input class="form-control" placeholder="Name" type="text" name="ImportantLink[name][]" id="name' + counter + '" value="" >' +
                '</div>' +
                '<div class="col col2" style="width: 45%; float: left">' +
                '<input class="form-control" placeholder="URL" type="text" name="ImportantLink[url][]" id="url'+counter+'" value="" >' +
                '</div>'+
                '<div class="col col3" style="width: 10%; float: left">'+
				'<a class="btn-delete" onClick="removebtn(' +counter+ ')">X</a>'+
                '</div>'+
          '</div>'
                );		
newTextBoxDiv.appendTo("#DocTextBoxesGroup");  
}
// add download link name and url text box Dynamicaly by jquery
    var dcounter =1;
    $("#adddownloadbtn").click(function() {
addldownloadinks(dcounter);
dcounter++;
    });
    function removebtn(val) {
        if (dcounter == 1) {
            return false;
        }
        dcounter--;
        $("#DownloadTextBoxDiv" + val).remove();
    }
 // end add attribute text box Dynamicaly by jquery end
function addldownloadinks(attrID)
{
    var dcounter=attrID ;
    	if(dcounter>7){
            alert("Only 8 allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'DownloadTextBoxDiv' + dcounter)
             .attr("class", 'col-3 addmarginB30 clearfix')
                
	newTextBoxDiv.after().html('<div class="col col1" style="width: 45%; float: left">'+
                '<input class="form-control" placeholder="Name" type="text" name="ImportantLink[name][]" id="name' + dcounter + '" value="" >' +
                '</div>' +
                '<div class="col col2" style="width: 45%; float: left">' +
                '<input class="form-control" placeholder="URL" type="text" name="ImportantLink[url][]" id="url'+dcounter+'" value="" >' +
                '</div>'+
                '<div class="col col3" style="width: 10%; float: left">'+
				'<a class="btn-delete" onClick="removebtn(' +dcounter+ ')">X</a>'+
                '</div>'+
          '</div>'
                );		
newTextBoxDiv.appendTo("#DownloadTextBoxesGroup");  
}

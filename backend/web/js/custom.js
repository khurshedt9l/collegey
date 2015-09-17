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
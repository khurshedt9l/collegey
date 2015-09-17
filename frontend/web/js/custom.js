//Custom Scripts
jQuery('.toggleMobMenu').click(function(){
	jQuery(this).next().slideToggle();
});
jQuery('.default-tabs ul li a').click(function() {
		newText = jQuery(this).text(); 
	   jQuery('.toggleMobMenu').text(newText);
	   jQuery('.default-tabs ul li').removeClass('active');
	   jQuery(this).parent().addClass('active');  
	   //return false;
});

//
$("#mainMenu").mmenu({
  	 extensions: ["theme-dark"],
		offCanvas: {
		   position  : "right",
		   zposition : "back"
		}
}, { 
   clone: true
});
closeMobileMenu();
function closeMobileMenu(){
//	var API = $("#mainMenu").data( "mmenu" );
//	$(window).on('resize', function(event){
//	   var windowWidth = $(window).width();
//		if(windowWidth > 768){
//			API.close();
//		}	
//	});
}	
//Sticky Header
jQuery(document).ready(function($){
	var smallWindow = false;

	$(window).scroll(function() {
		var scroll = $(window).scrollTop();

		if (scroll >= 100) {
			$('#logo').attr('src', 'images/logo-small.png')
			$("header").addClass("sticky-header");
			$('.resource-search-wrap').css('padding','160px 0 210px');
		}
		if (scroll < 100) {
			$("header").removeClass("sticky-header");
			$('#logo').attr('src', 'images/logo.png');
			$('.resource-search-wrap').css('padding','160px 0 120px');
		}
	})/*].resize(function(){
		if ( !smallWindow && this.innerWidth <= 1024 ) {
			smallWindow = true;
			$('.top-bar-section').find('ul.right').hide(0).delay(500).show(0);
		}
		if ( smallWindow && this.innerWidth > 1024 ) {
			smallWindow = false;
		}
	});*/
});
$(window).on("load resize scroll", function () {
  if ($(window).width() < 768) {
	  $('header #logo').attr('src', 'images/logo-small.png');
	  $('.sticky-header #logo').attr('src', 'images/logo-small.png');
  }
  else{
	  $('#logo').attr('src', 'images/logo.png');
	  $('.sticky-header #logo').attr('src', 'images/logo-small.png');
  }
}).resize();
//Scroll TO Ele
$(".scroll-me").click(function(e) {  
    var id = $(this).attr('href');
    var $id = $(id);
    if ($id.length === 0) {
        return;
    }
	$('.p-Tabs li').removeClass('active');
	$(this).parent().addClass('active');	
    e.preventDefault();
	var pos = $(id).offset().top - 150;
	$('body, html').animate({scrollTop: pos});
});

//dropdown list for Country ,state,city
function signup() {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    this.countrychange = function (url) {
        var val = $('#address-country_id').select2('val');
        $.ajax({
            type: 'POST',
            url: url,
            data: {country_id: val, _csrf: csrfToken},
            dataType: 'json',
            success: function (data) {
                
                //state
                $('#address-state_id').select2('destroy');
                $('#address-state_id').empty();
                $("#address-state_id").append(data.list);
                $('#address-state_id').select2();
                //city
                $('#address-city_id').select2('destroy');
                $('#address-city_id').empty();
                $("#address-city_id").append(data.citylist);
                $('#address-city_id').select2();


            }
        });
    },
            this.statechange = function (url) {
                var val = $('#userprofile-state_id').select2('val');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {state_id: val, _csrf: csrfToken},
                    dataType: 'json',
                    success: function (data) {
                        //------ city---
                        $('#userprofile-city_id').select2('destroy');
                        $('#userprofile-city_id').empty();
                        $("#userprofile-city_id").append(data.citylist);
                        $('#userprofile-city_id').select2();


                    }
                });
            }
}
var signup_obj = new signup();
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

//-------show image from temp location (preview) before submit form
function previewimg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profilepic').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#userprofile-image").change(function(){
        previewimg(this);
    });

// append textarea in user profile description on click update
function edit() {
    alert('')
    var wdith = $("p").css('width');
    var p = $("#prfiledesc:first");
    var t = p.text().replace("\n", "").replace(/\s{2,}/g, " ").trim();
    p.replaceWith("<p><textarea  id='userprofile-description' class='form-control height120' name='UserProfile[description]'>" + t + "</textarea></p>")
    $(".edit").css("width", wdith);
    $('input.editable').removeClass('displaynone');
}
$("#updateprofile").click(edit);

// =============submit education form =======================
//    $(document).on("beforeSubmit", "#education-form", function () {
//        alert('sdfsd');
//     var form = $(this);
//     alert('response');
//     // return false if form still have some validation errors
//     if (form.find('.has-error').length) {
//         alert('response');
//          return false;
//     }
//     $.ajax({
//          url: form.attr('action'),
//          type: 'post',
//          data: form.serialize(),
//          success: function (response) {
//               alert(response);
//          }
//     });
//     return false;
//});

$("#testmyform").click(function(){
        var form = $("#education-form");
 if (form.find('.has-error').length) {
      return false;
 }
 $.ajax({
      url: form.attr('action'),
      type: 'post',
      data: form.serialize(),
      dataType: 'json',
      success: function (response) {
           var jsondata=response.data;
           var arr = $.map(jsondata, function(el) { return el; });
           var ispassed='';
           if(arr[3]==1)
           {
               ispassed='Appearing';
           }
           else
           {ispassed='Passed';}
          var previewdata='<div style="width:100%">'+
                               '<div style="width: 15%;float: left;padding: 5px 0px;"><b>Course Name :</b></div>'+
                                    '<div style="width: 85%;float: left;padding: 5px 0px;">'+ arr[0] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 15%;float: left; padding: 5px 0px;"><b>Branch</b></div>'+
                                '<div style="width: 85%;float: left;padding: 5px 0px;">'+ arr[1] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 15%;float: left; padding: 5px 0px;"><b>School/College</b></div>'+
                                '<div style="width: 85%;float: left;padding: 10px 0px;">'+ arr[1] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 15%;float: left; padding: 5px 0px;"><b>University/Board</b></div>'+
                                '<div style="width: 85%;float: left;padding: 5px 0px;">'+ arr[2] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 40%;float: left;"><b>Exam Passed</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ ispassed +'</div>'+
                                '</div>'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 40%;float: left;"><b>No. of Backlogs:</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ arr[4] +'</div>'+
                                '</div>'+
                                '<div style="width: 34%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 40%;float: left;"><b>Total Marks:</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ arr[5] +'</div>'+
                                '</div>'+
                            '</div>'+
                           
                            '<div style="width:100%">'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                   '<div style="width: 40%;float: left;"><b>Obtained Marks:</b></div>'+
                                   '<div style="width: 60%;float: left;">'+ arr[6] +'</div> '+
                                '</div>'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 50%;float: left;"><b>Dates Attended:</b></div>'+
                                    '<div style="width: 30%;float: left;">'+ arr[7] +'</div>'+
                                '</div>'+
                                '<div style="width: 34%;float: left;padding: 5px 0px;">'+
                                  '<div style="width: 40%;float: left;"><b>Year Of Passing:</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ arr[8] +'</div> '+ 
                                '</div>'+
                            '</div>'+
                                                    
                            '<div style="clear: both;"></div>'+
                        '<p>'+ arr[9] +'</p>'+
                        '<div style="clear: both;height:10px;border-top:5px#ff0"></div>';
                $("#previews-formdata").append(previewdata);
               $('#education-form')[0].reset();
          
          
          
      }
 });
 return false;   
});
//$("#testmyform").click(function(){
//    var csrfToken = $('meta[name="csrf-token"]').attr("content");
//    this.countrychange = function (url) {
//        var val = $('#address-country_id').select2('val');
//        $.ajax({
//            type: 'POST',
//            url: url,
//            data: {country_id: val, _csrf: csrfToken},
//            dataType: 'json',
//            success: function (data) {
//                //var res=$.parseJSON(data);
//                $('#address-state_id').select2('destroy');
//                $('#address-state_id').empty();
//                $("#address-state_id").append(data.list);
//                $('#address-state_id').select2();
//            }
//        }
//    }
//    }

//$("#testmyform").click(function(){
//var csrfToken = $('meta[name="csrf-token"]').attr("content");
//var form = $("#education-form");
// if (form.find('.has-error').length) {
//      return false;
// }
//var course_name=$("#education-course_name").val();
//var branch=$("#education-branch").val();
//var university_board=$("#education-university_board").val();
//var is_passed=$("#education-is_passed").val();
//var backlog=$("#education-backlog").val();
//var tmarks=$("#education-total_marks").val();
//var omarks=$("#education-obtained_marks").val();
//var attenddate=$("#w0").val();
//var passingyr=$("#w1").val();
//var description=$("#education-description").val();
// $.ajax({
//      url: form.attr('action'),
//      type: 'post',
//      data: {course_name: course_name,
//             branch: branch,
//             university_board: university_board,
//             is_passed: is_passed,
//             backlog: backlog,
//             tmarks: tmarks,
//             omarks: omarks,
//             attenddate: attenddate,
//             passingyr: passingyr,
//             description: description,
//             _csrf: csrfToken
//            },
//             dataType: 'json',
//      success: function (response) {
//           alert(response.data);
//      }
// });
// return false;   
//});

//// ============submit competitive exam by ajax========
//$('#competitiveEexam-subbtn').click(function(){
//    var form = $("#competitiveExam-form");
// if (form.find('.has-error').length) {alert('sdf');
//      return false;
// }
// $.ajax({
//       url:form.attr('action'),
//       type: 'post',
//       data: form.serialize(),
//       dataType: 'json',
//      success: function (response) {
//           var jsondata=response.data;
//           var arr = $.map(jsondata, function(el) { return el; });
//           var previewdata='<li>'+
//                              '<h4>'+ arr[2] +'</h4>'+
//                              '<p class="title">'+arr[3]+'<br />'+arr[4]+'<br>'+arr[5]+'</p>'+
//                          '</li>';
//        $("#compExmpreviewdata").append(previewdata);
//        $('#competitiveExam-form')[0].reset();
//      }
//    
//    });
//    return false;
//    
//})

// ============submit certification exam by ajax========
$('#certification-subbtn').click(function(){
    var form = $("#certification-form");
 if (form.find('.has-error').length) {
      return false;
 }
 $.ajax({
       url:form.attr('action'),
       type: 'post',
      data: form.serialize(),
      dataType: 'json',
      success: function (response) {
           var jsondata=response.data;
           var arr = $.map(jsondata, function(el) { return el; });
           var previewdata='<li><h4>' +arr[0]+ '</h4>'+
                            '<p class="title"><b>Authority Name</b><br />'+ arr[1] +'<br />'+
                            '<b>Licence Number</b><br />'+ arr[2] +'<br />'+
                            '<b>Dates Attend</b><br />'+ arr[3] +'<br />'+
                            '<b>Dates of Completion</b><br />'+ arr[4] +'<br />'+
                            '<b>Valid Up To</b><br />'+ arr[5] +'<br />'+
                            '</p></p>';
        $("#certificationreviewdata").append(previewdata);
        $('#certification-form')[0].reset();
      },
//      error: function(response){
//      alert(response);
    //  }
    });
    return false;
    
});

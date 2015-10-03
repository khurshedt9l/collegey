<?php
use yii\helpers\Html;
use yii\web\Application;
use yii\web\Session;
use yii\base\View;
use yii\helpers\Url;
use yii\web\UrlManager;
use common\models\Event;
use common\models\University;
use common\models\EventQuickInformation;
use common\models\Documents;
use common\models\Userform;
use yii\db\Query;
use yii\db\ActiveRecord;
use yii\db\Expression;

//$this->title = 'Student User Profile';
//$this->params['breadcrumbs'][] = 'User Profile';
//echo "<pre>";print_r($model->quickinfo);die;
?>
<!-- Main Section -->

<section class="contnetCntr">
	<div class="container">
        <div class="row">
            <div class="col-lg-12">                            
                
                <div class="u-header1">
                    <div class="box clearfix">
                        <div class="u-logo">
                            <div class="dummyspace"></div>
                            <div class="u-logo-container">
                                <img src="<?php echo $model->university['logo'];?>" alt="University Logo" />
                            </div>
                        </div>                    
                    </div>
                    <ul class="grey-social-links clearfix">
                        <li class="web"><a class="sprite" href="#">website</a></li>
                        <li class="fb"><a class="sprite" href="#">fb</a></li>
                        <li class="twitter"><a class="sprite" href="#">twitter</a></li>
                    </ul>
                    <div class="u-detail">                	
                        <h4><?php echo $model->university['name'];?></h4>
                        <a class="add-wishlist btn" href="#"><i></i>Add to wishlist</a>
                    </div>
                </div>
                <div class="p-Tabs">
                    <ul class="clearfix">
                        <li class="one"><a href="#university-videos" class="scroll-me"><i class="sprite i-videos"></i>Videos</a></li>
                        <li class="two active"><a href="#live-chat" class="scroll-me"><i class="sprite i-livechat"></i>Live Chat</a></li>
                        <li class="three"><a href="#other-information" class="scroll-me"><i class="sprite i-otherinfo"></i>Other Information</a></li>
                    </ul>
                </div>
               
            </div>            
        </div>
            <?php
            $profilepic=(\yii::$app->user->isGuest ?'images/default_profile_pic.jpg':'');
            if(!\yii::$app->user->isGuest) {
                $usermode=Userform::find()->where(['id'=>\Yii::$app->user->id])->one();
                $profilepic=($usermode->userprofile['image']!=''?$usermode->userprofile['image']:'images/default_profile_pic.jpg');
            ?>
        <div class="row addmarginB10">
        	<div class="col-lg-12">
            	<h3 id="live-chat" class="normal-heading text-uppercase addmarginB20">Live Chat</h3>
            </div>
        	<div class="col-lg-8 col-md-8 col-sm-7">
            	<div class="c-mainWindow shadowBox">
                    <ul class="u-chatWindow" id="chatlog">
                    </ul>
                    <div id="someonetyping" style="padding:10px 91px;"></div>
		<!--<div id='conversation'></div>-->
                    <div class="c-input">
                        <input type="text" id="message_input" class="form-control" placeholder="Type Here..." />
                        <input type="submit" class="sendBtn" id="sendmsgbtn" onclick="sendMessage()" value="Send" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-5">
            	<ul class="c-userList shadowBox" id="usersActivity">
                </ul>
            </div>
        </div>
            <?php }?>
        <div class="row addmarginB30">
        	<div class="col-lg-12">
            	<h3 id="university-videos" class="normal-heading text-uppercase addmarginB20">Videos</h3>
                <ul class="colTwo-VideoList clearfix">
                    <?php foreach ($model->videos AS $video)  { ?>
                    <li>
                        <div class="box">
                            <div class="videoView">
                                <iframe width="100%" height="315" src="<?php echo $video->url;?>"></iframe>
                            </div>
                            <div class="content">
                                <h5 class="ellipsis"><?php echo $video->name;?></h5>
                            </div>
                        </div>
                    </li>
                        <?php }?>
                </ul>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-lg-12">
            	<h3 id="other-information" class="normal-heading text-uppercase addmarginB20"><?php echo $model->name;?></h3>
                <div class="whiteBg radius5 addmarginB30 shadowBox">
                    <div class="padding30px">
<!--                        <h4 class="font-patua fnt-size16px addmarginB10">Who We Are?</h4>-->
                        <p class="addmarginB30"><?php echo $model->description;?></p>
<!--                        <h4 class="font-patua fnt-size16px addmarginB10">Key Figures :</h4>
                        <p>25% international students</p>
                      <p>Student body represents 67 nationalities</p>
                      <p class="addmarginB20">95% faculty member and 400 external experts</p>
                      <a href="#"><img src="images/video-preview.jpg"></a>-->
                    </div>
                </div>
                <div class="whiteBg radius5 addmarginB30 shadowBox">
                	<div class="padding30px">
                    	<div class="row">
                        	<div class="col-md-4">
                            	<h4 class="fnt-size20px font-patua addmarginB20">Links</h4>
                                <ul class="list-style-one">
                                    <?php $i=0;$class=''; foreach ($model->links AS $Link) 
                                        {
                                        if($i%2)
                                        $class="alternate";
                                        ?>
                                    <li class="<?php echo $class;?>"><a target="_blank" href="<?php echo $Link->url;?>"><?php echo $Link->name;?></a></li>
                                    <?php $class="";$i++;}?>
                                </ul>
                            </div>  
                            <div class="col-md-4">
                            	<h4 class="fnt-size20px font-patua addmarginB20">Quick Information</h4>
                                <ul class="list-style-one">
                                    <?php $j=0;$class=''; foreach ($model->quickinfo AS $quickinfo) 
                                        {
                                        if($j%2)
                                        $class="alternate";
                                        ?>
                                   <li class="<?php echo $class;?>"><a target="_blank" href="<?php echo $quickinfo->url;?>"><?php echo $quickinfo->title;?></a></li>
                                        <?php $class=""; $j++;}?>
                                </ul>
                            </div>
                            <div class="col-md-4">
                            	<h4 class="fnt-size20px font-patua addmarginB20">Document</h4>
                                <ul class="list-style-one">
                                    <?php $j=0;$class=''; foreach ($model->document AS $doc) 
                                        {
                                        if($j%2)
                                        $class="alternate";
                                        ?>
                                   <li class="<?php echo $class;?>"><a target="_blank" href="<?php echo $doc->url;?>"><?php echo $doc->title;?></a></li>
                                        <?php $class=""; $j++;}?>                                
                                </ul>
                            </div>                                                        
                        </div>
                    </div>
                </div>
                <div class="whiteBg radius5 addmarginB30 shadowBox">
                	<div class="padding30px">
                    	<div class="clearfix u-contactBox">
                        	<h3 class="fnt-size24px font-patua addmarginB30">Contact Us</h3>
                        	<div class="map-canvas">
                            	<div id="u-map"></div>
                            </div>
                            <div class="u-address">
                                <?php
                                if(isset($model->university->address->city['name'])) {?>
                            	<h4><?php echo $model->university['name'];?> </h4>
                                <p><?php echo $model->university->address['address'];?><br><?php echo $model->university->address['landmark'];?><br><?php echo $model->university->address->city['name'];?>
                                <?php echo $model->university->address->state['name'];?><br><?php echo $model->university->address->countries['countryName'];?>(<?php echo $model->university->address['pincode'];?>)</p>
                                <p>E: <a href="#"><?php echo $model->university->contact['email']?></a></p>
                                <p>F: <?php echo $model->university->contact['fax']?><br />P: <?php echo $model->university->contact['landline']?>,
                                <?php echo $model->university->contact['mobile']?></p>
                                <?php }?>
                            </div>
                        </div>
                    </div>
               </div>
                
            </div>
        </div>    
    </div>
</section>

<!-- End Main Section -->

<script type="text/javascript">	
	$("#u-map").gmap3({
  map:{
    options: {
      center:[<?php 
      if(isset($model->university->address->city))
      echo $model->university->address->city['latitude'] ."," .$model->university->address->city['longitude'];
      ?>],
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    }
  },
  marker: {    
    options: {
      icon: new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green.png")
      //icon: new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green.png")
    }
  }
});
</script>
<script src="http://localhost:1337/socket.io/socket.io.js"></script>
<script type="text/javascript">
var socketio = io.connect("http://localhost:1337");
socketio.on("message_to_client", function(data) {
document.getElementById("chatlog").innerHTML = ($("#chatlog").html()+'<li class="clearfix">'+
                            '<div class="c-img"><img src="'+data['liveuserpic']+'"></div>'+
                            '<div class="c-chat">'+
                                '<span class="c-time"><i></i>'+data['currentdatetime']+'</span>'+
                                '<h5 class="c-name">'+data['liveusername']+'</h5>'+
                                '<span class="c-type greenBg">Student</span>'+
                                '<p>'+data['message']+'</p>'+'</div></li>');                        
});
socketio.on('connect', function(){
<?php if(! \Yii::$app->user->isGuest) {?>
socketio.emit('adduser', {username:'<?php echo \Yii::$app->user->identity->username;?>',userprofilepic:'<?php echo $profilepic;?>',usertype:'<?php echo \Yii::$app->user->identity->username;?>',chatroom:'<?php echo $model->id;?>',userid:'<?php echo \Yii::$app->user->identity->id;?>'});
<?php }?>
});
function switchRoom(room){
		socketio.emit('switchRoom', room);
}
function sendMessage() {
    var msg =$('#message_input').val();
    $('#message_input').val('');
    $('#message_input').focus();
    <?php if(! \Yii::$app->user->isGuest) {?>
    socketio.emit("message_to_server", { message : msg,userprofilepic:'<?php echo $profilepic ;?>',userid:<?php echo \Yii::$app->user->identity->id;?>});
<?php }?>
}
$('#message_input').keypress(function(e) {
        if(e.which == 13) {
                $(this).blur();
                $('#sendmsgbtn').focus().click();
        }
});
//===============user isTyping?========
var typing = false,timeout = undefined;
       
    function timeoutTyping() {
        typing = false;
        socketio.emit('typing', false);           
    }
$("#message_input").keypress(function(e) {
           if(e.which !== 13) {
             if(typing === false && $(this).is(":focus")) {
               typing = true;
               socketio.emit('typing',true);
             } else {
                 timeout = setTimeout(timeoutTyping,3000);
            console.log('typing3.....');
             clearTimeout(timeout);
             
             }
           }
        });
socketio.on("isTyping",function(data) {
           if(data.isTyping) {
              $("#someonetyping").html(data.user+" is typing...");
              timeout = setTimeout(timeoutTyping,3000);
           } else {
              $("#someonetyping").html(" ");
           }
        });
//===============END user isTyping?=======
// update user activity log
socketio.on('updatechat', function (allusers, allpic, userstype, jointime) {
    console.log(userstype);
    $('#usersActivity').empty();
    var i=1;
          $.each(allusers, function(index, value) {
          $('#usersActivity').append('<li id="'+value+'" class="clearfix"><div class="c-img"><img id="userpic_'+i+'" src="" /></div><div class="c-user"><h5>'+value+'</h5><span id="usertype_'+i+'" class="greenBg"></span><span id="chatjoin_'+i+'"></span></div></li>');
          i++;});
      var j=1;
          $.each(allpic, function(index, value) {
          $("#userpic_"+j).attr("src",value);
          j++;});
      var j=1;
          $.each(userstype, function(index, value) {
          $("#usertype_"+j).html('Student');
          j++;});
      var j=1;
          $.each(jointime, function(index, value) {
          $("#chatjoin_"+j).html(value);
          j++;});
      
      });

      
socketio.on('leftchat', function (username, data) {
$("#"+username).remove();
});
window.onbeforeunload = function() {
    alert('sdfsdfsd');
    <?php if(! \Yii::$app->user->isGuest) {?>
    socketio.emit('testfunction', {userID:'<?php echo \Yii::$app->user->identity->id;?>',chatRoom:'<?php echo $model->id;?>'});
<?php }?>
};
</script>

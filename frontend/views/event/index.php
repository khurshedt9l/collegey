<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Application;
use common\models\User;
use yii\web\Session;
use yii\base\View;
use common\models\University;
use common\models\Event;
use common\models\Address;
use yii\web\UrlManager;
use yii\db\Query;
use yii\db\ActiveRecord;
use yii\db\Expression;
//$this->title = 'Student User Profile';
//$this->params['breadcrumbs'][] = 'User Profile';
?>
<!-- Main Section -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">            
            <div class="default-tabs addmarginB20">
            	<a class="toggleMobMenu"><i class="sprite"></i>Upcoming Events</a>
                <ul class="clearfix">
                    <li class="active" id="upcomming"><a href="#">Upcoming Events</a></li>
                    <li id="past"><a href="#">Past Events</a></li>                   
                    <li><a href="#">Followers</a></li>
                </ul>
            </div>               
            <div class="u-header1">
            	<div class="box clearfix">
                	<div class="u-logo">
                    	<div class="dummyspace"></div>
                        <div class="u-logo-container">
                        	<img src="images/university-logo.jpg" alt="University Logo" />
                        </div>
                    </div>                    
                </div>
                <ul class="grey-social-links clearfix">
                    <li class="web"><a class="sprite" href="#">website</a></li>
                    <li class="fb"><a class="sprite" href="#">fb</a></li>
                    <li class="twitter"><a class="sprite" href="#">twitter</a></li>
                </ul>
                <div class="u-detail">                	
                	<h4>University of National Training for Counselors and Mentors</h4>
                    <a class="red-editButton" href="university-detail-edit.html"><i></i>Update Profile</a>
                </div>
            </div>    
            <div class="col-4-event-grid">
            	<ul class="clearfix" id="upcomming_event">
                    <?php foreach ($upcomming_event as $event) {
                        ?>
                	<li>
                    	<div class="box">
                        	<div class="itemImageBlock">
                                    <a href="<?php echo \Yii::$app->urlManager->createUrl(['event/view', 'id'=>$event->id]);?>"><img src="<?php echo $event->banner;?>" /></a>
                            </div>
                            <div class="detail">
                                <p><?php echo \Yii::$app->formatter->asDatetime($event->start_date , "php:d M Y");?></p>
                                <h5><a href="<?php echo \Yii::$app->urlManager->createUrl(['event/view', 'id'=>$event->id]);?>"><?php echo $event->name;?></a></h5>
                                <?php if(isset($event->university->address->city['name'])) { ?>
                                <span><?php echo $event->university->address->city['name']; }?></span>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
                <ul class="clearfix" id="past_event">
                    <?php foreach ($past_event as $event) {
                        ?>
                	<li>
                    	<div class="box">
                        	<div class="itemImageBlock">
                                    <a href="<?php echo \Yii::$app->urlManager->createUrl(['event/view', 'id'=>$event->id]);?>"><img src="<?php echo $event->banner;?>" /></a>
                            </div>
                            <div class="detail">
                                <p><?php echo \Yii::$app->formatter->asDatetime($event->start_date , "php:d M Y");?></p>
                                <h5><a href="<?php echo \Yii::$app->urlManager->createUrl(['event/view', 'id'=>$event->id]);?>"><?php echo $event->name;?></a></h5>
                                <?php if(isset($event->university->address->city['name'])) { ?>
                                <span><?php echo $event->university->address->city['name']; }?></span>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Main Section -->
<script>
    $(document).ready(function()
    {
      $("#past").removeClass("active");
      $("#upcomming").addClass("active");
      $("#past_event").hide();
      $("#upcomming_event").show();
    })
  $("#past").click(function()
  {
      $("#past").addClass("active");
      $("#upcomming").removeClass("active");
      $("#upcomming_event").fadeOut(1000,function()
      {
          $("#past_event").fadeIn(1000);
      })
  })
  $("#upcomming").click(function()
  {
      $("#past").removeClass("active");
      $("#upcomming").addClass("active");
       $("#past_event").fadeOut(1000,function()
      {
          $("#upcomming_event").fadeIn(1000);
      })
  })
</script>
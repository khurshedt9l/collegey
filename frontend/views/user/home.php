<?php
use yii\helpers\Html;
use yii\web\Application;
use yii\web\Session;
use yii\base\View;
use yii\helpers\Url;
use yii\web\UrlManager;
use common\models\Event;
use common\models\University;
use yii\db\Query;
use yii\db\ActiveRecord;
use yii\db\Expression;
//$this->title = 'Student User Profile';
//$this->params['breadcrumbs'][] = 'User Profile';
?>
<!-- Main Section -->

<div class="contnetCntr">
	<div class="container">
    <div class="row">
        <div class="col-lg-12">                            
            
            <div class="p-header shadowBox addmarginB30">
            	<div class="box clearfix">
                	<div class="img">
                    	<img src="images/user.png" />
                    </div>
                    <div class="detail">
                        <a href="<?php echo \Yii::$app->urlManager->createUrl('user/update-profile');?>" class="editIconBtn"></a>
                        <h3><?php echo ucwords(strtolower($model->fname .' '. $model->lname));?></h3>
                        <p><?php  echo $model->userprofile['description'];?></p>
                    </div>
                </div>
                <div class="default-tabs">
                    <a class="toggleMobMenu" href="<?php echo \Yii::$app->urlManager->createUrl('user/home');?>"><i class="sprite"></i>Home</a>
                    <ul class="clearfix">
                        <li class="active"><a href="<?php echo \Yii::$app->urlManager->createUrl('user/dashboard');?>">Dashboard</a></li>            
                        <li><a href="<?php echo \Yii::$app->urlManager->createUrl('user/resource');?>">Resources<span class="count">2</span></a></li>
                        <li><a href="<?php echo \Yii::$app->urlManager->createUrl('university/index');?>">Universities<span class="count">10</span></a></li>
                    </ul>
                </div>
            </div>                        
            
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        	<h3 class="normal-heading text-uppercase addmarginB20">Live Events</h3>
            <div class="col-4-event-grid col-3-event-grid">
            	<ul class="clearfix">
                    <?php
                   $startdate =date('Y-m-d 00:00:00');
                   $closedate =date('Y-m-d 00:00:00');//Yii::$app->formatter->asDate(date("Y-m-d"));// new \yii\db\Expression('DATE()');
                   $event=  Event::find()
                            ->where(['<=', 'start_date', $startdate])
                            ->andWhere(['>=', 'close_date', $closedate])
                            ->all();
                    foreach($event as $evnt)
                    {
                        $eventid=$evnt->id;
                    ?>
                	<li>
                    	<div class="box">
                        	<div class="itemImageBlock">
                            	<a href="<?php echo Yii::$app->urlManager->createUrl(['event/view', 'id'=>$eventid])?>"><img src="<?php echo $evnt->banner ;?>"></a>
                            </div>
                            <div class="detail">
                                <p><?php echo Yii::$app->formatter->asDatetime($evnt->start_date, "php:d M Y");?></p>
                                <h5><a href="<?php echo Yii::$app->urlManager->createUrl(['event/view','id'=>$eventid])?>"><?php echo $evnt->name;?></a></h5>
                                <?php if(isset($evnt->university->address->city['name'])) {?>
                                <span><?php echo $evnt->university->address->city['name'];?></span>
                                <?php }?>
                            </div>
                        </div>
                    </li>  
                    <?php }?>
                </ul>
            </div>
            <h3 class="normal-heading text-uppercase addmarginB20">Upcoming Events</h3>
            <div class="col-4-event-grid col-3-event-grid">
            	<ul class="clearfix">
                	<?php
                    $startdate =date("Y-m-d 00:00:00");
                    $closedate=date("Y-m-d 00:00:00");// new \yii\db\Expression('NOW()');
                    $event=  Event::find()
                            ->where(['>', 'start_date', $startdate])
                            ->andWhere(['>=', 'close_date', $closedate])
                            ->all();
                    foreach($event as $evnt)
                    {
                        $eventid=$evnt->id;
                    ?>
                	<li>
                    	<div class="box">
                        	<div class="itemImageBlock">
                            	<a href="<?php echo Yii::$app->urlManager->createUrl(['event/view' ,'id' =>$eventid])?>"><img src="<?php echo $evnt->banner ;?>"></a>
                            </div>
                            <div class="detail">
                                <p><?php echo Yii::$app->formatter->asDatetime($evnt->start_date, "php:d M Y");?></p>
                                <h5><a href="<?php echo Yii::$app->urlManager->createUrl(['event/view' , 'id' =>$eventid])?>"><?php echo $evnt->name;?></a></h5>
                                <span><?php 
                                    if(isset($evnt->university->address->city['name']))
                                    echo $evnt->university->address->city['name'];
                                    ?>
                                </span>
                            </div>
                        </div>
                    </li>  
                    <?php }?>                
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        	<div class="update-slate-view">
            	<h4 class="heading">Updates</h4>
            	<ul>
                	<li>
                    	<span>57m ago</span>
                        <h5>SBSC College </h5>
                        <p>Lorem Ipsum dolor sit amet, lorem dolor sit amet</p>
                    </li>
                    <li>
                    	<span>57m ago</span>
                        <h5>SBSC College </h5>
                        <p>Lorem Ipsum dolor sit amet, lorem dolor sit amet</p>
                    </li>
                    <li>
                    	<span>57m ago</span>
                        <h5>SBSC College </h5>
                        <p>Lorem Ipsum dolor sit amet, lorem dolor sit amet</p>
                    </li>
                    <li>
                    	<span>57m ago</span>
                        <h5>SBSC College </h5>
                        <p>Lorem Ipsum dolor sit amet, lorem dolor sit amet</p>
                    </li>
                    <li>
                    	<span>57m ago</span>
                        <h5>SBSC College </h5>
                        <p>Lorem Ipsum dolor sit amet, lorem dolor sit amet</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

<!-- End Main Section -->

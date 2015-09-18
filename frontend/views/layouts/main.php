<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\web\UrlManager;

AppAsset::register($this);
$route = Yii::$app->controller->id . '/' . $controllerId = Yii::$app->controller->action->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en" type="text/javascript"></script>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php 
$bodyclass='';
if($route=='site/signup')
  $bodyclass="static-img";  
?>
<body class="<?php echo $bodyclass;?>">
<?php $this->beginBody() ?>
<div class="page">
    <?php
    $headerclass='';
    if($route=='site/signup')
{?>
 <header>
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12">
                    <a href="index.html"><img src="<?php echo Yii::$app->urlManager->getBaseUrl(TRUE);?>images/logo.png" alt="logo" /></a>
            </div>            
        </div>
    </div>
</header>
<?php }
else if($route=='site/index')
    $headerclass="header-home";
else
    $headerclass="";
{?>
<header class="<?php echo $headerclass;?>">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">            
            	<a href="index.html"><img id="logo" src="<?php Yii::$app->urlManager->getBaseUrl(true);?>images/logo.png" alt="logo" /></a>
                <a id="hamburger" href="#mainMenu"><span></span></a>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-9 hidden-xs">
            	<nav id="mainMenu">
                	<ul class="clearfix">
                            <li><a href="<?php echo \Yii::$app->urlManager->createUrl('university/index')?>">University</a></li>
                        <li><a href="<?php echo \Yii::$app->urlManager->createUrl('event/index')?>">Events</a></li>
                        <li><a href="<?php echo \Yii::$app->urlManager->createUrl('resource/index')?>">Resources</a></li>
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl('site/login');?>">Login</a></li>
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl('site/signup');?>">Sign Up</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<?php }?>
<div class="wrap">
    

    <div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php if($route!='site/signup')
{?>
<footer>
	<div class="footerTop">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-3 col-sm-3">
                	<a href="index.html"><img src="<?php echo Yii::$app->urlManager->baseUrl;?>/images/footer-logo.png" /></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed</p>                    
                </div>
                <div class="col-md-8 col-sm-9">
                	<div class="row">
                    	<div class="col-md-6">
                        	<h5>College Board</h5>
                        	<ul class="list clearfix">                                
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Careers</a></li>                               
                                <li><a href="#">Membership</a></li>
                                <li><a href="#">News & Press</a></li>                               
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privacy Policy</a></li>                               
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                        	<h5>Our Programs</h5>
                        	<ul class="list clearfix">
                                <li><a href="#">Partners</a></li>
                                <li><a href="#">Sponsorship</a></li>
                                <li><a href="#">FAQ's</a></li>
                                <li><a href="#">Contact Us</a></li>                                
                            </ul>
                        </div>
                    </div>                	                    
                </div>
                 <div class="col-md-1 col-sm-12">
                 	<ul class="social-icons-grey clearfix">
                    	<li class="fb"><a class="sprite" href="#">fb</a></li>
                        <li class="twitter"><a class="sprite" href="#">twitter</a></li>
                        <li class="gplus"><a class="sprite" href="#">gplus</a></li>
                    </ul>
                 </div>
            </div>
        </div>
    </div>
    <div class="footerBot">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12">
                	<p class="copytext">Copyright &copy; <a href="index.html">Collegey</a> 2015</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php }?>
</div>
<?php $this->endBody() ?>
<script type="text/javascript">
$(document).ready(function() {
  $(".singleSelectBox").select2({
	 minimumResultsForSearch: Infinity,	
  });
});
</script>
<script>
$(document).ready(function() {
  $(document).on('init.slides', function() {
    $('.loading-container').fadeOut(function() {
      $(this).remove();
		$('.banner-content').fadeIn();
    });
  });
   $('#slides').superslides({
    slide_easing: 'easeInOutCubic',
    slide_speed: 800,
    pagination: true,
    hashchange: false,
    scrollable: false
  }); 
});
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
</body>
</html>
<?php $this->endPage() ?>

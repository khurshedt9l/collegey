<?php
use yii\web\UrlManager;
use yii\helpers\Html;
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
use yii\bootstrap\ActiveForm;
use common\models\University;

/* @var $this yii\web\View */

$this->title = '-:: Welcome To Collegey ::-';
?>
<div class="banner-container">
<div class="loading-container">
  <div class="pulse"></div>
</div>
<div id="slides">
  <div class="slides-container">
      <img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/banner-1.jpg" alt="">
    <img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/banner-2.jpg" alt="">
     <img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/banner-1.jpg" alt="">
  </div>
</div>
    <div class="banner-content">
        <div class="container">
        	<div class="row">
            	<div class="col-lg-12">
                	<h1>Find your dream college <br />and get accepted</h1>
       				<p>Learn all about your dream university.</p>
                    <div class="home-search">
                        <?php
                        $data=array();
                        $model=new University();
                        $universityName=  University::find()->select('name')->distinct()->all();
                        foreach($universityName as $name)
                        {
                            array_push($data, $name->name);
                        }
                        //echo "<pre>"; print_r($data);die;
                        $form= ActiveForm::begin(['id'=>'search-form',
                        'enableAjaxValidation'=>false,'enableClientValidation'=>true,'validateOnSubmit'=>true,
                        'action' => Yii::$app->urlManager->createUrl('university/searchcollege')]);
                        echo TypeaheadBasic::widget(['name' => 'name','id' => 'university-name','data' => $data,'scrollable' => true,
                        'dataset' => ['limit' =>1000],'options' => ['placeholder' => 'Search colleges by name'],'pluginOptions' => ['highlight'=>true],]);
                        ?>
                        <?= Html::submitButton('search' ,['class' =>'btn']);?>
                        <?php ActiveForm::end();?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="livechatBand">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-12">
                	<p><img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/live-chat-text.png" /><span>Join the conversation, chat sessions are going on now</span> <a href="sign-up.html">Sign Up Now</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Header -->
<!-- Main Section -->

<section class="features-section">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12">
            	<h3>Features</h3>
                <ul>
                	<li>
                        <div class="box">
                        	<img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/f-icon-1.png" />
                            <h5>Universities</h5>
                            <p> Learn more about hundreds <br />of colleges and universities.</p>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                        	<img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/f-icon-2.png" />
                            <h5>Events</h5>
                            <p> Learn more about hundreds <br />of Event universities.</p>
                        </div>
                    </li>
                    <li>
                        <div class="box">
                        	<img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/f-icon-3.png" />
                            <h5>resources</h5>
                            <p>Find hundreds of resources of <br />colleges and universities. </p>
                        </div>
                    </li>
                     <li class="large">
                        <div class="box">
                        	<img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/f-icon-2.png" />
                            <h5>Events</h5>
                            <p> Learn more about hundreds <br />of Event universities.</p>
                        </div>
                    </li>
                    <li class="large last">
                        <div class="box">
                        	<img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/f-icon-3.png" />
                            <h5>resources</h5>
                            <p>Find hundreds of resources of <br />colleges and universities. </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="partner-section">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
            	<h3>Features</h3>
                <div class="owl-carousel">
                    <div class="item"><img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/partner-1.jpg" /></div>
                    <div class="item"><img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/partner-2.jpg" /></div>
                    <div class="item"><img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/partner-3.jpg" /></div>
                    <div class="item"><img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/partner-4.jpg" /></div>
                    <div class="item"><img src="<?php Yii::$app->urlManager->getBaseUrl(true);?>/images/partner-5.jpg" /></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Main Section -->


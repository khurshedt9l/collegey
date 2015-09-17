<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Application;
use common\models\User;
use yii\web\Session;
use yii\base\View;
use yii\helpers\Url;
use conquer\select2\Select2Widget;
use common\models\University;
use common\models\Address;
use common\models\Contacts;
use kartik\file\FileInput;
use yii\web\UrlManager;
use kartik\widgets\DatePicker;
$rootPath = str_replace(DIRECTORY_SEPARATOR.'frontend', "", Yii::$app->basePath);
//$this->title = 'Student User Profile';
//$this->params['breadcrumbs'][] = 'User Profile';
?>
<div class="contnetCntr">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-8 col-md-8 col-sm-8">
            	<div class="u-detail-view shadowBox">
                	<div class="u-mode-profile">
                        <div class="u-banner">
                            <img class="u-banner-img" src="<?php echo $model->banner;?>" />
                            <div class="u-logo">
                                <div class="dummyspace"></div>
                                <div class="u-logo-container">
                                    <img src="<?php echo $model->logo;?>" alt="University Logo">
                                </div>
                            </div>
                        </div>                                        
                    </div>
                    <div class="u-detail-box">
                    	<div class="padding30px">
                        	<div class="clearfix">
                            	<ul class="grey-social-links clearfix">
                                    <li class="web"><a class="sprite" href="<?php echo $model->website;?>">website</a></li>
                                    <li class="fb"><a class="sprite" href="#">fb</a></li>
                                    <li class="twitter"><a class="sprite" href="#">twitter</a></li>
                                </ul>
                            	<div class="detail">
                                	<h3><?php echo $model->name;?></h3>
                                    <p><?php echo $model->description;?></p>
                                </div>
                            </div>
                            <div class="borB"></div>
                            <div class="row addmarginB30">
                                <div class="col-md-6">
                                    <h4 class="fnt-size20px font-patua text-uppercase addmarginB20">Important Links</h4>
                                    <ul class="list-style-one">
                                        <?php 
                                        $i=0;
                                        $alt='';
                                        foreach($model->importantlinks as $downlink){
                                          if($i%2)
                                          $alt='alternate';
                                          ?>
                                        <li class="<?php echo $alt;?>"><?php echo $downlink->name;?></li>
                                        <?php }?>                                      
                                    </ul>
                                </div>  
                                <div class="col-md-6">
                                    <h4 class="fnt-size20px font-patua text-uppercase addmarginB20">Download</h4>
                                    <ul class="list-style-one">
                                        <?php 
                                        $i=0;
                                        $alt='';
                                        foreach($model->downloadlinks as $downlink){
                                          if($i%2)
                                          $alt='alternate';
                                          ?>
                                        <li class="<?php echo $alt;?>"><?php echo $downlink->name;?></li>
                                        <?php }?>                                                                               
                                    </ul>
                                </div>                                                                                        
                            </div>
                            <div class="borB"></div>
                            <div class="clearfix u-contactBox">
                        	<h3 class="fnt-size24px font-patua addmarginB30">Contact Us</h3>
                        	<div class="map-canvas">
                            	<div id="u-map"></div>
                            </div>
                            <div class="u-address">
                            	<h4><?php echo $model->name;?> </h4>
                                <p><?php echo $model->address['address'];?><br><?php echo $model->address['landmark'];?><br><?php echo $model->address->city['name'];?>
                                ,<?php echo $model->address->state['name'];?><br><?php echo $model->address->countries['countryName'];?>(<?php echo $model->address['pincode'];?>)</p>
                                <p>E: <a href="#"><?php echo $model->contact['email']?></a></p>
                                <p>F: <?php echo $model->contact['fax']?><br />P: <?php echo $model->contact['landline']?>,
                                <?php echo $model->contact['mobile']?></p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
            
            	<div class="redBg radius4 addmarginB30 shadowBox">
                	<div class="padding30px">
                    	<h4 class="fnt-size20px addmarginB20 font-patua txtfff">Learn all about your dream university.</h4>
                        <div class="formElements addmarginB20">
                        	<input type="text" class="form-control" placeholder="Search Colleges by Name">
                        </div>
                        <a href="#" class="searchBtn">Search</a>
                    </div>
                </div>
                
                <div class="sideBarFilters shadowBox">
                	<div class="padding30px">
                    	<h4 class="fnt-size20px addmarginB20 font-patua">Search Colleges by program type</h4>
                        <div class="sb-filters">
                        	<i class="sprite i-university"></i>
                            <div class="sb-dropdown">
                                <select data-tags="true" data-placeholder="Select Program Category" class="form-control singleSelectBox">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <a href="#" class="searchBtn">Search</a>
                    </div>
                </div>
                
                <div class="sideBarFilters shadowBox">
                	<div class="padding30px">
                    	<h4 class="fnt-size20px addmarginB20 font-patua">Search Colleges by Location</h4>
                        <div class="sb-filters sb-filters-2 addmarginB20">
                        	<i class="sprite i-location"></i>
                            <div class="sb-dropdown">
                                <select data-tags="true" data-placeholder="Select State" class="form-control singleSelectBox">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="sb-filters addmarginB20">
                        	<i class="sprite i-location"></i>
                            <div class="sb-dropdown">
                                <select data-tags="true" data-placeholder="Select City" class="form-control singleSelectBox">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <a href="#" class="searchBtn">Search</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">	
	$("#u-map").gmap3({
  map:{
    options: {
      center:[28.613939,77.209021],
      zoom: 5,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    }
  },
  marker: {    
    options: {
      icon: new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green.png")
    }
  }
});
</script>
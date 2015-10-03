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
use common\models\States;
use common\models\Cities;
use kartik\file\FileInput;
use yii\web\UrlManager;
use kartik\widgets\DatePicker;
$rootPath = str_replace(DIRECTORY_SEPARATOR.'frontend', "", Yii::$app->basePath);
//$this->title = 'Student User Profile';
//$this->params['breadcrumbs'][] = 'User Profile';
?>
<!-- Main Section -->

<section class="contnetCntr">
    <div class="container">
    	<div class="row">
        	<div class="col-lg-12">
            	<div class="dropdownFilters shadowBox clearfix">
                	<div class="df-program-category">
                    	<i class="sprite"></i>
                        <div class="df-dropdown">
                        	<select data-tags="true" data-placeholder="Select Program Category" class="form-control singleSelectBox">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="df-states">
                    	<i class="sprite"></i>
                        <div class="df-dropdown">
                            <?= Html::dropDownList('id', null,ArrayHelper::map(\common\models\States::find()->orderBy(['name' =>SORT_ASC])->all(), 'id', 'name') ,['prompt'=>'Select State','class'=>'singleSelectBox', 'id'=>'userprofile-state_id' ,'readonly' =>'readonly','data-tags'=>true
                                               ,'onChange'=>'signup_obj.statechange("'.Url::toRoute(['site/city']).'"),UniversityByState("'.Url::toRoute(['university/search']).'")'
                                                ]) ?>
                        </div>
                    </div>
                    <div class="df-city">
                    	<i class="sprite"></i>
                        <div class="df-dropdown">

                            <?= Html::dropDownList('id', null,ArrayHelper::map(\common\models\States::find()->all(), 'id', 'name') ,['prompt'=>'Select City','class'=>'singleSelectBox', 'id'=>'userprofile-city_id' ,'readonly' =>'readonly','data-tags'=>true,
                                'onChange'=>'UniversityByState("'.Url::toRoute(['university/search']).'")'
                                ]);?>
<!--                            
                        	<select data-tags="true" data-placeholder="Select City" class="form-control singleSelectBox">
                                <option></option>
                            </select>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a href="#" onClick="$('#sideFilters').slideToggle(); return false;" class="filterMobBtn"><i class="sprite i-otherinfo"></i>Filters</a>
                <div class="sideFilters" id="sideFilters">
                	<div class="browse-items">
                    	<select data-tags="true" data-placeholder="Browse by type" class="form-control singleSelectBox">
                        	<option></option>
                        </select>
                    </div>
                    <h4>Filter by Categories</h4>
                	<div class="padding20px">                    	
                        <ul class="checkBox-list clearfix">
                            <li>
                                <input type="checkbox" id="rdb6">
                                <label for="rdb6">Admission (41)</label>
                            </li>
                            <li>
                                <input type="checkbox" id="rdb7">
                                <label for="rdb7">Loan (15)</label>
                            </li>
                            <li>
                                <input type="checkbox" id="rdb8">
                                <label for="rdb8">Scholarships (145)</label>
                            </li>
                            <li>
                                <input type="checkbox" id="rdb9">
                                <label for="rdb9">Travel (77)</label>
                            </li>
                            <li>
                                <input type="checkbox" id="rdb10">
                                <label for="rdb10">Food (7)</label>
                            </li>
                            <li>
                                <input type="checkbox" id="rdb11">
                                <label for="rdb11">Courses (81)</label>
                            </li>                                                                 
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            	<ul id="mason-container" class="resourse-listing">
                    <?php foreach($model as $university) {?>
                	<li class="mason-item">
                    	<div class="box">
                        	<div class="img">
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['university/view' ,'id'=>$university->id]);?>">
                                     <?php  
                                try { 
                                 ?>
                                    <img src="<?php echo $university->logo;?>" />
                                    <?php
                                    } 
                                    catch (Exception $e) { ?> <img src="images/university-1.jpg"/>
                               <?php  } ?> 
                                </a>
                            </div>
                            <div class="text-block">
                            	<h3><a href="<?php echo Yii::$app->urlManager->createUrl(['university/view' ,'id'=>$university->id]);?>"><?php echo $university->name;?></h3></a>
                                <?php  
                                try { 
                                 ?>
                                <span class="text-span redBg"> <?php echo  $university->address->city['name'];?></span>
                                <?php
                                 } catch (Exception $e) { }
                                 ?>                                
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- End Main Section -->
<script type="text/javascript">
$(document).ready(function() {
  var $boxes = $('.mason-item');
  $boxes.hide();
  var $container = $('#mason-container');
  $container.imagesLoaded( function() {
    $boxes.fadeIn();
    $container.masonry({
        itemSelector : '.mason-item',        
    });    
  });
});
function UniversityByState(url)
{
    var state=$("#userprofile-state_id").val();
    var city=$("#userprofile-city_id").val();
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: 'POST',
            url: url,
            data: {state_id: state,city_id:city, _csrf: csrfToken},
            dataType: 'json',
            success: function (data) {                    
           $('#mason-container').html();
           $('#mason-container').html(data);
            }
        });
}
</script>
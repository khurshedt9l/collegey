<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Application;
use common\models\Userform;
use yii\web\Session;
use yii\base\View;
use yii\helpers\Url;
use conquer\select2\Select2Widget;
use common\models\Country;
use kartik\file\FileInput;
use yii\web\UrlManager;
use kartik\widgets\DatePicker;
use yii\web\User;
//$this->title = 'Student User Profile';
//$this->params['breadcrumbs'][] = 'User Profile';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <div class="default-tabs addmarginB20">
            	<a class="toggleMobMenu"><i class="sprite"></i>Profile</a>
                <ul class="clearfix">
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('user/education');?>">Education</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('user/interview');?>">Interview</a></li>
                    <li class="active"><a href="<?php echo Yii::$app->urlManager->createUrl('user/profile');?>">Profile</a></li>           
                    <li><a href="#">Notification</a></li>                    
                </ul>
            </div>    
            <?php
                    $form =  ActiveForm::begin(['id'=>'profile-form',
                        'enableAjaxValidation'=>false,
                        'enableClientValidation'=>true,
                        'validateOnSubmit'=>true,
                        'options'=>['enctype' => 'multipart/form-data']]);
                ?>
            <div class="p-header shadowBox">
            	<div class="box clearfix">
                	<div class="img">
                            <?php
                                if (!empty($model->image)) {
                                    $img = $model->image;
                                } else {
                                   $img='images/user.png';
                                }
                                ?>
                                <img id="profilepic" class="file-preview-image" src="<?php echo $img; ?>" />
                    </div>
                    <div class="detail">
                        <a class="red-editButton" href="<?php echo Yii::$app->urlManager->createUrl('user/update-profile');?>"><i></i>Update Profile</a>
                        <h3><?php echo ucwords(strtolower($user->fname ." ". $user->lname));?></h3>
                        <p id="prfiledesc"><?php echo $model->description;?></p><br>
                        <p><?php echo $form->field($model, 'image')->fileInput(['class' => 'upload editable displaynone'])->label(false);?></p>
                    </div>
                </div>
            </div>                      
            <div class="whiteBg radius5 addmarginB30 shadowBox">
            	<div class="padding30px">
                	<div class="support-form addmarginB30">
                    	<div class="padding30px">
                        	<div class="formElements">
                            	<div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>First Name</label>
                                    	<?php echo $form->field($user, 'fname')->textInput(['value' =>$user->fname ,'class' =>'form-control','readonly' =>'readonly'])->label(false);?>
                                    </div>
                                    <div class="col col2">
                                    	<label>Last Name</label>
                                    	<?php echo $form->field($user, 'lname')->textInput(['value' =>$user->lname ,'class' =>'form-control','readonly' =>'readonly'])->label(false);?>
                                    </div>
                                    <div class="col col3">
                                     <label>Date of Birth</label>
                                    	<?php
                                        if(isset($model->DOB)){
                                        $dateofbirth=explode(' ', $model->DOB);
                                         $dateofbirth=explode('-', $dateofbirth[0]);
                                        echo $dateofbirth[2].'-'.$dateofbirth[1] .'-'. $dateofbirth[0];}
                                        ?>
                                     </div>
                                </div>
                                <div class="col-3 clearfix">
                                	<div class="col col1">
                                    	<label>Gender</label>
                                    	<?php echo $form->field($model, 'gender')->dropDownList(['0'=>'Select' ,'M'=>'Male' ,'F'=>'Female'],['class' =>'singleSelectBox' ,'readonly' =>'readonly'])->label(false);?>
                                    </div>
                                    <div class="col col2">
                                    	<label>Mobile Number</label>
                                    	<?php echo $form->field($user, 'phone')->textInput(['value' =>$user->phone ,'class' =>'form-control' ,'readonly' =>'readonly'])->label(false);?>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="support-form addmarginB30">
                    	<div class="padding30px">
                        	<div class="formElements">
                            	<div class="common">
                                	<label>Address</label>
                                    <?php echo $form->field($address, 'address')->textInput(['class'=>'form-control','placeholder'=>'Arress' ,'readonly' =>'readonly'])->label(false);?>
                                </div>
                            	<div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>Country</label>
                                    	<?php
                                            if (empty($address->country_id)) {
                                                $address->country_id = 'MYS';
                                            }
                                            $coutrylist=ArrayHelper::map(\common\models\Countries::findAll(['is_visible'=>1,'status'=>1]),'countryID','countryName');
                                            echo $form->field($address, 'country_id')->dropDownList($coutrylist,  ['prompt'=>'Select Country','class'=>'singleSelectBox' ,'readonly' =>'readonly','data-tags'=>true
                                               ,'onChange'=>'signup_obj.countrychange("'.Url::toRoute(['site/states']).'")'
                                                ])->label(false);
                                         ?>
                                    </div>
                                    <div class="col col2">
                                    	<label>State</label>
                                    	<?php
                                       
                                        if (!empty($addre->state_id)) {
                                            $state = ArrayHelper::map(\common\models\States::findAll(['id' => $address->state_id]), 'id', 'name');
                                        } else {
                                            $state = [];
                                        }
                                       // print_r($state);die;
                                        echo $form->field($address, 'state_id')->dropDownList(
                                                $state, ['prompt' => 'Select State', 'class' => 'singleSelectBox', 'data-tags' => true, 'onChange' => 'signup_obj.statechange("' . Url::toRoute(['site/city']) . '")']
                                        )->label(false);
                                        ?>
                                    </div>
                                    <div class="col col3">
                                    	<label>City</label>
                                    	<?php
                                          if (!empty($address->city_id)) {
                                            $city = ArrayHelper::map(\common\models\Cities::findAll(['id' => $address->city_id]), 'id', 'name');
                                        } else {
                                            $city = [];
                                        }
                                          echo $form->field($address, 'city_id')->dropDownList(
                                                  $city, ['prompt' => 'Select City', 'class' => 'singleSelectBox', 'data-tags' => true]
                                          )->label(false);
                                          ?>
                                    </div>
                                </div>
                                <div class="col-3 clearfix">
                                	<div class="col col1">
                                    	<label>Landmark</label>
                                        <?= $form->field($address, 'landmark')->textInput(['class' =>'form-control' ,'placeholder' =>'Landmark' ,'readonly' =>'readonly'])->label(false);?>
                                        </div>
                                        <div class="col col2">
                                    	<label>Pin Code</label>
                                        <?= $form->field($address, 'pincode')->textInput(['class' =>'form-control numberonly' ,'placeholder' =>'Pincode' ,'readonly' =>'readonly'])->label(false);?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="support-form addmarginB30">
                    	<div class="padding30px">
                        	<div class="formElements">
                            <p>Approximately how much per year of study will you, your family, and/or other sources of funding be able to provide to meet the cost of your education?</p>                            	
                                <div class="col-3 clearfix">
                                	<div class="col col1">
                                    	<?= $form->field($userpay, 'amount')->textInput(['class' =>'form-control numberonly' ,'placeholder' =>'Amount' ,'readonly' =>'readonly'])->label(false);?>
                                    </div>                                                                      
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="support-form addmarginB30">
                    	<div class="padding30px">
                        	<div class="formElements">
                            <p>Please select any of the following that you would be interested in learning about</p>                            	
                                <div class="common">
                                	<ul class="checkBox-list clearfix">
                                        <li>
                                            <input type="checkbox" id="rdb6">
                                            <label for="rdb6">Financial Aid</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="rdb7">
                                            <label for="rdb7">Test Prep Help</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="rdb8">
                                            <label for="rdb8">College Essay Assistance</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="rdb9">
                                            <label for="rdb9">College Application Help</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="rdb10">
                                            <label for="rdb10">Scholarships</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="rdb11">
                                            <label for="rdb11">Internships & Career Guidance</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="rdb12">
                                            <label for="rdb12">Discounts Offered to Students</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="rdb13">
                                            <label for="rdb13">Other College Admission Topics</label>
                                        </li>                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update',array('class'=>'btn btn-default addmarginR10'));?>
                    <?php echo Html::resetButton('Cancle',array('class'=>'btn btn-default addmarginR10'));?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            
        </div>
    </div>
</div>
<script>
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
var wdith = $("p").css('width');
var p = $("#prfiledesc:first");
var t = p.text().replace("\n", "").replace(/\s{2,}/g, " ").trim();
p.replaceWith("<p><textarea  id='userprofile-description' class='form-control height120' name='UserProfile[description]'>" + t + "</textarea></p>")
$(".edit").css("width", wdith);
$('input.editable').removeClass('displaynone');
$('#updateprofile').empty();
$('#updateprofile').append('<i></i>Save');
}
$("#updateprofile").click(edit);
</script>

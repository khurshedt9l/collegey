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
use common\models\InterviewVideo;
use common\models\Video;
use kartik\file\FileInput;
use yii\web\UrlManager;
use kartik\widgets\DatePicker;
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
                    <li class="active"><a href="<?php echo Yii::$app->urlManager->createUrl('user/interview');?>">Interview</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('user/profile');?>">Profile</a></li>           
                    <li><a href="#">Notification</a></li>                    
                </ul>
            </div>    
            <?php
                    $form =  ActiveForm::begin(['id'=>'interviewvideo-form',
                        'enableAjaxValidation'=>false,
                        'enableClientValidation'=>true,
                        'validateOnSubmit'=>true,
                        'options'=>['enctype' => 'multipart/form-data']]);
                ?>
            <div class="p-header shadowBox">
            	<div class="box clearfix">
                	<div class="img">
                            <?php
                                if (!empty($userprofile->image)) {
                                    $img = $userprofile->image;
                                } else {
                                   $img='images/user.png';
                                }
                                ?>
                                <img id="profilepic" class="file-preview-image" src="<?php echo $img; ?>" />
                    </div>
                    <div class="detail">
                    	<a class="red-editButton" id="updateprofile" href="<?php echo Yii::$app->urlManager->createUrl('user/update-profile');?>"><i></i>Update Profile</a>
                        <h3><?php echo ucwords(strtolower($user->fname ." ". $user->lname));?></h3>
                        <p id="prfiledesc"><?php  echo $userprofile->description;?></p><br>
                        <p><?php echo $form->field($userprofile, 'image')->fileInput(['class' => 'upload editable displaynone'])->label(false);?></p>
                    </div>
                </div>
            </div>   
            <? ActiveForm::end();?>
            <div class="whiteBg radius5 addmarginB30 shadowBox">
            	<div class="padding30px">
                    <ul class="data-previews data-previews-col-2 clearfix" id="certificationreviewdata">
                        <li><iframe style="width: 90%;height:100%;" src="<?php echo $model->video['url'];?>"></iframe></li> 
                                                
                    </ul>    
                    
                	<h2 class="formHeading">Video Interview<a id="addmorevideobtn"><i class="plus-small"></i>Add More</a></h2>
                	<div class="support-form" id="videoform">
                    	<div class="padding30px">
                                        <?php
                    $form =  ActiveForm::begin(['id'=>'interviewvideo-form',
                        'enableAjaxValidation'=>false,
                        'enableClientValidation'=>true,
                        'validateOnSubmit'=>true,
                        'options'=>['enctype' => 'multipart/form-data']]);
                ?>
                        	<div class="formElements">                            	
                            	<div class="col-2 remMarginB clearfix">
                                	<div class="col col1">
                                    	<label>Video Url</label>
                                    	<?php echo $form->field($video, 'url')->textInput(['class' =>'form-control' ,'placeholder' => 'Link/URL of video'])->label(false);?>
                                    </div>
                                    <div class="clearfix"></div>                                                                   
                                   <!-- <div class="col col1 videoPreviewBox addmarginT20 addmarginB30">
                                    	<img src="<?php //echo $baseUrl; ?>/images/video-preview.jpg" />                                        
                                    </div>
                                    <div class="clearfix"></div> -->    
                                    <div class="col col1">
                                    	<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Save',['class'=>'btn btn-default addmarginR10', 'id'=>'video-submitbtn']);?>
                                        <?php echo Html::resetButton('Cancle',array('class'=>'btn btn-default addmarginR10'));?>
                                    </div>                               
                                </div>                                
                            </div>
                        </div>
                    </div>                    
                </div>
            
            </div>
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
    $("#videoform").css("display","none");
   
    $("#addmorevideobtn").click(function(){
        $("#videoform").toggle(1000);        
    });
});

//// ============submit competitive exam by ajax========
//$('#video-submitbtn').click(function(){
//    var form = $("#interviewvideo-form");
// if (form.find('.has-error').length) {
//      return false;
// }
// $.ajax({
//       url:form.attr('action'),
//       type: 'post',
//       data: form.serialize()+"&isnew=1",
//       dataType: 'json',
//      success: function (response) {
//           var jsondata=response.data;
//           var arr = $.map(jsondata, function(el) { return el; });
//           var previewdata='<li>'+
//                              '<h4>'+ arr[2] +'</h4>'+
//                              '<p class="title">Score:'+arr[3]+'<br />Percentile:'+arr[4]+'<br>'+arr[5]+'</p>'+
//                          '</li>';
//        $("#compExmpreviewdata").append(previewdata);
//        $('#competitiveExam-form')[0].reset();
//      }
//    
//    });
//    return false;
//    
//})
</script>
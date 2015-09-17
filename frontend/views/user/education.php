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
use common\models\Country;
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
            	<a class="toggleMobMenu"><i class="sprite"></i>Education</a>
                <ul class="clearfix">
                   <li class="active"><a href="<?php echo Yii::$app->urlManager->createUrl('user/education');?>">Education</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('user/interview');?>">Interview</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('user/profile');?>">Profile</a></li>           
                    <li><a href="#">Notification</a></li>                       
                </ul>
            </div>    
            
            <div class="p-header shadowBox">
            	<div class="box clearfix">
                	<div class="img">
                    	 <?php
                                if (!empty($model->image)) {
                                    $url = explode('/',$model->image);
                                    $ar = array_map('strrev', explode('.', strrev($url[1]), 2));
                                    if (!empty($ar[1])) {
                                        $url[1] = $ar[1] . '_160x160.' . $ar[0];
                                    }
                                    $img = Yii::$app->params['s3url'] . $url[0] . '/' . $url[1];
                                } else {
                                   $img='images/user.png';
                                }
                                ?>
                                <img id="profilepic" class="file-preview-image" src="<?php echo $img; ?>" />
                    </div>
                    <div class="detail">
                    	<a class="red-editButton" href="<?php echo Yii::$app->urlManager->createUrl('user/update-profile');?>"><i></i>Update Profile</a>
                    	<h3><?php echo ucwords(strtolower($user->fname ." ". $user->lname));?></h3>
                        <p><?php  echo $userprofile->description;?></p>
                    </div>
                </div>
            </div>                      
            <div class="p-Tabs">
            	<ul class="clearfix">
                	<li class="one active"><a href="#add-education" class="scroll-me"><i class="sprite i-education"></i>Add Education</a></li>
                    <li class="two"><a href="#add-test-score" class="scroll-me"><i class="sprite i-testscore"></i>Add Test Scores</a></li>
                    <li class="three"><a href="#add-certificates" class="scroll-me"><i class="sprite i-certification"></i>Add Certification</a></li>
                </ul>
            </div>
            <div id="add-education" class="whiteBg radius5 addmarginB30 shadowBox">
            	<div class="padding30px">
                	<h2 class="formHeading"><i class="border-blue"></i>Education<a id="addmoreeducationbtn"><i class="plus-small"></i>Add More</a></h2>
                        <?php if(count($user->education)) {?>
                        <div class="data-previews" id='previews-formdata'>
                        <?php foreach ($user->education as  $edu) {?>
                        <?php if($edu->course_name) {?>
                        <div style="width:100%">
                               <div style="width: 15%;float: left;padding: 5px 0px;"><b>Course Name :</b></div>
                                    <div style="width: 85%;float: left;padding: 5px 0px;"><?php echo $edu->course_name;?></div>
                        </div>
                        <?php } if($edu->branch) {?>
                           <div style="width:100%">
                               <div style="width: 15%;float: left; padding: 5px 0px;"><b>Branch</b></div>
                                <div style="width: 85%;float: left;padding: 5px 0px;"><?php echo $edu->branch;?></div>
                            </div>
                        <?php } if($edu->school_college) {?>
                            <div style="width:100%">
                                <div style="width: 15%;float: left; padding: 5px 0px;"><b>School/College</b></div>
                                <div style="width: 85%;float: left;padding: 10px 0px;"><?php echo $edu->school_college;?></div>
                            </div>
                        <?php } if($edu->university_board) {?>
                            <div style="width:100%">
                                <div style="width: 15%;float: left; padding: 5px 0px;"><b>University/Board</b></div>
                                <div style="width: 85%;float: left;padding: 5px 0px;"><?php echo $edu->university_board;?></div>
                            </div>
                            <div style="width:100%">
                                <?php } if($edu->is_passed) {?>
                                <div style="width: 33%;float: left;padding: 5px 0px;">
                                    <div style="width: 40%;float: left;"><b>Exam Passed</b></div>
                                    <div style="width: 60%;float: left;"><?php if($edu->is_passed==1 ?$is_passed='Appearing':'Passed') echo $is_passed;?></div>
                                </div>
                                <?php } if($edu->backlog) {?>
                                <div style="width: 33%;float: left;padding: 5px 0px;">
                                    <div style="width: 40%;float: left;"><b>No. of Backlogs:</b></div>
                                    <div style="width: 60%;float: left;"><?php echo $edu->backlog;?></div>
                                </div>
                                <?php } if($edu->total_marks) {?>
                                <div style="width: 34%;float: left;padding: 5px 0px;">
                                    <div style="width: 40%;float: left;"><b>Total Marks:</b></div>
                                    <div style="width: 60%;float: left;"><?php echo $edu->total_marks;?></div>
                                </div>
                                <?php }?>
                            </div>
                           
                            <div style="width:100%">
                                <div style="width: 33%;float: left;padding: 5px 0px;">
                                   <div style="width: 40%;float: left;"><b>Obtained Marks:</b></div>
                                   <div style="width: 60%;float: left;"><?php echo $edu->obtained_marks;?></div>
                                </div>
                                <div style="width: 33%;float: left;padding: 5px 0px;">
                                    <div style="width: 50%;float: left;"><b>Dates Attended:</b></div>
                                    <div style="width: 30%;float: left;">
                                    <?php 
                                       $date=explode(' ',$edu->attend_date);$date=explode('-', $date[0]); echo $date[2] .'-'. $date[1].'-'. $date[0];
                                    ?></div>
                                </div>
                                <div style="width: 34%;float: left;padding: 5px 0px;">
                                  <div style="width: 40%;float: left;"><b>Year Of Passing:</b></div>
                                    <div style="width: 60%;float: left;">
                                    <?php 
                                       $date=explode(' ',$edu->passing_year);$date=explode('-', $date[0]); echo $date[2] .'-'. $date[1].'-'. $date[0];
                                    ?>
                                    </div>
                                </div>
                            </div>
                                                    
                            <div style="clear: both;"></div>
                            <p><?php echo $edu->description;?></p>
                            <div class="previewclearfix"></div>
                        <?php }?>
                        </div>
                        <?php }?>
                	<div class="support-form addmarginB30" id="educationform">
                    	<div class="padding30px">
                            <?php 
                        $model=new \common\models\Education();    
                        $form=  ActiveForm::begin(['id'=>'education-form',
                        'enableAjaxValidation'=>false,
                        'enableClientValidation'=>true,
                        'validateOnSubmit'=>true,
                        'options'=>['enctype' => 'multipart/form-data']]);?>
                        	<div class="formElements">
                            	<div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>Course Name</label>
                                    	<?php echo $form->field($model ,'course_name')->textInput(['class' =>'form-control'])->label(false); ?>
                                    </div>
                                    <div class="col col2">
                                    	<label>Branch</label>
                                    	<?php echo $form->field($model ,'branch')->textInput(['class' =>'form-control'])->label(false); ?>
                                    </div>
                                    
                                    <div class="col col3">
                                    	<label>School/College</label>
                                    	<?php echo $form->field($model ,'school_college')->textInput(['class' =>'form-control'])->label(false); ?>
                                    </div>
                                </div>
                                    <div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>University/Board</label>
                                    	<?php echo $form->field($model ,'university_board')->textInput(['class' =>'form-control'])->label(false); ?>
                                    </div>
                                        <div class="col col2">
                                    	<label>Exam Passed</label>
                                    	<?php echo $form->field($model ,'is_passed')->dropDownList(['0' =>'Select' ,'1'=>'Appearing', '2'=>'Passed'],['class' =>'form-control singleSelectBox'])->label(false); ?>
                                    </div> 
                                    <div class="col col3 inputTwoCol clearfix">
                                        <label>No. of Backlogs<label class="lbl2">Total Marks</label></label>
                                    	<div class="mcol-1">
                                         <?php echo $form->field($model ,'backlog')->textInput(['class' =>'form-control numberonly'])->label(false); ?>
                                        </div>
                                    	<div class="mcol-2">
                                         <?php echo $form->field($model ,'total_marks')->textInput(['class' =>'form-control numberonly'])->label(false); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>Obtained Marks</label>
                                    	<?php echo $form->field($model ,'obtained_marks')->textInput(['class' =>'form-control numberonly'])->label(false); ?>
                                    </div>
                                    <div class="col col2">
                                    	<label>Dates Attended</label>
                                    	<?php  
                                        echo DatePicker::widget([
                                        'name' => 'Education[attend_date]',
                                        'value' => '01/01/1990',
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' =>true,
                                            'todayBtn' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ]
                                    ]);
                                    ?>
                                    </div>
                                    <div class="col col3">
                                    	<label>Year of Passing</label>
                                    	<?php 
                                         echo DatePicker::widget([
                                        'name' => 'Education[passing_year]',
                                        'value' => '01/01/1990',
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' =>true,
                                            'todayBtn' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ]
                                    ]);
                                    ?>
                                    </div>
                                </div>
                                <div class="common">
                                	<label>Brief Description</label>
                                        <?php echo $form->field($model ,'description')->textarea(['class' =>'form-control height120'])->label(false); ?>                                </div>
                                        <?php echo Html::submitButton($model->isNewRecord ? 'Add <i class="plus-small"></i>' : 'Update',['class'=>'btn btn-default addmarginR10','id'=>'educationsubmitbtn']);?>
                                        <?php echo Html::resetButton('Cancle',array('class'=>'btn btn-default addmarginR10'));?>
                    
                            </div>
                            <?php ActiveForm::end();?>
                        </div>
                    </div>                   
                </div>
            </div>
            <div id="add-test-score" class="whiteBg radius5 addmarginB30 shadowBox">
            	<div class="padding30px">
                	<h2 class="formHeading"><i class="border-purple"></i>Test Score<a id="testscorebtn" class="cursorpointer"><i class="plus-small" ></i>Add More</a></h2>
                    <ul class="data-previews clearfix" id="compExmpreviewdata">
                        <?php foreach ($user->competitiveExamDestails as $CED) {?>
                        <li>
                        <h4><?php echo $CED->name;?></h4>
                        <p class="title">Score: <?php echo $CED->score;?><br>Percentile: <?php echo $CED->percentile;?><br><?php $date=explode(' ',$CED->date);
                        $date=explode('-', $date[0]); echo $date[2] .'-'. $date[1].'-'. $date[0];?>
                        </p>
                        </li>
                        <?php }?>
                    </ul>
                	<div class="support-form addmarginB30" id="testscoreform">
                    	<div class="padding30px">
                        	<div class="formElements">
                                  <?php 
                                    $compexmmodel=new \common\models\CompetitiveExam();
                                    $form=  ActiveForm::begin(['id'=>'competitiveExam-form',
                                    'enableAjaxValidation'=>false,
                                    'enableClientValidation'=>true,
                                    'action' => "/index.php?r=user/competitiveexam",
                                    'validateOnSubmit'=>true,
                                    'options'=>['enctype' => 'multipart/form-data']]);
                                  ?>
                            	<div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>Competitive Exam</label>
                                    	<?php echo $form->field($compexmmodel,'name')->textInput(['class' =>'form-control','placeholder' =>'Exam Name'])->label(false);?>
                                    </div>
                                    <div class="col col2 inputTwoCol">
                                        <div class="mcol-1">
                                    	<label>Score</label>
                                    	<?php echo $form->field($compexmmodel,'score')->textInput(['class' =>'form-control','placeholder' =>'Score'])->label(false);?>
                                        </div>
                                        <div class="mcol-2">
                                    	<label>Percentile</label>
                                    	<?php echo $form->field($compexmmodel,'percentile')->textInput(['class' =>'form-control','placeholder' =>'Percentile'])->label(false);?>
                                        </div>
                                    </div>
                                    <div class="col col3">
                                    	<label>Date</label>
                                    	
                                        <?php 
                                         echo DatePicker::widget([
                                        'name' => 'CompetitiveExam[date]',
                                        'value' => '01/01/2000',
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' =>true,
                                            'todayBtn' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ]
                                    ]);
                                    ?>
                                    </div>
                                    
                                </div>                                
                                <?php echo Html::submitButton($compexmmodel->isNewRecord ? 'Add <i class="plus-small"></i>' : 'Update',['class'=>'btn btn-default addmarginR10','id'=>'competitiveEexam-subbtn']);?>
                    	        <?php echo Html::resetButton('Cancle',array('class' => 'btn btn-default'));?>
                            <?php ActiveForm::end();?>
                                </div>
                        </div>
                    </div>                   
                </div>
            </div>
            <div id="add-certificates" class="whiteBg radius5 addmarginB30 shadowBox">
            	<div class="padding30px">
                	<h2 class="formHeading"><i class="border-green"></i>Certificates<a id="addmorecertificatebtn" class="cursorpointer"><i class="plus-small" ></i>Add More</a></h2>
                     <ul class="data-previews data-previews-col-2 clearfix" id="certificationreviewdata">
                         <?php foreach ($user->certifationdetails as $certificate) {?>
                    <li>
                        <h4><?php echo $certificate->name;?></h4>
                        <p class="title">Authority Name:<?php echo $certificate->certification_authority;?>
                        <br>Licence No.<?php echo $certificate->licence_no;?><br>Valid:<?php
                        $date=explode(' ',$certificate->valid_upto);
                        $date=explode('-', $date[0]); echo $date[2] .'-'. $date[1].'-'. $date[0];?></p>
                    </li>
                         <?php }?>
                    </ul>
                	<div class="support-form addmarginB30" id="certificateform">
                    	<div class="padding30px">
                        	<div class="formElements">
                                    <?php 
                                  $certfmodel =new \common\models\Certification();
                                    $form=  ActiveForm::begin(['id'=>'certification-form',
                                    'enableAjaxValidation'=>false,
                                    'enableClientValidation'=>true,
                                    'action' => "/index.php?r=user/certification",
                                    'validateOnSubmit'=>true,
                                    'options'=>['enctype' => 'multipart/form-data']]);
                                  ?>
                            	<div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>Certificate Name</label>
                                    	<?= $form->field($certfmodel, 'name')->textInput(['class' =>'form-control' ,'placeholder' =>'Certificate Name'])->label(false);?>
                                    </div>
                                    <div class="col col2">
                                    	<label>Certificate Authority</label>
                                    	<?= $form->field($certfmodel, 'certification_authority')->textInput(['class' =>'form-control' ,'placeholder' =>'Certification Authority'])->label(false);?>
                                    </div>
                                    <div class="col col3 inputTwoCol clearfix">
                                    	<label>Licence Number</label>
                                    	<?= $form->field($certfmodel, 'licence_no')->textInput(['class' =>'form-control' ,'placeholder' =>'Licence Number'])->label(false);?>
                                    </div>
                                </div>
                            	<div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>Dates Attend</label>
                                    	<?php 
                                         echo DatePicker::widget([
                                        'name' => 'Certification[attended_date]',
                                        'value' => '01/01/1990',
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' =>true,
                                            'todayBtn' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ]
                                    ]);
                                    ?>
                                    </div>
                                    <div class="col col2 clearfix">                                    	
                                    	<label>Dates of Completion</label>
                                    	<?php 
                                         echo DatePicker::widget([
                                        'name' => 'Certification[completion_date]',
                                        'value' => '01/01/1990',
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' =>true,
                                            'todayBtn' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ]
                                    ]);
                                    ?>
                                    </div>
                                    <div class="col col3 clearfix">
                                    	<label>Valid Up To</label>
                                    	<?php 
                                         echo DatePicker::widget([
                                        'name' => 'Certification[valid_upto]',
                                        'value' => '01/01/1990',
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' =>true,
                                            'todayBtn' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ]
                                    ]);
                                    ?>
                                    </div>
                                </div>  
                                <!--<div class="common smallCheckBox">
                                	<input type="checkbox" id="forCertificateExpire" name="Certification[is_expired]" />
                                        <label for="forCertificateExpire">This certificate doesn't expire</label>
                                </div>-->
                                <?php echo Html::submitButton($certfmodel->isNewRecord ? 'Add <i class="plus-small"></i>' : 'Update',['class'=>'btn btn-default addmarginR10','id'=>'certification-subbtn']);?>
                    	        <?php echo Html::resetButton('Cancle',array('class' => 'btn btn-default'));?>
                                        <?php ActiveForm::end();?>
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
    $("#testscoreform").css("display","none");
    $("#certificateform").css("display","none");
    $("#educationform").css("display","none");
    $("#certificateform").css("display","none");
    
    $("#testscorebtn").click(function(){
        $("#testscoreform").toggle(1000);        
    });
        $("#addmorecertificatebtn").click(function(){
        $("#certificateform").toggle(1000);        
    });
    $("#addmoreeducationbtn").click(function(){
        $("#educationform").toggle(1000);        
    });
});

// ============submit competitive exam by ajax========
$('#competitiveEexam-subbtn').click(function(){
    var form = $("#competitiveExam-form");
 if (form.find('.has-error').length) {
      return false;
 }
 $.ajax({
       url:form.attr('action'),
       type: 'post',
       data: form.serialize()+"&isnew=1",
       dataType: 'json',
      success: function (response) {
           var jsondata=response.data;
           var arr = $.map(jsondata, function(el) { return el; });
           var previewdata='<li>'+
                              '<h4>'+ arr[2] +'</h4>'+
                              '<p class="title">Score:'+arr[3]+'<br />Percentile:'+arr[4]+'<br>'+arr[5]+'</p>'+
                          '</li>';
        $("#compExmpreviewdata").append(previewdata);
        $('#competitiveExam-form')[0].reset();
      }
    
    });
    return false;
    
})

// ============submit certification exam by ajax========
$('#certification-subbtn').click(function(){
    var form = $("#certification-form");
 if (form.find('.has-error').length) {
      return false;
 }
 $.ajax({
       url:form.attr('action'),
       type: 'post',
      data: form.serialize()+"&isnew=1",
      dataType: 'json',
      success: function (response) {
           var jsondata=response.data;
           var arr = $.map(jsondata, function(el) { return el; });
           var previewdata='<li><h4>' +arr[2]+ '</h4>'+
                            '<p class="title"><br />'+ arr[3] +
                            '<br />'+ arr[4] +
                            '<br />'+ arr[5] +
                            '<br />'+ arr[6] +
                            '<br />'+ arr[7] +
                            '</p></li>';
        $("#certificationreviewdata").append(previewdata);
        $('#certification-form')[0].reset();
      },
//      error: function(response){
//      alert(response);
    //  }
    });
    return false;
    
});

$("#educationsubmitbtn").click(function(){
        var form = $("#education-form");
 if (form.find('.has-error').length) {
      return false;
 }
 $.ajax({
      url: form.attr('action'),
      type: 'post',
      data: form.serialize()+"&isnew=1",
      dataType: 'json',
      success: function (response) {
           var jsondata=response.data;
           var arr = $.map(jsondata, function(el) { return el; });
           var ispassed='';
           if(arr[6]==1)
           {
               ispassed='Appearing';
           }
           else
           {ispassed='Passed';}
          var previewdata='<div style="width:100%">'+
                               '<div style="width: 15%;float: left;padding: 5px 0px;"><b>Course Name :</b></div>'+
                                    '<div style="width: 85%;float: left;padding: 5px 0px;">'+ arr[2] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 15%;float: left; padding: 5px 0px;"><b>Branch</b></div>'+
                                '<div style="width: 85%;float: left;padding: 5px 0px;">'+ arr[4] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 15%;float: left; padding: 5px 0px;"><b>School/College</b></div>'+
                                '<div style="width: 85%;float: left;padding: 10px 0px;">'+ arr[5] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 15%;float: left; padding: 5px 0px;"><b>University/Board</b></div>'+
                                '<div style="width: 85%;float: left;padding: 5px 0px;">'+ arr[5] +'</div>'+
                            '</div>'+
                            '<div style="width:100%">'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 40%;float: left;"><b>Exam Passed</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ ispassed +'</div>'+
                                '</div>'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 40%;float: left;"><b>No. of Backlogs:</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ arr[7] +'</div>'+
                                '</div>'+
                                '<div style="width: 34%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 40%;float: left;"><b>Total Marks:</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ arr[8] +'</div>'+
                                '</div>'+
                            '</div>'+
                           
                            '<div style="width:100%">'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                   '<div style="width: 40%;float: left;"><b>Obtained Marks:</b></div>'+
                                   '<div style="width: 60%;float: left;">'+ arr[9] +'</div> '+
                                '</div>'+
                                '<div style="width: 33%;float: left;padding: 5px 0px;">'+
                                    '<div style="width: 50%;float: left;"><b>Dates Attended:</b></div>'+
                                    '<div style="width: 30%;float: left;">'+ arr[10] +'</div>'+
                                '</div>'+
                                '<div style="width: 34%;float: left;padding: 5px 0px;">'+
                                  '<div style="width: 40%;float: left;"><b>Year Of Passing:</b></div>'+
                                    '<div style="width: 60%;float: left;">'+ arr[11] +'</div> '+ 
                                '</div>'+
                            '</div>'+
                                                    
                            '<div style="clear: both;"></div>'+
                        '<p>'+ arr[12] +'</p>'+
                        '<div style="clear: both;height:10px;border-top:5px#ff0"></div>';
                $("#previews-formdata").append(previewdata);
               $('#education-form')[0].reset();
          
          
          
      }
 });
 return false;   
});
</script>
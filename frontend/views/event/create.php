<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Application;
use common\models\Event;
use common\models\Country;
use common\models\Documents;
use common\models\EventQuickInformation;
use yii\web\Session;
use yii\base\View;
use yii\helpers\Url;
use conquer\select2\Select2Widget;
use kartik\file\FileInput;
use yii\web\UrlManager;
use kartik\widgets\DatePicker;
use yii\web\User;

//$this->title = 'Student User Profile';
//$this->params['breadcrumbs'][] = 'User Profile';
?>
<!-- Main Section -->

<section class="contnetCntr">
<div class="container">
    <div class="row">
        <div class="col-lg-12">                                                                     
            
            <div class="ltgreenBg addmarginB20 radius5 shadowBox">
            	<h3 class="font-patua txtfff addmarginL20 addpaddingR20 addpaddingT25 addpaddingB25 fnt-size22px">Create Event</h3>
            </div>
            
            <div class="whiteBg radius5 addmarginB30 shadowBox">
            	<div class="padding30px">
                	<h2 class="formHeading">Event</h2>
                	<div class="support-form">
                    	<div class="padding30px">
                        	<div class="formElements">
                                    <?php    
                                        $form=  ActiveForm::begin(['id'=>'event-form',
                                        'enableAjaxValidation'=>false,
                                        'enableClientValidation'=>true,
                                        'validateOnSubmit'=>true,
                                        'options'=>['enctype' => 'multipart/form-data']]);
                                    ?>
                           	<div class="col-3 addmarginB30 clearfix">
                                	<div class="col col1">
                                    	<label>Select University</label>
                                        <?php echo $form->field($model, 'university_id')->dropDownList(ArrayHelper::map($university, 'id', 'name'),['prompt'=>'Select University','class' =>'singleSelectBox'])->label(false);?>
                                        </div>
                                    <div class="col col2">
                                    	<label>Fair Name</label>
                                    	<?php echo $form->field($model, 'name')->textInput(['class' =>'form-control' ,'placeholder' =>'Event Name'])->label(false);?>
                                    </div>
                                    <div class="col col3">
                                    	<label>Event Start</label>
                                    	<?php  
                                        echo DatePicker::widget([
                                        'name' => 'Event[start_date]',
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
                                <div class="col-3 addmarginB30 clearfix">
                                        <div class="col col1">
                                    	<label>Event Close</label>
                                            <?php  
                                            echo DatePicker::widget([
                                            'name' => 'Event[close_date]',
                                            'value' => '01/01/1990',
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'todayHighlight' =>true,
                                                'todayBtn' => true,
                                                'format' => 'dd/mm/yyyy'
                                             ]]);
                                        ?>
                                        </div>
                                    <div class="col col2">
                                        <label>Banner</label>
                                        <?php echo $form->field($model, 'banner')->fileInput()->label(false);?>
                                    </div>
                                </div>
                                    <div class="col-3 addmarginB30 clearfix">
                                        <div class="form-group field-education-description">
                                            <?php echo $form->field($model, 'description')->textarea(['class' =>'form-control height120'])->label();?>
                                        </div>
                                    </div>
                                    <h3 class="normal-heading text-uppercase addmarginB20">Links</h3>
                                    <?php 
                                    $link=new  \common\models\ImportantLink();
                                    ?>
                                  <div id='TextBoxesGroup'> 
                                        <div class="col-3 addmarginB30 clearfix">
                                              <div class="col col1">
                                              <label>Link Name</label>
                                              <?php echo $form->field($link, 'name[]')->textInput(['class' =>'form-control' ,'placeholder' =>'Name'])->label(false);?>
                                              </div>
                                          <div class="col col2">
                                              <label>Link URL</label>
                                              <?php echo $form->field($link, 'url[]')->textInput(['class' =>'form-control' ,'placeholder' =>'URL'])->label(false);?>
                                          </div>
                                          <div class="col col3">
                                          <i class="plus-small" id='addlinkbtn'></i>                                    	
                                          </div>
                                        </div> 
                                 </div>
                                    
                                 <h3 class="normal-heading text-uppercase addmarginB20">Videos</h3>
                                    <?php 
                                    $video=new \common\models\EventVideo();
                                    ?>
                                  <div id='VideoTextBoxesGroup'> 
                                        <div class="col-3 addmarginB30 clearfix">
                                              <div class="col col1">
                                              <label>Video Name</label>
                                              <?php echo $form->field($video, 'name[]')->textInput(['class' =>'form-control' ,'placeholder' =>'Name'])->label(false);?>
                                              </div>
                                          <div class="col col2">
                                              <label>VIdeo URL</label>
                                              <?php echo $form->field($video, 'url[]')->textInput(['class' =>'form-control' ,'placeholder' =>'URL'])->label(false);?>
                                          </div>
                                          <div class="col col3">
                                          <i class="plus-small" id='addvideobtn'></i>                                    	
                                          </div>
                                        </div> 
                                 </div>
                                 
                                 <h3 class="normal-heading text-uppercase addmarginB20">Quick Information</h3>
                                    <?php 
                                    $quickinfo=new EventQuickInformation();
                                    ?>
                                  <div id='InfoTextBoxesGroup'> 
                                        <div class="col-3 addmarginB30 clearfix">
                                              <div class="col col1">
                                              <label>Title</label>
                                              <?php echo $form->field($quickinfo, 'title[]')->textInput(['class' =>'form-control' ,'placeholder' =>'Name'])->label(false);?>
                                              </div>
                                          <div class="col col2">
                                              <label>URL</label>
                                              <?php echo $form->field($quickinfo, 'url[]')->textInput(['class' =>'form-control' ,'placeholder' =>'URL'])->label(false);?>
                                          </div>
                                          <div class="col col3">
                                          <i class="plus-small" id='addinfobtn'></i>                                    	
                                          </div>
                                        </div> 
                                 </div>
                                 
                                 <h3 class="normal-heading text-uppercase addmarginB20">Documents</h3>
                                    <?php 
                                    $document=new Documents();
                                    ?>
                                  <div id='DocTextBoxesGroup'> 
                                        <div class="col-3 addmarginB30 clearfix">
                                              <div class="col col1">
                                              <label>Title</label>
                                              <?php echo $form->field($document, 'title[]')->textInput(['class' =>'form-control' ,'placeholder' =>'Name'])->label(false);?>
                                              </div>
                                          <div class="col col2">
                                              <label>URL</label>
                                              <?php echo $form->field($document, 'url[]')->textInput(['class' =>'form-control' ,'placeholder' =>'URL'])->label(false);?>
                                          </div>
                                          <div class="col col3">
                                          <i class="plus-small" id='adddocbtn'></i>                                    	
                                          </div>
                                        </div> 
                                 </div>
                                    
                                 <?php echo Html::submitButton($model->isNewRecord ? 'Save' : 'Update',['class'=>'btn btn-default addmarginR10','id'=>'educationsubmitbtn']);?>
                                 <?php echo Html::resetButton('Cancle',array('class'=>'btn btn-default addmarginR10'));?>
                           <?php ActiveForm::end();?>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>                                                                                   
            
        </div>
    </div>
</div>
</section>
<!-- End Main Section -->
<script>
 // add link name and url text box Dynamicaly by jquery
    var counter =1;
    $("#addlinkbtn").click(function() {
addeventlinks(counter);
counter++;
    });
    function removebtn(val) {
        if (counter == 1) {
            return false;
        }
        counter--;
        $("#TextBoxDiv" + val).remove();
    }
 // end add attribute text box Dynamicaly by jquery end
function addeventlinks(attrID)
{
    var counter=attrID ;
    	if(counter>7){
            alert("Only 8 allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter)
             .attr("class", 'col-3 addmarginB30 clearfix')
                
	newTextBoxDiv.after().html('<div class="col col1">'+
                '<input class="form-control" placeholder="Name" type="text" name="ImportantLink[name][]" id="name' + counter + '" value="" >' +
                '</div>' +
                '<div class="col col2">' +
                '<input class="form-control" placeholder="URL" type="text" name="ImportantLink[url][]" id="url'+counter+'" value="" >' +
                '</div>'+
                '<div class="col col3">'+
                     '<div class="text-right">'+
                       '<a class="btn-delete" onClick="removebtn(' +counter+ ')">X</a>'+
                '</div>'+
                '</div>'+
          '</div>'
                );
//$( "<p>Test</p>" ).insertAfter( ".inner" );			
newTextBoxDiv.appendTo("#TextBoxesGroup");  
}
 // add link name and url text box Dynamicaly by jquery
    var videocounter =1;
    $("#addvideobtn").click(function() {
addeventvideo(videocounter);
videocounter++;
    });
    function removevideobtn(val) {
        if (videocounter == 1) {
            return false;
        }
        videocounter--;
        $("#VideoTextBoxDiv" + val).remove();
    }
function addeventvideo(attrID)
{
var counterVideo=attrID ;
    	if(videocounter>1){
            alert("Only 2 allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'VideoTextBoxDiv' + counterVideo)
             .attr("class", 'col-3 addmarginB30 clearfix')
                
	newTextBoxDiv.after().html('<div class="col col1">'+
                '<input class="form-control" placeholder="Name" type="text" name="EventVideo[name][]" id="vname' + videocounter + '" value="" >' +
                '</div>' +
                '<div class="col col2">' +
                '<input class="form-control" placeholder="URL" type="text" name="EventVideo[url][]" id="vurl'+videocounter+'" value="" >' +
                '</div>'+
                '<div class="col col3">'+
                     '<div class="text-right">'+
                       '<a class="btn-delete" onClick="removevideobtn(' +videocounter+ ')">X</a>'+
                '</div>'+
                '</div>'+
          '</div>'
                );		
newTextBoxDiv.appendTo("#VideoTextBoxesGroup");  
}
// add quick information title and url text box Dynamicaly by jquery
    var infocounter =1;
    $("#addinfobtn").click(function() {
addeventquickinfolink(infocounter);
infocounter++;
    });
    function removeinfobtn(val) {
        if (infocounter == 1) {
            return false;
        }
        infocounter--;
        $("#InfoTextBoxDiv" + val).remove();
    }
function addeventquickinfolink(attrID)
{
var counterVideo=attrID ;
    	if(infocounter>7){
            alert("Only 8 allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'InfoTextBoxDiv' + counterVideo)
             .attr("class", 'col-3 addmarginB30 clearfix')
                
	newTextBoxDiv.after().html('<div class="col col1">'+
                '<input class="form-control" placeholder="Name" type="text" name="EventQuickInformation[title][]" id="vname' + infocounter + '" value="" >' +
                '</div>' +
                '<div class="col col2">' +
                '<input class="form-control" placeholder="URL" type="text" name="EventQuickInformation[url][]" id="vurl'+infocounter+'" value="" >' +
                '</div>'+
                '<div class="col col3">'+
                     '<div class="text-right">'+
                       '<a class="btn-delete" onClick="removeinfobtn(' +infocounter+ ')">X</a>'+
                '</div>'+
                '</div>'+
          '</div>'
                );		
newTextBoxDiv.appendTo("#InfoTextBoxesGroup");  
}
// add document title and url text box Dynamicaly by jquery
    var doccounter =1;
    $("#adddocbtn").click(function() {
addedoc(doccounter);
doccounter++;
    });
    function removedocbtn(val) {
        if (doccounter == 1) {
            return false;
        }
        doccounter--;
        $("#DocTextBoxDiv" + val).remove();
    }
function addedoc(attrID)
{
var counterVideo=attrID ;
    	if(doccounter>7){
            alert("Only 8 allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'DocTextBoxDiv' + counterVideo)
             .attr("class", 'col-3 addmarginB30 clearfix')
                
	newTextBoxDiv.after().html('<div class="col col1">'+
                '<input class="form-control" placeholder="Name" type="text" name="Documents[title][] value="" >' +
                '</div>' +
                '<div class="col col2">' +
                '<input class="form-control" placeholder="URL" type="text" name="Documents[url][]" value="" >' +
                '</div>'+
                '<div class="col col3">'+
                     '<div class="text-right">'+
                       '<a class="btn-delete" onClick="removedocbtn(' +doccounter+ ')">X</a>'+
                '</div>'+
                '</div>'+
          '</div>'
                );		
newTextBoxDiv.appendTo("#DocTextBoxesGroup");  
}
</script>

<style>
.plus-small {
    width: 21px;
    height: 21px;
    display: inline-block;
    vertical-align: middle;
    margin-right: 5px;
    background: url(../images/sprite.png) no-repeat -106px 0px;
    margin-left: 5px;
}    
</style>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use common\models\Address;
use common\models\Contacts;
use common\models\ImportantLink;
use common\models\DownloadLink;
use yii\web\UrlManager;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
    $addresmodel=new Address();
    $contactsmodel= new Contacts;
    $implink=new ImportantLink();
    $downloadlink=new DownloadLink();
?>
<div class="university-form">

    <?php $form =  ActiveForm::begin(['id'=>'university-form',
                        'enableAjaxValidation'=>false,
                        'enableClientValidation'=>true,
                        'validateOnSubmit'=>true,
                        'options'=>['enctype' => 'multipart/form-data']]); ?>
    <div style="width: 100%;">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div style="width: 100%;">
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>
    <div style="width: 100%;">
        <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
    </div>
    <div id='DocTextBoxesGroup'> 
    <div style="width: 100%;">
        <div style="width: 45%; float: left;"><?= $form->field($implink, 'name')->textInput(['maxlength' => true])->label('Important Link Title') ;?></div>
        <div style="width: 45%;float: left;"><?= $form->field($implink, 'url')->textInput(['maxlength' => true])->label('Important Link Url') ; ?></div>
        <div style="width: 10%;float: left;"><i class="plus-small" id="addlinkbtn"></i></div>
    </div>
    </div>
    <div id="DownloadTextBoxesGroup">
    <div style="width: 100%;">
        <div style="width: 45%; float: left;"><?= $form->field($downloadlink, 'name')->textInput(['maxlength' => true])->label('Download Title') ;?></div>
        <div style="width: 45%;float: left;"><?= $form->field($downloadlink, 'url')->textInput(['maxlength' => true])->label('Download Url') ; ?></div>
        <div style="width: 10%;float: left;"><i class="plus-small" id="adddownloadbtn"></i></div>
    </div>
    </div>
    <div style="width: 100%;">
        <div style="width:50%; float: left;"><?= $form->field($model, 'logo')->fileInput(['maxlength' => true]) ?></div>
        <div style="width:50%;float: left;"><?= $form->field($model, 'banner')->fileInput(['maxlength' => true]) ?></div>
    </div>
    <div style="width: 100%;">
        <div style="width:50%; float: left;">
        <?php  
        echo '<label class="control-label">Establish</label>';
         echo DatePicker::widget([
        'name' => 'University[establish]',
        'value' => '01/01/1990',
        'pluginOptions' => ['autoclose'=>true,'todayHighlight' =>true,'todayBtn' => true,'format' => 'dd/mm/yyyy']]);?></div>
        <div style="width:50%;float: left;"><?= $form->field($addresmodel, 'address')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div style="width: 100%;">
        <div style="width:50%; float: left;"><?= $form->field($addresmodel, 'landmark')->textInput(['maxlength' => true]) ?></div>
        <div style="width:50%;float: left;">
        <?php
        if (empty($addresmodel->country_id)) {$addresmodel->country_id = 'IND';}
            $coutrylist=ArrayHelper::map(\common\models\Countries::findAll(['is_visible'=>1,'status'=>1]),'countryID','countryName');
            echo $form->field($addresmodel, 'country_id')->dropDownList($coutrylist,  ['prompt'=>'Select Country','class'=>'singleSelectBox','data-tags'=>true
               ,'onChange'=>'countrychange("'.Url::toRoute(['site/states']).'")'
                ])->label(false);
        ?>
        </div>
    </div>
     <div style="width: 100%;">
        <div style="width:50%; float: left;">
            <?php                      
            if (!empty($addre->state_id)) {
                $state = ArrayHelper::map(\common\models\States::findAll(['id' => $addresmodel->state_id]), 'id', 'name');
            } else {
                $state = [];
            }
            echo $form->field($addresmodel, 'state_id')->dropDownList(
                    $state, ['prompt' => 'Select State', 'class' => 'singleSelectBox', 'data-tags' => true, 'onChange' => 'statechange("' . Url::toRoute(['site/city']) . '")']
            )->label(false);
           ?>
        </div>
        <div style="width:50%;float: left;">
           <?php
                if (!empty($addresmodel->city_id)) {
                  $city = ArrayHelper::map(\common\models\Cities::findAll(['id' => $addresmodel->city_id]), 'id', 'name');
              } else {
                  $city = [];
              }
                echo $form->field($addresmodel, 'city_id')->dropDownList(
                        $city, ['prompt' => 'Select City', 'class' => 'singleSelectBox', 'data-tags' => true]
                )->label(false);
           ?>
        </div>
    </div>
    <div style="width:100%">
        <div style="width:25%;float: left;"><?= $form->field($addresmodel, 'pincode')->textInput(['maxlength' => true]) ?></div>
        <div style="width:25%;float: left;"><?= $form->field($contactsmodel, 'email')->input('email',['maxlength' => true]) ?></div>
        <div style="width:25%;float: left;"><?= $form->field($contactsmodel, 'landline')->textInput(['class'=>'singleSelectBox' ,'maxlength' => true]) ?></div>
        <div style="width:25%;float: left;"><?= $form->field($contactsmodel, 'mobile')->textInput(['class'=>'form-control numberonly' ,'maxlength' => true]) ?></div>
    </div>
    <div style="width:100%">
        <div style="width:25%;float: left;"><?= $form->field($contactsmodel, 'fax')->textInput(['class'=>'form-control numberonly' ,'maxlength' => true]) ?></div>
        <div style="width:25%;float: left;"><?php $form->field($model, 'is_verified')->textInput() ?></div>
        <div style="width:25%;float: left;"><?php $form->field($model, 'is_featured')->textInput() ?></div>
        <div style="width:25%;float: left;"><?php $form->field($model, 'status')->textInput() ?></div>
    </div>

    <div class="form-group" style="width: 100%">
        <div style="width:25%;float: left;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

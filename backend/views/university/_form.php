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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($implink, 'name')->textInput(['maxlength' => true])->label('Important Link Title') ;?>
    
    <?= $form->field($implink, 'url')->textInput(['maxlength' => true])->label('Important Link Url') ; ?>
    
    <?= $form->field($downloadlink, 'name')->textInput(['maxlength' => true])->label('Download Title') ;?>
    
    <?= $form->field($downloadlink, 'url')->textInput(['maxlength' => true])->label('Download Url') ; ?>

    <?= $form->field($model, 'logo')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'banner')->fileInput(['maxlength' => true]) ?>
     <?php  
        echo '<label class="control-label">Establish</label>';
         echo DatePicker::widget([
        'name' => 'University[establish]',
        'value' => '01/01/1990',
        'pluginOptions' => [
            'autoclose'=>true,
            'todayHighlight' =>true,
            'todayBtn' => true,
            'format' => 'dd/mm/yyyy'
        ]
    ]);
    ?>

<?= $form->field($addresmodel, 'address')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($addresmodel, 'landmark')->textInput(['maxlength' => true]) ?>
    
    <?php
            if (empty($addresmodel->country_id)) {
                $addresmodel->country_id = 'IND';
            }
            $coutrylist=ArrayHelper::map(\common\models\Countries::findAll(['is_visible'=>1,'status'=>1]),'countryID','countryName');
            echo $form->field($addresmodel, 'country_id')->dropDownList($coutrylist,  ['prompt'=>'Select Country','class'=>'singleSelectBox','data-tags'=>true
               ,'onChange'=>'countrychange("'.Url::toRoute(['site/states']).'")'
                ]);
    ?>
    <?php
                                       
            if (!empty($addre->state_id)) {
                $state = ArrayHelper::map(\common\models\States::findAll(['id' => $addresmodel->state_id]), 'id', 'name');
            } else {
                $state = [];
            }
           // print_r($state);die;
            echo $form->field($addresmodel, 'state_id')->dropDownList(
                    $state, ['prompt' => 'Select State', 'class' => 'singleSelectBox', 'data-tags' => true, 'onChange' => 'statechange("' . Url::toRoute(['site/city']) . '")']
            );
    ?>
    
    <?php
            if (!empty($addresmodel->city_id)) {
              $city = ArrayHelper::map(\common\models\Cities::findAll(['id' => $addresmodel->city_id]), 'id', 'name');
          } else {
              $city = [];
          }
            echo $form->field($addresmodel, 'city_id')->dropDownList(
                    $city, ['prompt' => 'Select City', 'class' => 'singleSelectBox', 'data-tags' => true]
            );
    ?>
    
    <?= $form->field($addresmodel, 'pincode')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($contactsmodel, 'email')->input('email',['maxlength' => true]) ?> 
    
    <?= $form->field($contactsmodel, 'landline')->textInput(['class'=>'form-control numberonly' ,'maxlength' => true]) ?>
    
    <?= $form->field($contactsmodel, 'mobile')->textInput(['class'=>'form-control numberonly' ,'maxlength' => true]) ?>
    
    <?= $form->field($contactsmodel, 'fax')->textInput(['class'=>'form-control numberonly' ,'maxlength' => true]) ?>
    
    

    <?php $form->field($model, 'is_verified')->textInput() ?>

    <?php $form->field($model, 'is_featured')->textInput() ?>

    <?php $form->field($model, 'status')->textInput() ?>

    <?php //$form->field($model, 'created')->textInput() ?>

    <?php //$form->field($model, 'updated')->textInput() ?>

    <?php //$form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'statutory_body_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

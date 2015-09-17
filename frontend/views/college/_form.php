<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\College */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="college-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'university_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'banner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'establish')->textInput() ?>

    <?= $form->field($model, 'statutory_body_id')->textInput() ?>

    <?= $form->field($model, 'important_links_id')->textInput() ?>

    <?= $form->field($model, 'download_links_id')->textInput() ?>

    <?= $form->field($model, 'is_featured')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'college_image_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

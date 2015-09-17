<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UniversitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="university-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'website') ?>

    <?= $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'banner') ?>

    <?php // echo $form->field($model, 'establish') ?>

    <?php // echo $form->field($model, 'important_links_id') ?>

    <?php // echo $form->field($model, 'download_links_id') ?>

    <?php // echo $form->field($model, 'is_verified') ?>

    <?php // echo $form->field($model, 'is_featured') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'statutory_body_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CollegeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="college-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'university_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'banner') ?>

    <?php // echo $form->field($model, 'establish') ?>

    <?php // echo $form->field($model, 'statutory_body_id') ?>

    <?php // echo $form->field($model, 'important_links_id') ?>

    <?php // echo $form->field($model, 'download_links_id') ?>

    <?php // echo $form->field($model, 'is_featured') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'college_image_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

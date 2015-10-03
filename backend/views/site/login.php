<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
      <div class="login-box-body">
          <div class="login-logo">
        <a href="../../index2.html"><b>Login</b></a>
      </div>
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
          <div class="form-group has-feedback">
            <?= $form->field($model, 'username')->textInput(['placeholder' =>'username'])->label(FALSE) ?>
          </div>
          <div class="form-group has-feedback">
            <?= $form->field($model, 'password')->passwordInput(['password'])->label(FALSE) ;?>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div><!-- /.col -->
          </div>
         <?php ActiveForm::end(); ?>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


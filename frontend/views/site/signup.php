<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\base\Widget;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\base\View;
use yii\helpers\Url;
use yii\web\Application;
//$this->title = 'Signup';
//$this->params['breadcrumbs'][] = $this->title;
?>

<section class="login-box">
    <div class="container">
        <div class="row">
           <div class="col-md-12">
           		<div class="register-form">
                	 <h1>Sign Up</h1>
            		 <p class="addmarginB30">Already have an account? <a href="login.php">Log in</a></p>                     
                     <div class="formElements">
                     	<?php $form=ActiveForm::begin([
                            'id' => 'form-signup',
                            'enableAjaxValidation'=>false,
                            'enableClientValidation'=>true,
                            'validateOnSubmit'=>true,
                            'options'=>['enctype' => 'multipart/form-data']]);?>
                     	<div class="col-2 social-signin clearfix">
                        	<div class="col col1">
                            	<a class="fb" href="signup-02.php"><i></i>Sign Up</a>
                            </div>
                            <div class="col col2">
                            	<a class="gplus" href="signup-02.php"><i></i>Sign Up</a>
                            </div>
                        </div> 
                     	<div class="col-2 clearfix">
                            <div class="col col1">
                            	<?php echo $form->field($usermodel,'fname')->textInput(['class' =>'form-control' ,'placeholder' =>'First Name'])->label(false);?>
                            </div>
                            <div class="col col2">
                            	<?php echo $form->field($usermodel,'lname')->textInput(['class' =>'form-control' ,'placeholder' =>'Last Name'])->label(false);?>
                            </div>
                        </div> 
                        <div class="col-2 clearfix">
                        	<div class="col col1">
                            	<?php echo $form->field($usermodel,'email')->input('email' ,['class' =>'form-control' ,'placeholder' =>'Email'])->label(false);?>
                            </div>
                            <div class="col col2">
                            	<?php echo $form->field($usermodel,'password')->passwordInput(['class' =>'form-control' ,'placeholder' =>'Password'])->label(false);?>
                            </div>
                        </div> 
                        <div class="col-2 addmarginB25 clearfix">
                        	<div class="col col1">
                            	<?php echo $form->field($usermodel,'phone')->textInput(['class' =>'form-control' ,'placeholder' =>'Phone /Mobile No.'])->label(false);?>
                            </div>
                            <div class="col col2">
                             <?php echo Html::dropDownList('country', '' , $countrymap ,['class' => 'form-control singleSelectBox']);?>
                            </div>
                        </div>                     	
                        <div class="text-center addmarginB25">
                        	<p>By Signing up, I agree to the <a href="#">terms & condition</a></p>
                        </div>
                         <?=  Html::submitButton('Signup', ['class' => 'btn', 'name' => 'signup-button']) ?>
                         <?php ActiveForm::end();?>
                     </div>
                </div>
           </div>
        </div>
    </div>
</section>

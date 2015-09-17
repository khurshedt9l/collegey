<?php
use yii\web\Session;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UrlManager;
?>

<section class="features-section">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="thanksDiv">
                    <?php if (Yii::$app->session->getFlash('registerFlash')): ?>
                        <p><?php echo Yii::$app->session->getFlash('registerFlash'); ?></p>
                    <?php endif; ?>                        
                        <a href="<?php echo Yii::$app->urlManager->createUrl('site/index'); ?>" class="button">Go Back to Home Page</a>
                </div>
            </div>
        </div>
    </div>
</section>
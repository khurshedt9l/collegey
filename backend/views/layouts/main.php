<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

//AppAsset::register($this);
$asset=backend\assets\AppAsset::register($this);
$baseUrl=$asset->baseUrl;
$route = Yii::$app->controller->id . '/' . $controllerId = Yii::$app->controller->action->id;
if($route=='site/login')
$bodyclass="hold-transition skin-blue sidebar-mini login-page";
else
$bodyclass="hold-transition skin-blue sidebar-mini";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?php echo $bodyclass;?>">
<?php $this->beginBody() ?>

<div class="wrap">
<?php if($route!='site/login') {?>
		<?= $this->render('header.php',['baseUrl' => $baseUrl]);?>
		<?= $this->render('leftmenu.php',['baseUrl' => $baseUrl]);?>
<?php }?>		
        <?= $this->render('content.php',['baseUrl' => $baseUrl,'content'=>$content]);?>
<?php if($route!='site/login') {?>
		<?= $this->render('footer.php',['baseUrl' => $baseUrl]);?>
		<?= $this->render('rightside.php',['baseUrl' => $baseUrl]);?>
<?php }?>
<div class="control-sidebar-bg"></div>
</div>
<?php $this->endBody() ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script>
      $.widget.bridge('uibutton', $.ui.button);
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(".singleSelectBox").select2({
	 minimumResultsForSearch: Infinity,	
  });
});
</script>
</body>
</html>
<?php $this->endPage() ?>

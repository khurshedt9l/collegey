<?php
	use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		  <?php $this->title;?>
		</h1>
		<?php Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],		
		])?>
	</section>
	<section class="container">
	   <?= $content ?>
	</section>

</div>

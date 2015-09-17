<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Universities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create University', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'website',
            'logo',
            // 'banner',
            // 'establish',
            // 'important_links_id',
            // 'download_links_id',
            // 'is_verified',
            // 'is_featured',
            // 'status',
            // 'created',
            // 'updated',
            // 'image',
            // 'statutory_body_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

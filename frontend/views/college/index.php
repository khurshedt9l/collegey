<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CollegeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colleges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="college-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create College', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'university_id',
            'name',
            'description:ntext',
            'website',
            // 'logo',
            // 'banner',
            // 'establish',
            // 'statutory_body_id',
            // 'important_links_id',
            // 'download_links_id',
            // 'is_featured',
            // 'created',
            // 'modified',
            // 'status',
            // 'college_image_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

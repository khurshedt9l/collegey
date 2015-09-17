<?php

namespace frontend\controllers;
use common\models\University;

class UniversityController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionDetail($id)
    {
        $model=University::findOne(['id'=>$id]);
        //echo "<pre>";print_r($model->downloadlinks);die;
        //$model_address=  \common\models\Address::findOne(['id'=>$model->id]);
        return $this->render('view' ,['model'=>$model]);
    }
    
}

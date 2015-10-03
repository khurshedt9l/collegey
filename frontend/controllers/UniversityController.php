<?php

namespace frontend\controllers;
use common\models\University;
use common\models\Address;

class UniversityController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model=  University::find()->all();
        return $this->render('index', ['model' =>$model]);
    }
    
    public function actionView($id)
    {
        $model=University::findOne(['id'=>$id]);
        //echo "<pre>";print_r($model->downloadlinks);die;
        //$model_address=  \common\models\Address::findOne(['id'=>$model->id]);
        return $this->render('view' ,['model'=>$model]);
    }
    
    public function actionSearch()
    {
     $stateID=$_POST['state_id'];
     $cityID=$_POST['city_id'];
     if(isset($stateID) && isset($cityID) && $stateID!='' && $cityID!='')
     {  //return $cityID;
         $model= \common\models\Address::find()->where(['state_id' =>$stateID, 'city_id' =>$cityID])->all();
     }
     else if(isset($stateID) && $stateID!='')
     {
      $model= \common\models\Address::find()->where(['state_id' =>$stateID])->all();   
     }
     else
     {
      $model= \common\models\Address::find()->all();    
     }
     $html='';
     foreach($model as $adrs)
     {
         $university= University::findOne(['id'=>$adrs->university_id]);
         
         $html.='<li class="mason-item">
                    	<div class="box">
                        	<div class="img">
                            	<a href="'. \Yii::$app->urlManager->createUrl(['university/view' ,'id'=>$university->id]) .'"><img src="'.$university->logo.'" /></a>
                            </div>
                            <div class="text-block">
                            	<h3><a href="university-detail.html">'.$university->name.'</h3></a>
                                <span class="text-span redBg">'.$adrs->city['name'].'</span>
                            </div>
                        </div>
                </li>';
     }
     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return $html;  
    }
    public function actionSearchcollege()
    {
        //echo "university search by state and city ";die;
      // $unvname=$_POST['name'];
       //echo $state=$_POST['state'];
       //echo $city=$_POST['city'];die;
     if(isset ($_POST['name']) && $_POST['name']!='')
     {
         $model=  University::find()->where(['name' => $_POST['name']])->all();
         return $this->render('index', ['model' =>$model]);
     }
 else if(isset ($_POST['state']) && $_POST['state']!='' && isset ($_POST['city']) && $_POST['city']!=''){
         $model= Address::find()->where(['state_id' =>$_POST['state'], 'city_id' =>$_POST['city']])->all();
         $universityID=array();
         foreach ($model as $val)
         {
             array_push($universityID, $val->university_id);  
         }
         $model=  University::find()->where(['IN','id',$universityID])->all();
         return $this->render('index', ['model' =>$model]);
     }
     else if(isset ($_POST['state']) && $_POST['state']!=''){
        $model= Address::find()->where(['state_id' =>$_POST['state']])->all();
         $universityID=array();
         foreach ($model as $val)
         {
             array_push($universityID, $val->university_id);  
         }
         $model=  University::find()->where(['IN','id',$universityID])->all();
         return $this->render('index', ['model' =>$model]);
     }
 else {
         $model=  University::find()->all();
         return $this->render('index', ['model' =>$model]);
     }
    }
    
}

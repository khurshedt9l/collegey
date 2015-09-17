<?php

namespace frontend\controllers;
use yii;
use common\models\Event;
use common\models\University;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class EventController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate()
    {   
        $img_move_to =\Yii::$app->basePath .'/web/images/uploads/';
        $model=new Event();
        $linksmodel=new \common\models\ImportantLink();
        $videomodel=new \common\models\EventVideo();
        $quickinfomodel=new \common\models\EventQuickInformation();
        $docmodel=new \common\models\Documents();
        $university=  University::find()->all();
        if (isset($_POST['Event']) && $_POST['EventVideo'] && $_POST['ImportantLink']) {
         $model->attributes = $_POST['Event'];
         $model->created=new \yii\db\Expression('NOW()');
         $start_date= explode('/', $_POST['Event']['start_date']);
         $model->start_date=$start_date[2] .'-'.$start_date[1] .'-'. $start_date[0];
         $close_date= explode('/', $_POST['Event']['close_date']);
         $model->close_date=$close_date[2] .'-'.$close_date[1] .'-'. $close_date[0];
         $linksmodel->attributes= $_POST['ImportantLink'];
         $videomodel->attributes=$_POST['EventVideo'] ;
         $quickinfomodel->attributes=$_POST['EventQuickInformation'] ;
         $docmodel->attributes=$_POST['Documents'] ;
         $banner=  UploadedFile::getInstance($model, 'banner');
         $ext=end(explode('.', $banner->name));
         $bannername=Yii::$app->security->generateRandomString('30').'.'.$ext;
         $model->banner='images/uploads/'.$bannername;
         $createddate=new \yii\db\Expression('NOW()');
         ///echo "<pre>";print_r($videomodel->attributes);die;         
         if($model->validate())
         {
         if($model->save())
         {
             $i=0;
             // saveing event multiple video links that comes in array 
         foreach ($videomodel->name as $vdata)
         {
          $videomodel->url=$videomodel['url'][$i];
          \Yii::$app->db->createCommand()
                  ->insert('tlb_event_video',['event_id' =>$model->id, 'name'=>$vdata, 'url'=>$videomodel['url'],'created'=>$createddate])
                  ->execute();
           $videomodel->attributes=$_POST['EventVideo'] ;           
           $i++;
         }
         //END saveing event multiple video links that comes in array
         $i=0;
         //saveing event multiple Important links that comes in array
         foreach ($linksmodel->name as $vdata)
         {
          $linksmodel->url=$linksmodel['url'][$i];
          \Yii::$app->db->createCommand()
                  ->insert('tlb_important_link',['event_id' =>$model->id, 'name'=>$vdata, 'url'=>$linksmodel['url'], 'is_live'=>1, 'created'=>$createddate])
                  ->execute();
           $linksmodel->attributes=$_POST['ImportantLink'] ;           
           $i++;
         }
         //END saveing event multiple Important links that comes in array
         //saveing event quickinformation links that comes in array
         $i=0;
         foreach ($quickinfomodel->title as $infodata)
         {
          $quickinfomodel->url=$quickinfomodel['url'][$i];
          \Yii::$app->db->createCommand()
                  ->insert('tbl_event_quick_information',['event_id' =>$model->id, 'title'=>$infodata, 'url'=>$quickinfomodel['url'], 'created'=>$createddate])
                  ->execute();
           $quickinfomodel->attributes=$_POST['EventQuickInformation'] ;           
           $i++;
         }
         //END saveing event quickinformation links that comes in array
         $i=0;
           //saveing event quickinformation links that comes in array
         foreach ($docmodel->title as $docdata)
         {
          $docmodel->url=$docmodel['url'][$i];
          \Yii::$app->db->createCommand()
                  ->insert('tbl_documents',['event_id' =>$model->id, 'title'=>$docdata, 'url'=>$docmodel['url'], 'created'=>$createddate])
                  ->execute();
           $docmodel->attributes=$_POST['Documents'] ;           
           $i++;
         }
         //END saveing event quickinformation links that comes in array
        
          //echo "<pre>";print_r($quickinfomodel->attributes);die;
         // $videomodel->event_id=$model->id;
          //$linksmodel->event_id=$model->id;
          //$videomodel->created=new \yii\db\Expression('NOW()');
          //$linksmodel->created=new \yii\db\Expression('NOW()');
          //$videomodel->save();
          //$linksmodel->save();
         $banner->saveAs ($img_move_to.$bannername);
         }
         }
        }
        return $this->render('create',['model' =>$model ,'university' =>$university]);
    }
    
    public function actionView($id)
    { 
            $model= Event::findOne(['id' =>$id]);
            return $this->render('view' ,['model' =>$model]);
    }

}

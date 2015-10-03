<?php

namespace backend\controllers;

use Yii;
use common\models\University;
use common\models\UniversitySearch;
use common\models\Address;
use common\models\Contacts;
use common\models\ImportantLink;
use common\models\DownloadLink;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Expression;


/**
 * UniversityController implements the CRUD actions for University model.
 */
class UniversityController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all University models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UniversitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single University model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new University model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $rootPath = str_replace(DIRECTORY_SEPARATOR.'backend', "", Yii::$app->basePath);
        $img_move_to = $rootPath.'/frontend/web/images/uploads/';
        
        $model = new University();
        $addressmodel= new Address();
        $contactmodel=new Contacts();
        $implink=new ImportantLink();
        $downloadlink=new DownloadLink();

        if ($model->load(Yii::$app->request->post())) {
            $image_logo= UploadedFile::getInstance($model, 'logo');
            $image_banner= UploadedFile::getInstance($model, 'banner');
            $model->logo=$image_logo->name;
            $ext_logo=end(explode('.', $image_logo));
            $ext_banner=end(explode('.', $image_banner));
            $rndstrngLogo=Yii::$app->security->generateRandomString('32').".".$ext_logo;
            $rndstrngBanner=Yii::$app->security->generateRandomString('32').".".$ext_banner;
            $path = Yii::$app->basePath . '/uploads/';
            $model->logo='images/uploads/'.$rndstrngLogo;
            $model->banner='images/uploads/'.$rndstrngBanner;
            $model->establish=$_POST['University']['establish'];
            $model->created=new Expression('NOW()');
            
            $addressmodel->address=$_POST['Address']['address'];
            $addressmodel->landmark=$_POST['Address']['landmark'];
            $addressmodel->country_id=$_POST['Address']['country_id'];
            $addressmodel->state_id=$_POST['Address']['state_id'];
            $addressmodel->city_id=$_POST['Address']['city_id'];
            $addressmodel->pincode=$_POST['Address']['pincode'];
            $addressmodel->created=new Expression('NOW()');
            
            $contactmodel->email=$_POST['Contacts']['email'];
            $contactmodel->landline=$_POST['Contacts']['landline'];
            $contactmodel->mobile=$_POST['Contacts']['mobile'];
            $contactmodel->created=new Expression('NOW()');
            $contactmodel->fax=$_POST['Contacts']['fax'];
            //$contactmodel->status=$_POST['University']['status'];
            
            $implink->name=$_POST['ImportantLink']['name'];
            $implink->url=$_POST['ImportantLink']['url'];
            
            $downloadlink->name=$_POST['DownloadLink']['name'];
            $downloadlink->url=$_POST['DownloadLink']['url'];
           if($model->save())
           {    $image_logo->saveAs ($img_move_to.$rndstrngLogo); 
                $image_banner->saveAs ($img_move_to.$rndstrngBanner); 
                $contactmodel->university_id=$model->id;
                $addressmodel->university_id=$model->id;
                
                $implink->university_id=$model->id;
                $downloadlink->university_id=$model->id;
                if($addressmodel->validate() && $contactmodel->validate() && $downloadlink->validate() && $implink->validate())
                {
                    $contactmodel->save();
                    $addressmodel->save();
                    $downloadlink->save();
                    $implink->save();
                } 
           }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing University model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing University model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the University model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return University the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = University::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

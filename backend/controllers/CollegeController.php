<?php

namespace backend\controllers;

use Yii;
use common\models\College;
use common\models\CollegeSearch;
use common\models\Address;
use common\models\Contacts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Expression;

/**
 * CollegeController implements the CRUD actions for College model.
 */
class CollegeController extends Controller
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
     * Lists all College models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CollegeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single College model.
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
     * Creates a new College model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new College();
        $addressmodel= new Address();
        $contactmodel=new Contacts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $image_logo= UploadedFile::getInstance($model, 'logo');
            $image_banner= UploadedFile::getInstance($model, 'banner');
            $model->logo=$image_logo->name;
            $ext_logo=end(explode('.', $image_logo));
            $ext_banner=end(explode('.', $image_banner));
            $rndstrngLogo=Yii::$app->security->generateRandomString('32').".".$ext_logo;
            $rndstrngBanner=Yii::$app->security->generateRandomString('32').".".$ext_banner;
            $path = Yii::$app->basePath . '/uploads/';
            $model->logo='backend/uploads/'.$rndstrngLogo;
            $model->banner='backend/uploads/'.$rndstrngBanner;
            $model->establish=$_POST['College']['establish'];
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
            $contactmodel->status=$_POST['College']['status'];
            
            if($model->save())
           {
                $image_logo->saveAs ($path.$rndstrngLogo); 
                $image_banner->saveAs ($path.$rndstrngBanner);
                $contactmodel->college_id=$model->id;
                $addressmodel->college_id=$model->id;
                if($addressmodel->validate() && $contactmodel->validate())
                {
                    $contactmodel->save();
                    $addressmodel->save();
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
     * Updates an existing College model.
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
     * Deletes an existing College model.
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
     * Finds the College model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return College the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = College::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

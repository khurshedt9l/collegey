<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\BackendLoginForm;
use common\models\States;
use common\models\City;
use yii\filters\VerbFilter;
use common\models\Userform;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'states' ,'city'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index' ,'states' ,'city'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin1()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogin()
    {
        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new BackendLoginForm();
       
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionStates(){
        
        $data='';
            $countryId = $_POST['country_id'];
        
 
        $states = \common\models\States::find()
                ->where(['countryID' => $countryId])
                ->orderBy('name ASC')
                ->all();
        $list="<option value=''>Select State</option>";
        if(count($states)>0){
            foreach($states as $state){
                $list.="<option value='".$state->id."'>".$state->name."</option>";
            }
        }
        else{
            $list= "<option>-</option>";
        }
        if (empty($data)) {
            $citydata = \common\models\Cities::findAll(['countryID' => $countryId]);
            $citylist="<option value=''>Select City</option>";
        if(count($citydata)>0){
            foreach($citydata as $city){
                $citylist.="<option value='".$city->id."'>".$city->name."</option>";
            }
        }
        else{
            $citylist= "<option>-</option>";
        }
        } else {
           $citylist= "<option>-</option>";
        }
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'list' => $list,
                //'ilist'=>$ilist,
                'citylist'=>$citylist,
                'code' => 100,
            ];
    }

    public function actionCity() { 
        
        $stateId = $_POST['state_id'];
        $citydata = \common\models\Cities::findAll(['stateID' => $stateId]);
        $citylist = "<option value=''>Select City</option>";
        if (count($citydata) > 0) {
            foreach ($citydata as $city) {
                $citylist.="<option value='" . $city->id . "'>" . $city->name . "</option>";
            }
        } else {
            $citylist = "<option>-</option>";
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [           
            'citylist' => $citylist,
            'code' => 100,
        ];
    }
}

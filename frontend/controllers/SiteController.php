<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Countries;
use common\models\Userform;
use common\models\LoginForm;
use yii\helpers\ArrayHelper;
use yii\web\UrlManager;
use frontend\models\SignupForm;
use yii\web\Request;
use yii\db\Expression;
use yii\web\Session;
use yii\web\User;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    { 
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup1()
    {
        $model = new SignupForm();
        if ($model->load( Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
       $countries=  Countries::find()->all();
       $countrymap= ArrayHelper::map($countries, 'countryID', 'countryName');
        return $this->render('signup', [
            'model' => $model,
            'countrymap' => $countrymap,
        ]);
    }
    
    public function actionSignup()
    {
        
        if (isset(Yii::$app->user->identity->id)) {
            $this->redirect(\yii\helpers\Url::to(['site/index']));
        }         
        $userModel = new Userform();

        if ($userModel->load(Yii::$app->request->post())) {
            $userModel->attributes = $_POST['Userform'];
           $valid = $userModel->validate();
            if ($valid) { 
                $userModel->status = 0;
                $userModel->setPassword( $userModel->password);
                $userModel->salt=$userModel->generateSaltkeyCustomFunction();
                $userModel->created=new \yii\db\Expression('NOW()');
                $userModel->session_id= session_id();
                $userrname=explode('@' ,  trim($userModel->email));
                $userModel->username=$userrname[0];
                $userModel->terms_agreed=1;
                $userModel->creation_ip = Yii::$app->request->userIP;
                try {
                    $userModel->save();
                    Yii::$app->session->setFlash('registerFlash','An email has been sent to your registered Email ID. Please verify it to access your account.');
                 //$this->redirect(Yii::$app->UrlManager->createUrl('site/flash'));
                 $this->redirect(Yii::$app->UrlManager->createUrl('user/profile'));
                } catch (Exception $e) {
                    Yii::$app->session->setFlash('registerFlash', $e->getMessage());
                }
            }
        }
$countries=  Countries::find()->orderBy(['countryName' =>SORT_ASC])->all();
       $countrymap= ArrayHelper::map($countries, 'countryID', 'countryName');
        return $this->render('signup', [
            'usermodel' => $userModel,
            'countrymap' => $countrymap,
        ]);
    }
    
    public function actionFlash() {
        return $this->render('flash');
    }
    
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
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
        $citydata = models\Cities::findAll(['stateID' => $stateId]);
        //$citydata = CHtml::listData($citydata, 'id', 'name');
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

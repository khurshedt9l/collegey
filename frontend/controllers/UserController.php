<?php

namespace frontend\controllers;
use yii;
use common\models\UserProfile;
use common\models\Userform;
use yii\web\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Address;
use common\models\UserPay;
use common\models\Cities;
use common\models\Education;
use common\models\CompetitiveExam;
use common\models\Certification;
use common\models\InterviewVideo;
use common\models\Video;
use common\models\MediaModule;
use yii\db\Expression;
use yii\web\Session;
use yii\web\UploadedFile;


class UserController extends \yii\web\Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile', 'update-profile','education', 'competitiveexam', 'certification' ,'interview' ,'home'],     
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],//use for anonymous users
                    ],
                    [
                        'actions' => ['profile', 'update-profile','education', 'competitiveexam', 'certification' ,'interview' ,'home'],
                        'allow' => true,
                        'roles' => ['@'],//all authenticate users
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'certification' => ['post'],
                    'competitiveexam' => ['post'],
                    
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionProfile() {
//        if(\Yii::$app->user->isGuest)            
//        return $this->redirect( Yii::$app->urlManager->createUrl('site/login'));
        $userdetails= \Yii::$app->user->identity;        
                $model = UserProfile::find()
                                      ->where(['user_id'=>$userdetails->id])
                                      ->one();              
               if(empty($model)){
                   $model=new UserProfile();
               }
        $address=Address::find()
                         ->where(['user_id' =>$userdetails->id])
                         ->one();
        if(empty($address))
        {
            $address=new Address();
        }
        $userpay=  UserPay::find()
                         ->where(['user_profile_id' =>$userdetails->id])
                         ->one();
        if(empty($userpay))
        {
            $userpay=new UserPay();
        }
        
         $user = Userform::findOne(['id'=>$userdetails->id]);
        if (!empty($model->image)) {
            $oldpic = $model->image;
        } else {
            $oldpic = '';
        }
//        if (isset($_POST['User'])) {
//            $user->fname = $_POST['User']['fname'];
//            $user->lname = $_POST['User']['lname'];
//            if ($user->validate(array('fname', 'lname'))) {
//                $user->update();
//            }
//        }

        if (isset($_POST['UserProfile'])) {

//            if (empty($_POST['UserProfile']['state_id'])) {
//                
//                $model->addError('state_id', 'Please select a state', array('class' => 'errorMsg'));
//                return $this->render('profile', ['model' => $model, 'user' => $user]);
////                 $model->validate();
////            echo "<pre>";print_r('hello');die;
//                Yii::$app->end();
//            }
            
            $model->attributes = $_POST['UserProfile'];
            if(isset($model) && $model->user_id){
                 $model->modified=new \yii\db\Expression('NOW()'); 
            }
            else{
            $model->created= new \yii\db\Expression('NOW()');
             }
            $model->user_id=Yii::$app->user->identity->id;
            $model->description=$_POST['UserProfile']['description'];
            $model->gender=$_POST['UserProfile']['gender'];
            //$model->phone=$_POST['UserProfile']['phone'];
            //$model->address=$_POST['UserProfile']['address'];
            //$model->city_id=$_POST['UserProfile']['city_id'];
            //$model->country_id=$_POST['UserProfile']['country_id'];
            //$model->zip=$_POST['UserProfile']['zip'];
            //$model->state_id=$_POST['UserProfile']['state_id'];
            $model->image = $oldpic;
//            if (!empty($_POST['userimage'])) {
//                $folder = 'userimages/';
//                $myArray = explode('_', $_POST['userimage'], 2);
//                $tmpfolder = yii::$app->basePath . DIRECTORY_SEPARATOR . "web" . DIRECTORY_SEPARATOR . "imgtemp" . DIRECTORY_SEPARATOR;
//                $name = Yii::$app->basePath . "/web/imgtemp/" . $_POST['userimage'];
//                if (file_exists($name)) {
//                $filename = $folder . $myArray[1];
//                
//                list($width, $height) = getimagesize($name);
//                $image = Yii::app()->iwi->load($name);
//                if($width >= 160 && $height >= 160){
//                $image->resize(160, 160, Iwi::NONE);}
//                $image->save();
//                $ar = explode('.', $filename);
//                $newname = $ar[0].'_160x160.'.$ar[1];
//                $dest = $tmpfolder . time() . '_usrimg' . $myArray[1];
//                copy($name, $dest);
//                SiteUtil::UploadS3($newname, $dest);
//                SiteUtil::UploadS3($filename, $dest);
//                
//                $image = Yii::app()->iwi->load($name);
//                if($width >= 70 && $height >= 70){
//                $image->resize(70, 70, Iwi::NONE);}
//                $image->save();
//                $ar = explode('.', $filename);
//                $newname = $ar[0].'_70x70.'.$ar[1];
//                $dest1 = $tmpfolder . time() . '_usrimgthumb' . $myArray[1];
//                copy($name, $dest1);
//                SiteUtil::UploadS3($newname, $dest1);
//                
//                $image = Yii::app()->iwi->load($name);
//                if($width >= 50 && $height >= 50){
//                $image->resize(50, 50, Iwi::NONE);}
//                $image->save();
//                $ar = explode('.', $filename);
//                $newname = $ar[0].'_50x50.'.$ar[1];
//                $dest2 = $tmpfolder . time() . '_usrimg1' . $myArray[1];
//                copy($name, $dest2);
//                SiteUtil::UploadS3($newname, $dest2);
//                
//                $image = Yii::app()->iwi->load($name);
//                if($width >= 35 && $height >= 35){
//                $image->resize(35, 35, Iwi::NONE);}
//                $image->save();
//                $ar = explode('.', $filename);
//                $newname = $ar[0].'_35x35.'.$ar[1];
//                $dest3 = $tmpfolder . time() . '_usrimg2' . $myArray[1];
//                copy($name, $dest3);
//                SiteUtil::UploadS3($newname, $dest3);
//          
//                unlink($name);
//                unlink($dest);
//                unlink($dest1);
//                unlink($dest2);
//                unlink($dest3);
//                  
//                $model->image = $filename;
//                }
//            }
            
            if ($model->validate() && $user->validate()) {
              
          $transaction=\Yii::$app->db->beginTransaction();
          try {
                if($model->save())
                {
                $address->user_id=$model->id;
                $address->address=$_POST['Address']['address'];
                $address->landmark=$_POST['Address']['landmark'];
                $address->pincode=$_POST['Address']['pincode'];
                $address->country_id=$_POST['Address']['country_id'];
                $address->state_id=$_POST['Address']['state_id'];
                $address->city_id=$_POST['Address']['city_id'];
                $userpay->user_profile_id=$model->id;
                $userpay->currency_id=1;
                $userpay->time_slot_id=5;
                $userpay->amount=$_POST['UserPay']['amount'];
                if($address->validate() && $userpay->validate())
                {$address->save();
                $userpay->save();
                }
                }
                $transaction->commit();
            }
       catch (Exception $e) 
            {
               $transaction->rollback();               
            }
         }
        }
        return $this->render('profile', ['model' => $model, 'user' => $user ,'address' =>$address ,'userpay'=>$userpay]);
    }
    
    public function actionUpdateProfile() {
        $rootPath = str_replace(DIRECTORY_SEPARATOR.'backend', "", Yii::$app->basePath);
        $img_move_to = $rootPath.'/web/images/uploads/';
        $userdetails= \Yii::$app->user->identity;        
                $model = UserProfile::find()
                                      ->where(['user_id'=>$userdetails->id])
                                      ->one();              
               if(empty($model)){
                   $model=new UserProfile();
               }
        $address=Address::find()
                         ->where(['user_id' =>$userdetails->id])
                         ->one();
        if(empty($address))
        {
            $address=new Address();
        }
        $userpay=  UserPay::find()
                         ->where(['user_profile_id' =>$userdetails->id])
                         ->one();
        if(empty($userpay))
        {
            $userpay=new UserPay();
        }
        
         $user = Userform::findOne(['id'=>$userdetails->id]);
        if (!empty($model->image)) {
            $oldpic = $model->image;
        } else {
            $oldpic = '';
        }
        if (isset($_POST['UserProfile'])) {           
            $model->attributes = $_POST['UserProfile'];
            if(isset($model) && $model->user_id){
                 $model->modified=new \yii\db\Expression('NOW()'); 
            }
            else{
            $model->created= new \yii\db\Expression('NOW()');
             }
            $model->user_id=$userdetails->id;
            $model->description=$_POST['UserProfile']['description'];
            $dateofbirth= explode('/', $_POST['UserProfile']['DOB']);
            $model->DOB=$dateofbirth[2] .'-'.$dateofbirth[1] .'-'. $dateofbirth[0];
            $model->gender=$_POST['UserProfile']['gender'];
            $model->image = $oldpic;
            $profileimg=UploadedFile::getInstance($model, 'image');
            $model->image=$profileimg->name;
            $ext=end(explode('.', $profileimg));
            $rndstrngprofile=Yii::$app->security->generateRandomString('32').".".$ext;
            $path = Yii::$app->basePath . '/uploads/';
            $model->image='images/uploads/'.$rndstrngprofile;
            
            if ($model->validate() && $user->validate()) {
              
          $transaction=\Yii::$app->db->beginTransaction();
          try {
                if($model->save())
                {
                $profileimg->saveAs ($img_move_to.$rndstrngprofile); 
                $address->user_id=$model->id;
                $address->address=$_POST['Address']['address'];
                $address->landmark=$_POST['Address']['landmark'];
                $address->pincode=$_POST['Address']['pincode'];
                $address->country_id=$_POST['Address']['country_id'];
                $address->state_id=$_POST['Address']['state_id'];
                $address->city_id=$_POST['Address']['city_id'];
                $userpay->user_profile_id=$model->id;
                $userpay->currency_id=1;
                $userpay->time_slot_id=5;
                $userpay->amount=$_POST['UserPay']['amount'];
                $user->fname=$_POST['Userform']['phone'];
                $user->lname=$_POST['Userform']['phone'];
                $user->phone=$_POST['Userform']['phone'];
                if($address->validate() && $userpay->validate())
                {
                    $address->save();$userpay->save();$user->save();
                }
                }
                $transaction->commit();
                }
       catch (Exception $e) 
            {
               $transaction->rollback();               
            }
         }
        }
        return $this->render('updateprofile', ['model' => $model, 'user' => $user ,'address' =>$address ,'userpay'=>$userpay]);
    }
     
    public function actionEducation() {
        $userdetails= \Yii::$app->user->identity;
        $model= Education::find()
                         ->where(['user_id' =>$userdetails->id])
                         ->one();
        if(empty($model))
        {
            $model=new Education();
        }
        
        $userprofile = UserProfile::find()
           ->where(['user_id'=>$userdetails->id])
           ->one();
               
               if(empty($userprofile)){
                   $userprofile=new UserProfile();
               }
               
         $user = Userform::find()
                       ->where(['id'=>$userdetails->id])
                       ->one();
               
               if(empty($user)){
                   $user=new Userform();
               }
               //echo "<pre>";print_r($user->competitiveExamDestails);die;
               if (isset($_POST['Education'])) {
               $model->attributes = $_POST['Education'];
               $model->user_id=$userdetails->id;
               $model->course_name=$_POST['Education']['course_name'];
               $model->branch=$_POST['Education']['course_name'];
               $model->school_college=$_POST['Education']['school_college'];
               $model->university_board=$_POST['Education']['university_board'];
               $model->is_passed=$_POST['Education']['is_passed'];
               $model->backlog=$_POST['Education']['backlog'];
               $model->total_marks=$_POST['Education']['total_marks'];
               $model->obtained_marks=$_POST['Education']['obtained_marks'];
               $attend_date= explode('/', $_POST['Education']['attend_date']);
               $model->attend_date=$attend_date[2] .'-'.$attend_date[1] .'-'. $attend_date[0];
               $passing_year= explode('/', $_POST['Education']['passing_year']);
               $model->passing_year=$passing_year[2] .'-'.$passing_year[1] .'-'. $passing_year[0];
               $model->description=$_POST['Education']['description'];
               
               if($model->validate())
               {
                   
                   if(isset($_POST['isnew']))
                   {
                    \Yii::$app->db->createCommand()->insert('tlb_education',[
                           'course_name' =>$model->course_name,
                           'branch' =>$model->branch,
                           'school_college' =>$model->school_college,
                           'university_board' =>$model->university_board,
                           'is_passed' =>$model->is_passed,
                           'backlog' =>$model->backlog,
                           'total_marks' =>$model->total_marks,
                           'obtained_marks' =>$model->obtained_marks,
                           'attend_date' =>$model->attend_date,
                           'passing_year' =>$model->passing_year,
                           'description' =>$model->description,                        
                           'created' =>new \yii\db\Expression('NOW()'),
                           'user_id' =>$userdetails->id,
                        ])->execute(); 
                   }
                   else {$model->save();}
                  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' =>$model,
                    ];
               }
               }
        return $this->render('education', ['model' => $model ,'user' => $user ,'userprofile' => $userprofile]);
    }
    
     public function actionCompetitiveexam() { 
         //echo "<pre>";print_r($_POST);die;
         $userdetails= \Yii::$app->user->identity;
         $model= CompetitiveExam::find()
                         ->where(['user_id' =>$userdetails->id])
                         ->one();
        if(empty($model))
        {
            $model=new CompetitiveExam();
        }
        $userprofile = UserProfile::find()
           ->where(['user_id'=>$userdetails->id])
           ->one();
               
               if(empty($userprofile)){
                   $userprofile=new UserProfile();
               }
         $user = Userform::find()
                       ->where(['id'=>$userdetails->id])
                       ->one();
               
               if(empty($user)){
                   $user=new Userform();
               }
               if (isset($_POST['CompetitiveExam'])) {
               $model->attributes = $_POST['CompetitiveExam'];
               $model->user_id=$userdetails->id;
               $date= explode('/', $_POST['CompetitiveExam']['date']);
               $model->date=$date[2] .'-'.$date[1] .'-'. $date[0];
               $model->name=$_POST['CompetitiveExam']['name'];
               $model->score=$_POST['CompetitiveExam']['score'];
               $model->percentile=$_POST['CompetitiveExam']['percentile'];
               $model->created=  new \yii\db\Expression('NOW()');
               if($model->validate())               {
                   if(isset($_POST['isnew']))
                   {
                       \Yii::$app->db->createCommand()->insert('tlb_competitive_exam',[
                            'name' =>$model->name,
                            'date' =>$model->date,
                           'score' =>$model->score,
                           'percentile' =>$model->percentile,
                           'created' =>new \yii\db\Expression('NOW()'),
                           'user_id' =>$userdetails->id,
                        ])->execute();
                   } 
                   else
                   {$model->save();}
                  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' =>$model,
                    ]; 
               }
               }
        //return $this->render('education', ['model' => $model ,'user' => $user ,'userprofile' => $userprofile]);
    }
    
    public function actionCertification() { 
        $userdetails= \Yii::$app->user->identity;
        $model= Certification::find()
                         ->where(['user_id' =>$userdetails->id])
                         ->one();
        if(empty($model))
        {
            $model=new Certification();
        }
        $userprofile = UserProfile::find()
           ->where(['user_id'=>$userdetails->id])
           ->one();
               
               if(empty($userprofile)){
                   $userprofile=new UserProfile();
               }
               
         $user = Userform::find()
                       ->where(['id'=>$userdetails->id])
                       ->one();
               
               if(empty($user)){
                   $user=new Userform();
               }
               if (isset($_POST['Certification'])) {
                   
               $model->attributes = $_POST['Certification'];
               $model->user_id=$userdetails->id;
               $model->name=$_POST['Certification']['name'];
               $model->certification_authority=$_POST['Certification']['certification_authority'];
               $model->licence_no=$_POST['Certification']['licence_no'];
               $attended_date= explode('/', $_POST['Certification']['attended_date']);
               $model->attended_date=$attended_date[2] .'-'.$attended_date[1] .'-'. $attended_date[0];
               $completion_date= explode('/', $_POST['Certification']['completion_date']);
               $model->completion_date=$completion_date[2] .'-'.$completion_date[1] .'-'. $completion_date[0];
               $valid_upto= explode('/', $_POST['Certification']['valid_upto']);
               $model->valid_upto=$valid_upto[2] .'-'.$valid_upto[1] .'-'. $valid_upto[0];
               $model->created= new \yii\db\Expression('NOW()');
               
               if($model->validate())
               {
                   if(isset($_POST['isnew']))
                   {
                       \Yii::$app->db->createCommand()->insert('tlb_certification',[
                            'name' =>$model->name,
                            'certification_authority' =>$model->certification_authority,
                            'licence_no' =>$model->licence_no,
                            'attended_date' =>$model->attended_date,
                            'completion_date' =>$model->completion_date,
                            'valid_upto' =>$model->valid_upto,
                            'created' =>new \yii\db\Expression('NOW()'),
                            'user_id' =>$userdetails->id,
                        ])->execute();
                   } 
                   else
                   {$model->save();}
                  \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' =>$model,
                    ]; 
               }
               }
    }

    public function actionInterview() { 
        $userdetails= \Yii::$app->user->identity;        
        $model= InterviewVideo::find()
                         ->where(['user_id' =>$userdetails->id])
                         ->one();
                 //echo "<pre>";print_r($model->video);die;
        if(empty($model))
        {
            $model=new InterviewVideo();
        }
        
        $video = new Video();
           
               
         $user = Userform::find()
                       ->where(['id'=>$userdetails->id])
                       ->one();
               
               if(empty($user)){
                   $user=new Userform();
               }
               


          $userprofile = UserProfile::find()
                                ->where(['user_id'=>$userdetails->id])
                                ->one();
         if(empty($userprofile)){
             $userprofile=new UserProfile();
         }
               if (isset($_POST['Video'])) {
               $video->attributes = $_POST['Video'];
               $video->media_module_id=5;// id 5 is interview video type in tlb_media_module table           
               $model->user_id=$userdetails->id;
               if($video->validate())
               {
                  $video->save();
                  $model->video_id=$video->id;
                  $model->save();
               }
               }
        return $this->render('interview', ['model' => $model ,'user' => $user ,'video' => $video ,'userprofile' =>$userprofile]);
    }

    public function actionHome()
    {
        $model=Userform::findOne(['id' => \Yii::$app->user->identity->id]);       
        return $this->render('home', ['model' => $model]);
    }
    
}

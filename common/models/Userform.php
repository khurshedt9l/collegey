<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * This is the model class for table "tbl_user".
 *
 * @property string $id
 * @property string $fname
 * @property string $lname
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $password_strategy
 * @property integer $requires_new_password
 * @property string $phone
 * @property string $validation_key
 * @property string $creation_ip
 * @property string $lastlogin_ip
 * @property string $last_login_time
 * @property integer $terms_agreed
 * @property integer $is_locked_out
 * @property string $lock_out_time
 * @property integer $login_attempts
 * @property string $session_id
 * @property string $created
 * @property string $modified
 * @property integer $deleted
 * @property integer $user_level
 * @property integer $status
 *
 * @property BuBuyingRequest[] $buBuyingRequests
 * @property BuQuotations[] $buQuotations
 * @property InEventGoing[] $inEventGoings
 * @property TblCertificationBody[] $tblCertificationBodies
 * @property TblCertificationBody[] $tblCertificationBodies0
 * @property TblCompanyFollow[] $tblCompanyFollows
 * @property TblCompanyUser[] $tblCompanyUsers
 * @property TblConversation[] $tblConversations
 * @property TblConversation[] $tblConversations0
 * @property TblConversationConnect[] $tblConversationConnects
 * @property TblConversationReply[] $tblConversationReplies
 * @property TblFollowing[] $tblFollowings
 * @property TblIpayTxn[] $tblIpayTxns
 * @property TblOrderQuotation[] $tblOrderQuotations
 * @property TblPostComments[] $tblPostComments
 * @property TblPostLike[] $tblPostLikes
 * @property TblProductFollow[] $tblProductFollows
 * @property TblRating[] $tblRatings
 * @property TblTransaction[] $tblTransactions
 * @property TblUserForgotPassword[] $tblUserForgotPasswords
 * @property TblUserProfile $tblUserProfile
 */
class Userform extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    public $newPassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user';
    }
//public function behaviors()
//    {
//        return [
//            TimestampBehavior::className(),
//        ];
//    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email','fname','lname','password'], 'required'],
            [['requires_new_password', 'terms_agreed', 'is_locked_out', 'login_attempts', 'deleted', 'user_level', 'status'], 'integer'],
            [['last_login_time', 'lock_out_time', 'created', 'modified'], 'safe'],
            //[['session_id'], 'required'],
            [['fname', 'lname'], 'string', 'max' => 100],
            [['username', 'email', 'password', 'salt', 'session_id'], 'string', 'max' => 255],
            [['password_strategy', 'phone', 'validation_key'], 'string', 'max' => 50],
            [['creation_ip', 'lastlogin_ip'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'salt' => 'Salt',
            'password_strategy' => 'Password Strategy',
            'requires_new_password' => 'Requires New Password',
            'phone' => 'Phone',
            'validation_key' => 'Validation Key',
            'creation_ip' => 'Creation Ip',
            'lastlogin_ip' => 'Lastlogin Ip',
            'last_login_time' => 'Last Login Time',
            'terms_agreed' => 'Terms Agreed',
            'is_locked_out' => 'Is Locked Out',
            'lock_out_time' => 'Lock Out Time',
            'login_attempts' => 'Login Attempts',
            'session_id' => 'Session ID',
            'created' => 'Created',
            'modified' => 'Modified',
            'deleted' => 'Deleted',
            'user_level' => 'User Level',
            'status' => 'Status',
        ];
    }
    
    
    public function getCountries() {
        //$criteria = new CDbCriteria();
        //$criteria->condition='status = 1';
        //$criteria->order = 'countryName ASC';
        $countryModel = Country::find()
                ->where(['status'=>1])
                ->orderBy(['countryName'=>SORT_ASC])
                ->all();//model()->findAll($criteria);
            $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Product::find()->all(), 'countryID', 'countryName'));

        if ($countryModel) {
            $countryList =ArrayHelper::map($countryModel, 'countryID', 'countryName');
//            $countryList = Html::listData($countryModel, 'countryID', 'countryName');
            return $countryList;
        }
        return false;
    }
    
    public function getStates($countryId){
       $statesModel= States::find()->where(['countryID'=>$countryId])->orderBy(['name'=>SORT_ASC])->all();   
       if($statesModel){
           $stateList =ArrayHelper::map($statesModel, 'id', 'name');
           //$stateList=  CHtml::listData($statesModel, 'id', 'name');
           return $stateList;
       }else{
           return array();
       }
       
        
    }
    
    public function getCities($countryId){
        $cityModel= City::model()->findAllByAttributes(array('countryID'=>$countryId));
        if($cityModel){
            $cityList= CHtml::listData($cityModel, 'id', 'name');
            return $cityList;
        }else{
             return array();
        }
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyingRequests()
    {
        return $this->hasMany(BuyingRequest::className(), ['posted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotations::className(), ['seller_id' => 'id']);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return Userform::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->salt;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function setPasswordreturn($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
      $this->salt = Yii::$app->security->generateRandomString();
    }
    
    public function generateSaltkeyCustomFunction()
    {
      return Yii::$app->security->generateRandomString();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
   public function backvalidatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
       
    }
    
    public function getCertification()
    {
        return $this->hasMany(Certification::className(), ['user_id' => 'id']);
    }
    public function getCompetitiveExamDestails()
    {
        return $this->hasMany(CompetitiveExam::className(), ['user_id' => 'id']);
    }
    public function getCertifationdetails()
    {
        return $this->hasMany(Certification::className(), ['user_id' => 'id']);
    }
    public function getEducation()
    {
        return $this->hasMany(Education::className(), ['user_id' => 'id']);
    }
    
    public function getUserprofile()
    {
         return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }

}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $birth_date
 * @property string $gender
 * @property string $about
 * @property integer $pay_per_year
 * @property string $interested_in_learning
 * @property string $image
 * @property string $created
 * @property string $modified
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'gender'], 'required'],
            [['user_id'], 'integer'],
            [['DOB', 'created', 'modified'], 'safe'],
            [['description'], 'string'],
            [['gender'], 'string', 'max' => 1],
            [[ 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'DBO' => 'Date Of Birth',
            'gender' => 'Gender',
            'about' => 'About',
            'pay_per_year_id' => 'Pay Per Year',
            'interested_in_learning' => 'Interested In Learning',
            'image' => 'Image',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}

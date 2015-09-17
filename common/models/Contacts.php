<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_contacts".
 *
 * @property integer $id
 * @property integer $university_id
 * @property integer $college_id
 * @property integer $user_id
 * @property string $email
 * @property string $landline
 * @property string $mobile
 * @property string $fax
 * @property integer $status
 * @property string $created
 * @property string $updated
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_id', 'college_id', 'user_id', 'status'], 'integer'],
            [['email'], 'required'],
            [['created', 'updated'], 'safe'],
            [['email'], 'string', 'max' => 150],
            [['landline'], 'string', 'max' => 30],
            [['mobile'], 'string', 'max' => 20],
            [['fax'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'university_id' => 'University ID',
            'college_id' => 'College ID',
            'user_id' => 'User ID',
            'email' => 'Email',
            'landline' => 'Landline No.',
            'mobile' => 'Mobile No.',
            'fax' => 'Fax',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

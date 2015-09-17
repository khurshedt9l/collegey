<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_certification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $certification_authority
 * @property string $licence_no
 * @property string $attended_date
 * @property string $completion_date
 * @property integer $is_expired
 * @property string $valid_upto
 */
class Certification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_certification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name' ,'certification_authority' ,'licence_no'], 'required'],
            [['user_id', 'is_expired'], 'integer'],
            [['attended_date', 'completion_date', 'valid_upto','created','modified'], 'safe'],
            [['name', 'certification_authority', 'licence_no'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'certification_authority' => 'Certification Authority',
            'licence_no' => 'Licence No',
            'attended_date' => 'Attended Date',
            'completion_date' => 'Completion Date',
            'is_expired' => 'Is Expired',
            'valid_upto' => 'Valid Upto',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}

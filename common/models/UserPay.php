<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_pay".
 *
 * @property integer $id
 * @property integer $user_profile_id
 * @property integer $amount
 * @property integer $currency_id
 * @property integer $time_slot_id
 */
class UserPay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_pay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_profile_id', 'amount', 'currency_id', 'time_slot_id'], 'required'],
            [['user_profile_id', 'amount', 'currency_id', 'time_slot_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_profile_id' => 'User Profile ID',
            'amount' => 'Amount',
            'currency_id' => 'Currency ID',
            'time_slot_id' => 'Time Slot ID',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_address".
 *
 * @property integer $id
 * @property integer $university_id
 * @property integer $college_id
 * @property integer $user_id
 * @property string $address
 * @property string $landmark
 * @property integer $pincode
 * @property double $latitude
 * @property double $longitude
 * @property string $country_id
 * @property integer $state_id
 * @property integer $city_id
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['university_id', 'college_id', 'user_id', 'pincode', 'state_id', 'city_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['address', 'landmark'], 'string', 'max' => 255],
            [['country_id'], 'string', 'max' => 20],
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
            'address' => 'Address',
            'landmark' => 'Landmark',
            'pincode' => 'Pincode',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'country_id' => 'Country',
            'state_id' => 'State',
            'city_id' => 'City',
        ];
    }
    
            public function getAddress()
    {
        return $this->hasOne(Address::className(), ['university_id' => 'id']);
    }
    
    public function getCountries()
    {
        return $this->hasOne(Countries::className(), ['countryID' => 'country_id']);
    }
    public function getState()
    {
        return $this->hasOne(States::className(), ['id' => 'state_id']);
    }
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}

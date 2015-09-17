<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 * @property integer $stateID
 * @property string $countryID
 * @property double $latitude
 * @property double $longitude
 *
 * @property Countries $country
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['stateID'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name'], 'string', 'max' => 50],
            [['countryID'], 'string', 'max' => 3],
            [['countryID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['countryID' => 'countryID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'stateID' => 'State ID',
            'countryID' => 'Country ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['countryID' => 'countryID']);
    }
}

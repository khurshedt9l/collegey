<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property integer $id
 * @property string $name
 * @property string $countryID
 * @property double $latitude
 * @property double $longitude
 *
 * @property Countries $country
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryID'], 'required'],
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

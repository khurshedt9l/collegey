<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property string $countryID
 * @property string $countryName
 * @property string $localName
 * @property string $description
 * @property string $image
 * @property string $banner_image
 * @property integer $is_visible
 * @property string $code
 * @property string $region
 * @property string $continent
 * @property double $latitude
 * @property double $longitude
 * @property double $surfaceArea
 * @property integer $population
 * @property integer $status
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryID', 'localName', 'description', 'image', 'code', 'region', 'continent'], 'required'],
            [['is_visible', 'population', 'status'], 'integer'],
            [['continent'], 'string'],
            [['latitude', 'longitude', 'surfaceArea'], 'number'],
            [['countryID'], 'string', 'max' => 3],
            [['countryName'], 'string', 'max' => 52],
            [['localName'], 'string', 'max' => 45],
            [['description', 'image', 'banner_image'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 2],
            [['region'], 'string', 'max' => 26],
            [['code'], 'unique'],
            [['countryName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryID' => 'Country ID',
            'countryName' => 'Country Name',
            'localName' => 'Local Name',
            'description' => 'Description',
            'image' => 'Image',
            'banner_image' => 'Banner Image',
            'is_visible' => 'Is Visible',
            'code' => 'Code',
            'region' => 'Region',
            'continent' => 'Continent',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'surfaceArea' => 'Surface Area',
            'population' => 'Population',
            'status' => 'Status',
        ];
    }

}

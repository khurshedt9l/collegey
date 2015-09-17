<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_event".
 *
 * @property integer $id
 * @property integer $university_id
 * @property integer $college_id
 * @property string $name
 * @property string $description
 * @property string $banner
 * @property string $start_date
 * @property string $close_date
 * @property string $created
 * @property string $updated
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_id', 'college_id'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['start_date', 'close_date', 'created', 'updated'], 'safe'],
            [['name', 'banner'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'description' => 'Description',
            'banner' => 'Banner',
            'start_date' => 'Start Date',
            'close_date' => 'Close Date',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getUniversity()
    {
        return $this->hasOne(University::className(), ['id' =>'university_id']);
    }
    public function getLinks()
    {
        return $this->hasMany(ImportantLink::className(), ['event_id' =>'id']);
    }
    public function getVideos()
    {
        return $this->hasMany(EventVideo::className(), ['event_id' =>'id']);
    }
    public function getQuickinfo()
    {
        return $this->hasMany(EventQuickInformation::className(), ['event_id' =>'id']);
    }
    public function getDocument()
    {
        return $this->hasMany(Documents::className(), ['event_id' =>'id']);
    }
}

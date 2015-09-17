<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_event_video".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $name
 * @property string $url
 * @property integer $size
 * @property integer $duration
 * @property string $created
 * @property string $updated
 */
class EventVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_event_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'url'], 'required'],
            [['event_id', 'size', 'duration'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'name' => 'Name',
            'url' => 'Url',
            'size' => 'Size',
            'duration' => 'Duration',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

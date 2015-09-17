<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_event_quieck_information".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $created
 * @property string $updated
 */
class EventQuickInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_event_quick_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id',], 'integer'],
            [['event_id'], 'required'],
            [['created', 'updated'], 'safe'],
            [['title', 'url'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'url' => 'Url',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

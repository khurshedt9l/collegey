<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_video".
 *
 * @property integer $id
 * @property integer $interview_video_id
 * @property integer $url
 * @property integer $size
 * @property integer $duration
 * @property integer $media_module_id
 * @property string $created
 * @property string $updated
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_module_id'], 'required'],
            [['size', 'duration', 'media_module_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [[ 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'interview_video_id' => 'Interview Video ID',
            'url' => 'Url',
            'size' => 'Size',
            'duration' => 'Duration',
            'media_module_id' => 'Media Module ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

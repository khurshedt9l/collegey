<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_interview_video".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $video_id
 */
class InterviewVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_interview_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'video_id'], 'required'],
            [['user_id', 'video_id'], 'integer'],
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
            'video_id' => 'Video ID',
        ];
    }
    
    public function getVideo()
    {
        return $this->hasOne(Video::className(), ['id' =>'video_id']);
    }
}

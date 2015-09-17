<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tbl_documents".
 *
 * @property integer $id
 * @property integer $university_id
 * @property integer $event_id
 * @property string $title
 * @property string $url
 * @property string $created
 * @property string $updated
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_id', 'event_id'], 'integer'],
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
            'university_id' => 'University ID',
            'event_id' => 'Event ID',
            'title' => 'Title',
            'url' => 'Url',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_download_link".
 *
 * @property integer $id
 * @property integer $university_id
 * @property integer $college_id
 * @property string $name
 * @property string $url
 * @property string $activate_date
 * @property string $deactivate_date
 * @property integer $is_live
 * @property integer $is_featured
 * @property string $created
 * @property string $modified
 * @property integer $deleted
 */
class DownloadLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_download_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_id', 'college_id', 'is_live', 'is_featured', 'deleted'], 'integer'],
            //[['name', 'url'], 'required'],
            [['activate_date', 'deactivate_date', 'created', 'modified'], 'safe'],
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
            'university_id' => 'University ID',
            'college_id' => 'College ID',
            'name' => 'Name',
            'url' => 'Url',
            'activate_date' => 'Activate Date',
            'deactivate_date' => 'Deactivate Date',
            'is_live' => 'Is Live',
            'is_featured' => 'Is Featured',
            'created' => 'Created',
            'modified' => 'Modified',
            'deleted' => 'Deleted',
        ];
    }
}

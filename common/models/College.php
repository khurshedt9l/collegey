<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_college".
 *
 * @property integer $id
 * @property integer $university_id
 * @property string $name
 * @property string $description
 * @property string $website
 * @property string $logo
 * @property string $banner
 * @property string $establish
 * @property integer $statutory_body_id
 * @property integer $important_links_id
 * @property integer $download_links_id
 * @property integer $is_featured
 * @property string $created
 * @property string $modified
 * @property integer $status
 * @property integer $college_image_id
 */
class College extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_college';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_id'], 'required'],
            [['university_id', 'statutory_body_id', 'important_links_id', 'download_links_id', 'is_featured', 'status', 'college_image_id'], 'integer'],
            [['description'], 'string'],
            [['establish', 'created', 'modified'], 'safe'],
            [['name', 'website', 'logo', 'banner'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'description' => 'Description',
            'website' => 'Website',
            'logo' => 'Logo',
            'banner' => 'Banner',
            'establish' => 'Establish',
            'statutory_body_id' => 'Statutory Body ID',
            'important_links_id' => 'Important Links ID',
            'download_links_id' => 'Download Links ID',
            'is_featured' => 'Is Featured',
            'created' => 'Created',
            'modified' => 'Modified',
            'status' => 'Status',
            'college_image_id' => 'College Image ID',
        ];
    }
}

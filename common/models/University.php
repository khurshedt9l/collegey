<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_university".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $website
 * @property string $logo
 * @property string $banner
 * @property string $establish
 * @property integer $important_links_id
 * @property integer $download_links_id
 * @property integer $is_verified
 * @property integer $is_featured
 * @property integer $status
 * @property string $created
 * @property string $updated
 * @property string $image
 * @property integer $statutory_body_id
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_university';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['establish', 'created', 'updated'], 'safe'],
            [['important_links_id', 'download_links_id', 'is_verified', 'is_featured', 'status', 'statutory_body_id'], 'integer'],
            [['name', 'website', 'logo', 'banner', 'image'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'website' => 'Website',
            'logo' => 'Logo',
            'banner' => 'Banner',
            'establish' => 'Establish',
            'important_links_id' => 'Important Links ID',
            'download_links_id' => 'Download Links ID',
            'is_verified' => 'Is Verified',
            'is_featured' => 'Is Featured',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'image' => 'Image',
            'statutory_body_id' => 'Statutory Body ID',
        ];
    }
    
        public function getAddress()
    {
        return $this->hasOne(Address::className(), ['university_id' => 'id']);
    }
      public function getContact()
    {
        return $this->hasOne(Contacts::className(), ['university_id' => 'id']);
    }
    
     public function getImportantlinks()
    {
        return $this->hasMany(ImportantLink::className(), ['university_id' => 'id']);
    }
    
     public function getDownloadlinks()
    {
        return $this->hasMany(DownloadLink::className(), ['university_id' => 'id']);
    }
}

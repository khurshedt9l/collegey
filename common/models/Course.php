<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_course".
 *
 * @property integer $id
 * @property integer $college_id
 * @property integer $university_id
 * @property string $name
 * @property string $description
 * @property integer $eligibility
 * @property integer $course_type
 * @property string $start
 * @property string $complete
 * @property string $created
 * @property string $modified
 * @property integer $duration
 * @property integer $time_slot
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['college_id', 'university_id', 'eligibility', 'course_type', 'duration', 'time_slot'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['start', 'complete', 'created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'college_id' => 'College ID',
            'university_id' => 'University ID',
            'name' => 'Name',
            'description' => 'Description',
            'eligibility' => 'Eligibility',
            'course_type' => 'Course Type',
            'start' => 'Start',
            'complete' => 'Complete',
            'created' => 'Created',
            'modified' => 'Modified',
            'duration' => 'Duration',
            'time_slot' => 'Time Slot',
        ];
    }
}

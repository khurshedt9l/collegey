<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_education".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $course_name
 * @property string $description
 * @property string $branch
 * @property string $university_board
 * @property integer $total_marks
 * @property integer $obtained_marks
 * @property string $attend_date
 * @property string $passing_year
 * @property integer $is_passed
 * @property integer $backlog
 * @property string $document
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'total_marks', 'obtained_marks', 'is_passed', 'backlog'], 'integer'],
            [['description'], 'string'],
            [['attend_date', 'passing_year'], 'safe'],
            [['course_name', 'school_college'], 'string', 'max' => 250],
            [['branch', 'university_board', 'document'], 'string', 'max' => 255],
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
            'course_name' => 'Course Name',
            'description' => 'Description',
            'branch' => 'Branch',
            'university_board' => 'University Board',
            'total_marks' => 'Total Marks',
            'obtained_marks' => 'Obtained Marks',
            'attend_date' => 'Attend Date',
            'passing_year' => 'Passing Year',
            'is_passed' => 'Is Passed',
            'backlog' => 'Backlog',
            'document' => 'Document',
            'school_college' => 'School /College',
        ];
    }
}

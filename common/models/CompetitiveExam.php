<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tlb_competitive_exam".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $score
 * @property string $percentile
 * @property string $date
 * @property string $created
 * @property string $updated
 */
class CompetitiveExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tlb_competitive_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id' ,'name'], 'required'],
            [['user_id'], 'integer'],
            [['score', 'percentile'], 'number'],
            [['date', 'created', 'updated'], 'safe'],
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
            'user_id' => 'User ID',
            'name' => 'Name',
            'score' => 'Score',
            'percentile' => 'Percentile',
            'date' => 'Date',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}

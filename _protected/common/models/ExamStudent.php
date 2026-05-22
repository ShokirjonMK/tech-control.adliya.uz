<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam_student".
 *
 * @property int $id
 * @property int $student_id
 * @property int $exam_id
 * @property int $mark
 * @property int $group_id
 * @property int $uni_id
 * @property int $fan_id
 * @property int $smester
 */
class ExamStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [[ 'exam_id', 'mark', 'group_id', 'uni_id', 'fan_id', 'smester'], 'required'],
            [['user_update','user_create','student_id', 'exam_id', 'mark', 'group_id', 'uni_id', 'fan_id', 'smester'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'exam_id' => 'Exam ID',
            'mark' => 'Mark',
            'group_id' => 'Group ID',
            'uni_id' => 'Uni ID',
            'fan_id' => 'Fan ID',
            'smester' => 'Smester',
        ];
    }
}

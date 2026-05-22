<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam_permission".
 *
 * @property int $id
 * @property int $faculty_id
 * @property int $direction_id
 * @property int $group_id
 * @property int $fan_id
 * @property int $exam_id
 * @property string $start_date
 * @property string $finish_date
 * @property int $exam_name_id
 * @property int $course_number_id
 * @property int $status
 */
class ExamPermission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam_permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faculty_id', 'direction_id', 'group_id', 'fan_id', 'exam_id', 'start_date', 'finish_date', 'exam_name_id', 'course_number_id', 'status'], 'required'],
            [['faculty_id', 'direction_id', 'group_id', 'fan_id', 'exam_id', 'exam_name_id', 'course_number_id', 'status'], 'integer'],
            [['start_date', 'finish_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faculty_id' => 'Faculty ID',
            'direction_id' => 'Direction ID',
            'group_id' => 'Group ID',
            'fan_id' => 'Fan ID',
            'exam_id' => 'Exam ID',
            'start_date' => 'Start Date',
            'finish_date' => 'Finish Date',
            'exam_name_id' => 'Exam Name ID',
            'course_number_id' => 'Course Number ID',
            'status' => 'Status',
        ];
    }
}

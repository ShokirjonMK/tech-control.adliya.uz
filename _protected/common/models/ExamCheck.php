<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam_check".
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $course_id
 * @property int $fan_id
 * @property int $exam_name_id
 * @property int $student_id
 * @property string $description
 * @property int $mark
 * @property int $status
 * @property int $last_date 
 */
class ExamCheck extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'exam_check';
    }

    public function rules()
    {
        return [
            [['teacher_id', 'course_id', 'fan_id', 'exam_name_id', 'student_id', 'status'], 'required'],
            [['teacher_id', 'course_id', 'fan_id', 'exam_name_id', 'student_id', 'mark', 'status'], 'integer'],
            [['checked_pdf'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 888],
            [['last_date'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'teacher_id' => 'Teacher ID',
            'course_id' => 'Course ID',
            'fan_id' => 'Fan ID',
            'exam_name_id' => 'Exam Name ID',
            'student_id' => 'Student ID',
            'checked_pdf' => 'Checked Pdf',
            'description' => 'Description',
            'mark' => 'Mark',
            'status' => 'Holati',
            'last_date' => 'Oxirgi muddat',
        ];
    }
}
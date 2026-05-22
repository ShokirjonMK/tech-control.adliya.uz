<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam_answer".
 *
 * @property int $id
 * @property int $exam_name_id
 * @property int $faculty_id
 * @property int $direction_id
 * @property int $group_id
 * @property int $fan_id
 * @property string $answer_pdf
 * @property int $student_id
 * @property string $created_at
 * @property string $update_at
 */
class ExamAnswer extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exam_name_id', 'faculty_id', 'direction_id', 'group_id', 'fan_id', 'answer_pdf', 'student_id', 'created_at', 'update_at'], 'required'],
            [['exam_name_id', 'faculty_id', 'direction_id', 'group_id', 'fan_id', 'student_id'], 'integer'],
            [['created_at', 'update_at'], 'safe'],
            [['answer_pdf', 'original_name'], 'string', 'max' => 255],
            ['file', 'file', 'extensions' => ['pdf']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_name_id' => 'Exam Name ID',
            'faculty_id' => 'Faculty ID',
            'direction_id' => 'Direction ID',
            'group_id' => 'Group ID',
            'fan_id' => 'Fan ID',
            'answer_pdf' => 'Answer Pdf',
            'student_id' => 'Student ID',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
            'original_name' => 'Original Name',
        ];
    }
}

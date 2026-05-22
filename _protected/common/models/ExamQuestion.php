<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam_question".
 *
 * @property int $id
 * @property int $faculty_id
 * @property int $direction_id
 * @property int $group_id
 * @property int $fan_id
 * @property int $exam_name_id
 * @property string $file_pdf
 * @property string $title
 * @property int $status
 */
class ExamQuestion extends \yii\db\ActiveRecord
{
    public $file;
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faculty_id', 'direction_id', 'group_id', 'fan_id', 'exam_name_id', 'file_pdf', 'title', 'status'], 'required'],
            [['faculty_id', 'direction_id', 'group_id', 'fan_id', 'exam_name_id', 'status'], 'integer'],
            [['file_pdf', 'title'], 'string', 'max' => 255],
            ['file', 'file', 'extensions' => ['jpg', 'png','doc','docx', 'pdf']],
            //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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
            'exam_name_id' => 'Exam Name ID',
            'file_pdf' => 'File Pdf',
            'title' => 'Title',
            'status' => 'Status',
        ];
    }
}

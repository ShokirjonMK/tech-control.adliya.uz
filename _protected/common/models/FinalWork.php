<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "final_work".
 *
 * @property int $id
 * @property string $name
 * @property int $uni_id
 * @property int $group_id
 * @property int $smester
 * @property int $fan_id
 * @property int $teacher_id
 * @property int|null $student_id
 * @property string|null $qr_code
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property string|null $updated_by
 * @property string|null $answer_pdf
 * @property string|null $description
 * @property int|null $ball
 */
class FinalWork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'final_work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id'], 'required'],
            [['uni_id', 'group_id', 'smester', 'fan_id', 'teacher_id', 'student_id', 'status', 'created_by', 'ball'], 'integer'],
            [['created_at', 'updated_at', 'updated_by'], 'safe'],
            [['description'], 'string', 'max' => 655],
            [['name', 'qr_code', 'answer_pdf'], 'string', 'max' => 255],
             [['started_date', 'finished_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'uni_id' => 'Uni ID',
            'group_id' => 'Guruh nomi',
            'smester' => 'Smester',
            'fan_id' => 'Fan nomi',
            'teacher_id' => "O'qituvchilar",
            'student_id' => 'Student ID',
            'qr_code' => 'Qr Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'answer_pdf' => 'Answer Pdf',
            'description' => 'Description',
            'ball' => 'Ball',
        ];
    }
}
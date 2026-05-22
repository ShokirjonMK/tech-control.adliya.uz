<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "monitoring".
 *
 * @property int $id
 * @property int $student_id
 * @property int $group_id
 * @property int $faculty_id
 * @property int $direction_id
 * @property int $status
 * @property int $time_table_id
 * @property string $date
 * @property int $uni_id
 */
class Monitoring extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monitoring';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'group_id', 'faculty_id', 'direction_id', 'status', 'time_table_id', 'date', 'uni_id'], 'required'],
            [['id', 'student_id', 'group_id', 'faculty_id', 'direction_id', 'status', 'time_table_id', 'uni_id'], 'integer'],
            [['date'], 'safe'],
            [['id'], 'unique'],
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
            'group_id' => 'Group ID',
            'faculty_id' => 'Faculty ID',
            'direction_id' => 'Direction ID',
            'status' => 'Status',
            'time_table_id' => 'Time Table ID',
            'date' => 'Date',
            'uni_id' => 'Uni ID',
        ];
    }
}

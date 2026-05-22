<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "std_note".
 *
 * @property int $id
 * @property int $student_id
 * @property string $date
 * @property string $description
 * @property int $user_id
 * @property int $uni_id
 */
class StdNote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'std_note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'description', 'user_id', 'uni_id'], 'required'],
            [['student_id', 'user_id', 'uni_id'], 'integer'],
            [['date'], 'safe'],
            [['description'], 'string'],
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
            'date' => 'Date',
            'description' => 'Description',
            'user_id' => 'User ID',
            'uni_id' => 'Uni ID',
        ];
    }
}
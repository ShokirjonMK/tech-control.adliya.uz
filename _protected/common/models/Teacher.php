<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property int $teacher_id
 * @property int $kafedra_id
 * @property int $fan_id
 * @property int $lang_id
 * @property int $status
 */
class Teacher extends \yii\db\ActiveRecord
{

    public $rasm;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'kafedra_id', 'fan_id', 'lang_id'], 'required'],
            [['user_id', 'kafedra_id', 'fan_id', 'lang_id', 'status'], 'integer'],
            ['rasm', 'file', 'extensions' => ['jpg', 'png', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Teacher ID',
            'kafedra_id' => 'Kafedra ID',
            'fan_id' => 'Fan ID',
            'lang_id' => 'Lang ID',
            'status' => 'Status',
        ];
    }
}

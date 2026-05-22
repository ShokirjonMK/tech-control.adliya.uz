<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property int $id
 * @property int $exam_id
 * @property int $group_id
 * @property int $fan_id
 * @property int $status
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */


    public static function tableName()
    {
        return 'permission';
    }
    public $faculty;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exam_id', 'group_id', 'fan_id', 'status'], 'required'],
            [['faculty','uni_id','exam_id', 'group_id', 'fan_id', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' =>       'ID',
            'exam_id' =>  'Exam ID',
            'group_id' => 'Group ID',
            'fan_id' =>   'Fan ID',
            'uni_id' =>   'Uni ID',
            'status' =>   'Status',
        ];
    }
}

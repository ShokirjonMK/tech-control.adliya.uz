<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property string $name
 * @property int $mark
 * @property int $sort
 * @property int $uni_id
 * @property int $status
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mark', 'sort', 'uni_id', 'status'], 'required'],
            [['mark', 'sort', 'uni_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'mark' => 'Mark',
            'sort' => 'Sort',
            'uni_id' => 'Uni ID',
            'status' => 'Status',
        ];
    }
}

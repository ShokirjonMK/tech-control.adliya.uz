<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "para".
 *
 * @property int $id
 * @property string $name
 * @property string $time_start
 * @property string $time_end
 * @property int $sort
 * @property int $uni_id
 */
class Para extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'para';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'time_start', 'time_end', 'sort'], 'required'],
            [['id', 'sort', 'uni_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
//            [['time_start', 'time_end'], 'string', 'max' => 5],
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
            'name' => 'Name',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
            'sort' => 'Sort',
            'uni_id' => 'Uni ID',
        ];
    }
}

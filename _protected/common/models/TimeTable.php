<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "time_table".
 *
 * @property int $id
 * @property int $group_id
 * @property string $week_day
 */
class TimeTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [[ 'group_id', 'week_day'], 'required'],
            [['id', 'group_id','smester', ], 'integer'],
            [['week_day'], 'string'],
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
            'group_id' => 'Group ID',
            'week_day' => 'Week Day',
           
        ];
    }
    public function getGroup()
    {
        return $this->hasMany(Group::className(), ['group_id' => 'id']);
    }
    
    
}

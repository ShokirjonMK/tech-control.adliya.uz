<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property int $finance_type
 * @property int $group_id
 * @property int $status
 * @property int $user_id
 */
class Student extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['finance_type', 'group_id', 'user_id'], 'required'],
            [['finance_type', 'group_id', 'status', 'user_id'], 'integer'],
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
            'finance_type' => 'Ta`lim turi',
            'group_id' => 'Guruh nomi',
            'status' => 'Holari',
            'user_id' => 'User ID',
        ];
    }

}

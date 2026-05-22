<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_lib".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $uni_id
 * @property int $user_id
 * @property int $fan_id
 * @property string $created_at
 */
class CategoryLib extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_lib';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'uni_id', 'fan_id', 'user_id'], 'required'],
            [['status', 'uni_id', 'user_id', 'fan_id'], 'integer'],
            [['created_at'], 'safe'],
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
            'status' => 'Status',
            'uni_id' => 'Uni ID',
            'fan_id' => 'Fan Id',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }
}

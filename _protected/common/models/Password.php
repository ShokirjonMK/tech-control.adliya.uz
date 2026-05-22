<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "password".
 *
 * @property int $id
 * @property string $password
 * @property int $user_id
 * @property int $key_id
 * @property string $created_at
 * @property string $updated_at
 */
class Password extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'password';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'user_id', 'key_id'], 'required'],
            [['user_id', 'key_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['password'], 'string', 'max' => 191],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password' => 'Password',
            'user_id' => 'User ID',
            'key_id' => 'Key ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

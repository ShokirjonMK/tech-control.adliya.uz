<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "keys".
 *
 * @property int $id
 * @property string $key
 * @property string $created_at
 * @property string $updated_at
 */
class Keys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['key'], 'string', 'max' => 191],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

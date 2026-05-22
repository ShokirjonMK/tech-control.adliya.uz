<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "edu_type".
 *
 * @property int $id
 * @property string $name
 * @property int $uni_id
 * @property int $status
 * @property string $created_at
 */
class EduType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'edu_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'uni_id', 'status'], 'required'],
            [['uni_id', 'status'], 'integer'],
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
            'uni_id' => 'Uni ID',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kafedra".
 *
 * @property int $id
 * @property string $name
 * @property int $mudir_id
 * @property int $status
 * @property int $uni_id
 */
class Kafedra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kafedra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mudir_id', 'status', 'uni_id'], 'required'],
            [['id', 'mudir_id', 'status', 'uni_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'mudir_id' => 'Mudir ID',
            'status' => 'Status',
            'uni_id' => 'Uni ID',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fan".
 *
 * @property int $id
 * @property string $name
 * @property int $uni_id
 * @property int $kafedra_id
 */
class Fan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'kafedra_id'], 'required'],
            [['id', 'uni_id', 'kafedra_id'], 'integer'],
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
            'uni_id' => 'Uni ID',
            'kafedra_id' => 'Kafedra ID',
        ];
    }
}

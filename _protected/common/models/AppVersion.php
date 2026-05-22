<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app_version".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $version
 * @property string|null $definition
 * @property int|null $status
 */
class AppVersion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_version';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['definition'], 'string'],
            [['status', 'code'], 'integer'],
            [['name', 'version'], 'string', 'max' => 255],
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
            'version' => 'Version',
            'definition' => 'Definition',
            'status' => 'Status',
        ];
    }
}
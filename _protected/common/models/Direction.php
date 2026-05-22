<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "direction".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $uni_id
 * @property string $edu_type
 * @property string $mvdir_code
 * @property int $faculty_id
 */
class Direction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status','edu_type', 'faculty_id'], 'required'],
            [['status', 'uni_id', 'faculty_id'], 'integer'],
            [['name', 'edu_type', 'mvdir_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'status' => 'Holati',
            'uni_id' => 'Uni ID',
            'edu_type' => 'Ta`lim turi',
            'faculty_id' => 'Fakultet nomi',
            'mvdir_code' => 'Yo`nalish kodi',
        ];
    }
}
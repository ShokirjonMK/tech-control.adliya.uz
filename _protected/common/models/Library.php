<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "library".
 *
 * @property int $id
 * @property int $nomi
 * @property int $fan_id
 * @property int $course_id
 * @property int $user_id
 * @property string $fayl
 * @property int $uni_id
 * @property int $status
 * @property string $created_at
 */
class Library extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'fan_id', 'category', 'course_id', 'user_id', 'uni_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['fayl', 'name'], 'string', 'max' => 200],
            [['id'], 'unique'],
            ['file', 'file', 'extensions' => ['jpg', 'png','doc','docx', 'pdf']],
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
            'fan_id' => 'Fan ID',
            'course_id' => 'Course ID',
            'user_id' => 'User ID',
            'fayl' => 'Fayl',
            'uni_id' => 'Uni ID',
            'status' => 'Status',
            'category' => 'Category',
            'created_at' => 'Created At',
        ];
    }
}

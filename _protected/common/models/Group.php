<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $uni_id
 * @property int $faculty_id
 * @property int $direction_id
 * @property int $course_number
 * @property int $smester
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $kozim;

    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'uni_id', 'faculty_id', 'direction_id', 'course_number', 'smester'], 'required'],
            [['id','lang_id', 'status', 'uni_id', 'faculty_id', 'direction_id', 'course_number', 'smester'], 'integer'],
            [['name',], 'string', 'max' => 255],
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
            'name' => 'Guruh nomi',
            'status' => 'Holati',
            'uni_id' => 'Uni ID',
            'faculty_id' => 'Fakeltet nomi',
            'direction_id' => 'Mutaxasislik nomi',
            'course_number' => 'Kurs',
            'smester' => 'Semester',
            'lang_id' => 'Ta`lim tili',
        ];
    }
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }

    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

}

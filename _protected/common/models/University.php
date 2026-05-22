<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "university".
 *
 * @property int $id
 * @property string $name
 * @property string $bank_name
 * @property string $bank_adress
 * @property int $bank_hisob
 * @property int $INN
 * @property string $shartnoma
 * @property int $number
 * @property int $mfo
 * @property string $status
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['bank_hisob', 'INN', 'number', 'mfo'], 'integer'],
            [['status'], 'string'],
            [['name', 'bank_name', 'bank_adress', 'shartnoma'], 'string', 'max' => 255],
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
            'bank_name' => 'Bank Name',
            'bank_adress' => 'Bank Adress',
            'bank_hisob' => 'Bank Hisob',
            'INN' => 'Inn',
            'shartnoma' => 'Shartnoma',
            'number' => 'Number',
            'mfo' => 'Mfo',
            'status' => 'Status',
        ];
    }
}

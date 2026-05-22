<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "is_there".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $date
 * @property string|null $start_at
 * @property string|null $finish_at
 * @property int|null $uni_id
 * @property int|null $status
 * @property int|null $different
 */
class IsThere extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'is_there';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'uni_id', 'status', 'different'], 'integer'],
            [['date', 'start_at', 'finish_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date' => 'Date',
            'start_at' => 'Start At',
            'finish_at' => 'Finish At',
            'uni_id' => 'Uni ID',
            'status' => 'Status',
            'different' => 'Different',
        ];
    }
}

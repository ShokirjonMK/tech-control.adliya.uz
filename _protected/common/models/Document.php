<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $shartnoma
 * @property string|null $ob
 * @property string|null $pos
 * @property string|null $inn
 * @property string|null $inps
 * @property string|null $diplom
 */
class Document extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['shartnoma', 'ob', 'pos', 'inn', 'inps', 'diplom'], 'string', 'max' => 255],
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
            'user_id' => '',
            'shartnoma' => '',
            'ob' => '',
            'pos' => '',
            'inn' => '',
            'inps' => '',
            'diplom' => '',
        ];
    }
}

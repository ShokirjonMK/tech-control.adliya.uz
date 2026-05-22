<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "fast_messenger".
 *
 * @property integer $id
 * @property string $name
 * @property integer $views
 * @property integer $status
 * @property string $description
 * @property string $image
 * @property integer $sort
 * @property string $type
 * @property integer $rating
 */
class FastMessenger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fast_messenger';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['views', 'status', 'sort', 'rating'], 'integer'],
            [['name', 'description', 'image', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'views' => 'Views',
            'status' => 'Status',
            'description' => 'Description',
            'image' => 'Image',
            'sort' => 'Sort',
            'type' => 'Type',
            'rating' => 'Rating',
        ];
    }
}

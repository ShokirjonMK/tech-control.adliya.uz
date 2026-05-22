<?php

namespace common\helpers;


use common\models\Building;
use common\models\Room;
use phpDocumentor\Reflection\Types\Integer;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class RoomHelper
{

    public static function getStatusList(): array
    {
        return [
            Room::STATUS_ACTIVE => Yii::t('models', 'Актив'),
            Room::STATUS_INACTIVE => Yii::t('models', 'Неактив'),
        ];
    }


    public static function getStatusName(Integer $name)
    {
        return ArrayHelper::getValue(self::getStatusList(), $name);
    }

    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Room::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case Room::STATUS_INACTIVE:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getStatusList(), $status), [
            'class' => $class,
        ]);
    }


    public static function getBuildingList()
    {
        $subjectList = Building::find()
            ->select('building.id, building.name')
            ->all();

        return ArrayHelper::map($subjectList, 'id', function ($model) {
            return $model['name'];
        });
    }
}


<?php

namespace common\helpers;


use common\models\Building;
use phpDocumentor\Reflection\Types\Integer;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class BuildingHelper
{

    public static function getStatusList(): array
    {
        return [
            Building::STATUS_ACTIVE => Yii::t('models', 'Актив'),
            Building::STATUS_INACTIVE => Yii::t('models', 'Неактив'),
        ];
    }
    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case Building::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case Building::STATUS_INACTIVE:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getStatusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getStatusName(Integer $name)
    {
        return ArrayHelper::getValue(self::getStatusList(), $name);
    }


}


<?php

namespace common\helpers;


use common\models\MaterialBase;
use phpDocumentor\Reflection\Types\Integer;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class MaterialBaseHelper
{

    public static function getStatusList(): array
    {
        return [
            MaterialBase::STATUS_ACTIVE => Yii::t('models', 'Актив'),
            MaterialBase::STATUS_INACTIVE => Yii::t('models', 'Неактив'),
        ];
    }
    public static function getStatusLabel($status): string
    {
        switch ($status) {
            case MaterialBase::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            case MaterialBase::STATUS_INACTIVE:
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


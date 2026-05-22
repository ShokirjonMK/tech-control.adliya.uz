<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\Building $model
*/

$this->title = Yii::t('models', 'Bino');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Buildings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud building-create">

    <h1>
        <?= Yii::t('models', 'Bino') ?>
        <small>
                        <?= Html::encode($model->name) ?>
        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
         
        </div>
    </div>

    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>

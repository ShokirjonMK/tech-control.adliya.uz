<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\Room $model
*/

$this->title = Yii::t('models', 'Xona');
$this->params['breadcrumbs'][] = ['label' => Yii::t('models', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud room-create">

    <h1>
        <?= Yii::t('models', 'Xona') ?>
        <small>
                        <?= Html::encode($model->name) ?>
        </small>
    </h1>


    <hr />

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>

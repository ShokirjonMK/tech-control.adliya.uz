<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Yaroqliligi */

$this->title = 'Update Yaroqliligi: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Yaroqliligis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yaroqliligi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

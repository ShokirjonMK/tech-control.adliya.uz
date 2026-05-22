<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WhoRecive */

$this->title = 'Update Who Recive: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Who Recives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="who-recive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

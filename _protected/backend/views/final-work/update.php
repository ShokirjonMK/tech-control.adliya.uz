<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FinalWork */

$this->title = 'Update Final Work: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Final Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="final-work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

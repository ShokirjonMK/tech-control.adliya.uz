<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Holati */

$this->title = 'Update Holati: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Holatis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="holati-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TarkibiyBolinma */

$this->title = 'Update Tarkibiy Bolinma: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tarkibiy Bolinmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tarkibiy-bolinma-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

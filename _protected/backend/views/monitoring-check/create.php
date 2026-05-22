<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MonitoringCheck */

$this->title = 'Create Monitoring Check';
$this->params['breadcrumbs'][] = ['label' => 'Monitoring Checks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoring-check-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

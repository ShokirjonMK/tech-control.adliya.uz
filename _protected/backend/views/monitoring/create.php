<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Monitoring */

$this->title = 'Create Monitoring';
$this->params['breadcrumbs'][] = ['label' => 'Monitorings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitoring-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

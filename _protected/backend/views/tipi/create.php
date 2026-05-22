<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipi */

$this->title = 'Create Tipi';
$this->params['breadcrumbs'][] = ['label' => 'Tipis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

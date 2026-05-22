<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HowCome */

$this->title = 'Create How Come';
$this->params['breadcrumbs'][] = ['label' => 'How Comes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="how-come-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

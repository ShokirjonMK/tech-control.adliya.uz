<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WhoRecive */

$this->title = 'Create Who Recive';
$this->params['breadcrumbs'][] = ['label' => 'Who Recives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="who-recive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

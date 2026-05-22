<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kafedra */

$this->params['breadcrumbs'][] = ['label' => 'Kafedras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kafedra-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

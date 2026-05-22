<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Fan */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Fans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fan-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

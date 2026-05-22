<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Para */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Paras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="para-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

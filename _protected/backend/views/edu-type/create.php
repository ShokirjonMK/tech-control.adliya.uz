<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EduType */

$this->title = 'Create Edu Type';
$this->params['breadcrumbs'][] = ['label' => 'Edu Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edu-type-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

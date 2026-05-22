<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TarkibiyBolinma */

$this->title = 'Create Tarkibiy Bolinma';
$this->params['breadcrumbs'][] = ['label' => 'Tarkibiy Bolinmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarkibiy-bolinma-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

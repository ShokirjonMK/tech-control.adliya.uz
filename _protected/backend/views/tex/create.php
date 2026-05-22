<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TexMainBase */

$this->title = 'Create Tex Main Base';
$this->params['breadcrumbs'][] = ['label' => 'Tex Main Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tex-main-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

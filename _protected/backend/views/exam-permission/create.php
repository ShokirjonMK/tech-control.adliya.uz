<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExamPermission */

$this->title = 'Create Exam Permission';
$this->params['breadcrumbs'][] = ['label' => 'Exam Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

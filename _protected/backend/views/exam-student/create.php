<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExamStudent */

$this->title = 'Create Exam Student';
$this->params['breadcrumbs'][] = ['label' => 'Exam Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-student-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

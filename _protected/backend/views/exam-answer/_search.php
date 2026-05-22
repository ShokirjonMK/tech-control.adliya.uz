<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExamAnswerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-answer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'exam_name_id') ?>

    <?= $form->field($model, 'faculty_id') ?>

    <?= $form->field($model, 'direction_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'fan_id') ?>

    <?php // echo $form->field($model, 'answer_pdf') ?>

    <?php // echo $form->field($model, 'student_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

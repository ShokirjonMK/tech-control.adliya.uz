<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExamPermissionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-permission-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'faculty_id') ?>

    <?= $form->field($model, 'direction_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <?= $form->field($model, 'fan_id') ?>

    <?php // echo $form->field($model, 'exam_id') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'finish_date') ?>

    <?php // echo $form->field($model, 'exam_name_id') ?>

    <?php // echo $form->field($model, 'course_number_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

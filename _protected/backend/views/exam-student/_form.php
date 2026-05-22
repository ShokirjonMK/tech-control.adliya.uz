<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExamStudent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-create">
    <div class="card card-info" style="padding: 40px;">
        <div class="card-header" style="text-align: center;">
            <h3 class="card-title1 " style="text-align: center;">Exam Student yaratish</h3>
        </div>
        <br>

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?php $exam = \yii\helpers\ArrayHelper::map(\common\models\Exam::find()->all(), 'id', 'name'); ?>
            <?= $form->field($model, 'student_id')->textInput() ?>

            <?= $form->field($model, 'exam_id')->DropdownList($exam) ?>

            <?= $form->field($model, 'mark')->textInput() ?>

            <?= $form->field($model, 'group_id')->textInput() ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'fan_id')->textInput() ?>

            <?= $form->field($model, 'smester')->textInput() ?>

            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'Style'=>'width:100%; margin-top:32px']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>

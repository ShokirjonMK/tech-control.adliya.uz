<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UniversitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="university-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'bank_name') ?>

    <?= $form->field($model, 'bank_adress') ?>

    <?= $form->field($model, 'bank_hisob') ?>

    <?php // echo $form->field($model, 'INN') ?>

    <?php // echo $form->field($model, 'shartnoma') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'mfo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

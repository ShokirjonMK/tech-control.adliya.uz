<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TexSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tex-main-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tartib_raqami') ?>

    <?= $form->field($model, 'uzasbo_nomi') ?>

    <?= $form->field($model, 'tipi_id') ?>

    <?= $form->field($model, 'parametr') ?>

    <?php // echo $form->field($model, 'bino') ?>

    <?php // echo $form->field($model, 'tarkibiy_bolinma_id') ?>

    <?php // echo $form->field($model, 'inventar_ichki') ?>

    <?php // echo $form->field($model, 'yili') ?>

    <?php // echo $form->field($model, 'holati_id') ?>

    <?php // echo $form->field($model, 'yaroqliligi_id') ?>

    <?php // echo $form->field($model, 'inventar_b') ?>

    <?php // echo $form->field($model, 'partiya') ?>

    <?php // echo $form->field($model, 'dona_narx') ?>

    <?php // echo $form->field($model, 'partiya_narx') ?>

    <?php // echo $form->field($model, 'bino_qushimcha') ?>

    <?php // echo $form->field($model, 'how_come_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

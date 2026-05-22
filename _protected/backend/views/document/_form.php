<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>


<style>
    td {
        vertical-align: middle !important
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
                        <div class="card-header" style="text-align: center;">
                            <h3 class="card-title1 " style="text-align: center;">
                                <h2 style="text-align:center">Hujjat </h2>
                            </h3>
                        </div>
                        <br>
                        <div class="course-form">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'shartnoma')->textInput(['maxlength' => true]) ?>
                                    <?= $form->field($model, 'ob')->textInput(['maxlength' => true]) ?>
                                    <?= $form->field($model, 'pos')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
                                    <?= $form->field($model, 'inps')->textInput(['maxlength' => true]) ?>
                                    <?= $form->field($model, 'diplom')->textInput(['maxlength' => true]) ?>
                                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'margin-top:32px; width:100%']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


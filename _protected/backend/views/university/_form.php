<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
?>


<style>
    input[type=checkbox] {
        box-sizing: border-box;
        padding: 0;
        width: 50px;
        height: 38px;
    }

    .field-user-first {
        margin-top: 25px;
    }

    .weekDays-selector input {
        display: none !important;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        width: 30px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #2AD705;
        color: #ffffff;
    }
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
                                <h2 style="text-align:center"> Universitet</h2>
                            </h3>
                        </div>
                        <br>
                        <div class="university-form">

                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'bank_adress')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'bank_hisob')->textInput() ?>

                                    <?= $form->field($model, 'INN')->textInput() ?>

                                </div>
                                <div class="col-sm-6">

                                    <?= $form->field($model, 'shartnoma')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'number')->textInput() ?>

                                    <?= $form->field($model, 'mfo')->textInput(['maxlength' => 9]) ?>

                                    <?= $form->field($model, 'status')->dropDownList([1=>'Aktiv',2=>'Passiv']) ?>

                                    <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'style'=>'margin-top:32px; width:100%']) ?>

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

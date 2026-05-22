<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kafedra */
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
                                <h2 style="text-align:center">Kafedra</h2>
                            </h3>
                        </div>
                        <br>
                        <div class="kafedra-form">
                            <?php
                            $user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
                            $mudir = \yii\helpers\ArrayHelper::map(\common\models\User::find()
                                ->where(['uni_id'=>$user->uni_id, 'role_id'=>'Mudir'])
                                ->all(), 'id', 'full_name');

                            ?>
                            <?php $form = ActiveForm::begin(); ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Kafedra nomi') ?>
                                        <?= $form->field($model, 'mudir_id')->dropDownList($mudir)->label('Kafedra Mudiri') ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'status')->dropDownList([1=>'Aktiv', 0=>'Passiv'])->label('Holati') ?>
                                        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width:100%; margin-top:31px']) ?>
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

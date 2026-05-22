<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
//use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Para */
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
                                <h2 style="text-align:center"> Juftlik yaratish </h2>
                            </h3>
                        </div>
                        <br>
                        <div class="para-form">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nomi') ?>
                                    <?=$form->field($model, 'time_start')->textInput(['type' => 'time'])->label('Boshlash vaqti') ?>
                                </div>
                                <div class="col-sm-6">
                                    <?=$form->field($model, 'time_end')->textInput(['type' => 'time'])->label('Tugash vaqti') ?>
                                    <?= $form->field($model, 'sort')->dropDownList([1=>'Aktiv',0=>'Passiv'])->label('Holati') ?>
                                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width:100%']) ?>
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


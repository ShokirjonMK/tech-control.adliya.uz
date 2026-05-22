<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fan */
/* @var $form yii\widgets\ActiveForm */
$user=\common\models\User::find()
    ->where(['=', 'user.id', Yii::$app->user->id])
    ->one();
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
                                <h2 style="text-align:center">Tahrirlash </h2>
                            </h3>
                        </div>
                        <br>
                        <div class="fan-form">
                            <?php $form = ActiveForm::begin(); ?>
                            <?php  $kafedra = \yii\helpers\ArrayHelper::map(common\models\Kafedra::find()->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name');?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'kafedra_id')->dropDownList($kafedra) ?>
                                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width:100%; margin-top:32px']) ?>
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

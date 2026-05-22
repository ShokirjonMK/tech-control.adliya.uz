<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="user-create">
    <div class="card card-info" style="padding: 40px;">
        <div class="card-header" style="text-align: center;">
            <h3 class="card-title1 " style="text-align: center;">Oraliq tahrirlash</h3>
        </div>
        <br>
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nomi') ?>
                <?= $form->field($model, 'mark')->textInput()->label('Yuqori ball') ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'sort')->textInput()->label('Tartibi') ?>
                <?= $form->field($model, 'status')->dropDownList([1=>'Ochiq', 0=>'Yopiq'])->label('Holati') ?>
                
            </div>
            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success','style'=>'margin-top:32px; width:100%']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
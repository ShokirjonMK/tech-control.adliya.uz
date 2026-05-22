<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form yii\widgets\ActiveForm */
$user=\common\models\User::find()
    ->where(['=', 'user.id', Yii::$app->user->id])->one();?>



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
                                <h2 style="text-align:center"> Mutaxasislik </h2>
                            </h3>
                        </div>
                        <br>
                        <div class="direction-form">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                    <? $user=\common\models\User::find()
                                        ->where(['=', 'user.id', Yii::$app->user->id])->one();?>

                            <? if (!$user->uni_id == 4){?> 
                                    <?= $form->field($model, 'mvdir_code')->textInput(['maxlength' => true]) ?>

                            <? } ?>
                                    <?php $eduType =\yii\helpers\ArrayHelper::map(common\models\EduType::find()->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name') ?>

                                    <?= $form->field($model, 'edu_type')->dropDownList($eduType, ['options' => ['selected'=>true]]) ?>


                                </div>
                                <div class="col-sm-6">
                                    <?php $fak =\yii\helpers\ArrayHelper::map(common\models\Faculty::find()->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name') ?>
                            <? if (!$user->uni_id == 4){?> 

                                    <?php $id = Yii::$app->request->get('id')?>
                                    <?= $form->field($model, 'faculty_id')->dropDownList($fak, ['options' => [$id => ['selected'=>true]]]) ?>
                            <? } ?>
                                    
                                    <?= $form->field($model, 'status')->dropDownList([1=>'Aktiv',0=>'Passiv']) ?>
                                    <?= Html::submitButton('Saqlash ', ['class' => 'btn btn-success', 'style'=>'width:100%; margin-top:32px']) ?>
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

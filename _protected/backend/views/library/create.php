<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Library */
/* @var $form yii\widgets\ActiveForm */

$user = \common\models\User::find()->where(['id'=>Yii::$app->user->id])->one();
$course =  yii\helpers\ArrayHelper::map(\common\models\Course::find()->where(['uni_id'=>$user->uni_id, 'status'=>1])->all(), 'id', 'name');
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
                                <h2 style="text-align:center">Kategoriya yaratish</h2>
                            </h3>
                        </div>
                        <br>
                        <div class="course-form">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'name')->textInput() ?>
                                    
                                </div>
                                <div class="col-sm-6">

                                    <?= $form->field($model, 'status')->dropDownList([1=>'Aktiv', 2=>'Passiv'])->label('Holati')   ?>

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


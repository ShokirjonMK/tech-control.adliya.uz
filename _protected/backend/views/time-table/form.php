<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\TimeTable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-table-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row"> 
        <div class="col-sm-3">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-education"></i> Dars jadval</h4></div>

            <?= $form->field($model, 'group_id')->textInput() ?>

            <?= $form->field($model, 'week_day')
            ->dropDownList([ 1 => 'Dushanba', 2 => 'Seshanba', 3 => 'Chorshanba', 4 => 'Payshanba', 5 => 'Juma', 6 => 'Shanba', ], ['prompt' => '']) ?>
            <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
        </div>
        <?php  $para = \yii\helpers\ArrayHelper::map(common\models\Para::find()->all(), 'id', 'name');?>
        <?php  $fan = \yii\helpers\ArrayHelper::map(common\models\Fan::find()->all(), 'id', 'name');?>
        <?php  $teacher = \yii\helpers\ArrayHelper::map(common\models\Teacher::find()->all(), 'id', 'teacher_id');?>
        <?php  $xona = \yii\helpers\ArrayHelper::map(common\models\Room::find()->all(), 'id', 'name');?>

<!--  -->
        <div class="col-sm-8">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 6, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            
                            'model' => $modelsDarsjadval[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'para_id',
                                'fan_id',
                                'teacher_id',
                                'xona_id',
                                
                            ],
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                        ]); ?>

                        <div class="container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsDarsjadval as $i => $modelDarsjadval): ?>
                            <div class="item panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                   <div class="pull-right">
                                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        // necessary for update action.
                                        if (! $modelDarsjadval->isNewRecord) {
                                            echo Html::activeHiddenInput($modelDarsjadval, "[{$i}]id");
                                        }
                                    ?>
                                
                                
                                    <div class="row">
                                        <div class="col-sm-3">
                                            
                                            <?= $form->field($modelDarsjadval, "[{$i}]para_id", ['inputOptions' => ['class' => 'form-control mt-2' , 'placeholder'=>'Para id','required'=>'required'],])/*->dropDownList($para)*/->label(false);  ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelDarsjadval, "[{$i}]fan_id", ['inputOptions' => ['class' => 'form-control mt-2' , 'placeholder'=>'Fan id','required'=>'required'],])->label(false);  ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelDarsjadval, "[{$i}]teacher_id", ['inputOptions' => ['class' => 'form-control mt-2' , 'placeholder'=>'Teacher id','required'=>'required'],])->label(false);  ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($modelDarsjadval, "[{$i}]xona_id", ['inputOptions' => ['class' => 'form-control mt-2' , 'placeholder'=>'Xona id','required'=>'required'],])->label(false);  ?>

                                        </div>
                                    </div><!-- .row -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
            </div>
<!--  -->


    <?php ActiveForm::end(); ?>

</div>

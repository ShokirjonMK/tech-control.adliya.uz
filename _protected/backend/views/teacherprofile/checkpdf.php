<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<style>
    
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="course-teacher-view">
                    <div class="card card-info" style="padding: 40px; overflow-x: scroll;">
             <div class="room-form">

                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'description')->textarea(['rows' => '3', 'maxlength'=>250])->label('Izoh') ?>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row">
                                        <div class="col-sm-12">

                                    <?= $form->field($model, 'mark')->input('number', ['min'=>0,'max'=>$maxball])->label('Ball') ?>
                                        </div>

                                        <div class="col-sm-12 pb-2" style="margin-top: -24px;">

                                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success', 'style'=>'width:100%;margin-top:32px ']) ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>          
                        <br>
                        <div class="row">
                        <iframe src="<?= \yii\helpers\Url::to(['../../uploads/answer/' . $exam_answer->answer_pdf], true) ?>" style="width:100%; height:700px;" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
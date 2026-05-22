<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>

<div class="final-work-form">
    <div class="card card-info" style="padding: 40px;">
        <div class="card-header" style="text-align: center;">
            <h3 class="card-title1 " style="text-align: center;">Yakuniy</h3>
        </div>
        <br>
        <?php $form = ActiveForm::begin(['method' => 'post']); ?>
        <div class="row">
            <div class="col-sm-6">
            <? $user=\common\models\User::find()->where(['=', 'user.id', Yii::$app->user->id])->one();?>
            <?= $form->field($model, 'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Group::find()->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name'), ['options' => [$id => ['selected'=>true]]]) ?>
            
            <div class="row">
            <div class="col-sm-12" style="text-align: center;">

            <label>Tekshirish vaqtni belgilang: </label>
            </div>
            <div class="col-sm-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>

             <input required="" type="date" value="<?php echo date("Y-m-d");  ?>" class="form-control float-right" name="started_date">
                </div>
                </div>
            <div class="col-sm-6">

         <!-- <label>Oxirgi vaqtni belgilang: </label> -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>

             <input required="" type="date" value="" class="form-control float-right" name="finished_date">
                </div>
            </div>
            </div></div>
           
            <div class="col-sm-6">
            <?//= $form->field($model, 'teacher_id')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\User::find()->where(["uni_id"=>$user->uni_id])->andWhere(["role_id"=>"Teacher"])->all(), 'id', 'full_name'), ['options' => [$id => ['selected'=>true]]]) ?>
            <?= $form->field($model, 'fan_id')->dropDownList(\yii\helpers\ArrayHelper::map(common\models\Fan::find()->where(["uni_id"=>$user->uni_id])->all(), 'id', 'name'), ['options' => [$id => ['selected'=>true]]]) ?>
            <?= $form->field($model, 'status')->dropDownList([1=>'Ochiq', 0=>'Yopiq'])->label('Holati') ?>

            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success','style'=>'margin-top:32px; float:right; width:30%']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
